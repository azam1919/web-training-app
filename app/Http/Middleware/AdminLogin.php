<?php

namespace App\Http\Middleware;

use App\Models\ModulesGroup;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('session_time')) {
            $session_time = Session::get('session_time');
            $current_time = time();
            $inactive = 3600;
            if ($current_time - $session_time > $inactive) {
                $request->session()->flush();
                return redirect('/admin');
            } else {
                if (Session::has('full_name')) {
                    $REQUEST_URI = '/' . Route::current()->uri();
                    $modules_urls = function ($query) use ($REQUEST_URI) {
                        $query->where('url', $REQUEST_URI);
                    };
                    $permissions = function ($query) {
                        $query->where('r_id', Session::get('r_id'));
                    };
                    $module_groups = ModulesGroup::with('modules')->whereHas('modules.permissions', $permissions)->whereHas('modules.modules_urls', $modules_urls)
                        ->with('modules.permissions', $permissions)
                        ->with('modules.modules_urls', $modules_urls)
                        ->get();
                    // $response = response('', 404);
                    foreach ($module_groups as $module_group) {
                        foreach ($module_group->modules as $module) {
                            if (!empty($module->permissions)) {
                                if (($module->id == $module->permissions['m_id']) && ($module->permissions['view'] == 1)) {
                                    $response = $next($request);
                                } elseif (!empty($module->modules_urls)) {
                                    foreach ($module->modules_urls as $modules_url) {
                                        if ($module->id == $module->permissions['m_id'] && $module->id == $modules_url->m_id &&  $module->status == 1) {
                                            $response = $next($request);
                                        }
                                    }
                                } else {
                                    // $response = response('', 404);
                                    $response = $next($request);
                                }
                            }
                        }
                    }
                    $response = $next($request);

                    return $response->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
                }
            }
        }
    }
}
