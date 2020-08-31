<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    public function show(User $user){
        return view('profile.index',[
            'user'=>$user
        ]);
    }

    public function edit(User $user){
        $this->authorize('update',[$user]);
        return view('profile.edit',[
            'user'=>$user
        ]);
    }

    public function update(User $user, Request $request){
        $this->authorize('update',[$user]);
        $user->update($this->validateUser($request));
        return redirect('/profile/' . $user->id);
    }

    protected function validateUser($request){
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
    }

    public function grantmod(User $user, Request $request){
        $this->authorize('grantModerator',Auth::user());
        DB::table('role_user')->insert(['user_id'=>$user->id, 'role_id'=>2]);
        return redirect('/profile/' . $user->id);
    }

    public function revokemod(User $user, Request $request){
        $this->authorize('revokeModerator',Auth::user());
        DB::table('role_user')->where(['user_id'=>$user->id, 'role_id'=>2])->delete();
        return redirect('/profile/' . $user->id);
    }

}
