<?php

namespace App\Http\Middleware;

use Closure;

class FormDataParser
{
    /**
     * Handle an incoming request to parse POST Swagger data to array
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $entityBody = file_get_contents('php://input');
        $params = explode("&", $entityBody);

        if( !count($params) or empty($params[0]) ) return $next($request);

        $params_result = [];

        foreach( $params as $param ) {
            $param_data = explode("=", $param);

            if( count($param_data) != 2 ) {
                continue;
            }

            if( isset($params_result[$param_data[0]]) ) {
                if( !is_array($params_result[$param_data[0]]) ) {
                    $params_result[$param_data[0]] = [$params_result[$param_data[0]]];
                }
                $params_result[$param_data[0]][] = $param_data[1];
            } else {
                $params_result[$param_data[0]] = $param_data[1];
            }
        }

        $_REQUEST = $_POST = $params_result;

        $request->merge($params_result);

        return $next($request);
    }
}
