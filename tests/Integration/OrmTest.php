<?php

/*
 *--------------------------------------------------------------------------
 * @MiaShare HR!
 * 2022-03-25
 *--------------------------------------------------------------------------
 *
 * I do not camelCase in my unit tests because it is easier to distinguish
 * between tests and code if you follow this convention.  It is also easier
 * to read the output of phpunit when you use snake_case.
 */

namespace Tests\Integration;

use App\Models\User;
use Tests\TestCase;

class OrmTest extends TestCase
{
    /**
     * @see \App\Models\User::Roles
     *
     * @test
     */
    public function can_load_administrator(){

        $result = User::whereHas('Roles', function ($q){
            $q->whereName('administrator');
        })->count();

        $this->assertEquals(1, $result);
    }

    /**
     * @see \App\Models\User::Roles
     *
     * @test
     */
    public function can_load_NON_administrator(){
        $result = User::whereDoesntHave('Roles', function ($q){
            $q->whereName('administrator');
        })->count();

        $this->assertGreaterThanOrEqual(9, $result);
    }

    /**
     * @see \App\Models\User::Tasks
     *
     * @test
     */
    public function can_load_user_tasks (){

        $result = User::whereHas('Tasks')->count();

        $this->assertGreaterThan(0, $result);
    }
}
