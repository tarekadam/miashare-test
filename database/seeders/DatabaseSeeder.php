<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        User::factory(10)
            ->create();

        self::makeAnAdmin();
    }

    private static function makeAnAdmin(){
        $user           = User::first();
        $user->is_admin = true;
        $user->save();
    }
}
