<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Movie;
use App\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

   function index(){
       $users_count= User::whereRole('user')->count();
       $movies_count=Movie::count();
       $categories_count=Category::count();
     return view('dashboard.welcome',compact('users_count','categories_count','movies_count'));

 }
}
