<?php

namespace App\Http\Controllers\Api;

use App\Worker;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class WorkerController extends Controller
{
    use ApiResponser;


    public function __construct()
    {
        $this->middleware('auth:api');
    }


    //get all workers
    public function index()
    {
        $workers = Worker::all();
        return $this->showAll($workers);
    }


    //store new worker
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:workers|max:50',
            'password' => 'required|min:6',
            'salary' => 'required|numeric',
            'bonus' => 'numeric'
        ];

        $this->validate($request, $rules);

        $request_data = $request->all();
        $request_data['password'] = bcrypt($request->password);

        $worker = Worker::create($request_data);

        return $this->showOne($worker);
    }



    //show specific worker
    public function show($id)
    {
        $worker = Worker::find($id);
        return $this->showOne($worker);
    }



    //update specific worker
    public function update(Request $request, Worker $worker)
    {
        $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:workers|max:50',
            'password' => 'required|min:6',
            'salary' => 'required|numeric',
            'bonus' => 'numeric'
        ];

        $this->validate($request, $rules);

        $request_data = $request->all();
        if ($request->has('password')) {
            $request_data['password'] = bcrypt($request->password);
        }

        $worker->update($request_data);
        return $this->showOne($worker);
    }



    //delete specific worker
    public function destroy(Worker $worker)
    {
        $worker->delete();
        return $this->showOne($worker);
    }


}
