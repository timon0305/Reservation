<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;
class ProfileController extends Controller
{
    public function changePasswordStore(Request $request){
        $auth_user = auth()->guard(auth_user()->guard)->user();
        $user = app(get_class($auth_user))->findOrFail($auth_user->id);
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'confirmed|string|different:old_password',
        ]);
        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            $request->session()->flash('success', 'Password changed');
            return redirect()->back();
        } else {
            $request->session()->flash('error', 'Password does not match');
            return redirect()->back();
        }
    }

}
