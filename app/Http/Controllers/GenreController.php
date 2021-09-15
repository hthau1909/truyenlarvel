<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Str;


class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:add genre|edit genre|delete genre|browse genre',['only'=>['index','show']]);
        $this->middleware('permission:add genre',['only'=>['create','store']]);
        $this->middleware('permission:edit genre',['only'=>['edit','update']]);
        $this->middleware('permission:delete genre',['only'=>['destroy']]);
    }
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genre.index',compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name_genre' => 'required|unique:genres|max:255',
            'decription' => 'required|max:255',
            ],
            [
            'name_genre.required' => 'Tồn tại!',
            'decription.required' => 'Tồn tại!',
            ]);
        $genre = new Genre();
        $genre->name_genre = $data['name_genre'];
        $genre->decription = $data['decription'];
        $genre->slug_genre = Str::of($data['name_genre'])->slug('-').'-'.rand(1000,30000);
        $genre->save();
        return redirect()->back()->with('status','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genre = Genre::find($id);
        return view('admin.genre.edit',compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([
            'name_genre' => 'required',
            'decription' => 'required',
        ]);
        $genre = Genre::find($id);
        $genre->name_genre = $request->name_genre;
        $genre->decription = $request->decription;
        $genre->slug_genre = Str::of($request->name_genre)->slug('-').'-'.rand(1000,30000);;
        $genre->save();
        return redirect()->route('genre.index')->with('status','Đã cập nhật');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genre::where('id',$id)->delete();
        return redirect() -> back()->with('status','Đã xóa thành công !!!!');
    }
}
