<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\post\CratePostRequest;
use App\Http\Requests\Api\post\UpdatePostRequest;
use App\Http\Resources\Api\post\PostResource;
use App\Services\PostService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponseTrait;

    protected $postService;

    // Inject PostService into the controller
    public function __construct(PostService $postService)
    {
        $this->middleware('auth:sanctum');
        $this->postService = $postService;
    }

    // Create a new post
    public function store(CratePostRequest $request)
    {
        $data =$request->validated();

        $post = $this->postService->createPost($data);

        return $this->successResponse(new PostResource($post), 'Post created successfully');
    }

    // Get all posts for the authenticated users
    public function index(Request $request)
    {
        $posts = $this->postService->getPosts($request->limit);

        return $this->successResponse(PostResource::collection($posts), 'Posts retrieved successfully');
    }

    // Get a single post by ID
    public function show($id)
    {
        $post = $this->postService->getPostById($id);

        if (!$post) {
            return $this->errorResponse('Post not found ', 404);
        }

        return $this->successResponse(new PostResource($post), 'Post retrieved successfully');
    }

    // Update a post
    public function update(UpdatePostRequest $request, $id)
    {
       $data =  $request->validated();

        $post = $this->postService->updatePost($id, $data);

        if (!$post) {
            return $this->errorResponse('Post not found or not authorized to update', 404);
        }

        return $this->successResponse(new PostResource($post), 'Post updated successfully');
    }

    // Delete a post
    public function destroy($id)
    {
        $post = $this->postService->deletePost($id);

        if (!$post) {
            return $this->errorResponse('Post not found or not authorized to delete', 404);
        }

        return $this->successResponse([], 'Post deleted successfully');
    }
}
