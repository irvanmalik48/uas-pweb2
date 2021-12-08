<?php

namespace App\Controllers;
use App\Models\Users;
use CodeIgniter\HTTP\RedirectResponse;

class Login extends BaseController
{
    public function __construct()
    {
        $this->Users = new Users();
    }

    public function index()
    {
        helper(["form"]);
        echo view("login");
    }

    public function auth(): RedirectResponse
    {
        $session = session();
        $model = $this->Users;
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("pass");
        $data = $model->where("email", $email)->first();

        if (!$data) {
            $data = $model->where("uname", $email)->first();
        }

        if (!$data) {
            $session->setFlashdata("msg", "Email/Username not found");
            return redirect()->to("/login");
        }

        $pass = $data["pass"];
        $verify_pass = password_verify($password, $pass);

        if (!$verify_pass) {
            $session->setFlashdata("msg", "Wrong Password");
            return redirect()->to("/login");
        }

        $ses_data = [
            "user_id" => $data["id"],
            "user_uname" => $data["uname"],
            "user_email" => $data["email"],
            "logged_in" => true,
        ];

        $session->set($ses_data);

        return redirect()->to("/dashboard");
    }
}
