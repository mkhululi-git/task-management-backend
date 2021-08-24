<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return response($tasks);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'required|max:255',
            'board_id' => 'required|exists:boards,id',
            'user_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id'
        ]);
        if ($validator->errors()->count()) {
            return response($validator->errors(), 400);
        }


        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->board_id = $request->board_id;
        $task->user_id = $request->user_id;
        $task->status_id = $request->status_id;
        $task->save();
        return response($task, 201);
    }



    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        return $task ?
            response($task) :
            response('Task not found', 404);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'required|max:255',
            'status_id' => 'required|exists:statuses,id'
        ]);
        if ($validator->errors()->count()) {
            return response($validator->errors(), 400);
        }

        $task = Task::find($id);
        if(!$task) return response('Task not found', 404);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status_id = $request->status_id;
        $task->save();
        return response($task);
    }



    /**
     * Update the specified attributes of a resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function patch_update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'max:100',
            'description' => 'max:255',
            'status_id' => 'exists:statuses,id'
        ]);
        if ($validator->errors()->count()) return response($validator->errors(), 400);

        $task = Task::find($id);
        if(!$task) return response('Task not found', 404);
        if ($request->title) $task->title = $request->title;
        if ($request->description) $task->description = $request->description;
        if ($request->status_id) $task->status_id = $request->status_id;
        $task->save();
        return response($task);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::loginUsingId(2);

        Gate::authorize('delete', Task::find($id));

        return Task::destroy($id) ?
            response('Task deleted successfully') :
            response('Task not found', 404);
    }
}
