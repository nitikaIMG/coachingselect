<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

class AdminController extends Controller
{

    public function admin_profile() {

        if(request()->isMethod('get')) {

            return view('admin_profile');

        } else {

            $input = request()->except('_token');

            User::where('id', auth()->user()->id)->update($input);

            return redirect()->back()->with('success', 'Updated successfully');
        }
    }

    public function change_password() {

        if(request()->isMethod('get')) {

            return view('change_password');

        } else {

            $input = request()->except('_token');

            if( !Hash::check($input['old_password'], auth()->user()->password) ){
                return back()->with('error', 'Old password does not matched');
            }

            if($input['new_password'] != $input['confirm_password']) {
                return back()->with('error', 'New password does not matched to confirm password');
            }

            $input['password'] = Hash::make($input['confirm_password']);
            $input['decrypted_password'] = $input['confirm_password'];

            unset(
                $input['old_password'],
                $input['new_password'],
                $input['confirm_password']
            );

            User::where('id', auth()->user()->id)->update($input);

            // logout other devices

            auth()->logoutOtherDevices(
                request()->get('new_password')
            );

            return redirect()->back()->with('success', 'Updated successfully');
        }
    }
}