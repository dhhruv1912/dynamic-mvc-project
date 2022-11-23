<div>
    <div class="bottom-0 position-fixed row w-85 mx-3 ">
        <div class="col-12">
            <div class="card shadow mb-2">
                <div class="card-body p-2">
                    <nav aria-label="Page navigation">
                        @if ($paginator->hasPages())
                        <ul class="pagination list-pagination justify-content-center mb-0">
                            <li class="page-item prev {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $paginator->url(1) }}" class="page-link"><i class='tf-icon bx bxs-chevrons-left' ></i></i></a>
                            </li>
                            <li class="page-item prev {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $paginator->url($paginator->currentPage()-1) }}" class="page-link"><i class='tf-icon bx bxs-chevron-left'></i></a>
                            </li>

                            @if ($paginator->currentPage() > 3)
                            <li class="page-item hidden-xs"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
                            @endif
                            @if ($paginator->currentPage() > 4)
                            <li class="page-item"><a class="page-link">...</a></li>
                            @endif
                            @foreach (range(1, $paginator->lastPage()) as $i)
                                @if ($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                                    @if ($i == $paginator->currentPage())
                                    <li class="page-item active"><a class="page-link active">{{ $i }}</a></li>
                                    @else
                                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                                    @endif
                                @endif
                            @endforeach
                            @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                                <li class="page-item"><a class="page-link">...</a></li>
                            @endif
                            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                                <li class="page-item hidden-xs"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
                            @endif
                            <li class="page-item next {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="page-link"><i class='tf-icon bx bxs-chevron-right' ></i></a>
                            </li>
                            <li class="page-item next {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link"><i class='tf-icon bx bxs-chevrons-right' ></i></a>
                            </li>
                        </ul>
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>