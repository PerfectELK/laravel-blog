<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Admin;
use Illuminate\Support\Facades\Cookie;
use App\Material;

class AdminController extends Controller
{
    protected function auth()
    {
        //Cookie::get('login');
        if(isset($_COOKIE['login'])){
            $materials = Material::all();
            return view('admin/home',compact('materials'));
        }

        return view('admin.auth');
    }
    protected function check()
    {
        $confirm = Admin::whereRaw('name= ? and password = ?',[
            $_POST['name'],
            $_POST['password']
        ])->count();
        if($confirm > 0){
            Cookie::queue('login', $_POST['name'] , 60);
            $materials = Material::all();
            return view('admin/home',compact('materials'));
        } else{
            session_start();
            $_SESSION['errors'] = [
                "Неверный логин или пароль"
            ];

            return view('admin/auth');
        }
    }
    protected function logout()
    {
        setcookie('login', "", time() - 3600);
        return redirect('/');
    }
}
