<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index(){
        $users = \App\Models\User::where('role', '!=', 99)->get();
        return view('admin.users.index', compact('users'));
    }

    public function edit($id){
        $user = \App\Models\User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $user = \App\Models\User::find($id);
        $user->update($request->all());
        return redirect()->route('admin.users.index');
    }

    public function destroy($id){
        $user = \App\Models\User::find($id);
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
