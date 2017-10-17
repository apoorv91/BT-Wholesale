<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceDetails extends Model
{
	public $table = 'bt_service_details_tbl';
	protected $primaryKey = 'service_request_Id';
	public $incrementing = 'true';
	public $timestamps  = false;
	public $modelTablename = 'bt_service_details_tbl';

	public function getUserServiceData($user_id){

// DB::enableQueryLog();
	$data =  $this::where('user_id', $user_id)->first();
// dd(DB::getQueryLog());
		return $data;
	}
}

?>