<?php

namespace App\Controllers;
use App\Models\Users;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->Users = new Users();
    }

    public function index()
    {
        $userId = session()->get("user_id");

        $data = $this->Users->where("id", $userId)->first();

        $user = [
            "id" => $data["id"],
            "uname" => $data["uname"],
            "name" => $data["name"],
            "nim" => $data["nim"],
            "email" => $data["email"],
            "description" => $data["description"],
            "faculty" => $data["faculty"],
            "major" => $data["major"],
            "nim" => $data["nim"],
            "image" => $data["image"],
            "logged_in" => TRUE,
        ];

        return view("dashboard", $user);
    }
}
