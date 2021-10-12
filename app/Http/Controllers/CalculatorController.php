<?php

namespace App\Http\Controllers;


use App\Calculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CalculatorController extends Controller
{
    public function index(Request $request)
    {
        $this->validate(request(), [
            'length' => 'required',
            'width' => 'required'

        ]);
        $number_one = $request->input('width');;
        $number_two = $request->input('length');
        $sum = $number_one + $number_two;
        $cm=$sum*100;
        $m = $sum / 100;


        $table = new Calculator(); //modelname

        $table->width = $number_one;
        $table->length = $number_two;
        $table->original_result = $sum;
        $table->result_cm = $cm;
        $table->result_m = $m;

        $table->save();
        if (!$table) {
            return redirect('/showcal')->with('success_message', 'Your Mirror Detail is not Successfull Create:');
        }

        else
        {
        return redirect('/showcal');//->with('success_message','Your Mirror Detail is Successfull Create:');
        }
        //echo $result;

    }

    public function sections()
    {
        Session::put('page', 'sections');
        $sections = Calculator::latest()->paginate(15);
        return view('calculator')->with(compact('sections'));
    }
}
