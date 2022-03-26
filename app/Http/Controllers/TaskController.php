<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Contracts\Support\Renderable;

class TaskController extends Controller{

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     *
     * @return Response
     */
    public function store(TaskRequest $request): Renderable{
        $task = new Task($request->only(['memo']));
        $task->saveOrFail();

        return view('home');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     *
     * @return Response
     */
    public function destroy(Task $task): Renderable{
        $task->deleteOrFail();

        return view('home');
    }
}
