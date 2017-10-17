<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Models\ServiceDetails;
use App\Http\Models\UserDetails;
use App\Http\Models\SiteDetails;
use App\Http\Models\DataCentreDetails;
use App\Http\Models\ColocationDetails;
use DateTime;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation;
use Illuminate\Support\Facades\Redirect;
use App\Services\SoapService;
use SoapClient;
use SoapParam;
use SoapVar;

use BTWholesale\SoapAPI\SoapAPI;
use PDF;
use App;
use App\Mail\SendMailClass;
use Mail;

class ServiceController extends Controller
{ 
	use SoapAPI;
	private $get_service_value_db = "";
	private $user_id = "";
	private $connectionBT;
	private $sitespeedDatas = "",$resilienceDatas = "",$dataCentres = "",$dataCentresSpeeds = "",$colocationLocations = "",$colocationRacks = "",$colocationPowerRatings = "",$colocationPowerRegimes = "",$colocationNetworkServices = "",$qosLevel = "";
	public $apiErrors = array();


	public function __construct() { 

		//$this->connectionBT = new SoapAPI() ;  

	}

	public function getSpeedData(){ 

		$this->sitespeedDatas = array('2' =>'2Mbps' , '10' =>'10Mbps','30' =>'30Mbps','50' =>'50Mbps','100' =>'100Mbps');

	}

	public function getResilienceData(){

		$this->resilienceDatas = array('null' => 'Not required','adsl' => 'Yes - ADSL', 'fttc' => 'Yes - FTTC'); 

	}

	public function getDataCentres(){

		// provision date yyyy-mm-dd format.

		$GetDataCentres =  array('DunsId' => "856120977D" ,'ProvisionDate' => "2017-07-19");
		$result = $this->getDataCentresAPI($GetDataCentres);
		
		$this->dataCentres = $result->DataCentres->DataCentre;

		// $this->dataCentres = array('6DG Birmingham Central' => '6DG Birmingham Central','6DG Birmingham South (Studley)' => '6DG Birmingham South (Studley)','6DG London' => '6DG London','AQL DC3 Leeds' => 'AQL DC3 Leeds','CityLifeLine' => 'CityLifeLine','Equinix LD5' => 'Equinix LD5','Equinix LD6 - (via LD5)' => 'Equinix LD6 - (via LD5)');

	}

	public function getDataCentresSpeed(){
		$this->dataCentresSpeeds = array('10' => '10Mbps','100' => '100Mbps','1000' => '1000Mbps');
	}

	public function getColocationLocations(){

		$this->colocationLocations = array('6DG Birmingham Central' => '6DG Birmingham Central','6DG Birmingham South (Studley)' => '6DG Birmingham South (Studley)','6DG London' => '6DG London','AQL DC3 Leeds' => 'AQL DC3 Leeds','CityLifeLine' => 'CityLifeLine','Equinix LD5' => 'Equinix LD5','Equinix LD6 - (via LD5)' => 'Equinix LD6 - (via LD5)');

	}
	public function getColocationRacks(){

		$this->colocationRacks = array('1' => '1','2' => '2','3' => '3');
	}

	public function getColocationPowerRatings(){

		$this->colocationPowerRatings = array('1kW' => '1kW','2kW' => '2kW','3kW' => '3kW');
	}

	public function getColocationPowerRegimes(){

		$this->colocationPowerRegimes = array('pre_provisioned' => 'Pre Provisioned','metered' => 'Metered');
	}

	public function getColocationNetworkServices(){


		$this->colocationNetworkServices = array('100Mb_s' => '100Mb/s','1Gb_s' => '1Gb/s','10Gb_s' => '10Gb/s');
	}

	public function getColocationAccessInternets(){

		$this->colocationAccessInternets = array('10Mb_sm' => '10Mb/sm','20Mb_sm' => '20Mb/sm','50Mb_sm' => '50Mb/sm');
	}

	public function getQosLevel(){

		$this->qosLevel = array('standardm' => 'Standardm','premiumm' => 'Premiumm');
	}

	public function showForm(Request $request){

		$this->get_service_value_db = "string";
		$this->user_id = "";
		$apiErrors = array();

		if($request->session()->has('user_id')){

			if(!empty(session('user_id'))){

				$result = DB::table('bt_service_details_tbl')->where('user_id',session('user_id'))->value('service_type');
				$count = count($result);

				if($count>0)
				{
					//echo 'records found: '.$count;

					$this->user_id = session('user_id');
					$this->get_service_value_db = $result;

				}else{
					//echo 'remove session val';
					$request->session()->forget('user_id');
				}
			}	
		}
		return view('index')->with('service_type',$this->get_service_value_db);
	}

	// method for displaying data from DB to internet access view.

	public function showInternetAccessFrom(){


		if(session()->has('user_id')){
			if(!empty(session('user_id'))){

				$this->user_id = session('user_id');
				$this->service_type = session('service_type');

				$this->getSpeedData();
				$this->getResilienceData();
				$this->getDataCentres();
				$this->getDataCentresSpeed();
				$this->getColocationLocations();
				$this->getColocationRacks();
				$this->getColocationPowerRatings();
				$this->getColocationPowerRegimes();
				$this->getColocationPowerRatings();
				$this->getColocationNetworkServices();
				$this->getColocationAccessInternets();
				$this->getQosLevel();

				$siteDetails = new SiteDetails();
				$results = $siteDetails->getUserData($this->user_id,$this->service_type);
				if($this->service_type == 'internet_access'){

					// print_r($this->colocationNetworkServices);
					return view('internetAccess')->with('results',$results)->with('sitespeedDatas',$this->sitespeedDatas)->with('resilienceDatas' ,$this->resilienceDatas)->with('dataCentres',$this->dataCentres)->with('dataCentresSpeeds',$this->dataCentresSpeeds)->with('colocationLocations',$this->colocationLocations)->with('colocationRacks',$this->colocationRacks)->with('colocationPowerRatings',$this->colocationPowerRatings)->with('colocationPowerRegimes',$this->colocationPowerRegimes)->with('colocationNetworkServices',$this->colocationNetworkServices)->with('colocationAccessInternets',$this->colocationAccessInternets)->with('qosLevels',$this->qosLevel)->with('apiErrors',$this->apiErrors);;
				}
			}
		}
	}

	public function showFrom(){

		$siteDetails = new SiteDetails();
		$serviceDetails = new ServiceDetails();
		$dataCentre = new DataCentreDetails();
		$colocationDetails = new ColocationDetails();

		if(session()->has('user_id')){
			if(!empty(session('user_id'))){

				$this->user_id = session('user_id');
				$this->service_type = session('service_type');
				$this->getSpeedData();
				$this->getResilienceData();
				$this->getDataCentres();
				$this->getDataCentresSpeed();
				$this->getColocationLocations();
				$this->getColocationRacks();
				$this->getColocationPowerRatings();
				$this->getColocationPowerRegimes();
				$this->getColocationPowerRatings();
				$this->getColocationNetworkServices();
				$this->getColocationAccessInternets();
				$this->getQosLevel();

				if($this->service_type == 'internet_access'){
					$results = $siteDetails->getUserData($this->user_id,$this->service_type);

					// print_r($this->colocationNetworkServices);
					return view('internetAccess')->with('results',$results)->with('sitespeedDatas',$this->sitespeedDatas)->with('resilienceDatas' ,$this->resilienceDatas)->with('dataCentres',$this->dataCentres)->with('dataCentresSpeeds',$this->dataCentresSpeeds)->with('colocationLocations',$this->colocationLocations)->with('colocationRacks',$this->colocationRacks)->with('colocationPowerRatings',$this->colocationPowerRatings)->with('colocationPowerRegimes',$this->colocationPowerRegimes)->with('colocationNetworkServices',$this->colocationNetworkServices)->with('colocationAccessInternets',$this->colocationAccessInternets)->with('apiErrors',$this->apiErrors);

				}else if($this->service_type == 'multi_site'){

					$siteData = $siteDetails->getUserData($this->user_id,$this->service_type);
					$serviceData = $serviceDetails->getUserServiceData($this->user_id);
					$dataCenterData = $dataCentre->getUserDataCentreData($this->user_id,$this->service_type);
					$colocationData = $colocationDetails->getUserColocationData($this->user_id,$this->service_type);

					return view('multiSite')->with('results', $siteData)->with('serviceData',$serviceData)->with('dataCenterDatas',$dataCenterData)->with('colocationDatas',$colocationData)->with('sitespeedDatas',$this->sitespeedDatas)->with('resilienceDatas' ,$this->resilienceDatas)->with('dataCentres',$this->dataCentres)->with('dataCentresSpeeds',$this->dataCentresSpeeds)->with('colocationLocations',$this->colocationLocations)->with('colocationRacks',$this->colocationRacks)->with('colocationPowerRatings',$this->colocationPowerRatings)->with('colocationPowerRegimes',$this->colocationPowerRegimes)->with('colocationNetworkServices',$this->colocationNetworkServices)->with('colocationAccessInternets',$this->colocationAccessInternets);
				}	
			}
		}
	}

	public function showUserDetailsForm(){

		if(session()->has('user_id')){
			if(!empty(session('user_id'))){

				$userdetails = new UserDetails();
				$userData = $userdetails->getUserDetails(session('user_id'));
				return view('userDetails')->with('userDatas',$userData);

			}else{

				return view('index');
			}
		}
	}

	public function storeForm1Values(Request $request){

		DB::enableQueryLog();
		$this->user_id = "";
		$result = "";
    
		$ldate = strtotime(date('Y-m-d H:i:s'));
		$service_value = $request->service_type;

		if($request->session()->has('user_id')){

			$this->user_id = session('user_id');
		}

		$service = new ServiceDetails();
		$userDetails = new UserDetails();
		$service->service_type = $service_value;


		$service->added_time = date('Y-m-d H:i:s');

		if (!empty($this->user_id)) {

			try{

				$update = ['service_type' => $service_value,'added_time' => $service->added_time];
				$result = DB::table('bt_service_details_tbl')->where('user_id', $this->user_id)->update($update);

				$request->session()->put('service_type',$service_value);

			}catch(\Exception $e){
				echo $e;
			}

		}else{

			$userDetails->save();
			$lastInsertedId = $userDetails->id;

			$service->user_id = $lastInsertedId;
			$result = $service->save();

			$request->session()->put('user_id',$lastInsertedId);
			$request->session()->put('service_type',$service_value);

		} 

		if($service_value=="internet_access")
		{
			return $this->showInternetAccessFrom();
			//return view('internetAccess');

		}else if($service_value=="multi_site"){

			return $this->showFrom();
			//return view('multiSite');
		}
	}

	public function internetAccessFormvalues(Request $request){

		$sitepostcode = array();
		$sitespeed = array();
		$siteresilient = array();
		$mergedArray = array();
		$SiteDetailsObj = new SiteDetails();
		$result_Address = array();
		
		if($request->session()->has('user_id')){
			
			$this->user_id = session('user_id');
			$this->service_type = session('service_type');
			$del_result = $SiteDetailsObj->deleteUserData($this->user_id,$this->service_type);
		}

		$sitepostcode = $request->sitepostcode;
		$sitespeed = $request->sitespeed;
		$siteresilient = $request->siteresilient;

		$rules = [
		'sitepostcode.*' => 'required|min:7|max:8',
		'sitespeed.*' => 'required',
		'siteresilient.*' => 'required'
		];

		$messages = [
		'sitepostcode.*.required' => ' Please enter valid postcode.',
		'sitepostcode.*.min' => ' The postcode must be of 7 characters.',
		'sitepostcode.*.max' => ' The postcode must be of 8 characters.',
		'sitespeed.*.required' => ' The speed field is required.',
		'siteresilient.*.required' => ' The speed must be at least 5 characters.',
		];

		$validator = Validator::make($request->all(), $rules, $messages);

		foreach($sitepostcode as $key => $value)
		{

			$SiteDetails = new SiteDetails();
			$SiteDetails->user_id = $this->user_id;
			$SiteDetails->postcode = $value;
			$SiteDetails->speed = $sitespeed[$key];
			$SiteDetails->resilience = $siteresilient[$key];
			$SiteDetails->service_type = session('service_type');
			$SiteDetails->added_time = date('Y-m-d H:i:s');
			$result = $SiteDetails->save();
			
			if(!empty($value)){

				if ($validator->fails()==0) {

					$GetAddressData =  array('DunsId'=> '856120977D' , 'AddressIdentifiers' => array('AddressIdentifier' => array('UPRN' => '48083357','Postcode' => $value)));

			$SpokeSite1 = new SoapVar(array("Postcode" => "BS34 5LE"), XSD_ANYTYPE, "PostcodeSiteType", "http://bt.pricingtool.net/schema/v5", "SpokeSite");

			$SpokeSiteEtherwayBandwidth = new SoapVar(array("EtherwayBandwidth" => "100 Mbit/s Protected (RAO1)"), XSD_ANYTYPE, "EtherwayFibreBandwidthType", "http://bt.pricingtool.net/schema/v5", "SpokeSiteEtherwayBandwidth");


			$GetWholesaleEthernetELANQuote =   array( 
			'DunsId'=> '856120977D' ,
			'CustomerQuoteReference'=> 'test quote 1' , 
			'Circuits' => array(
			'Circuit' => array(
			'CustomerCircuitReference' => 'example 3',
			'EtherflowELANCoS' => 'Default CoS (Standard)',
			'EtherflowELANBandwidth' => '50 Mbit/s',
			'SpokeSite' => $SpokeSite1,
			'SpokeSiteEtherwayBandwidth' => $SpokeSiteEtherwayBandwidth ,
			)));  


			try {  

			$result = $this->getWholesaleEthernetELANQuoteAPI($GetWholesaleEthernetELANQuote ); 
			        print_r($result);  exit;
			} catch(Exception $e) {  
			  
			   echo $e->getMessage();
			 
			}

		    $result_Address[] = $this->GetWholesaleEthernetELANQuote($GetAddressData);

					if(!empty($result_Address[$key]->AddressIdentifiers->AddressIdentifier->Errors)){

						$this->apiErrors[$key] = $result_Address[$key]->AddressIdentifiers->AddressIdentifier->Errors;

					}else{
						$this->apiErrors[$key]= "";
					}
				}
			}
		}

		if ($validator->fails()) {
	
			return Redirect::back()->withErrors($validator)->withInput();

		}else if(count($this->apiErrors)>0 && $this->apiErrors[0]!=""){

			return $this->showFrom();

		}else if($validator->fails() && count($this->apiErrors)>0){
	
			return Redirect::back()->withErrors($validator)->withInput()->with('apiErrors',$this->apiErrors);

		}else{

			return $this->showUserDetailsForm();
		}
	}

	public function multiSiteFormValues(Request $request){

		$multisitepostcode = array();
		$multisitespeed = array();
		$multisiteresilient = array();

		$datacentersitelocation = array();
		$datacentersitespeed = array();

		$colocation_location = array();
		$colocation_racks_number = array();
		$colocation_maxPoweRating = array();
		$colocation_powerRegime = array();
		$colocation_NetworkServices = array();
		$colocation_internetAccess = array();
		$dedicatedPodRequirements = array();

		$mergedsiteAccessArray = array();
		$mergedDataCentresArray = array();

		$SiteDetailsObj = new SiteDetails();
		$service = new ServiceDetails();
		$dataCentreObj = new DataCentreDetails();
		$colocationDetailsObj = new ColocationDetails();

		if($request->session()->has('user_id')){

			$this->user_id = session('user_id');
			$this->service_type = session('service_type');

			$delSiteDetails = $SiteDetailsObj->deleteUserData($this->user_id,$this->service_type);
			$delDataCentreDetails = $dataCentreObj->deleteUserDataCentreData($this->user_id,$this->service_type);
			$delColocationDetails = $colocationDetailsObj->deleteUserColocationData($this->user_id,$this->service_type);

		}

// multiple values of site access form in the form of array.


		$multisitepostcode = $request->multisitepostcode;
		$multisitespeed = $request->multisitespeed;
		$multisiteresilient = $request->multisiteresilient;

		if(count($multisitepostcode)>0){
			foreach ($multisitepostcode as $key => $value) {

				$SiteDetails = new SiteDetails();
				$SiteDetails->user_id = $this->user_id;
				$SiteDetails->postcode = $value;
				$SiteDetails->speed = $multisitespeed[$key];
				$SiteDetails->resilience = $multisiteresilient[$key];
				$SiteDetails->service_type = session('service_type');
				$SiteDetails->added_time = date('Y-m-d H:i:s');
				$result = $SiteDetails->save();

				$GetAddressData =  array('DunsId'=> '856120977D' , 'AddressIdentifiers' => array('AddressIdentifier' => array('UPRN' => '48083357','Postcode' => $value)));

				$result_Address = $this->getAddressesAPI($GetAddressData);

				if(!empty($result_Address->AddressIdentifiers->AddressIdentifier->Errors)){

					$this->apiErrors =  $result_Address->AddressIdentifiers->AddressIdentifier->Errors;	
				}
			}

		}

// multiple values of data centres form in the form of array.

		$datacentersitelocation = $request->datacentersitelocation;
		$datacentersitespeed = $request->datacentersitespeed;

		if(count($datacentersitelocation)>0){
			foreach ($datacentersitelocation as $key => $value) {

				$dataCenter = new DataCentreDetails();
				$dataCenter->user_id = $this->user_id;
				$dataCenter->data_centre = $value;
				$dataCenter->speed = $datacentersitespeed[$key];
				$dataCenter->service_type = session('service_type');
				$dataCenter->added_time = date('Y-m-d H:i:s');
				$dataCenter->save();
			}
		}

// multiple values of colocation quote form in the form of array.

		$colocation_location = $request->colocation_location;
		$colocation_racks_number = $request->colocation_racks_number;
		$colocation_maxPoweRating = $request->colocation_maxPoweRating;
		$colocation_powerRegime = $request->colocation_powerRegime;
		$colocation_NetworkServices = $request->colocation_NetworkServices;
		$colocation_internetAccess = $request->colocation_internetAccess;
		$dedicatedPodRequirements = $request->dedicatedPodRequirements;

		if(count($colocation_location)>0){
			foreach ($colocation_location as $key => $value) {

				$dataColocation = new ColocationDetails();
				$dataColocation->user_id = $this->user_id;
				$dataColocation->location = $value;
				$dataColocation->racks_number = $colocation_racks_number[$key];
				$dataColocation->max_power_rating = $colocation_maxPoweRating[$key];
				$dataColocation->power_regime = $colocation_powerRegime[$key];
				$dataColocation->network_services = $colocation_NetworkServices[$key];
				$dataColocation->internet_access = $colocation_internetAccess[$key];
				if(empty($dedicatedPodRequirements[$key])){
					$dataColocation->checkbox_value = 0;
				}else{
					$dataColocation->checkbox_value = 1;
				}

				$dataColocation->service_type = session('service_type');
				$dataColocation->added_time = date('Y-m-d H:i:s');
				$dataColocation->save();
			}
		}

		$update = ['qos_level' => $request->qoslevel,'gateway_speed' => $request->internet_getway_speed,'added_time' => date("Y-m-d H:i:s")];
		$result = DB::table($service->modelTablename)->where('user_id', $this->user_id)->update($update);

		$rules = [
		'multisitepostcode.*' => 'required|min:5|max:8',
		'colocation_location.*' => 'required',
		'colocation_racks_number.*' => 'required',
		'colocation_maxPoweRating.*' => 'required',
		'colocation_NetworkServices.*' => 'required',
		'colocation_internetAccess.*' => 'required',
		'dedicatedPodRequirements.*' => 'required'
		];

		$messages = [
		'multisitepostcode.*.required' => ' Please enter valid postcode.',
		'multisitepostcode.*.min' => ' Postcode must be at least 5 characters.',
		'multisitepostcode.*.max' => ' Postcode may not be greater than 8 characters.',
		'colocation_location.*' => 'Invalid Colocation Site',
		'colocation_racks_number.*' => 'Invalid Number Of Racks',
		'colocation_maxPoweRating.*' => 'Invalid Power Rating',
		'colocation_NetworkServices.*' => 'Invalid Power Regime',
		'colocation_internetAccess.*' => 'Invalid Port 2 Our Network Service',
		'dedicatedPodRequirements.*' => 'Invalid Internet Access Value',

		];

		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);	
		}else{
			return $this->showUserDetailsForm();
		}	
	}

	public function userDetailsFormValues(Request $request){

// form values requested
		if($request->session()->has('user_id')){

			$this->user_id = session('user_id');
		}

		$userDetails = new UserDetails();
		$update = ['Name' => $request->name,'company_name' => $request->company,'phone_number' => $request->phone,
		'email_id' => $request->email,'website' => $request->website,'enquiry_reason' => $request->reason,
		'comments' => $request->comments,'added_time' => date("Y-m-d H:i:s")];
		$request->session()->put('sendMail_email', $request->email);
		$result = DB::table($userDetails->modelTablename)->where('id',$this->user_id)->update($update);

		$rules = [
		'name' => 'required',
		'company' => 'required',
		'phone' => 'required|numeric',
		'email' => 'required|email'
		];

		$messages = [
		'name.required' => ' Please enter your name.',
		'company.min' => ' Missing company name',
		'phone.required' => ' Missing phone number',
		'email.required' => ' Missing email address',
		];

		$validator = Validator::make($request->all(), $rules, $messages);

		if ($validator->fails()) {

			return Redirect::back()->withErrors($validator)->withInput();

		}else{

			$sndMailObject = new SendMailController();

			$content = [
			'body'=> ''
			];

			$sendToEmail = $request->email;

			Mail::to($sendToEmail)->send(new SendMailClass($content));
			return view('thankYouPage')->with('mail_email', $request->email);
		}
	}

	public function startFresh(){

		session()->forget('user_id');
		session()->forget('service_type');
		session()->forget('url');
		return view('index');
	} 

	public function showThankYouPage(){

		
		$mail_email = "";

		if(session()->has('sendMail_email')){
			$mail_email = session('sendMail_email');

		}else{
			$mail_email = 'you';
		}


		return view('thankYouPage')->with('mail_email',$mail_email);
	}

	public function formValidationPost(Request $request)
	{
		$rules = [
		'sitepostcode.*' => 'required|min:5|max:8',
		'sitespeed.*' => 'required',
		'siteresilient.*' => 'required'
		];

		$messages = [
		'sitepostcode.*.required' => ' The postcode field is required.',
		'sitepostcode.*.min' => ' The postcode must be at least 5 characters.',
		'sitepostcode.*.max' => ' The postcode may not be greater than 8 characters.',
		'sitespeed.*.required' => ' The speed field is required.',
		'siteresilient.*.required' => ' The speed must be at least 5 characters.',
		];

		Validator::validate($request->all(),$rules,$messages);

		dd('You are successfully added all fields.');

	}

	public function pdfview()
	{
		return  PDF::loadFile(public_path().'/pdfContent.html')->save(public_path().'/my_stored_file.pdf')->stream('download.pdf');
	}

}
