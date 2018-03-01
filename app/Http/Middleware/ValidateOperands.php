<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;


class ValidateOperands
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty($request->slugNum)){
            return response()->json([
                'error' => ['status'=>422,
                    'message'=>'Operands must be number.'],
            ],422);
        }
        if($request->slugNum){
            $allNumbers = explode('/', $request->slugNum);
            foreach($allNumbers as $numbers)
            {
                    //Check if operands are Number
                if(!preg_match('/^[0-9]+$/', $numbers)){
                    //Check operands are float/double
                    if(!preg_match('/^[0-9]+(\\.[0-9]+)?$/', $numbers)){
                        return response()->json([
                            'error' => ['status'=>422,
                                'message'=>'Operands must be number.'],
                        ],422);
                    }
                }
                //if denominator is zero in division operation
                if($request->segment(1) == 'divide'){
                    if($numbers == 0){
                        return response()->json([
                            'error' => ['status'=>422,
                                'message'=>'Denominator should not be zero.'],
                        ],422);
                    }
                }
            }

            $validData = $allNumbers;
            if($request->segment(1) != 'divide'){
            sort($validData, SORT_NUMERIC);
            }
            $key = $request->segment(1).'_'.implode(array_flatten($validData),'');

            if(Cache::has($key)){
                $data =Cache::get($key);
                return response()->json([
                    'data' => ['operands'=>$data['operands'],
                        'result'=>$data['result']
                    ],
                ]);
            }

            $request->request->add(['operands' => $allNumbers]);
            return $next($request);
        }

    }
}
