<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * return paginated list of posts
     * 
     * @return PostResource
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return PostResource::collection($posts);
    }

    /**
     * fetch and return posts
     * 
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * validate and save a new post to the database
     * 
     * @param Request $request
     * 
     * @return PostResource
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'author' => 'required'
        ]);

        $post = Post::create($data);

        return new PostResource($post);
    }

    /**
     * validate and update a post to the database
     * 
     * @param  Request $request
     * 
     * @return PostResource
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return new PostResource($post);
    }

    /**
     * delete a post to the database
     * 
     * @param mixed $id
     * 
     * @return mixed
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return '';
    }
}
