@if ($paginator->hasPages())
    <ul class="list-inline list-unstyled">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="prev disabled"><a href="javascript:void(0)" class="page-link"><i class="fa fa-angle-left"></i></a></li>
        @else
            <li class="prev"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-angle-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><a href="javascript:void(0)" class="page-link">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a href="javascript:void(0)" class="page-link">{{ $page }}</a></li>
                    @else
                        <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="next"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-angle-right"></i></a></li>
        @else
            <li class="next disabled"><a href="javascript:void(0)" class="page-link"><i class="fa fa-angle-right"></i></a></li>
        @endif
    </ul>
@endif