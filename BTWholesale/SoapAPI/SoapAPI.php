<?php 
/**
 * Created by Apoorv
 * Date: 15/07/2017
 * Time: 12:41
 */
namespace App\Traits;
namespace BTWholesale\SoapAPI;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Services\SoapService;
use SoapClient;
use SoapParam;
use File;
use Illuminate\Support\Facades\Storage;
use BTWholesale\Certificate\Certificate;

trait SoapAPI 
{
  private $wsdl;
  private $endpoint; 
  private $certificate; 
  private $options;  
  protected $result;
  private $client;  


  protected function connectionBT()
  { 


   $this->wsdl       =  "http://btlaravel.stpi.com/Service/BTWPricingToolService-v5.wsdl"; 
   $this->endpoint   = 'https://www.wsr-onrampws-robt.bt.co.uk:5443/PricingToolv5.0';
   $this->certificate   = public_path()."/Certificate/Certificate.pem";  

   $this->options = array(  
    'location'      => $this->endpoint,
    'keep_alive'    => true,
    'trace'         => true,
    'local_cert'    => $this->certificate, 
    "stream_context" => stream_context_create(
      array(
        'ssl' => array(
          'verify_peer'       => false,
          'verify_peer_name'  => false,
          )
        )
      ),
    'cache_wsdl'    => WSDL_CACHE_NONE 
    );
   


   try {  

     $this->client = new SoapClient($this->wsdl, $this->options); 
   } catch(Exception $e) {  

    echo $e->getMessage();
    
  }

  
}


protected function getDataCentresAPI($data) {  

  try {  

    $this->connectionBT() ;
    $this->result = $this->client->GetDataCentres($data);  

  } catch(Exception $e) {  

    echo $e->getMessage();
    
  }
  
  return $this->result ;  

}

protected function getAddressesAPI($data) {  

  try {  

   $this->connectionBT() ;
   $this->result = $this->client->GetAddresses($data);  

  } catch(Exception $e) {  

    echo $e->getMessage();
    
  }
  
  return $this->result ;  

}

protected function getWholesaleEthernetELANQuoteAPI($data){

  try {  

   $this->connectionBT() ;
   $this->result = $this->client->GetWholesaleEthernetELANQuote($data);  

  } catch(Exception $e) {  

    echo $e->getMessage();
    
  }
  
  return $this->result ; 

}

}
