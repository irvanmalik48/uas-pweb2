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

    public function index()
    {
        helper(["form"]);
        $data = [];
        echo view("register", $data);
    }

    public function save(): RedirectResponse
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

        if (!$this->validate($rules)) {
            $data["validation"] = $this->validator;
            echo view("register", $data);
        }

        $model = $this->Users;
        $data = [
            "uname" => $this->request->getPost("uname"),
            "name" => $this->request->getPost("name"),
            "email" => $this->request->getPost("email"),
            "pass" => password_hash(
                $this->request->getPost("pass"),
                PASSWORD_DEFAULT
            ),
        ];
        $model->save($data);

        return redirect()->to("/login");
    }
}
