<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;



class TaskController extends Controller
{
    protected $tasks;
    /**
     * �������� ������ ���������� �����������.
     *
     * @return void
     */

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }
    /**
     * ����������� ������ ���� ����� ������������.
     *
     * @param  Request  $request
     * @return Response
     */
    /**
     * �������� ������ ���� ����� ������������.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }
    /**
     * �������� ����� ������.
     *
     * @param  Request  $request
     * @return Response
     */


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->update();

        return redirect('/tasks');
    }
}
