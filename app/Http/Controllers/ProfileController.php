<?php

namespace App\Http\Controllers;

use App\Models\address;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function profile(Request $request)
    {
        $user=Auth::user();
      //  $address=adress::where('user_id',$user->id)->get();

        return view('profile', compact('user'));
    }

    public function profileUpdate (Request $request)
    {
        $request->validate([
            'picture' => 'mimes:png,jpg',
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'password'=>'confirmed',
        ]);



        $user = User::find(Auth::user()->id);
        $file = $request->file('picture');
        $input = $request->all();


        if ($input['password']) {
            $currentPassword = $input['current_password'];
            if (!Hash::check($currentPassword, request()->user()->password)) {
                session()->flash('currentPasswordError');
                return back();
            } else {
                $user->password = Hash::make($input['password']);
                $user->save();
            }
        }

        if($file){
            $ext=$file->getClientOriginalExtension();
            $fileName=time() . rand(100, 999) . '.' . $ext;
            $file->storeAs('public/img/users', $fileName);
            $user->picture=$fileName;
        }
        $address=address::find($input['main_address']);
        $address->main=1;
        $address->save();
        address::where('user_id', $user->id) -> where('id', '!=', $input['main_address'])-> update([
            'main'=>0
        ]);


        if($input['new_address']){

            if ($input['main_new_address']) {
                address::where('user_id', $user->id)-> update([
                    'main'=>0
                ]);
                $mainAddress=true;
        } else {
                $mainAddress=!$user->addresses->contains(function($address){
                    return $address->main==true;

                });
            }

            $address=new address();
            $address->user_id=$user->id;
            $address->address=$input['new_address'];
            $address->main=$mainAddress;
            $address->save();
        }


        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->save();
        session()->flash('profileUpdated');
        return back();
    }


}


