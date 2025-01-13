<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\PostFormRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $category = Category::where('status', '0')->get();
        return view('admin.post.add', compact('category'));
    }

    public function edit($post_id)
    {
        $category = Category::where('status', '0')->get();
        $post = Post::find($post_id);
        return view('admin.post.edit', compact('post', 'category'));
    }

    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        $post->delete();
        return redirect()->route('admin.post')->with('status', 'Delete Post Succesful');
    }

    // public function store(PostFormRequest $request)
    // {
    //     $data = $request->validated();
    //     if ($category = Category::where('id', $data['category_id'])->first()) {
    //         $post = new Post;
    //         $post->category_id = $data['category_id'];
    //         $post->name = $data['name'];
    //         $post->slug = Str::slug($data['name']);
    //         $post->description = $data['description'];
    //         $post->yt_iframe = $data['yt_iframe'];
    //         if (preg_match('/^https:\/\/www\.youtube\.com\/watch\?v=([\w-]{11})$/', $data['yt_iframe'], $matches)) {
    //             $post->yt_iframe = $matches[1];
    //         } else {
    //             return redirect()->back()->with('error', 'Invalid YouTube URL');
    //         }
    //         $post->meta_title = $data['meta_title'];
    //         $post->meta_description = $data['meta_description'];
    //         $post->meta_keyword = $data['meta_keyword'];
    //         $post->status = $request->status == true ? '1' : '0';
    //         $post->created_by = Auth::user()->id;
    //         $post->save();
    //     } else {
    //         return redirect()->back()->with('error', 'Category not found');
    //     }
    //     return redirect()->route('admin.post')->with('status', 'Post Add Successful');
    // }
    public function store(PostFormRequest $request)
    {
        $data = $request->validated();
        $category = Category::find($data['category_id']);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        if (!empty($data['yt_iframe']) && !preg_match('/^https:\/\/www\.youtube\.com\/watch\?v=([\w-]{11})$/', $data['yt_iframe'], $matches)) {
            return redirect()->back()->withInput()->withErrors(['yt_iframe' => 'Invalid YouTube URL']);
        } elseif (empty($data['yt_iframe'])) {
            $matches[1] = null;
        }
        $slug = Str::slug($data['name']);
        if (Post::where('slug', $slug)->exists()) {
            $slug .= '-' . time(); // Ensure unique slug
        }
        DB::transaction(function () use ($data, $matches, $slug) {
            $post = new Post;
            $post->category_id = $data['category_id'];
            $post->name = $data['name'];
            $post->slug = $slug;
            $post->description = $data['description'];
            $post->yt_iframe = $matches[1];
            $post->meta_title = $data['meta_title'];
            $post->meta_description = $data['meta_description'];
            $post->meta_keyword = $data['meta_keyword'];
            $post->status = request()->boolean('status') ? '1' : '0';
            $post->created_by = Auth::id();
            $post->save();
        });
        return redirect()->route('admin.post')->with('status', 'Post added successfully');
        // return response()->json(['success' => true, 'status' => 'Post added successfully']);
    }

    public function update(PostFormRequest $request, $post_id)
    {
        $data = $request->validated();
        $category = Category::find($data['category_id']);
        if (!$category) {
            return response()->json(['error' => 'Category not found, fck'], 404);
        }
        if (!empty($data['yt_iframe']) && !preg_match('/^https:\/\/www\.youtube\.com\/watch\?v=([\w-]{11})$/', $data['yt_iframe'], $matches)) {
            return redirect()->back()->withInput()->withErrors(['yt_iframe' => 'Invalid YouTube URL']);
        } elseif (empty($data['yt_iframe'])) {
            $matches[1] = null;
        }
        $post = Post::find($post_id);
        if (!$post) {
            return response()->json(['error' => 'Post not found, fck'], 404);
        }
        $slug = Str::slug($data['name']);
        if (Post::where('slug', $slug)->where('id', '!=', $post_id)->exists()) {
            $slug .= '-' . time(); // Ensure unique slug
        }
        DB::transaction(function () use ($post, $data, $matches, $slug) {
            $post->category_id = $data['category_id'];
            $post->name = $data['name'];
            $post->slug = $slug;
            $post->description = $data['description'];
            $post->yt_iframe = $matches[1];
            $post->meta_title = $data['meta_title'];
            $post->meta_description = $data['meta_description'];
            $post->meta_keyword = $data['meta_keyword'];
            $post->status = request()->boolean('status') ? '1' : '0';
            $post->created_by = Auth::id();
            $post->save();
        });
        return redirect()->route('admin.post')->with('status', 'Post updated successfully');
    }
}
