
<div class="row">
    <div class="col-lg-12">
        @if ($paginator->hasPages())
        <div class="product__pagination">
            @if($paginator->currentPage() != 1)
                <a href="{{ $paginator->url(1) }}" class=""><i class="fa-solid fa-angles-left"></i></a>
                <a href="{{ $paginator->url($paginator->currentPage()-1) }}" class=""><i class="fa-solid fa-angle-left"></i></a>
            @endif

            @if ($paginator->currentPage() > 3)
                <a class="" href="{{ $paginator->url(1) }}">1</a>
            @endif
            @if ($paginator->currentPage() > 4)
                <a class="">...</a>
            @endif
            @foreach (range(1, $paginator->lastPage()) as $i)
                @if ($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                    @if ($i == $paginator->currentPage())
                        <a class=" active">{{ $i }}</a>
                    @else
                        <a class="" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    @endif
                @endif
            @endforeach
            @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                    <a class="">...</a>
            @endif
            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                    <a class="" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
            @endif
            @if ($paginator->currentPage() != $paginator->lastPage()) 
                <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class=""><i class="fa-solid fa-angle-right"></i></a>
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class=""><i class="fa-solid fa-angles-right"></i></a>
            @endif
        </div>
        @endif
    </div>
</div>