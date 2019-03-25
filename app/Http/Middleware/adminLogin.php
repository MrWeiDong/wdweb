<?php  
namespace App\Http\Middleware;

use Closure;

class adminLogin {
	/**
     * 返回请求过滤器
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session('AdminInfo'))
        {	
			
        }else{
            return redirect('admin/login');
        }
    }
}