@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">
                    <span class="d-none d-md-block">&lsaquo;</span>
                    <span class="d-block d-md-none">@lang('pagination.previous')</span>
                </span>
            </li>
        @else
            <li class="page-item">
                <button type="button" class="page-link" wire:click="previousPage" rel="prev" aria-label="@lang('pagination.previous')">
                    <span class="d-none d-md-block">&lsaquo;</span>
                    <span class="d-block d-md-none">@lang('pagination.previous')</span>
                </button>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @php
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
            $showPages = 8;
            $halfTotal = floor($showPages / 2);
            $start = max($currentPage - $halfTotal, 1);
            $end = min($start + $showPages - 1, $lastPage);
            $startSkip = max($start - 2, 1);
            $endSkip = min($end + 2, $lastPage);
        @endphp

        {{-- Numbered Page Links --}}
        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $currentPage)
                <li class="page-item active">
                    <span class="page-link">{{ $i }}</span>
                </li>
            @else
                <li class="page-item">
                    <button type="button" class="page-link" wire:click="gotoPage({{ $i }})">{{ $i }}</button>
                </li>
            @endif
        @endfor

        {{-- Ellipsis for Skip (Start) --}}
        @if ($startSkip > 1)
            @if ($startSkip > 2)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            @endif
            <li class="page-item">
                <button type="button" class="page-link" wire:click="gotoPage(1)">1</button>
            </li>
        @endif

        {{-- Ellipsis for Skip (End) --}}
        @if ($endSkip < $lastPage)
            <li class="page-item">
                <button type="button" class="page-link" wire:click="gotoPage({{ $lastPage }})">{{ $lastPage }}</button>
            </li>
            @if ($endSkip < $lastPage - 1)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            @endif
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <button type="button" class="page-link" wire:click="nextPage" rel="next" aria-label="@lang('pagination.next')">
                    <span class="d-block d-md-none">@lang('pagination.next')</span>
                    <span class="d-none d-md-block">&rsaquo;</span>
                </button>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">
                    <span class="d-block d-md-none">@lang('pagination.next')</span>
                    <span class="d-none d-md-block">&rsaquo;</span>
                </span>
            </li>
        @endif
    </ul>
@endif
;
