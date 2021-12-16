<?php

namespace App\Controllers;

use App\Models\Users;
use CodeIgniter\HTTP\RedirectResponse;

class Register extends BaseController
{
    public function __construct()
    {
        $this->Users = new Users();
    }

    public function index(): string
    {
        helper(["form"]);
        $data = [];
        return view("register", $data);
    }

    public function save()
    {
        helper(["form"]);
        $rules = [
            "uname" =>
                "required|min_length[3]|max_length[20]|is_unique[users.uname]",
            "name" => "required|min_length[3]|max_length[100]",
            "email" =>
                "required|min_length[6]|max_length[100]|valid_email|is_unique[users.email]",
            "password" => "required|min_length[8]|max_length[200]",
        ];

        $messages = [
            "uname" => [
                "required" => "The username field can't be empty.",
                "min_length" => "Username must have at least 3 characters.",
                "max_length" =>
                    "Username must not have more than 20 characters.",
                "is_unique" => "Username already exists.",
            ],
            "email" => [
                "required" => "The email field can't be empty.",
                "min_length" => "Email must have at least 6 characters.",
                "max_length" => "Email must not have more than 100 characters.",
                "valid_email" => "Email is not valid.",
                "is_unique" => "Email already exists.",
            ],
            "name" => [
                "required" => "The name field can't be empty.",
                "min_length" => "Your name must have at least 3 characters.",
                "max_length" =>
                    "Your name must not have more than 100 characters.",
            ],
            "password" => [
                "required" => "The password field can't be empty.",
                "min_length" => "The password must have at least 8 characters.",
                "max_length" =>
                    "The password must not have more than 200 characters.",
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            session()->setFlashdata("msg", $this->validator->getErrors());
            echo view("register");
        } else {
            $data = [
                "uname" => $this->request->getPost("uname"),
                "name" => $this->request->getPost("name"),
                "email" => $this->request->getPost("email"),
                "pass" => password_hash(
                    $this->request->getPost("password"),
                    PASSWORD_DEFAULT
                ),
            ];

            $this->Users->save($data);

            return redirect()->to("/login");
        }
    }
}
