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
        $user1->name = 'Lamija';
        $user1->email = 'lamija@lamija.ba';
        $user1->password =  Hash::make('lamija2021');
        $user1->save();
    }

}
