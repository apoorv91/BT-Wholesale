<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ColocationDetails extends Model
{

	protected $table = 'bt_colocation_quote_tbl';
	protected $primaryKey = 'id';
	public $incrementing = 'true';
	public $timestamps  = false;
	public $modelTableName = 'bt_colocation_quote_tbl';

	public function getUserColocationData($user_id,$service_type){

		//DB::enableQueryLog();
		$where = ['user_id' => $user_id,'service_type' => $service_type];
		//$result = DB::table($this->modelTableName)->where($where)->get();
		 $result = $this::where($where)->get();
		//dd(DB::getQueryLog());
		return $result;
	}

	public function deleteUserColocationData($user_id,$service_type){

		$where = ['user_id' => $user_id,'service_type' => $service_type];
		$del_result = $this::where($where)->delete();
		return $del_result;
	}
}

?>