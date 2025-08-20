<!-- controller -->
$products = Product::where('subcategory_id',$subcategory->id)->where('status',0)->paginate(20);


<!-- view -->
<div class="row">
    <div class="col-lg-12 col-sm-12">
        {{ $products->links() }}
        <!--or-->
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>


<!-- css for center -->
<style>
    .pagination {
        justify-content: center;
    }
</style>


<!-- bootstrap load na nila 8.0-->
<!-- app/Providers/AppServiceProvider.php -->
use Illuminate\Pagination\Paginator;

public function boot()
{
Paginator::useBootstrap();
}


$all_blog = Blog::paginate(8); // 8 posts per page

<!---Custom design paginaton-->
<div class="pagination_wrap">
    <ul>
        <!-- Previous Page Link -->
        @if ($all_blog->onFirstPage())
            <li class="disabled"><a href="#"><i class="far fa-angle-double-left"></i></a></li>
            @else
            <li><a href="{{ $all_blog->previousPageUrl() }}"><i class="far fa-angle-double-left"></i></a></li>
        @endif

        <!-- Pagination Elements -->
        @foreach ($all_blog->getUrlRange(1, $all_blog->lastPage()) as $page => $url)
            @if ($page == $all_blog->currentPage())
                <li><a href="{{ $url }}" class="current_page">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a></li>
            @elseif ($page == 1 || $page == $all_blog->lastPage() || ($page >= $all_blog->currentPage() - 1 && $page <= $all_blog->currentPage() + 1))
                <li><a href="{{ $url }}">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a></li>
            @elseif ($page == $all_blog->currentPage() - 2 || $page == $all_blog->currentPage() + 2)
                <li><a href="#"><i class="fal fa-ellipsis-h"></i></a></li>
            @endif
        @endforeach

        <!-- Next Page Link -->
        @if ($all_blog->hasMorePages())
            <li><a href="{{ $all_blog->nextPageUrl() }}"><i class="far fa-angle-double-right"></i></a></li>
        @else
            <li class="disabled"><a href="#"><i class="far fa-angle-double-right"></i></a></li>
        @endif
    </ul>
</div>