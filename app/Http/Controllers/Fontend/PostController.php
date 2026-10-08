<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use App\Repositories\PostCatalogueRepository;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;
    protected $postService;
    protected $postCatalogueRepository;

    public function __construct(
        PostRepository $postRepository,
        PostService $postService,
        PostCatalogueRepository $postCatalogueRepository
    ) {
        $this->postRepository = $postRepository;
        $this->postService = $postService;
        $this->postCatalogueRepository = $postCatalogueRepository;
    }
    public function index(Request $request)
    {
        $postCategories = $this->postCatalogueRepository->all();
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
        $postCatalogueId = $post->postCatalogues->pluck('id')->toArray(); // lấy ra id danh mục đang đc xem ở bảng pivot và toArray chuyển thành mảng phẳng 
        $postSimilar = $this->postRepository->getLimitOrder(
            ['users', 'postCatalogues'],
            [
                ['publish', 1],
                ['id', '!=', $post->id],

            ],
            [
                ['created_at', 'desc']
            ]
            ,
            $postCatalogueId,
            4
        );
        return view('fontend.post.detail', compact(
            'post',
            'postCatalogueId',
            'postSimilar',
        ));
    }
    public function search($request, $keyword = ''){

        return view('fontend.search.detail');
    }
}
