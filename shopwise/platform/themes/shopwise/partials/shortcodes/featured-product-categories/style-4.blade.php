<div class="section pt-0 small_pb">
	<div class="container">
    	<div class="row">
        	<div class="col-12">
            	<div class="cat_overlap radius_all_5">
                	<div class="row align-items-center">
        				<div class="col-lg-3 col-md-4">
                        	<div class="text-center text-md-left">
                                <h2 class="h4">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                                @if ($shortcode->subtitle)
                                    <p class="mb-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</p>
                                @endif
                                @if ($shortcode->link)
                                    <a href="{{ url($shortcode->link) }}" class="btn btn-line-fill btn-sm">{!! BaseHelper::clean($shortcode->link_text ?: __('View All')) !!}</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8">
                            <div class="cat_slider mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "1"}, "380":{"items": "2"}, "991":{"items": "3"}, "1199":{"items": "4"}}'>
                                @foreach ($categories->loadMissing('metadata') as $category)
                                    <div class="item">
                                        <div class="categories_box">
                                            <a href="{{ $category->url }}">
                                                @if ($icon = $category->getMetaData('icon', true))
                                                    <i class="{{ $icon }}"></i>
                                                @else
                                                    <img src="{{ RvMedia::getImageUrl($category->getMetaData('icon_image', true) ?: $category->image, null, false, RvMedia::getDefaultImage()) }}" alt="category-image" loading="lazy" />
                                                @endif
                                                <span>{{ $category->name }}</span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION CATEGORIES -->
