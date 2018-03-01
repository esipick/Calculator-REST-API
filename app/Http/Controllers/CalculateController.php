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
        $validData = $this->validateOperands($request);
        if(!$validData){
               return response()->json([
                   'error' => ['status'=>422,
                                'message'=>'Operands must be number.'],
               ],422);
           }

           //check if operends are exist in cache
       $cacheExit = $this->checkExistInCache('add',$validData);
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

        $this->storeInCache('add',$allNumbers);
        $this->storeInCache('add_result',$total);
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
        $validData = $this->validateOperands($request);
        if(!$validData){
            return response()->json([
                'error' => ['status'=>200,
                    'message'=>'Operands must be number.'],
            ],422);
        }
        $allNumbers = $validData;

        $total =$allNumbers[0];
        for($i=1; $i<count($allNumbers); $i++){
            $total -= $allNumbers[$i];
        }

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
        $validData = $this->validateOperands($request);
        if(!$validData){
            return response()->json([
                'error' => ['status'=>200,
                    'message'=>'Operands must be number.'],
            ],422);
        }
        $allNumbers = $validData;

        $total =$allNumbers[0];
        for($i=1; $i<count($allNumbers); $i++){
            $total *= $allNumbers[$i];
        }

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
        $validData = $this->validateOperands($request);
        if(!$validData){
            return response()->json([
                'error' => ['status'=>200,
                    'message'=>'Operands must be number.'],
            ],422);
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

        return response()->json([
            'data' => ['operands'=>$allNumbers,
                'result'=>$total],
        ]);
    }

    /**
     * Validation before mathematical operations on operand
     *
     * @param string $request  operands
     * @return array | boolen
     */

    private function validateOperands($request){
        if(empty($request->slugNum)){
            return false;
        }
        if($request->slugNum){
            $allNumbers = explode('/', $request->slugNum);
            foreach($allNumbers as $numbers){
                if(!preg_match('/^[0-9]+$/', $numbers)){
                    if(!preg_match('/^[0-9]+(\\.[0-9]+)?$/', $numbers)){
                        return false;
                    }
                }
            }
            return $allNumbers;
        }
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
