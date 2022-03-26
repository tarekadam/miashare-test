<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse as Response;

class TaskController extends Controller{

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     *
     * @return Response
     */
    public function store(TaskRequest $request): Response{
        $task = new Task($request->only(['memo']));
        $task->saveOrFail();

        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     *
     * @return Response
     */
    public function destroy(Task $task): Response{
        $task->deleteOrFail();

        return back();
    }
}
