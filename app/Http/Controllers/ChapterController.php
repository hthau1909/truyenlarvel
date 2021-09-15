<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Post;
use Illuminate\Support\Str;
use Auth;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:add chapter|edit chapter|delete chapter|browse chapter',['only'=>['index','show']]);
        $this->middleware('permission:add chapter',['only'=>['create','store']]);
        $this->middleware('permission:edit chapter',['only'=>['edit','update']]);
        $this->middleware('permission:delete chapter',['only'=>['destroy']]);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $post = Post::find($id);
        return view('admin.chapter.create',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chapter = new Chapter();
        $chapter->name_chapter = $request-> name_chapter;
        $chapter->content_chapter = $request -> content_chapter;
        $chapter->post_id = $request-> post_id;
        $chapter->slug_chapter = Str::of($request-> name_chapter)->slug('-').'-'.rand(1000,300000);
        $chapter->save();
        return redirect()->route('chapter.show',$request-> post_id)->with('status','Đã thêm chương mới');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if ($post->user_id == Auth::id()) {
           $list_chap = Chapter::where('post_id',$id)->orderBy('id','ASC')->get();
            $post = Post::find($id);
            $stt=1;
            return view('admin.chapter.chapter-post',compact('list_chap','post','stt'));
        }
        else
        {
            return redirect()->back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chapter = Chapter::find($id);
        return view('admin.chapter.edit',compact('chapter'));
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
        $chapter = Chapter::find($id);
        $chapter->name_chapter = $request-> name_chapter;
        $chapter->content_chapter = $request -> content_chapter;
        $chapter->post_id = $request-> post_id;
        $chapter->slug_chapter = Str::of($request-> name_chapter)->slug('-').'-'.rand(1000,300000);
        $chapter->save();
        return redirect()->route('chapter.show',$request-> post_id)->with('status','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapter::where('id',$id)->delete();
        return redirect()->back()->with('status','Đã xóa');
    }
    public function createchapter($id)
    {
        $post = Post::find($id);
        return view('admin.chapter.create',compact('post'));
    }
}
