<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $user1 = new User();
        $user1->name = 'Die Werber';
        $user1->email = 'info@die-werber.ch';
        $user1->password =  Hash::make('4ceFsTe7CJNmGH82YbT4');
        $user1->save();

        $user2 = new User();
        $user2->name = 'swissweb-admin';
        $user2->email = 'contact@die-werber.ch';
        $user2->password = Hash::make('4ceFsTe7CJNmGH82YbT4');
        $user2->save();
    }

}
