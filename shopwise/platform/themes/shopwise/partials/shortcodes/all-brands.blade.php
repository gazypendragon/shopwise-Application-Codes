<div class="section pt-0 small_pb">
    <div class="container">
        @if (clean($title))
            <div class="heading_tab_header">
                <div class="heading_s2">
                    <h2 class="h4">{!! BaseHelper::clean($title) !!}</h2>
                </div>
            </div>
        @endif
        @if ($brands->count() > 0)
            <div class="row">
                @foreach($brands as $brand)
                    <div class="col-md-3 col-6" style="margin-bottom: 10px;">
                        <a href="{{ $brand->url }}">
                            <img src="{{ RvMedia::getImageUrl($brand->logo) }}" alt="{{ $brand->name }}" loading="lazy" />
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
