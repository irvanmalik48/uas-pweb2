<?php

namespace App\Controllers;
use App\Models\Users;
 
class Login extends BaseController
{
    public function index() {
        helper(['form']);
        echo view('login');
    } 
 
    public function auth() {
        $session = session();
        $model = new Users();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('pass');
        $data = $model->where('email', $email)->first();

        if (!$data) {
            $data = $model->where('uname', $email)->first();
        }

        if (!$data) {
            $session->setFlashdata('msg', 'Email/Username not found');
            return redirect()->to('/login');
        }

        $pass = $data['pass'];
        $verify_pass = password_verify($password, $pass);

        if (!$verify_pass) {
            $session->setFlashdata('msg', 'Wrong Password');
            return redirect()->to('/login');
        }

        $ses_data = [
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
        $session->set($ses_data);

        return redirect()->to('/dashboard');
    }
 
    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}