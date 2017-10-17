  @extends('layouts.app')
  @section('content')
  <div class="container">
    <div class="row">
      <?php //$sitespeedDatas = array('2' =>'2Mbpss' , '10' =>'10Mbpss','30' =>'30Mbpss','50' =>'50Mbpss','100' =>'100Mbpss'); ?>
      <div id="frame-mini" style="width:495px">
        <div class="node">
          <div class="content clear-block">

           <h4>Internet access quote </h4>
          <!--  <p>Error Message: </p> <?php //print_r($apiErrors); ?>
          <p>Error Message validation: </p>
           <?php 
          // echo '<pre>';  
         // var_dump($errors); 
          ?>  -->

           <form method="post" action="/UserDetails/site">

            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">      
         <table border="0" width="489" cellpadding="2" class="" cellspacing="0" >

          <?php 
          $counter=1;
          if(count($results)>0){
            foreach ($results as $key => $result){

              $id_value = "remove_item_".$key;
           //  echo $apiErrors[$key]; 
              ?>
              <?php if($counter>1){ ?>
              <tr class='RemoveAll' id=<?php echo $id_value; ?>>
               <?php }else{ ?>
               <tr>
                 <?php } ?>
                 <td>
                   <div style="border: 1px solid #999999; margin-bottom:12px">
                    <table cellpadding="2" cellspacing="0" width="489">
                      <tr  style="height:18px">
                        <td bgcolor="#6680B2" style="color: #FFFFFF">&nbsp;&nbsp;Site <?php echo $counter; ?> 
                        </td>
                      <!-- <?php //if(count($errors)>$key){ ?>
                         <td bgcolor="{{ (count($apiErrors)>$key) ? '#E40C25' : '#6680B2' }}" style="color: #FFFFFF">&nbsp;&nbsp;Site <?php //echo $counter; ?>       
                         </td>
                         <?php //} //if(count($apiErrors)>$key){
                        ?>
                       <td bgcolor="{{ (count($apiErrors)>$key) ? '#E40C25' : '#6680B2' }}" style="color: #FFFFFF">&nbsp;&nbsp;Site <?php //echo $counter; ?>
                         
                       </td>
                       <?php //} ?> -->
                     </tr>
                     <tr>
                       <td>
                        <!-- Start connectedcities voucher promo -->

                        <!-- Start normal options -->
                        <div style="padding: 4px">
                          <table cellspacing="0" cellpadding="0" class="paddedtable">
                           <tr>
                            @if(count($errors)>$key)
                            <span class="text-danger ValidationSpan"><?php echo $errors->all()[$key]; ?></span>
                            @endif 
                            @if(count($apiErrors)>0)
                            @if(count($apiErrors)>$key)
                            <span class="text-danger ValidationSpan">
                              <?php 
                              if(!is_null($apiErrors[$key])){
                                echo $apiErrors[$key]; 
                              }
                              ?> 
                            </span>
                            @endif
                            @endif
                          </tr>
                          <tr>
                            <!-- <div class="form-group {{ $errors->has('sitepostcode') ? 'has-error' : '' }}"> -->
                            <td>
                              <span class="bodyCopy {{ $errors->has('sitepostcode') ? 'has-error' : '' }}">Postcode:</span></td>
                              <td width="130">
                                <input type="text" class="clearFieldsData" name="sitepostcode[]" value="<?php echo $result->postcode; ?>" style="width:110px" autofocus>
                              </td>
                              <!-- </div> -->
                              <td><span class="bodyCopy">Speed:</span></td>
                              <td>
                               <select name="sitespeed[]">
                                <?php 
                                foreach($sitespeedDatas as $key => $sitespeedData){ ?>
                                <option value="<?php echo $key; ?>"<?php echo ($result->speed == $key ? ' selected' : ''); ?> ><?php echo $sitespeedData; ?></option>                         
                                <?php } ?>
                              </select>
                            </td>
                          </tr>
                          <tr>      
                           <td ><span class="bodyCopy">Resilience:</span></td>
                           <td colspan="2">
                            <select name="siteresilient[]">
                             <?php foreach($resilienceDatas as $key => $resilienceData){ ?>
                             <option value="<?php echo $key; ?>"<?php echo ($result->resilience == $key ? ' selected' : '');?>><?php echo $resilienceData; ?></option>
                             <?php } ?>
                           </select>
                         </td>
                         <td align="right">
                          <?php if($counter>1){ ?>
                          <button type="button" onclick="removeRow('<?php echo $counter; ?>');" class="BackgroundClass"><a href="#" class="BackgroundClass" style="text-decoration:none">Remove</a></button>
                          <?php } ?>
                        </td>
                      </tr>

                    </table>
                  </div>
                  <!-- End normal options -->
                </td>
              </tr>
            </table>
          </div>
        </td>
      </tr>
      <?php $counter++; } }else{ ?>

      <tr>
       <td>
         <div style="border: 1px solid #999999; margin-bottom:12px">
          <table cellpadding="2" cellspacing="0" width="489">
            <tr  style="height:18px">
             <td bgcolor="#6680B2" style="color: #FFFFFF">&nbsp;&nbsp;Site 1</td>
           </tr>
           <tr>
             <td>
              <!-- Start connectedcities voucher promo -->

              <!-- Start normal options -->
              <div style="padding: 4px">
                <table cellspacing="0" cellpadding="0" class="paddedtable">
                  <tr >
                    <td><span class="bodyCopy {{ $errors->has('sitepostcode') ? 'has-error' : '' }}">Postcode:</span></td>
                    <td width="130">
                      <input type="text" class="clearFieldsData" name="sitepostcode[]" value="" style="width:110px" autofocus>

                    </td>
                    <td><span class="bodyCopy">Speed:</span></td>
                    <td>
                     <select name="sitespeed[]">

                      <?php foreach($sitespeedDatas as $key => $sitespeedData){ ?>
                      <option value="<?php echo $key; ?>" selected><?php echo $sitespeedData; ?></option>                          <?php } ?>
                    </select>
                  </td>
                </tr>
                <tr>      
                 <td ><span class="bodyCopy">Resilience:</span></td>
                 <td colspan="2">
                  <select name="siteresilient[]">

                   <?php foreach($resilienceDatas as $key => $resilienceData){ ?>
                   <option value="<?php echo $key; ?>"><?php echo $resilienceData; ?></option>
                   <?php } ?>
                 </select>
               </td>
               <td align="right">
               </td>
             </tr>

           </table>
         </div>
         <!-- End normal options -->
       </td>
     </tr>
   </table>
 </div>
</td>
</tr>
<?php } ?>

<tr class="input_fields_wrap"></tr>

<tr>
  <td>
   <table border="0" cellpadding="2" cellspacing="2">
    <tr>
     <td><span class="bodyCopy">Do you have more sites you'd like to connect?</span></td>
     <td>&nbsp;<input type="button" name="addanother" class="BackgroundClass add_field_button" value="Add another site"></td>
     <td><input type="hidden" name="counter_updated_val" id="counter_updated_val" value="<?php echo $counter; ?>"></td>
   </tr>
 </table>
</td>
</tr>

</table>
<br />
<div>             
  <input type="button" name="back" value="Back" onclick="window.location='{{ url("/service") }}'" class="BackgroundClass">
  <input type="button" name="clearform" value="Clear Form" class="BackgroundClass ClearAllItems">  
  <input type="submit" name="next" value="Next" class="BackgroundClass">
</div>
</form>

</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
  var counter_updated_val = $("#counter_updated_val").val();
var x = counter_updated_val; //initlal text box count
var counter_value = counter_updated_val;

$(document).ready(function(){

var max_fields      = 10; //maximum input boxes allowed
var wrapper         = $(".input_fields_wrap"); //Fields wrapper
var add_button      = $(".add_field_button"); //Add button ID
var clear_all_items = $(".ClearAllItems");

  $(add_button).click(function(e){ //on add input button click
   e.preventDefault();
      if(counter_value < max_fields){ //max input box allowed
 //text box increment
          $(wrapper).append('<div id="remove_item_'+(x)+'" class="RemoveAll"><tr><td><input type="hidden" name="site1bearer" value="" /><input type="hidden" name="site1access" value="" /><input type="hidden" name="site1carrier" value="" /><div style="border: 1px solid #999999; margin-bottom:12px"><table cellpadding="2" cellspacing="0" width="489"><tr style="height:18px"><td bgcolor="#6680B2" style="color: #FFFFFF">&nbsp;&nbsp;Site '+x+'</td></tr><tr><td><!-- Start connectedcities voucher promo --><!-- Start normal options --><div style="padding: 4px"><table cellspacing="0" cellpadding="0" class="paddedtable"><tr><td><span class="bodyCopy">Postcode:</span></td><td width="130"><input type="text" name="sitepostcode[]"value=""style="width:110px" class="clearFieldsData" autofocus></td><td><span class="bodyCopy">Speed:</span></td><td><select name="sitespeed[]"><?php foreach($sitespeedDatas as $key => $sitespeedData){ ?><option value="<?php echo $key; ?>"><?php echo $sitespeedData; ?></option><?php } ?></select></td></tr><tr><td><span class="bodyCopy">Resilience:</span></td><td colspan="2"><select name="siteresilient[]"> <?php foreach($resilienceDatas as $key => $resilienceData){ ?><option value="<?php echo $key; ?>"><?php echo $resilienceData; ?></option><?php } ?></select></td><td align="right"><button type="button" onclick="removeRow('+x+');" class="BackgroundClass"><a href="#" class="BackgroundClass" style="text-decoration:none">Remove</a></button></td><td align="right"></td></tr></table></div></td></tr></table></div></td></tr></div>'); //add input box
          x++;
          counter_value++;
          $(window).scrollTop($(document).height());
        }

      });

  $(clear_all_items).click(function(e){
    e.preventDefault();
    if(x>1){
      $(".RemoveAll").remove();
      x = 1;
      counter_value = 1;
    } 
    $(".clearFieldsData").val("");
    $(".ValidationSpan").hide();
    $(".ValidationSpan").val("");
  });
});

function removeRow(value){
 alert("#remove_item_"+value);
 $("#remove_item_"+value).remove();
 counter_value--;
}
</script>

@endsection





