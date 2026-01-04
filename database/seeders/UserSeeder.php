<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $departments = Department::pluck('id', 'name');

        $users = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => null,
                'full_name' => 'System Administrator',
                'user_type' => 'admin',
                'department' => 'IT',
                'department_id' => $departments['IT'],
                'is_active' => true,
                'password' => Hash::make('admin123'),
            ],
            [
                'name' => 'Mark',
                'username' => 'tester',
                'email' => 'mark@gmail.com',
                'full_name' => 'Mark',
                'user_type' => 'tester',
                'department' => 'QUALITY',
                'department_id' => $departments['QUALITY'],
                'is_active' => true,
                'password' => Hash::make('test123'),
            ],
            [
                'name' => 'Adam',
                'username' => 'adam',
                'email' => 'adam@gmail.com',
                'full_name' => 'Adam',
                'user_type' => 'tester',
                'department' => 'ELECTRICAL',
                'department_id' => $departments['ELECTRICAL'],
                'is_active' => true,
                'password' => Hash::make('test123'),
            ],
            [
                'name' => 'Laura',
                'username' => 'thermal',
                'email' => 'laura@gmail.com',
                'full_name' => 'Laura',
                'user_type' => 'tester',
                'department' => 'THERMAL',
                'department_id' => $departments['THERMAL'],
                'is_active' => true,
                'password' => Hash::make('test123'),
            ],
            [
                'name' => 'Bartosz',
                'username' => 'quality',
                'email' => 'bartosz@gmail.com',
                'full_name' => 'Bartosz',
                'user_type' => 'tester',
                'department' => 'IT',
                'department_id' => $departments['IT'],
                'is_active' => true,
                'password' => Hash::make('test123'),
            ],
            [
                'name' => 'Elliot',
                'username' => 'mechanical',
                'email' => 'elliot@gmail.com',
                'full_name' => 'Elliot',
                'user_type' => 'tester',
                'department' => 'MECHANICAL',
                'department_id' => $departments['MECHANICAL'],
                'is_active' => true,
                'password' => Hash::make('test123'),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['username' => $user['username']],
                $user
            );
        }
    }
}
