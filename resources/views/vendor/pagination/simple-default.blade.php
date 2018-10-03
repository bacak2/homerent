@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif
        {{-- Pagination Elements --}}
        @notmobile
        @for($i = 1; $i <= $elements; $i++)
            @if ($i == $paginator->currentPage())
                <li class="page-item active"><a class="item active" href="/search/{{ $view."?".http_build_query(Request::except('page'))."&page=".$i }}">{{ $i }}</a></li>
            @else
                <li class="page-item"><a class="item" href="/search/{{ $view."?".http_build_query(Request::except('page'))."&page=".$i }}">{{ $i }}</a></li>
            @endif
        @endfor
        @endnotmobile
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="nextPage"><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
@endif
