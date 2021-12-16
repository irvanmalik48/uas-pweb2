<?php

namespace App\Controllers;
use App\Models\Users;
use Config\Services;

class Edit extends BaseController
{
    public function __construct()
    {
        $this->Users = new Users();
    }

    public function index() {
        helper(["form"]);

        $userId = session()->get("user_id");

        $data = $this->Users->where("id", $userId)->first();

        $user = [
            "id" => $data["id"],
            "uname" => $data["uname"],
            "name" => $data["name"],
            "nim" => $data["nim"],
            "email" => $data["email"],
            "desc" => $data["description"],
            "faculty" => $data["faculty"],
            "major" => $data["major"],
        ];    

        return view("edit", $user);
    }

    public function user() {
        helper(["form"]);

        $userId = session()->get("user_id");

        $data = $this->Users->where("id", $userId)->first();

        $orig_uname = $data["uname"];
        $orig_email = $data["email"];

        $uc = $this->request->getPost("uname") == $orig_uname;
        $ec = $this->request->getPost("email") == $orig_email;
        
        $flag_uname = "";
        $flag_email = "";

        if (!$uc) {
            $flag_uname = "|is_unique[users.uname]";
        }

        if (!$ec) {
            $flag_email = "|is_unique[users.email]";
        }

        $rules = [
            "uname" => "required|min_length[3]|max_length[20]" . $flag_uname,
            "email" => "required|min_length[6]|max_length[100]" . $flag_email,
            "name" => "required|min_length[3]|max_length[100]",
        ];

        if (!$this->validate($rules)) {
            $data["validation"] = $this->validator;
            echo view("edit", $data);
        }

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

    public function pass() {
        helper(["form"]);

        $userId = session()->get("user_id");

        $data = $this->Users->where("id", $userId)->first();

        $rules = [
            "pass" => "required|min_length[8]|max_length[200]",
            "confpass" => "required|min_length[8]|max_length[200]|matches[pass]",
        ];

        if (!$this->validate($rules)) {
            $data["validation"] = $this->validator;
            echo view("edit", $data);
        }

        $data = [
            "pass" => password_hash(
                $this->request->getPost("pass"),
                PASSWORD_DEFAULT
            ),
        ];

        $this->Users->update($userId, $data);

        return redirect()->to("/");
    }

    public function image() {
        helper(["form", "url"]);

        $userId = session()->get("user_id");

        $data = $this->Users->where("id", $userId)->first();

        $rules = [
            "image" => "uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]",
        ];

        if (!$this->validate($rules)) {
            $data["validation"] = $this->validator;
            echo view("edit", $data);
        }

        $avatar = $this->request->getFile("image");
        $avatar->move(WRITEPATH . "../public/assets/img/");

        $data = [
            "image" => $avatar->getName(),
        ];

        $this->Users->update($userId, $data);

        return redirect()->to("/");
    }
}
