<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $find_user = User::where('email', 'sonjoy@gmail.com')->first();
        if(is_null($find_user)) {
            $user = new User();
            $user->name = 'Sonjoy Barua';
            $user->email = 'sonjoy@gmail.com';
            $user->password = Hash::make('12345678');
            $user->save();
        }

    }
}
