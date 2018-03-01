<?php
namespace App\Http\Controllers;

use App\Http\Requests\CalculateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
     * Calculate sum of more then one or more then one operand.
     *
     * @param string $slugNum Number operands
     * @return json
     */
    public function add(Request $request)
    {
        $allNumbers = $request->operands;
        $total = $allNumbers[0];
        for ($i = 1; $i < count($allNumbers); $i++) {
            $total += $allNumbers[$i];
        }
        return response()->json([
            'data' => ['operands' => $allNumbers,
                'result' => $total,
                'operation' => $request->segment(1)],
        ]);
    }

    /**
     * Calculate difference of more then one operands.
     *
     * @param string $slugNum Number operands
     * @return json
     */
    public function subtract(Request $request)
    {

        $allNumbers = $request->operands;
        $total = $allNumbers[0];
        for ($i = 1; $i < count($allNumbers); $i++) {
            $total -= $allNumbers[$i];
        }

        return response()->json([
            'data' => ['operands' => $allNumbers,
                'result' => $total,
                'operation' => $request->segment(1)],
        ]);
    }

    /**
     * Calculate Multiplication of more then one operands.
     *
     * @param string $slugNum Number operands
     * @return json
     */
    public function multiply(Request $request)
    {
        $allNumbers = $request->operands;
        $total = $allNumbers[0];
        for ($i = 1; $i < count($allNumbers); $i++) {
            $total *= $allNumbers[$i];
        }

        return response()->json([
            'data' => ['operands' => $allNumbers,
                'result' => $total,
                'operation' => $request->segment(1)],
        ]);
    }

    /**
     * Calculate Division of more then one operands.
     *
     * @param string $slugNum Number operands
     * @return json
     */
    public function divide(Request $request)
    {
        $allNumbers = $request->operands;
        $total = $allNumbers[0];
        for ($i = 1; $i < count($allNumbers); $i++) {
            $total /= $allNumbers[$i];
        }

        return response()->json([
            'data' => ['operands' => $allNumbers,
                'result' => $total,
                'operation' => $request->segment(1)],
        ]);
    }

}
