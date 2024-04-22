 <div class="section pb_20 small_pt">
    <div class="container">
        <div class="row">
            @for($i = 0; $i < count($ads); $i++)
                <div class="col-md-{{ $i % 2 == 0 ? 5 : 7 }}">
                    {!! $ads[$i] !!}
                </div>
            @endfor
        </div>
    </div>
</div>
