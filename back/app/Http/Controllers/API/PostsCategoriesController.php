<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Model\PostCategory;
use App\Model\PostCategoryDescription;
use App\Model\Post;


class PostsCategoriesController extends BaseController
{
    public function index(Request $request) {
        $languageId = $request->language_id;
        $getPostsCategories = PostCategory::with(['posts_categories_description' => function($query) use ($languageId) {
            return $query->where('language_id', $languageId);
        }])->get();
        return response()->json($getPostsCategories, 200);
    }

    public function store() {
        $newPostCategory = PostCategory::create();
        return $this->sendResponse($newPostCategory, 'New posts category added successfully.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'language_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        $postCategory = PostCategoryDescription::updateOrCreate(
            ['language_id' => $request->language_id, 'posts_category_id' => $id],
            ['posts_category_id' => $id, 'name' => $request->name, 'language_id' => $request->language_id]
        );
        return $this->sendResponse('Success', 'Post category modified successfully.');
    }

    public function destroy($id) {
        $postsInCategory = Post::find($id);
        if($postsInCategory) return $this->sendResponse('Not done', 'Delete all posts in that cagegory first');
        $postsCategory = PostCategory::find($id);
        $postsCategory->posts_categories_description()->delete();
        $postsCategory->delete();
        return $this->sendResponse('Success', 'Category deleted successfully');
    }
}
