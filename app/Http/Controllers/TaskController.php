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
     * @return Renderable
     */
    public function store(TaskRequest $request): Renderable{

        $task = new Task($request->only(['memo']));
        $task->saveOrFail();

        return view('home');
    }

    /**
     * Mark as complete.
     * @param Task $task
     *
     * @return Renderable
     */
    public function update(Task $task) : Renderable{

        $task->done = true;
        $task->saveOrFail();

        return view('home');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     *
     * @return Renderable
     */
    public function destroy(Task $task): Renderable{
        $task->deleteOrFail();

        return view('home');
    }
}
