<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCategoryResource;
use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostCategory;
use App\Services\PostService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function __construct(protected PostService $postService)
    {
    }

    /**
     * listCategories
     *
     * @return JsonResponse
     */
    public function listCategories()
    {
        try {
            $data = $this->postService->getListCategory();
            $listData = PostCategoryResource::collection($data);
            return $this->responseSuccess(['data' => $listData]);
        } catch (\Throwable $th) {
            Log::error("get list category ", $th);
            return $this->responseError(
                array(trans('alert.post.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * listPosts
     *
     * @param  PostCategory $category
     * @return \Illuminate\Http\Response
     */
    public function listPosts(PostCategory $category)
    {
        try {
            $posts = $this->postService->getListPostByCategory($category);
            $listData = PostResource::collection($posts);
            $posts->data = $listData;
            return $this->responseSuccess(['data' => $posts]);
        } catch (\Throwable $th) {
            Log::error("get post ", $th);
            return $this->responseError(
                array(trans('alert.post.get_list.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * show
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        try {
            $data = $this->postService->getPost($post);
            return $this->responseSuccess(['data' => PostDetailResource::make($data)]);
        } catch (\Throwable $th) {
            Log::error("get post ", $th);
            return $this->responseError(
                array(trans('alert.post.get_detail.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    public function showAll()
    {
        try {
            return $this->responseSuccess(['data' => PostDetailResource::collection(Post::select('*')->orderBy('id', 'DESC')->get())]);
        } catch (\Throwable $th) {
            Log::error("get post ", $th);
            return $this->responseError(
                array(trans('alert.post.get_detail.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
