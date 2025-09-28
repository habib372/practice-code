
<style>

.pagination {
    padding: 0;
}

.pagination li a, .pagination li span {
    color: #000;
    background: transparent;
    color: #000;
    margin: 2px;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    border-radius: 0;
}
.pagination li a,
.pagination li span {
    position: relative;
    float: left;
    padding: 10px 20px;
    line-height: 1.42857;
    text-decoration: none;
    border: 1px solid #ddd;
}

.pagination li a:first-child {
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    border-radius: 2px;
}

.pagination li a:hover,
.pagination li a:focus {
    background: #FFC300;
    color: #fff;
    border: 1px solid #FFC300;
}

@media screen and (max-width: 768px) {
    .pagination li a {
        padding: 7px 15px;
    }
}

.pagination li.active span {
    background: #FFC300;
    border: 1px solid #FFC300 !important;
}

.pagination li.active a:hover,
.pagination li.active a:focus {
    background: #FFC300;
    color: #fff;
    border: 1px solid #FFC300 !important;
}

 </style>


        <div class="row">
            <div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
                @if ($all_projects->hasPages())
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($all_projects->onFirstPage())
                            <li class="disabled"><span>&laquo;</span></li>
                        @else
                            <li>
                                <a href="{{ $all_projects->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($all_projects->links()->elements[0] as $page => $url)
                            @if ($page == $all_projects->currentPage())
                                <li class="active"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($all_projects->hasMorePages())
                            <li>
                                <a href="{{ $all_projects->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="disabled"><span>&raquo;</span></li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>