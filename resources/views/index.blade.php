<!-- <!DOCTYPE HTML>
<html>
<title>Interhost quoting tool</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<head>
	<style>
	.BackgroundClass{
		background-color: #6680B2;
		color: #FFFFFF;
		border: 0px;
		padding: 5px;
	}
		.error {
			color: #FF0000;
		}
	}
	</style>
</head>

<body>  --> 
<!--<?php 
// phpinfo();
	?>-->
	@extends('layouts.app')

	@section('content')
	<div class="container">
		<div class="row">
			<form method="post" action="/InternetAccess">  
				<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
				<p style="width: 700px;"> Please take a few moments to fill in the necessary information that will enable us to provide an accurate quotation which will be automatically e-mailed to you within a few minutes of completing the quotation form.</p>
				<p>What services are you looking for?</p>
				<br>
				
				<input type="radio" style='margin-left:40px;' name="service_type" value="multi_site" <?php if(!empty(session()->has('user_id'))){ echo ($service_type == 'multi_site' ? ' checked' : ''); } ?> checked="" > Multi-site (MPLS)
			</br>

			<input type="radio" style='margin-left:40px;' name="service_type" value="internet_access" <?php if(!empty(session()->has('user_id'))){ echo ($service_type == 'internet_access' ? ' checked' : ''); } ?>> Internet access
			<br><br>

			<input class="BackgroundClass" type="submit" name="next" value="Next">  

		</form>
	</div>
</div>
@endsection