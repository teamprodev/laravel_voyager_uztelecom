<?php

namespace App\Http\Middleware;

use App\Services\ApplicationData;
use Closure;
use Illuminate\Http\Request;

class CloneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(($request->application->user_id === auth()->user()->id && $request->application->status === ApplicationData::Status_Canceled ) || ($request->application->user_id === auth()->user()->id && $request->application->status === ApplicationData::Status_Refused) || ($request->application->user_id === auth()->user()->id && $request->application->status === ApplicationData::Status_Rejected))
        {
            return $next($request);
        }
        abort(403,'Unauthorized action.');
    }
}
