<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Student;
use App\Instructor;
use App\StudentCourse;
use App\InstructorCourse;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::truncate();
        Instructor::truncate();
        StudentCourse::truncate();
        InstructorCourse::truncate();
        User::truncate();
        User::insert([
                [
                    'first_name' => 'Admin',
                    'last_name' => 'Admin',
                    'user_name' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => \Hash::make('admin123'),
                    'gender' => '1',
                    'role' => '0',
                    'created_at' => Carbon\Carbon::now(),
                ],
            ]);
    }
}
