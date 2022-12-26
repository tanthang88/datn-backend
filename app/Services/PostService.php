<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostCategory;

class PostService
{
    private mixed $perPage;
    public function __construct()
    {
        $this->perPage = request()->get('limit', 20);
    }

    /**
     * getListCate
     *
     * @return void
     */
    public function getListCategory()
    {
        return PostCategory::all();
    }

    /**
     * getListPostByCategory
     *
     * @param  PostCategory$category
     * @param  $select
     * @return Object
     */
    public function getListPostByCategory(PostCategory $category, $select = ['*'])
    {
        return Post::select($select)
            ->with('postCategory')
            ->when(!empty($category), function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
            ->when(!empty($category), function ($query) {
                $query->where('post_display', POST::POST_ACTIVE);
            })
            ->orderBy('id', 'DESC')
            ->paginate($this->perPage);
    }

    /**
     * getPost
     *
     * @param  Post $post
     * @param  array $select
     * @return Object
     */
    public function getPost(Post $post, array $select = ['*'])
    {
        $post->increment('post_view');
        return Post::select($select)
            ->where('id', $post->id)
            ->where('post_display', POST::POST_ACTIVE)
            ->first();
    }
}
