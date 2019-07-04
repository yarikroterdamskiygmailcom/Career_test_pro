<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Model\Post;
use Validator;

class PostsController extends BaseController
{
    public function index(Request $request) {
        $languageId = $request->language_id;
        $getPosts = Post::where('language_id', $languageId)->get();
        return response()->json($getPosts, 200);
    }

    public function getPost($id) {
        $post = Post::where('id', $id)->first();
        return response()->json($post, 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'language_id' => 'required|numeric',
            'title' => 'required|string',
            'body' => 'required|string'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }
        $newPost = Post::create($request->all());

        return $this->sendResponse($newPost, 'New post created successfully.');
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'language_id' => 'required|numeric',
            'title' => 'required|string',
            'body' => 'required|string'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        $post = Post::where('id', $id)->update($request->all());
        return $this->sendResponse('Success', 'Post modified successfully.');
    }

    public function destroy($id) {
        Post::where('id', $id)->delete();
        return $this->sendResponse('Success', 'Post deleted successfully.');
    }

    public function searching(Request $request) {
        $languageId = $request->language_id;
        if($request->search == '') {
            $posts = Post::where('language_id', $languageId)->paginate(10);
        } else {
            $posts = Post::where('tags', 'like', '%' . $request->search . '%')
                ->where('language_id', $languageId)
                ->paginate(10);
        }
        return $this->sendResponse($posts, '');
    }
}
