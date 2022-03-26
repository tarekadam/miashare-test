<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() : void{
        if(!User::all()->count()){
            User::factory(10)
                ->create();
        }

        $user = User::first();
        $role = Role::firstOrCreate(['name' => 'administrator'],
                                    ['name' => 'administrator']);

        if($role->wasRecentlyCreated){
            $user->Roles()->attach($role);
        }

        if(!Task::all()->count()){
            self::populateTasks();
        }
    }

    private static function populateTasks() : void{
        $users = User::limit(5)->get();
        foreach($users as $user){
            for($i = 3; $i>0; $i--){
                $task = new Task(['memo' => Str::random(40)]);
                $user->Tasks()->save($task);
            }
        }
    }
}
