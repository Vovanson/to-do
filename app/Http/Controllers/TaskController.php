<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Add New Task
     *
     * @param  Request $request
     * @return string
     */
    public function addTask(Request $request)
    {
        $count = Task::where('name', $request->name)
            ->where('category_id', $request->category_id)
            ->count();
        if (!$count) {
            $task = new Task;
            $task->name = $request->name;
            $task->state = 'success';
            $task->done = '0';
            $task->category_id = $request->category_id;
            $task->save();

            return 'OK';

        } else {

            return 'Error';
        }
    }

    /**
     * Delete Task
     *
     * @param  int $id
     * @return string
     */
    public function deleteTask($id)
    {
        $del_task = Task::find($id);

        if ($del_task) {
            $del_task->delete();

            return ('deleteOK ' . $id);
        }

        return ('Can not be delete');
    }

    /**
     * Update Task
     *
     * @param  Request $request
     * @param  int $id
     * @return string
     */
    public function updateTask($id, Request $request)
    {
        $task = Task::find($id);

        if ($task) {
            $active = $request->active;
            $task->$active = $request->$active;
            $task->save();

            return ('saveOK ' . $id);
        }

        return ('Can not be update');
    }
}

