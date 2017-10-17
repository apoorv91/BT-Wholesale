<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<div  style="background-color: #FFFFFF;">
        {{ $header or '' }}
        <br/>
        <!-- Email Body -->
        <div>
            <!-- {{ Illuminate\Mail\Markdown::parse($slot) }} -->
            <p>Dear GSTA,<br/>
            Thank you for your recent online enquiry.<br/>
            Please find attached our proposal together with some further information on Interhost.<br/>
            Please do not hesitate to contact us on 01892 540428 or email us at info@interhostllp.com should you have any queries or require further assistance.<br/><br/>
            Yours faithfully,</p>
        </div>
        {{ $footer or '' }}    
    </div>

</body>
</html>
