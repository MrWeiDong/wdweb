<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Admin\ClassAllow\Allow;

use App\Models\Meun as MeunModel;

use App\models\Icon as IconModel;

class MeunController extends Allow{
	
	function __construct(){
		require_once('../resources/org/data/Data.php');
		$this->dataTree = new \Data;
	}

	public function index(){
		$data = MeunModel::all()->toArray();
		$info=$this->dataTree->tree($data,'title','id','pid');
		$data=[
			'data'=>$info,	
		];
		
		return view('admin.meun.index')->with($data);
	}
	
	public function edit(Request $request){
		if($request->isMethod('post')){
		
		}else{
			$icon = IconModel::all()->toArray();
			$data = [
				'icon' => $icon	
			];
			return view('admin.meun.add')->with($data);
		}
	}
	
}