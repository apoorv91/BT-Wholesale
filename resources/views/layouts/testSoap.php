<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">

</head>
<body>
<div>

<?php 

$url         = ""; 
$client     = new SoapClient($url, array("trace" => 1, "exception" => 0)); 

// Create the header 
$auth         = new ChannelAdvisorAuth($devKey, $password); 
$header     = new SoapHeader("http://www.example.com/webservices/", "APICredentials", $auth, false); 

// Call wsdl function 
$result = $client->__soapCall("DeleteMarketplaceAd", array( 
    "DeleteMarketplaceAd" => array( 
        "accountID"        => $accountId, 
        "marketplaceAdID"    => "9938745"        // The ads ID 
    ) 
), NULL, $header); 

// Echo the result 

if($result->DeleteMarketplaceAdResult->Status == "Success") 
{ 
    echo "Item deleted!"; 
} 
?>
	</div>
	
</body>
</html>

-----

https://www.onramp1.b2b.btwholesale.com/exchange/232510151


