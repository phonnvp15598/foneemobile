<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users =  User::paginate(5);
        return view('admin.user.index', compact('users'));
    }
    public function assignUser(Request $request){

        $user =  User::where('email', $request->email)->first();
        $user->roles()->detach();
        if($request->admin_role){
            $user->roles()->attach(Role::where('role_name', 'admin')->first());
        }
        if($request->author_role){
            $user->roles()->attach(Role::where('role_name', 'author')->first());
        }
        if($request->user_role){
            $user->roles()->attach(Role::where('role_name', 'user')->first());
        }
        return redirect()->back()->with('message', 'Đã cấp quyền cho người dùng thành công!');
    }
    public function delete($id){
        User::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Xóa người dùng thành công !');
    }
}
