<?php

namespace App\Controllers;
use App\Models\Users;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->Users = new Users();
    }

    public function index() {
        $userId = session()->get('user_id');

        $data = $this->Users->where('id', $userId)->first();

        $user = [
            'user_id' => $data['id'],
            'user_uname' => $data['uname'],
            'user_name' => $data['name'],
            'user_nim' => $data['nim'],
            'user_email' => $data['email'],
            'user_desc' => $data['description'],
            'user_faculty' => $data['faculty'],
            'user_major' => $data['major'],
            'user_nim' => $data['nim'],
            'user_image' => $data['image'],
            'logged_in' => TRUE
        ];

        return view("/dashboard", $user);
    }
}
