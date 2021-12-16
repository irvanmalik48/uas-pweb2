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

    public function index(): string
    {
        helper(["form"]);
        return view("login");
    }

    public function auth()
    {
        $session = session();
        $uname = $this->request->getPost("uname");
        $password = $this->request->getPost("pass");
        $data = $this->Users->where("uname", $uname)->first();

        $rules = [
            "uname" => "required",
            "pass" => "required",
        ];

        $messages = [
            "uname" => [
                "required" => "Please fill your username/email.",
            ],
            "pass" => [
                "required" => "Please fill your password.",
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            $session->setFlashdata("msg", $this->validator->getErrors());
            return redirect()->to("/login");
        } else {
            if (!$data) {
                $data = $this->Users->where("email", $uname)->first();
            }

            if (!$data) {
                $session->setFlashdata("msg", [
                    "exception" => "User not found.",
                ]);
                return redirect()->to("/login");
            }

            $pass = $data["pass"];
            $verify_pass = password_verify($password, $pass);

            if (!$verify_pass) {
                $session->setFlashdata("msg", [
                    "exception" => "Wrong password.",
                ]);
                return redirect()->to("/login");
            }

            $ses_data = [
                "user_id" => $data["id"],
                "user_uname" => $data["uname"],
                "user_email" => $data["email"],
                "logged_in" => true,
            ];

            $session->set($ses_data);

            return redirect()->to("/");
        }
    }
}
