<?php

namespace App\Controllers;
use App\Models\Users;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class Edit extends BaseController
{
    public function __construct()
    {
        $this->Users = new Users();
    }

    public function index(): string
    {
        helper(["form"]);

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
        ];

        return view("edit", $user);
    }

    public function user()
    {
        helper(["form"]);

        $userId = session()->get("user_id");

        $data = $this->Users->where("id", $userId)->first();

        $rules = [
            "uname" =>
                "required|min_length[3]|max_length[20]|is_unique[users.uname,id,{id}]",
            "email" =>
                "required|min_length[6]|max_length[100]|valid_email|is_unique[users.email,id,{id}]",
            "name" => "required|min_length[3]|max_length[100]",
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
        ];

        if (!$this->validate($rules, $messages)) {
            session()->setFlashdata(
                "uname_error",
                $this->validator->getErrors()
            );
            echo view("edit", $data);
        } else {
            $data = [
                "uname" => $this->request->getPost("uname"),
                "name" => $this->request->getPost("name"),
                "nim" => $this->request->getPost("nim"),
                "email" => $this->request->getPost("email"),
                "desc" => $this->request->getPost("desc"),
                "faculty" => $this->request->getPost("faculty"),
                "major" => $this->request->getPost("major"),
            ];

            $this->Users->update($userId, $data);

            $ses_data = [
                "user_id" => $userId,
                "user_uname" => $data["uname"],
                "user_email" => $data["email"],
                "logged_in" => true,
            ];

            session()->set($ses_data);

            return redirect()->to("/");
        }
    }

    public function pass()
    {
        helper(["form"]);

        $userId = session()->get("user_id");

        $data = $this->Users->where("id", $userId)->first();

        $rules = [
            "pass" => "required|min_length[8]|max_length[200]",
            "confpass" =>
                "required|min_length[8]|max_length[200]|matches[pass]",
        ];

        $messages = [
            "pass" => [
                "required" => "The password field can't be empty.",
                "min_length" =>
                    "The password must be at least 8 characters long.",
                "max_length" =>
                    "The password must not be beyond than 200 characters long.",
            ],
            "confpass" => [
                "required" => "The confirmation password field can't be empty.",
                "min_length" =>
                    "The confirmation password must be at least 8 characters long.",
                "max_length" =>
                    "The confirmation password must not be beyond than 200 characters long.",
                "matches" =>
                    "Confirmation password mismatched. Please try again.",
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            session()->setFlashdata(
                "pass_error",
                $this->validator->getErrors()
            );
            echo view("edit", $data);
        } else {
            $data = [
                "pass" => password_hash(
                    $this->request->getPost("pass"),
                    PASSWORD_DEFAULT
                ),
            ];

            $this->Users->update($userId, $data);

            return redirect()->to("/");
        }
    }

    public function image()
    {
        helper(["form", "url"]);

        $userId = session()->get("user_id");

        $data = $this->Users->where("id", $userId)->first();

        $rules = [
            "imagefile" =>
                "uploaded[imagefile]|mime_in[imagefile,image/jpg,image/jpeg,image/gif,image/png]|ext_in[imagefile,png,jpg,jpeg,gif]",
        ];

        $messages = [
            "imagefile" => [
                "uploaded" => "You must upload an image.",
                "mime_in" =>
                    "Please upload a valid image file. (only PNG, JPG/JPEG, GIF are allowed)",
                "ext_in" =>
                    "Please upload a valid image file. (only PNG, JPG/JPEG, GIF are allowed)",
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            session()->setFlashdata(
                "image_error",
                $this->validator->getError()
            );
            echo view("edit", $data);
        } else {
            $avatar = $this->request->getFile("imagefile");
            $avatar->move(WRITEPATH . "../public/assets/img/");

            $data = [
                "image" => "assets/img/" . $avatar->getName(),
            ];

            $this->Users->update($userId, $data);

            return redirect()->to("/");
        }
    }
}
