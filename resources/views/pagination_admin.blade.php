@if($paginator->hasPages())
<ul class="pagination">

    {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="paginate_button previous disabled">
        <a href="javascript:;">Previous</a>
    </li>
        @else
        <li class="paginate_button previous disabled">
        <a href="<?php echo $paginator->url( $paginator->currentPage() - 1 ); ?>">Previous</a>
    </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
        @endif
        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="active"><a class="paginate_button" href="javascript:;">{{ $page }}</a></li>
        @else
        <li class="paginate_button"><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())

        <li class="paginate_button next"><a href="{{ $paginator->nextPageUrl() }}">
                <img src="{{asset('public/images/pagright.png')}}" alt="" class="dpb">
            </a>
        </li>
        @else
        <li class="paginate_button next"><a href="javascript:;">
                <img src="{{asset('public/images/pagright.png')}}" alt="" class="dpb">
            </a>
        </li>
        @endif
</ul>
@endif