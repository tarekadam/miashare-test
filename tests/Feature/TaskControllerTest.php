<?php

namespace Tests\Feature;

use App\Http\Controllers\TaskController;
use App\Http\Requests\TaskRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TaskControllerTest extends TestCase{
    use DatabaseTransactions;

    /**
     * @see          TaskRequest::rules
     * @see          TaskController::store
     *
     * @dataProvider sampleRequests
     * @test
     */
    public function can_validate_request($memo, $status){
        $user = User::latest()->first();

        $respnse = $this->actingAs($user, 'web')
                        ->post(route('tasks.store', ['memo' => $memo]));

        xdebug_break();
        $respnse->assertStatus($status);
    }

    public function sampleRequests(){
        return [
            //min: 5
            ['memo' => 'abc', 'status' => 302],
            ['memo' => 'abcdefg asdfasdf asdf', 'status' => 200]
        ];
    }

}
