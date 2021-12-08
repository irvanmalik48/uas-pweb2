<?php namespace App\Controllers;

use App\Models\Users;
 
class Register extends BaseController
{
    public function index()
    {
        helper(['form']);
        $data = [];
        echo view('register', $data);
    }
 
    public function save()
    {
        helper(['form']);
        $rules = [
            'uname' => 'required|min_length[3]|max_length[20]|is_unique[users.uname]',
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|min_length[6]|max_length[100]|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|max_length[200]',
            'confpassword' => 'matches[password]'
        ];
         
        if(!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }

        $model = new Users();
        $data = [
            'uname' => $this->request->getVar('uname'),
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT)
        ];
        $model->save($data);
        
        return redirect()->to('/login');
    }
 
}
