<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permission:add category|edit category|delete category|browse category',['only'=>['index']]);
        $this->middleware('permission:add category',['only'=>['create','store']]);
        $this->middleware('permission:edit category',['only'=>['edit','update']]);
        $this->middleware('permission:delete category',['only'=>['destroy']]);
    }
    public function index()
    {
       // dd('abc');
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_category' => 'required|unique:categories|max:255',
            ],
            [
            'name_category.required' => 'Tồn tại!',
            ]);
        $category = new Category();
        $category->name_category = $data['name_category'];
        $category->decription  = $request ->decription;
        $category->slug_category = Str::of($data['name_category'])->slug('-').'-'.rand(1000,30000);
        $category->save();
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
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

        $category = Category::find($id);
        $category->name_category = $request-> name_category;
        $category->decription  = $request ->decription;
        $category->slug_category = Str::of($request-> name_category)->slug('-').'-'.rand(1000,30000);
        $category->save();
        return redirect()->route('category.index')->with('status','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id',$id)->delete();
        return redirect()->route('category.index')->with('status','Đã xóa');
    }
}
