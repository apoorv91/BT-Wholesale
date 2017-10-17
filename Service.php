<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $table = 'bt_service_details_tbl';
	protected $primaryKey = 'service_request_Id';
	public $incrementing = 'false';
	public $timestamps  = false;

	public function insertRow(){

		return "Acessing method of model";
	}
}

?>