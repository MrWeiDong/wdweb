<?php  
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Admin\ClassAllow\Allow;


class LoginController extends Allow {
	
	public function index(){
		return view('admin.login');
	}
}