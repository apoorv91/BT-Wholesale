<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
	protected $table = 'bt_user_details_tbl';
	protected $primaryKey = 'id';
	public $incrementing = 'true';
	public $timestamps  = false;
	public $modelTablename = 'bt_user_details_tbl';

	public function getUserDetails($user_id){
		
		$user_data_result = $this::where('id',$user_id)->first();
		return $user_data_result;
	}
}
?>