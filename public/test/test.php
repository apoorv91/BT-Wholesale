<?php  

$wsdl           = "http://192.168.1.135/abc/web/BTWPricingToolService-v5.wsdl"; 
#$wsdl           = "http://192.168.1.80/web/servicebt/BTWPricingToolService-v5.wsdl"; 

$endpoint       = 'https://www.wsr-onrampws-robt.bt.co.uk:5443/PricingToolv5.0';
$certificate    = "test1.pem" ;

#SetEnvIf Request_URI ^/index.php/api/ no-gzip=1

$options = array(
    'location'      => $endpoint,
    'keep_alive'    => true,
    'trace'         => true,
    'local_cert'    => $certificate,
    'cache_wsdl'    => WSDL_CACHE_NONE
);
 
$GetDataCentres =  array('DunsId' => "856120977D" ,'ProvisionDate' => "2017-05-05");


    $client = new SoapClient($wsdl, $options); 
    $result = $client->GetDataCentres($GetDataCentres);  
    echo '512 kbit/s '; 
        var_dump($result); 
 var_dump($client->__getLastRequest());


?>
