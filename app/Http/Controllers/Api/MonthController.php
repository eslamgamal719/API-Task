<?php

namespace App\Http\Controllers\Api;

use App\Month;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MonthController extends Controller
{

    use ApiResponser;

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    //show all months statistics
    public function index()
    {

        $months = Month::all();
        return $this->showAll($months);

    }


    //add months statistics
    public function store(Request $request)
    {

        $rules = [
            'month' => 'required|unique:months',
            'salary_payment_day' => 'required|numeric|max:31|min:27',
            'bonus_payment_day' => 'required|numeric',
            'salaries_total' => 'required|numeric',
            'bonus_total' => 'required|numeric',
            'payments_total' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        $month = Month::create($request->all());

        return $this->showOne($month);
    }


    //update specific month
    public function update(Request $request, $id)
    {

        $rules = [
            'month' => 'unique:months',
            'salary_payment_day' => 'numeric|min:26|max:31',
            'bonus_payment_day' => 'numeric|min:15',
            'salaries_total' => 'numeric',
            'bonus_total' => 'numeric',
            'payments_total' => 'numeric',
        ];

        $this->validate($request, $rules);

        $month = Month::find($id);
        $month->update($request->all());

        return $this->showOne($month);
    }


    //show specific month
    public function show($id)
    {

        $month = Month::find($id);
        return $this->showOne($month);
    }


    //delete specific month
    public function destroy($id)
    {

        $month = Month::find($id);
        $month->delete();

        return $this->showOne($month);
    }


    //get statistics for remainder months
    public function getRemainderMonths()
    {

        $currentMonth = date('m');
        $data = [];

        for ($i = $currentMonth; $i <= 12; $i++) {

            $month = Month::find($i);
            array_push($data, $month);

        }

        return $this->showAll($data);
    }


}
