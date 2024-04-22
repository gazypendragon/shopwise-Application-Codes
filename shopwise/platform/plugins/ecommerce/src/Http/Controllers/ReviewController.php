<?php

namespace Botble\Ecommerce\Http\Controllers;

use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Facades\Assets;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Requests\SelectSearchAjaxRequest;
use Botble\Base\Supports\Breadcrumb;
use Botble\Ecommerce\Forms\ReviewForm;
use Botble\Ecommerce\Http\Requests\ReviewRequest;
use Botble\Ecommerce\Models\Customer;
use Botble\Ecommerce\Models\Product;
use Botble\Ecommerce\Models\Review;
use Botble\Ecommerce\Tables\ReviewTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/ecommerce::review.name'), route('reviews.index'));
    }

    public function index(ReviewTable $dataTable)
    {
        $this->pageTitle(trans('plugins/ecommerce::review.name'));

        Assets::addStylesDirectly('vendor/core/plugins/ecommerce/css/review.css');

        return $dataTable->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/ecommerce::review.create_review'));

        return ReviewForm::create()->renderForm();
    }

    public function store(ReviewRequest $request)
    {
        $review = Review::query()
            ->where('customer_id', $request->input('customer_id'))
            ->where('product_id', $request->input('product_id'))
            ->exists();

        if ($review) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage(trans('plugins/ecommerce::review.review_already_exists'));
        }

        $review = Review::query()->create($request->validated());

        event(new CreatedContentEvent('review', $request, $review));

        return $this
            ->httpResponse()
            ->setNextRoute('reviews.show', $review)
            ->withCreatedSuccessMessage();
    }

    public function show(Review $review): View
    {
        Assets::addScriptsDirectly('vendor/core/plugins/ecommerce/js/admin-review.js')
            ->addStylesDirectly('vendor/core/plugins/ecommerce/css/review.css');

        $review->load([
            'user',
            'reply',
            'reply.user',
            'product' => fn (BelongsTo $query) => $query
                ->withCount('reviews')
                ->withAvg('reviews', 'star'),
        ]);

        $this->pageTitle(trans('plugins/ecommerce::review.view', ['name' => $review->user->name]));

        return view('plugins/ecommerce::reviews.show', compact('review'));
    }

    public function destroy(Review $review)
    {
        return DeleteResourceAction::make($review);
    }

    public function ajaxSearchCustomers(SelectSearchAjaxRequest $request)
    {
        $customers = Customer::query()
            ->where(function (Builder $query) use ($request) {
                $query
                    ->where('name', 'LIKE', "%{$request->input('search')}%")
                    ->orWhere('email', 'LIKE', "%{$request->input('search')}%");
            })
            ->select('id', 'name')
            ->paginate();

        return $this
            ->httpResponse()
            ->setData($customers);
    }

    public function ajaxSearchProducts(SelectSearchAjaxRequest $request)
    {
        $products = Product::query()
            ->wherePublished()
            ->where('is_variation', false)
            ->where('name', 'LIKE', "%{$request->input('search')}%")
            ->select('id', 'name')
            ->paginate();

        return $this
            ->httpResponse()
            ->setData($products);
    }
}
