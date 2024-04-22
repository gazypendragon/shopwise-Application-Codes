<!-- START SECTION SHIPPING INFO -->
<div class="section small_pb">
    <div class="container">
        <div class="row no-gutters">
            @for ($i = 1; $i <= 4; $i++)
                <div class="col-lg-3 col-sm-6">	
                    <div class="icon_box icon_box_style3">
                        <div class="icon">
                            <i class="{!! BaseHelper::clean($shortcode->{'icon' . $i}) !!}"></i>
                        </div>
                        <div class="icon_box_content">
                            <h6>{!! BaseHelper::clean($shortcode->{'title' . $i}) !!}</h6>
                            @if ($sub = $shortcode->{'subtitle' . $i})
                                <p>{!! BaseHelper::clean($sub) !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
<!-- START SECTION SHIPPING INFO -->
