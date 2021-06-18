<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Posts::all();
        return view('admin.posts.index',compact('posts'));
    }

    public function create()
    {
        $categories = Categories::where('type',0)->get();
        return view('admin.posts.form',compact('categories'));
    }

    public function store(Request $request)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'name' => $request->name,
            'slug' => $request->slug,
            'locate' => $request->locate,
            'img' => $request->img,
            'text' => $request->text,
            'content' => $request->content
        ];
        $post = Posts::create($data);
        Posts::FindOrFail($post->id)->Categories()->attach($request->categories);
        return redirect()->route('admin.posts.index')->with('success','Thêm bài viết thành công !');

    }

    public function show($id)
    {
        $categories = Categories::where('type',0)->get();
        $posts = Posts::FindOrFail($id);
        return view('admin.posts.form',compact('posts','categories'));
    }
    public function update(Request $request,$id)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'name' => $request->name,
            'slug' => $request->slug,
            'locate' => $request->locate,
            'img' => $request->img,
            'text' => $request->text,
            'content' => $request->content
        ];
        Posts::FindOrFail($id)->update($data);
        Posts::FindOrFail($id)->Categories()->sync($request->categories);
        return redirect()->back()->with('warning','Cập nhật bài viết thành công !');
    }

    public function destroy($id)
    {
        Posts::FindOrFail($id)->Categories()->detach();
        Posts::FindOrFail($id)->delete();
        return redirect()->route('admin.posts.index')->with('danger','Cập nhật bài viết thành công !');
    }
}
