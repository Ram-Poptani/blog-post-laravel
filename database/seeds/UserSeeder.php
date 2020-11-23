<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'poptaniram20@gmail.com')->get()->first();
        if (!$user) {
            User::create([
                'name' => 'Ram Poptani',
                'email' => 'poptaniram20@gmail.com',
                'password' => Hash::make('abcd1234'),
                'role' => 'admin',
            ]);
        }else {
            $user->update(['role' => 'admin']);
        }

        User::create([
            'name' => 'rishi khetpal',
            'email' => 'khetpalrishi20@gmail.com',
            'password' => Hash::make('abcd1234'),
        ]);

        User::create([
            'name' => 'rahul jethani',
            'email' => 'jethanirahul20@gmail.com',
            'password' => Hash::make('abcd1234'),
        ]);

        User::create([
            'name' => 'piyush jethanandani',
            'email' => 'jethanandanipiyush20@gmail.com',
            'password' => Hash::make('abcd1234'),
        ]);

        
    }
}
