 @extends('layouts.app')

    @section('content')
    <div class="container">
      <div class="row">
        <div style="width:750px">
          <br/>
          <div class="node">
            <div class="content clear-block">
             <span class="bodyCopy">
               Your quote will be emailed to you following the completion of this page.Please note that fields marked by <span class="error">*</span> indicate that you must enter a value.
             </span>
             <br/><br/>
             <form method="post" action="/ThankYouPage">
               <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

               <div id="contactdetails">
                 <table class="paddedtable" style="border-collapse: separate; border-spacing: 5px;" cellpadding="2" cellspacing="2">
                   <tr>
                     <td width="100px;">Your name <span class="error">*</span>:</td>
                     <td width="500px;"><input style="width: 200px;" type="text" placeholder="full name" name="name" value="<?php echo $userDatas->Name; ?>" autofocus>
                      @if(count($errors)>0)
                      @if($errors->has('name'))
                      &nbsp;<span class="text-danger ValidationSpan">{{ $errors->first('name') }}</span>
                      @endif  
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td width="100px;">Company <span class="error">*</span>:</td>
                    <td width="500px;">
                      <input style="width: 200px;" type="text" name="company" placeholder="company name" value="<?php echo $userDatas->company_name; ?>">
                      @if(count($errors)>0)
                      @if($errors->has('company'))
                      &nbsp;<span class="text-danger ValidationSpan">{{ $errors->first('company') }}</span>
                      @endif  
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td width="100px;">Phone <span class="error">*</span>:</td>
                    <td width="500px;">
                      <input style="width: 200px;" type="text" name="phone" placeholder="+919450293429" value="<?php echo $userDatas->phone_number; ?>">
                      @if(count($errors)>0)
                      @if($errors->has('phone'))
                      &nbsp;<span class="text-danger ValidationSpan">{{ $errors->first('phone') }}</span>
                      @endif  
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td width="100px;">Email <span class="error">*</span>:</td>
                    <td width="500px;">
                      <input style="width: 200px;" type="text" name="email" placeholder="eg: abc@gmail.com" value="<?php echo $userDatas->email_id; ?>">
                      @if(count($errors)>0)
                      @if($errors->has('email'))
                      &nbsp;<span class="text-danger ValidationSpan">{{ $errors->first('email') }}</span>
                      @endif  
                      @endif
                    </td>
                  </tr>
                  <tr class="website">
                    <td>Website:</td>
                    <td>
                      <input style="width: 200px;" type="text" name="website" placeholder="eg: www.xyz.com" value="<?php echo $userDatas->website; ?>">
                    </td>
                  </tr>
                  <tr>
                    <td>Reason for enquiry:</td>
                    <td>
                      <select name="reason" style="width: 200px;">
                        <option value="New service"<?php echo ($userDatas->enquiry_reason == 'New service' ? 'selected' : ''); ?>>New service</option>
                        <option value="Office relocation"<?php echo ($userDatas->enquiry_reason == 'Office relocation' ? 'selected' : ''); ?> >Office relocation</option>
                        <option value="Renewal of existing services"<?php echo ($userDatas->enquiry_reason == 'Renewal of existing services' ? 'selected' : ''); ?> >Renewal of existing services</option>
                        <option value="Upgrade of existing services"<?php echo ($userDatas->enquiry_reason == 'Upgrade of existing services' ? 'selected' : ''); ?> >Upgrade of existing services</option>
                        <option value="Other (Please specify)"<?php echo ($userDatas->enquiry_reason == 'Other (Please specify)' ? 'selected' : ''); ?> >Other (Please specify)</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Additional requirements<br>or comments:</td>
                    <td><textarea rows=5 cols=40 name="comments"><?php echo $userDatas->comments; ?></textarea></td>
                  </tr>
                </table>
              </div>
              <br/>

              <div>
               <input type="button" name="back" value="Back" onclick="window.location='{{ url("/InternetAccess") }}'" class="BackgroundClass">
               <input type="submit" name="button" value="Finish" class="BackgroundClass">
             </div>
             </form>
         </div>
       </div>
     </div>
   </div>
 </div>
 @endsection

