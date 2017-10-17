<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SiteDetails extends Model
{
	protected $table = 'bt_site_details_tbl';
	protected $primaryKey = 'id';
	public $incrementing = 'true';
	public $timestamps  = false;
	public $modalTableName = 'bt_site_details_tbl';

	public function getUserData($user_id,$service_type){

		$where = ['user_id' => $user_id,'service_type' => $service_type];
		$users = $this::where($where)->get(); 
	//dd(DB::getQueryLog());
		return $users;
	}

	public function deleteUserData($user_id,$service_type){

	//	DB::enableQueryLog();
		$where = ['user_id' => $user_id,'service_type' => $service_type];
		$del_data = $this::where($where)->delete();
		//dd(DB::getQueryLog());
		return $del_data;
	}
}
?>