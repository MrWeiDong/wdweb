<?php  
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Admin\ClassAllow\Allow;

use App\Models\Admin as AdminModel;

use DB;

class LoginController extends Allow {
	
	public function index(){
		
		$data = AdminModel::all();
		
		return view('admin.login');
	}
}