<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Genre;
use Illuminate\Support\Str;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:add post|edit post|delete post|publish post|browse post',['only'=>['index']]);
        $this->middleware('permission:add post',['only'=>['create','store']]);
        $this->middleware('permission:edit post',['only'=>['edit','update']]);
        $this->middleware('permission:delete post',['only'=>['destroy']]);
    }
    public function index()
    {
        if(Auth()->user()->hasPermissionTo('publish post') ||Auth()->user()->hasRole('admin'))
        {
            $posts = Post::with('postCategory','postGenre','chapter')->get();
            $stt = 1;
            return view('admin.post.index',compact('posts','stt'));
        }
        else
        {
            $posts = Post::with('postCategory','postGenre','chapter')->where('user_id',Auth::id())->get();
            $stt = 1;
            return view('admin.post.index',compact('posts','stt'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $genres = Genre::all();
        return view('admin.post.create',compact('categories','genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $post = new Post();
        $post->name_post = $request-> name_post;
        $post->author = $request-> author;
        foreach($request-> category as $cate_id)
            $post->category_id = $cate_id[0];
        foreach($request-> genre as $genre_id)
            $post->genre_id = $cate_id[0];
        $post->content_post = $request -> content;

        $img = $request->image;
        $imgname = $img->getClientOriginalName();
        $pathImg = $img->move('image/',$imgname);
        $post->image = $imgname;
        $post->status = $request-> status;
        $post->active = $request-> active;
        $post->user_id = Auth::id();
        $post->slug_post = Str::of($request-> name_post)->slug('-').rand(1000,300000);
        $post->save();
        $post->postCategory()->attach($request-> category);
        $post->postGenre()->attach($request-> genre);
        return redirect()->back()->with('status','Thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::find($id);
        if(Auth::id() == $post->user_id){
            $genrePost = $post->postGenre;
            $categoryPost = $post->postCategory;
            $genres = Genre::all();
            $categories = Category::all();
            return view('admin.post.edit',compact('post','genres','categories','genrePost','categoryPost'));
        }
        else
        {
            return redirect()->back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->postCategory()->sync($request-> category);
        $post->postGenre()->sync($request-> genre);

        $post->name_post = $request-> name_post;
        $post->author = $request-> author;
        foreach($request-> category as $cate_id)
            $post->category_id = $cate_id[0];
        foreach($request-> genre as $genre_id)
            $post->genre_id = $cate_id[0];
        $post->content_post = $request -> content;

        $img = $request->image;
        if($img)
        {
            $imgname = $img->getClientOriginalName();
            $pathImg = $img->move('image/',$imgname);
            $post->image = $imgname;
        }
        $post->status = $request-> status;
        $post->active = $request-> active;
        $post->slug_post = Str::of($request-> name_post)->slug('-').rand(1000,300000);
        $post->save();

        return redirect()->route('post.index')->with('status','Đã cập nhật');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id',$id)->delete();
        return redirect()->back()->with('status','Đã xóa');
    }
    public function publishpost(Request $request,$id)
    {
        $post = Post::find($id);
        $post->active = $request-> active;
        $post->save();
        $postname = $post->name_post;
        if($request-> active == 0)
            $status = 'Đã hủy kích hoạt :';
        else
            $status = 'Đã kích hoạt :';
        return redirect()->back()->with('status',''.$status.''.$postname.'');
    }
}
