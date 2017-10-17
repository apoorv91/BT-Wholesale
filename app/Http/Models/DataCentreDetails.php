<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataCentreDetails extends Model
{
	protected $table = 'bt_data_centre_details_tbl';
	protected $primaryKey = 'id';
	public $incrementing = 'true';
	public $timestamps  = false;
	public $modelTableName = 'bt_data_centre_details_tbl';

	public function getUserDataCentreData($user_id,$service_type){
		$where = ['user_id' => $user_id,'service_type' => $service_type];
		$result = $this::where($where)->get();
		//dd(DB::getQueryLog());
		return $result;
	}
	public function deleteUserDataCentreData($user_id,$service_type){

		$where = ['user_id' => $user_id,'service_type' => $service_type];
		$del_data_centres = $this::where($where)->delete();

		return $del_data_centres;
	}
}

?>