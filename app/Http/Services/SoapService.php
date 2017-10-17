<?php
namespace App\Services;
use SoapClient;

class SoapService extends Service
{
	
	public function __construct()
	{
		
	}
	
    public function getBtWholeSaleData(){

		$client = new SoapClient("http://bt.pricingtool.net/wsdl/pricingtoolSchema-v5:getAddressesIn");
		$args =  array(
		               'soap_version' => SOAP_1_2,
		               'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
		               'encoding' => 'UTF-8',
		               'trace' => 1,
		               'exceptions' => true,
		               'cache_wsdl' => WSDL_CACHE_NONE,
		               'features' => SOAP_SINGLE_ELEMENT_ARRAYS
		               );
		try{

			$res = $client->__soapCall("getAddressesIn", array($args));

			echo "<pre>";
			return print_r($res);

		}catch (SoapFault $exception){
			echo "FF";
				  //or any other handling you like
			return var_dump(get_class($exception));
			return var_dump($exception);
		}
    }
}
?>