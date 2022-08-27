<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\submenu;
use App\Models\userSecuriryForm;

class MustHaveRole
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

        if(auth()->user()->role_idrole == 1)
           return $next($request);

        if(auth()->user()->role_idrole == 2)
        {
            $pathinfo = '/'.$request->path();
            $userId = auth()->user()->id;
            $userSecurity = userSecuriryForm::join('submenus', 'submenus.submenuid', '=', 'user_securiry_forms.submenuid')
            ->select('user_securiry_forms.can')
            ->where('submenus.route', '=' ,$pathinfo)
            ->where('user_securiry_forms.userid', '=', $userId)
            ->get();        

            if($userSecurity->count() > 0){
                if($userSecurity[0]->can)
                    return $next($request);
                else
                    return redirect()->route('home');
            }
            return $next($request);
        }

        return redirect()->route('main');
    }
}
