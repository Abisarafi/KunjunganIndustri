<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::anything()->get();
        return $users;
    }
    public function test(Request $request)
    {


           DB::transaction(function() {
                User::create([
                    'name' => 'john',
                    'email' => 'johndo10e@gmail.com',
                    'votes' => '1',
                    'password' => 'dwed3223ijhygugugugjjsdfdfsd',
                ]);

                Post::create([
                    'title' => 'Post 10',
                    'description' => 'Laravel post',
                    'is_publish' => 0,
                ]);

            });

            return 'success';

    }
}
