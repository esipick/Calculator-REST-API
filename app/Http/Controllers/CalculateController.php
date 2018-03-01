<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculateController extends Controller
{
    /*
     *Add numbers
    */
    public function add(Request $request){
        return $request->a + $request->b + $request->c ;
    }

    /*
        *Subtract numbers
    */
    public function subtract(Request $request){
        return $request->a - $request->b - $request->c ;
    }

    /*
       *multiply numbers
   */
    public function multiply(Request $request){
        return $request->a * $request->b * $request->c ;
    }

    /*
      *divide numbers
  */
    public function divide(Request $request){
        return $request->a / $request->b ;
    }
}
