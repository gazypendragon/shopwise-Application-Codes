<ul class="nav nav-tabs justify-content-center {{ Arr::get($attributes ?? [], 'class') }}" id="tabmenubar" role="tablist">
    @foreach ($collections as $collection)
        <li class="nav-item">
            <a @class([
                'nav-link',
                'active' => $collection->id == $collectionId,
            ]) id="{{ $collection->slug }}-tab" data-toggle="tab" href="#{{ $collection->slug }}"
            role="tab" aria-controls="{{ $collection->slug }}" aria-selected="true"
            @if ($collection->id == $collectionId) data-loaded @endif data-ref="{{ $collection->slug }}"
            data-url="{{ route('public.ajax.products', ['collection_id' => $collection->id, 'limit' => $limit]) }}">{{ $collection->name }}</a>
        </li>
    @endforeach
</ul>
