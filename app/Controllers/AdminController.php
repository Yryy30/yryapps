<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }
    }

    public function index()
    {
        return view("admin/vw_dashboard");
    }

    public function listUsers()
    {
        $userModel = new UserModel();

        $users = $userModel->findAll();

        return view('admin/users/vw_users', ["users" => $users,]);
    }

    public function formUsers()
    {
        return view("admin/users/vw_addUsers");
    }

    public function addUsers()
    {
        if($this->request->getMethod() == "post"){
            
            $rules = [
                "name" => "required|min_length[3]|max_length[40]",
                "email" => "required|valid_email",
                "phone" => "required|min_length[5]|max_length[15]",
                "role" => "required|min_length[3]|max_length[15]",
                "password" => "required|min_length[3]|max_length[15]",
                "profile_image" => [
                    "rules" => "uploaded[profile_image]|max_size[profile_image,1024]|is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/gif,image/png]",
                    "label" => "Profile Image",],
            ];

            if(!$this->validate($rules)){
                
                return view("admin/users/vw_addUsers", ["validation" => $this->validator,]);
            
            }else{

                $file = $this->request->getFile("profile_image");
                $pass = $this->request->getVar("password");               

                $session = session();
                $profile_image = $file->getName();

                if($file->move("images", $profile_image)){

                    $userModel = new UserModel();
                    $data = [
                        "name" => $this->request->getVar("name"),
                        "email" => $this->request->getVar("email"),
                        "phone" => $this->request->getVar("phone"),
                        "role" => $this->request->getVar("role"),
                        "password" => password_hash($pass, PASSWORD_DEFAULT),
                        "profile_image" => "/images/" . $profile_image,
                    ];

                    if($userModel->insert($data)) {
                        $session->setFlashdata("success", "Data saved successfully");
                    }else{
                        $session->setFlashdata("error", "Failed to save data");
                    }
                }
            }
            return redirect()->to(base_url("/admin/list-users"));
        }
        return view("admin/users/vw_addUsers");
    }

}
