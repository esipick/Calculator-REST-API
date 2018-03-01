<?php

namespace App\Http\Middleware;

use Closure;

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
            foreach($allNumbers as $numbers){
                if(!preg_match('/^[0-9]+$/', $numbers)){
                    if(!preg_match('/^[0-9]+(\\.[0-9]+)?$/', $numbers)){
                        return response()->json([
                            'error' => ['status'=>422,
                                'message'=>'Operands must be number.'],
                        ],422);
                    }
                }
            }
            $request->request->add(['operands' => $allNumbers]);
            //$request->test = $request;
            return $next($request);
        }

    }
}
