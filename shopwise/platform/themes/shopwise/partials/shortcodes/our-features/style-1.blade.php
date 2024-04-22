<div class="section">
    <div class="container">
        <div class="row no-gutters">
            @for ($i = 1; $i < 4; $i++)
                <div class="col-md-4">
                    <div class="icon_box icon_box_style1">
                        <div class="icon">
                            <i class="{!! BaseHelper::clean($shortcode->{'icon' . $i}) !!}"></i>
                        </div>
                        <div class="icon_box_content">
                            <h5>{!! BaseHelper::clean($shortcode->{'title' . $i}) !!}</h5>
                            @if ($shortcode->{'description' . $i})
                                <p>{!! BaseHelper::clean($shortcode->{'description' . $i}) !!}</p>
                            @endif
                            @if ($shortcode->{'subtitle' . $i})
                                <p>{!! BaseHelper::clean($shortcode->{'subtitle' . $i}) !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
