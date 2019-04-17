<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = app('hash')->make(12345678);
        $defaultUsers = [
            ['email' => 'superadmin@mailinator.com', 'name' => 'superadmin', 'role' => 'SuperAdmin'],
            ['email' => 'developer@mailinator.com', 'name' => 'developer', 'role' => 'Developer'],
            ['email' => 'admin@mailinator.com', 'name' => 'admin', 'role' => 'Admin'],
            ['email' => 'User@mailinator.com', 'name' => 'user', 'role' => 'User'],
        ];

        foreach ($defaultUsers as $userInput) {
            if (\App\User::where('email', $userInput['email'])->count() === 0) {
                $role = $userInput['role'];
                unset($userInput['role']);
                $userInput['password'] = $password;
                $user = \App\User::firstOrCreate($userInput);
                if (!$user->hasRole($role)) {
                    $user->assignRole($role);
                }
            }
        }
    }
}
