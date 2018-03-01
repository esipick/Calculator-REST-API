<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * CalculateController
 *
 *
 * @package    CI
 * @subpackage Controller
 * @author     Developer <info@esipick.com>
 */
class CalculateController extends Controller
{
    /**
     * Calculate sum of more then one operands.
     *
     * @param string $slugNum  Number operands
     * @return json
     */
    public function add(Request $request){

        $allNumbers = explode('/', $request->slugNum);

        $total =$allNumbers[0];
        for($i=1; $i<count($allNumbers); $i++){
            $total += $allNumbers[$i];
        }

        return response()->json([
            'total' => $total,
        ]);
    }

    /**
     * Calculate difference of more then one operands.
     *
     * @param string $slugNum  Number operands
     * @return json
     */
    public function subtract(Request $request){
        if($request->slugNum)
        {
            $allNumbers = explode('/', $request->slugNum);

            $total =$allNumbers[0];
            for($i=1; $i<count($allNumbers); $i++){
                $total -= $allNumbers[$i];
            }
        }

        return response()->json([
            'total' => $total,
        ]);
    }

    /**
     * Calculate Multiplication of more then one operands.
     *
     * @param string $slugNum  Number operands
     * @return json
     */
    public function multiply(Request $request){
        if($request->slugNum)
        {
            $allNumbers = explode('/', $request->slugNum);

            $total =$allNumbers[0];
            for($i=1; $i<count($allNumbers); $i++){
                $total *= $allNumbers[$i];
            }
        }

        return response()->json([
            'total' => $total,
        ]);
    }

    /**
     * Calculate Division of more then one operands.
     *
     * @param string $slugNum  Number operands
     * @return json
     */
    public function divide(Request $request){
        if($request->slugNum)
        {
            $allNumbers = explode('/', $request->slugNum);

            $total =$allNumbers[0];
            for($i=1; $i<count($allNumbers); $i++){
                $total /= $allNumbers[$i];
            }
        }

        return response()->json([
            'total' => $total,
        ]);
    }
}
