<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function getPostCategories()
    {
        $categories = Category::orderBy('name', 'ASC')->where('model_type', 'پست ها')->get();
        return response()->json(["categories" => $categories], 200);
    }

    public function index()
    {
        $posts = Post::with(["category", "author"])->latest()->take(3)->get();
        return response()->json(["posts" => $posts], 200);
    }

    public function store(StorePostRequest $request)
    {
        if ($request->image) {
            $image = $request->file('image');
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->image)->resize(800, 600);
            $upload_path = 'upload/post/';
            $image_url = $upload_path . $name;
            $img->save($image_url);
        }

        $admin_id = auth()->guard("admin-api")->user()->id;
        $post = new Post();
        $post->admin_id = $admin_id;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->slug = str_replace(" ", "-", $request->title);
        $post->image = '/' . $image_url;
        $post->body = $request->body;
        $post->seo_title = $request->seo_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->status = $request->status;
        $post->featured = $request->featured;
        $post->isImportant = $request->isImportant;
        $post->save();

        $listOfTags = explode(',', $request->tags);
        foreach ($listOfTags as $tag) {
            $repeatTag = Tag::where('name', $tag)->first();
            if (!isset($repeatTag)) {
                $tags = new Tag();
                $tags->name = $tag;
                $tags->slug = strtolower(str_replace(" ", "-", $tag));
                $tags->save();
                $post->tags()->attach($tags->id);
                $post->save();
            } else {
                $post->tags()->attach($repeatTag->id);
                $post->save();
            }
        }
        return response()->json(["message" => " پست با موفقیت ذخیره شد "], 200);
    }

    public function show($id)
    {
        $post = Post::with(["category", "tags", "author", "comments"])->find($id);
        return response()->json(["post" => $post], 200);
    }

    public function editPost(StorePostRequest $request, $id)
    {

        $post = Post::findOrFail($id);

        if ($request->image) {
            $path = ltrim($post->image, "/");
            @unlink(public_path($path));
            $image = $request->file('image');
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->image)->resize(800, 600);
            $upload_path = 'upload/post/';
            $image_url = $upload_path . $name;
            $img->save($image_url);
        }

        $admin_id = auth()->guard("admin-api")->user()->id;
        $post->admin_id = $admin_id;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->slug = str_replace(" ", "-", $request->title);
        $post->image = isset($image_url) ? ('/' . $image_url) : $post->image;
        $post->body = $request->body;
        $post->seo_title = $request->seo_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->status = $request->status;
        $post->featured = $request->featured;
        $post->isImportant = $request->isImportant;
        $post->save();

        //delete tags
        $post->tags()->detach();
        $listOfTags = explode(',', $request->tags);
        foreach ($listOfTags as $tag) {
            $repeatTag = Tag::where('name', $tag)->first();
            if (!isset($repeatTag)) {
                $tags = new Tag();
                $tags->name = $tag;
                $tags->slug = strtolower(str_replace(" ", "-", $tag));
                $tags->save();
                $post->tags()->attach($tags->id);
                $post->save();
            } else {
                $post->tags()->attach($repeatTag->id);
                $post->save();
            }
        }
        return response()->json(["message" => " پست با موفقیت ویرایش شد "], 200);
    }

    public function destroy(Post $post)
    {
        $path = ltrim($post->image, "/");
        @unlink(public_path($path));
        $post->tags()->detach();
        $post->delete();
        return response()->json(["message" => "حذف با موفقیت انجام شد"], 200);
    }
}
