<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="heading_tab_header">
                <div class="heading_s2">
                    <h2 class="h4">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                </div>
                <div class="tab-style2">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#tabmenubar" aria-expanded="false">
                        <span class="ion-android-menu"></span>
                    </button>
                    @include(Theme::getThemeNamespace('partials.shortcodes.product-collections.nav-tabs', ['attributes' => ['class' => 'justify-content-md-end']]))
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="tab_slider">
                @foreach ($collections as $collection)
                    <div @class([
                        'tab-pane fade',
                        'show active' => $collection->id == $collectionId
                    ]) id="{{ $collection->slug }}" role="tabpanel" aria-labelledby="{{ $collection->slug }}-tab">
                        @if ($collection->id == $collectionId)
                            <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="true" data-dots="false"
                                data-nav="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                                @foreach($products as $product)
                                    <div class="item">
                                        {!! Theme::partial('product-item', compact('product')) !!}
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="half-circle-spinner">
                                <div class="circle circle-1"></div>
                                <div class="circle circle-2"></div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script type="text/x-custom-template" class="product-collection-items">
    <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="true" data-dots="false"
        data-nav="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
        __data__
    </div>
</script>

