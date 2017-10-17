<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Services\SoapService;
use SoapClient;
use SoapParam;
use File;
use Illuminate\Support\Facades\Storage;
use BTWholesale\SoapAPI\SoapAPI;
use SoapVar;


class SoapController extends Controller
{  	use SoapAPI;
	private $data;
	protected $resultData;

	
	public function __construct() {
  
	}

	public function getAddress(){

		$this->data =  array('DunsId'=> '856120977D' , 'AddressIdentifiers' => array('AddressIdentifier' => array('UPRN' => '48083357','Postcode' => 'SM4 5HH')));
		$this->resultData =    $this->getAddressesAPI($this->data ); 

		var_dump($this->resultData); 
		exit(); 

	}

	public function getDataCentres(){

		try {

			$this->data =  array('DunsId' => "856120977D" ,'ProvisionDate' => "2017-05-05");
			$this->resultData = $this->getDataCentresAPI($this->data);  

			var_dump(  $this->resultData); 
			exit(); 

		} catch(Exception $e) {
			echo $e->getMessage();

		}
	}

	public function getWholesaleEthernetELANQuote(){

		try {

			$SpokeSite = new SoapVar(array("NadKey" => "A00027562231/LS"), XSD_ANYTYPE, "NadKeySiteType", "http://bt.pricingtool.net/schema/v5", "SpokeSite");

			$SpokeSiteEtherwayBandwidth = new SoapVar(array("EtherwayBandwidth" => "FTTC 40:2 Mbit/s"), XSD_ANYTYPE, "EtherwayGEABandwidthType", "http://bt.pricingtool.net/schema/v5", "SpokeSiteEtherwayBandwidth");

			$this->data =  
			array( 
				'DunsId'=> '856120977D' ,
				'ProvisionDate'=> '2016-08-22' ,
				'CustomerQuoteReference'=> 'test quote 1' , 
				'Circuits' => array(
					'Circuit' => array(
						'CustomerCircuitReference' => 'example 3',
						'EtherflowELANCoS' => 'Default CoS (Standard)',
						'EtherflowELANBandwidth' => '5 Mbit/s',
						'SpokeSite' => $SpokeSite,
						'SpokeSiteEtherwayBandwidth' => $SpokeSiteEtherwayBandwidth ,
						)
					)
				);

			$this->resultData = $this->getWholesaleEthernetELANQuoteAPI($this->data);  

			echo  '<pre>';
			var_dump(  $this->resultData); 
			exit(); 

		} catch(Exception $e) {
			echo $e->getMessage();

		}
	}
}
