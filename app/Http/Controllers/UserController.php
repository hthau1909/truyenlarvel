<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Validator;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    public function index()
    {
        $list_role = Role::all();
        $list_user = User::with('roles','permissions')->get();
        return view('admin.user.index',compact('list_role','list_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request-> username;
        $email = $request-> email;

        $validator = Validator::make(
            array(
                'email' => $email
            ),
            array(
                'email' => 'required|email|unique:users'
            )
        );
        if ($validator->fails())
        {
            return redirect()->back()->with('status','Email Tồn Tại');
        }
        else {
            // Register the new user or whatever.
            $user = new User;
            $user->email = $request-> email;
            $user->name = $request-> username;

            $user->password = Hash::make($request-> password);
            $user->save();

            $user_role = User::find($user->id);
            $user_role->syncRoles([$request -> role]);
            return redirect()->back()->with('status','Thêm thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();

        $role_user = $user->getRoleNames()->first();//lấy vai trò hiện tại
        if ($role_user == null) {
            return redirect()->back()->with('status','Người dùng này chưa có vai trò');
        }
        $permission_user = $user->getPermissionsViaRoles();

        // $permissions = $user->getPermissionsViaRoles();
        return view('admin.user.editPer',compact('user','roles','role_user','permissions','permission_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id==1)
            return redirect()->back()->with('status','Bạn không được phép đổi vai trò user này');
        $user = User::find($id);
        $roles = Role::all();
        $role_user = $user->getRoleNames()->first();
        return view('admin.user.editRole',compact('user','roles','role_user'));
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
        // dd($request->all());
        $user = User::find($id);
        $role_id = $user->roles->first()->id;
        $role = Role::find($role_id);
        $role->syncPermissions($request-> permission);
        return redirect('/user');
    }
    public function updaterole(Request $request, $id)
    {
        $user = User::find($id);
        $user->syncRoles([$request -> choose_role]);
        return redirect('/user')->with('status','Đã cập nhật vai trò');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == 1)
            return redirect()->back()->with('status','Không có quyền xóa người dùng này');
        else{
            User::where('id',$id)->delete();
            return redirect()->back()->with('status','Đã xóa thành công');
        }

    }
}
