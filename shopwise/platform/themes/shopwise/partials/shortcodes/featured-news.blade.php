<div class="section pb_20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="heading_s1 text-center">
                    <h2>{!! BaseHelper::clean($title) !!}</h2>
                </div>
                <p class="leads text-center">
                @if ($description)
                    {!! BaseHelper::clean($description) !!}
                @endif
                @if ($subtitle)
                    {!! BaseHelper::clean($subtitle) !!}
                @endif
                </p>
            </div>
        </div>
        <div class="justify-content-center">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="blog_post blog_style2 box_shadow1">
                            <div class="blog_img">
                                <a href="{{ $post->url }}">
                                    <img src="{{ RvMedia::getImageUrl($post->image, 'small', false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}" loading="lazy" />
                                </a>
                            </div>
                            <div class="blog_content bg-white">
                                <div class="blog_text">
                                    <h5 class="blog_title"><a href="{{ $post->url }}">{{ $post->name }}</a></h5>
                                    <ul class="list_none blog_meta">
                                        <li><i class="ti-calendar"></i> {{ $post->created_at->translatedFormat('M d, Y') }}</li>
                                        <li><i class="eye"></i> {{ number_format($post->views) }} {{ __('Views') }}</li>
                                    </ul>
                                    <p>{{ Str::words($post->description, 35) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
