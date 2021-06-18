<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.user.index',compact('users'));
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        User::create($data);
        return redirect()->route('admin.user.index');
    }
    public function destroy($id)
    {
        User::FindOrFail($id)->delete();
        return back()->with('danger','Xóa thành công!');
    }
    public function update(Request $request,$id)
    {
        User::FindOrFail($id)->Roles()->sync([$request->role]);
        return back()->with('warning','Cập nhật thành công !');
    }
}
