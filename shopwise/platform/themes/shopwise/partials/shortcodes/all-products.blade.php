<div class="section pt-0 small_pb">
    <div class="container">
        @if ($title)
            <div class="heading_tab_header">
                <div class="heading_s2">
                    <h2 class="h4">{!! BaseHelper::clean($title) !!}</h2>
                </div>
            </div>
        @endif
        @if ($products->isNotEmpty())
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 col-6">
                        {!! Theme::partial('product-item', compact('product')) !!}
                    </div>
                @endforeach
            </div>
            @if ($products instanceof Illuminate\Pagination\LengthAwarePaginator)
                <div class="shop__pagination">
                    {!! $products->withQueryString()->links() !!}
                </div>
            @endif
        @endif
    </div>
</div>
