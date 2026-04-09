@if ($paginator->hasPages())
    <nav class="pagination" aria-label="Pagination">

        {{-- Predchadzajuca --}}
        @if ($paginator->onFirstPage())
            <span class="page-link" aria-disabled="true">&lt;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link">&lt;</a>
        @endif

        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();

            $start = max($current - 1, 1);
            $end = min($current + 1, $last);
        @endphp

        {{-- Prva strana --}}
        @if ($start > 1)
            <a href="{{ $paginator->url(1) }}"
               class="page-link {{ $current === 1 ? 'active' : '' }}">
                1
            </a>
        @endif

        {{-- Lave bodky --}}
        @if ($start > 2)
            <span class="page-ellipsis">...</span>
        @endif

        {{-- Stredne strany --}}
        @for ($page = $start; $page <= $end; $page++)
            <a href="{{ $paginator->url($page) }}"
               class="page-link {{ $page === $current ? 'active' : '' }}"
               @if ($page === $current) aria-current="page" @endif>
                {{ $page }}
            </a>
        @endfor

        {{-- Bodky napravo --}}
        @if ($end < $last - 1)
            <span class="page-ellipsis">...</span>
        @endif

        {{-- Posledna strana --}}
        @if ($end < $last)
            <a href="{{ $paginator->url($last) }}"
               class="page-link {{ $current === $last ? 'active' : '' }}">
                {{ $last }}
            </a>
        @endif

        {{-- Dalsia strana --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link">&gt;</a>
        @else
            <span class="page-link" aria-disabled="true">&gt;</span>
        @endif

    </nav>
@endif
