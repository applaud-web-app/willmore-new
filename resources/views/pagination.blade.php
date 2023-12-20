

@if($paginator->hasPages())
<div class="paginationsec">
    <ul>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li><a href="#url">
                <img src="{{asset('public/images/pagleft.png')}}" alt="" class="dpb">
            </a>
        </li>
        @else
        <li class="page-item">
            <a href="<?php echo $paginator->url( $paginator->currentPage() - 1 ); ?>">
                <img src="{{asset('public/images/pagleft.png')}}" alt="" class="dpb">
            </a>
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
        <li><a href="javascript:;" class="actv">{{ $page }}</a></li>
        @else
        <li class="page-item"><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}">
                <img src="{{asset('public/images/pagright.png')}}" alt="" class="dpb">
            </a>
        </li>
        @else
        <li><a href="javascript:;">
                <img src="{{asset('public/images/pagright.png')}}" alt="" class="dpb">
            </a>
        </li>
        @endif
    </ul>
</div>
@endif