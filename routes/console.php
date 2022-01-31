<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Category;
use App\Models\product;
use App\Models\role;
use Illuminate\Foundation\Auth\User;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/
Artisan::command('create', function(){
    $user=User::find(1);
    collect(['Admin', 'Manager', 'Custom'])-> each(function($name,$idx) use ($user){
        $role=role::where('name',$name)->first();
        $user->roles()->attach($role);
    });
});
