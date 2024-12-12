@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between ">
        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    {!! __('Hiển thị') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('đến') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('của') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('kết quả') !!}
                </p>
            </div>

            <div>
                <ul class="pagination ">
                    {{-- First Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link" style="color: #405189" >&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" style="color: #405189" href="{{ $paginator->url(1) }}">&laquo;</a>
                        </li>
                    @endif

                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link" style="color: #405189">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" style="color: #405189" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $currentPage = $paginator->currentPage();
                        $lastPage = $paginator->lastPage();
                        $start = max(1, $currentPage - 3);
                        $end = min($lastPage, $currentPage + 3);
                    @endphp

                    {{-- First Dots --}}
                    @if ($start > 1)
                        <li class="page-item disabled"><span class="page-link" style="color: #405189">...</span></li>
                    @endif

                    {{-- Page Numbers --}}
                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == $currentPage)
                            <li class="page-item active" aria-current="page">
                                <span class="page-link text-white" style="background-color: #405189; border-color: #405189;">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" style="color: #405189" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endfor

                    {{-- Last Dots --}}
                    @if ($end < $lastPage)
                        <li class="page-item disabled"><span class="page-link" style="color: #405189">...</span></li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" style="color: #405189" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link" style="color: #405189">&rsaquo;</span>
                        </li>
                    @endif

                    {{-- Last Page Link --}}
                    @if ($currentPage < $lastPage)
                        <li class="page-item">
                            <a class="page-link" style="color: #405189" href="{{ $paginator->url($lastPage) }}">&raquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link" style="color: #405189">&raquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif