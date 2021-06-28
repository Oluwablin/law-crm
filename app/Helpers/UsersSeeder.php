<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\User;

class UsersSeeder
{
    public static function corps()
    {
        $users = [
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email'    => 'super_admin@law.com',
                'password' => bcrypt('password#'),
            ],
        ];

        // Seed Users (users) table into the DB
        foreach ($users as $user) {
            $newUser = User::where('first_name', '=', $user['first_name'])->first();
            if ($newUser === null) {
                User::create([
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                ]);
            }
        }
    }
}
