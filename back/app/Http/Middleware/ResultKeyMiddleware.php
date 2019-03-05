<?php

namespace App\Http\Middleware;

use App\Model\Customer;
use Closure;

class ResultKeyMiddleware
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
        $customer = Customer::where('secret_link', $request->result_key);
        if($customer->count() == 0) return redirect('/');
        return $next($request);
    }
}
