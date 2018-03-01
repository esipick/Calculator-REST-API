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
     * @param string $slugNum  Number operands
     * @return json
     */
    public function add(Request $request){
        $validData = $request->operands;
         sort($validData, SORT_NUMERIC);
        $key = 'add_'.implode(array_flatten($validData),'');

        //check if operends are exist in cache
       $cacheExit = $this->checkExistInCache($key,$validData);
        if($cacheExit){
           return response()->json([
               'data' => ['operands'=>$validData,
                   'result'=>$cacheExit],
           ]);
       }

        $allNumbers = $validData;

        $total =$allNumbers[0];
        for($i=1; $i<count($allNumbers); $i++){
            $total += $allNumbers[$i];
        }

        $this->storeInCache($key,$allNumbers);
        $this->storeInCache($key.'_result',$total);
        return response()->json([
            'data' => ['operands'=>$allNumbers,
                        'result'=>$total],
        ]);
    }

    /**
     * Calculate difference of more then one operands.
     *
     * @param string $slugNum  Number operands
     * @return json
     */
    public function subtract(Request $request){
        $validData = $request->operands;
        sort($validData, SORT_NUMERIC);
        $key = 'subtract_'.implode(array_flatten($validData),'');

        //check if operends are exist in cache
        $cacheExit = $this->checkExistInCache($key,$validData);
        if($cacheExit){
            return response()->json([
                'data' => ['operands'=>$validData,
                    'result'=>$cacheExit],
            ]);
        }

        $allNumbers = $validData;

        $total =$allNumbers[0];
        for($i=1; $i<count($allNumbers); $i++){
            $total -= $allNumbers[$i];
        }

        $this->storeInCache($key,$allNumbers);
        $this->storeInCache($key.'_result',$total);
        return response()->json([
            'data' => ['operands'=>$allNumbers,
                'result'=>$total],
        ]);
    }

    /**
     * Calculate Multiplication of more then one operands.
     *
     * @param string $slugNum  Number operands
     * @return json
     */
    public function multiply(Request $request){
        $validData = $request->operands;
        sort($validData, SORT_NUMERIC);
        $key = 'multiply_'.implode(array_flatten($validData),'');
        //check if operends are exist in cache
        $cacheExit = $this->checkExistInCache($key,$validData);
        if($cacheExit){
            return response()->json([
                'data' => ['operands'=>$validData,
                    'result'=>$cacheExit],
            ]);
        }

        $allNumbers = $validData;

        $total =$allNumbers[0];
        for($i=1; $i<count($allNumbers); $i++){
            $total *= $allNumbers[$i];
        }

        $this->storeInCache($key,$allNumbers);
        $this->storeInCache($key.'_result',$total);
        return response()->json([
            'data' => ['operands'=>$allNumbers,
                'result'=>$total],
        ]);
    }

    /**
     * Calculate Division of more then one operands.
     *
     * @param string $slugNum  Number operands
     * @return json
     */
    public function divide(Request $request){
        $validData = $request->operands;
        $key = 'divide_'.implode(array_flatten($validData),'');
        //check if operends are exist in cache
        $cacheExit = $this->checkExistInCache($key,$validData);
        if($cacheExit){
            return response()->json([
                'data' => ['operands'=>$validData,
                    'result'=>$cacheExit],
            ]);
        }

        $allNumbers = $validData;

        $total =$allNumbers[0];
        for($i=1; $i<count($allNumbers); $i++){
            if($allNumbers[$i] == 0){
                return response()->json([
                    'error' => ['status'=>200,
                        'message'=>'Denominator should not be zero.'],
                ],422);
            }
            $total /= $allNumbers[$i];
        }

        $this->storeInCache($key,$allNumbers);
        $this->storeInCache($key.'_result',$total);
        return response()->json([
            'data' => ['operands'=>$allNumbers,
                'result'=>$total],
        ]);
    }

    /**
     * Get operands from cache if exist.
     *
     * @param string $key  Cache Key
     * @param array $data  Operands Array
     * @return array | boolen
     */
    private function checkExistInCache($key, $data){
        $cachedData =Cache::get($key);
        if(!$cachedData){
            return false;
        }

        if($cachedData == $data){
            return Cache::get($key.'_result');
        }

        return false;
    }

    /**
     * Store operands in cache cache if exist.
     *
     * @param string $key  Cache Key
     * @param array $data  Operands Array
     * @return array | boolen
     */
    private function storeInCache($key, $data){
       Cache::set($key,$data,1440);
        return true;
    }
}
