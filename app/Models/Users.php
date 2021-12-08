<?php
namespace App\Models;
use CodeIgniter\Model;

class Users extends Model {
    protected $table = "users";
    protected $allowedFields = [
        "uname", "email", "pass",
        "name", "nim", "faculty",
        "major", "description", "image"
    ];
}