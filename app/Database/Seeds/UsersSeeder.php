<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $user_object = new UserModel();
		$user_object->insertBatch([
			 [
			 "name" => "Yryy30",
			 "email" => "yry.arr30@gmail.com",
			 "phone" => "9988776655",
			 "role" => "admin",
			 "password" => password_hash("garangan12v", PASSWORD_DEFAULT)
			 ],
			 [
			 "name" => "Reii",
			 "email" => "reigaraga@gmail.com",
			 "phone" => "8888888888",
			 "role" => "operator",
			 "password" => password_hash("garaga12v", PASSWORD_DEFAULT)
			 ]
		 ]);
    }
}
