<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class BeforeResponse
{
    public $setTime = 11440;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $operands = $response->original['data']['operands'];
        if($request->segment(1) != 'divide'){
            sort($operands, SORT_NUMERIC);
        }
        $key = $response->original['data']['operation'].'_'.implode(array_flatten($operands),'');
        $data = ['operands'=>$response->original['data']['operands'],
                  'result'=> $response->original['data']['result']
                ];
        Cache::set($key, $data, $this->setTime);
         return $response;
    }
}
