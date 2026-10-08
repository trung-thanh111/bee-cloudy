<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Repositories\PostCatalogueRepository;
use App\Repositories\ProductCatalogueRepository;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;
    protected $postService;
    protected $postCatalogueRepository;
    protected $productCatalogueRepository;

    public function __construct(
        PostRepository $postRepository,
        PostService $postService,
        PostCatalogueRepository $postCatalogueRepository,
        ProductCatalogueRepository $productCatalogueRepository
    ) {
        $this->postRepository = $postRepository;
        $this->postService = $postService;
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->postCatalogueRepository = $postCatalogueRepository;
    }
    public function index(Request $request)
    {
        $postCategories = $this->postCatalogueRepository->allWhere([
            ['publish', 1]
        ]);
        $productCategories = $this->productCatalogueRepository->allWhere([
            ['publish', '=', 1]
        ]);
        $postStandC1 = $this->postRepository->getLimitOrder(
            ['users'],
            [
                ['publish', 1],
                ['outstanding', 1],
            ],
            [
                ['created_at', 'asc'],
            ],
            []

        );
        $postStandC2 = $this->postRepository->getLimitOrder(
            ['users'],
            [
                ['publish', 1],
                ['outstanding', 1],
            ],
            [
                ['created_at', 'desc'],
            ],
            [],
            2
        );
        $postStandC3 = $this->postRepository->getLimitOrder(
            ['users'],
            [
                ['publish', 1],
                ['outstanding', 1],
            ],
            [
                ['created_at', 'asc'],
            ]
        );
        $postLikes = $this->postRepository->getLimitOrder(
            [],
            [
                ['publish', 1],
            ],
            [
                ['like', 'asc'],
            ],
            [],
            6
        );
        $postNew = $this->postService->paginateFontend($request);
        return view('fontend.post.index', compact(
            'postCategories',
            'productCategories',
            'postStandC1',
            'postStandC2',
            'postStandC3',
            'postLikes',
            'postNew',
        ));
    }
    public function detail($slug)
    {
        $post = $this->postRepository->findBySlug($slug, ['users', 'postCatalogues']);
        $postCatalogues = $this->postCatalogueRepository->allWhere([
            ['publish', 1]
        ]);
        $productCategories = $this->productCatalogueRepository->allWhere([
            ['publish', '=', 1]
        ]);
        $postCatalogueId = $post->postCatalogues->pluck('id')->toArray(); // lấy ra id danh mục đang đc xem ở bảng pivot và toArray chuyển thành mảng phẳng 
        $postSimilar = $this->postRepository->getLimitOrder(
            ['users', 'postCatalogues'],
            [
                ['publish', 1],
                ['id', '!=', $post->id],

            ],
            [
                ['created_at', 'desc']
            ],
            $postCatalogueId,
            4
        );
        return view('fontend.post.detail', compact(
            'post',
            'postCatalogueId',
            'postSimilar',
            'postCatalogues',
            'productCategories',
        ));
    }

    public function postInCategory($id)
    {

        $postCatalogue = $this->postCatalogueRepository->findById($id, ['childrenReference']);
        $productCategories = $this->productCatalogueRepository->allWhere([
            ['publish', '=', 1]
        ]);
        $postCatalogues = $this->postCatalogueRepository->allWhere([
            ['publish', 1],
            ['id', '!=', $postCatalogue->id],
        ]);
        $postCatalogueIds = collect([$id]);
        if ($postCatalogue->childrenReference->count() > 0) {
            $postCatalogueIds = $postCatalogueIds->merge($postCatalogue->childrenReference->pluck('id'));
        }
        // lấy bài viết thông qua mối quan hệ postCatalogues
        $postInCatagories = Post::whereHas('postCatalogues', function ($query) use ($postCatalogueIds) {
            $query->whereIn('post_catalogues.id', $postCatalogueIds);
        })
            ->where('publish', 1)
            ->paginate(9);
        return view('fontend.post.category', compact(
            'postCatalogue',
            'postInCatagories',
            'postCatalogues',
            'productCategories',
        ));
    }
}
