@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    <div id="frame-mini" style="width:495px">
      <div class="node">
        <div class="content clear-block">

          <script type="text/javascript">
            if (typeof _gaq != 'undefined') _gaq.push(['_trackPageview', '/multi-site/configuration']);
          </script>
          <h4>Multi-Site L3VPN Wide Area Network </h4>
          <form method="post" action="/UserDetails/multisite">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <!-- <p>Error Message: </p> -->
            <!--  ####<?php echo "{{ $errors->first('colocation_location.') }}"; ?>$$$ -->
            <?php  // echo $errors->all()[0]; ?>
            @foreach($errors->all() as $error)
            <p class="text-danger">{{ $error }}</p>
            @endforeach

            <table border="0" width="490">
             <?php 
             $counter=1;
             if(count($results)>0){
              foreach ($results as $key => $result){
               if($counter==1){ ?>
               <tr>
                <!-- <tr class='RemoveAll' id=<?php //echo $id_value; ?>> -->
                <?php }else if($counter>1){ ?> 
                <tr id="remove_item_<?php echo $counter; ?>" class="RemoveAll">
                 <?php } ?>

                 <td>
                   <div style="border: 1px solid #999999; margin-bottom:12px">
                    <table cellpadding="2" cellspacing="0" width="100%">
                      <tr  style="height:18px">
                       <td bgcolor="#6680B2" style="color: #FFFFFF">&nbsp;&nbsp;Site <?php echo $counter; ?>  Layer 3 MPLS Connection</td>
                     </tr>
                     <tr>
                       <td>
                        <!-- Start connectedcities voucher promo -->

                        <!-- Start normal options -->
                        <div style="padding: 4px">
                          <table cellspacing="0" cellpadding="0" class="paddedtable">
                            <tr>
                              @if(count($errors)>$key)
                              <span class="text-danger ValidationSpan"><?php  echo $errors->all()[$key]; ?></span>
                              @endif  
                            </tr>
                            <tr>
                              <td><span class="bodyCopy {{ $errors->has('multisitepostcode') ? 'has-error' : '' }}">Postcode:</span></td>
                              <td width="130">
                                <input type="text" class="clearFieldsData" name="multisitepostcode[]" value="<?php echo $result->postcode; ?>" style="width:110px" autofocus>

                              </td>
                              <td><span class="bodyCopy">Speed:</span></td>
                              <td>
                                <select name="multisitespeed[]">
                                 <?php 
                                foreach($sitespeedDatas as $key => $sitespeedData){ ?>
                                <option value="<?php echo $key; ?>"<?php echo ($result->speed == $key ? ' selected' : ''); ?> ><?php echo $sitespeedData; ?></option>                         
                                <?php } ?>
                                 
                               </select>
                             </td>
                           </tr>
                           <tr>      
                             <td >
                               <span class="bodyCopy">Resilience:</span>
                             </td>
                             <td colspan="2">
                              <select name="multisiteresilient[]">
                                <?php foreach($resilienceDatas as $key => $resilienceData){ ?>
                             <option value="<?php echo $key; ?>"<?php echo ($result->resilience == $key ? ' selected' : '');?>><?php echo $resilienceData; ?></option>
                             <?php } ?>
                              </select>
                            </td>
                            <td align="right">
                              <?php if($counter>1){ ?>
                              <button type="button" onclick="removeSiteRow('<?php echo $counter; ?>')" class="BackgroundClass"><a href="#" class="BackgroundClass" style="text-decoration:none">Remove</a></button>
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
          <?php $counter++; } 
        }else{ ?>

        <tr>
         <td>
           <div style="border: 1px solid #999999">
            <table cellpadding="2" cellspacing="0" border="0" width="100%">
              <tr style="height:18px">
               <td class="BackgroundClass">&nbsp;&nbsp;Site 1 Layer 3 MPLS Connection</td>
             </tr>
             <tr>
               <td>
                <div class="sitedetail" style="padding: 4px">
                  <table cellspacing="0" cellpadding="0" class="paddedtable">
                    <tr>
                      <td><span class="bodyCopy {{ $errors->has('sitepostcode') ? 'has-error' : '' }}">Postcode:</span></td>
                      <td width="130">
                        <input type="text" name="multisitepostcode[]" class="clearFieldsData" value="" style="width:110px" autofocus>
                        <span class="text-danger">{{ $errors->first('sitepostcode') }}</span>
                      </td>
                      <td><span class="bodyCopy">Speed:</span></td>
                      <td>
                       <select name="multisitespeed[]">
                         <?php foreach($sitespeedDatas as $key => $sitespeedData){ ?>
                      <option value="<?php echo $key; ?>" ><?php echo $sitespeedData; ?></option>                          <?php } ?>
                       </select>
                     </td>
                   </tr>
                   <tr>      
                     <td ><span class="bodyCopy">Resilience:</span></td>
                     <td colspan="2">
                      <select name="multisiteresilient[]">
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
           </td>
         </tr>
       </table>
     </div>
     <br/>
   </td>
 </tr>
 <?php } ?>
 <tr class="input_fields_wrap"></tr>

 <?php
 $i=1;
 // echo '<pre>';

 if(count($dataCenterDatas)>0){
  foreach ($dataCenterDatas as $dataCenterData){ ?>

  <tr id="remove_data_centre_<?php echo $i; ?>" class="RemoveAll">
    <td>
      <div style="border: 1px solid #999999">
       <table cellpadding="2" cellspacing="0" border="0" width="100%">
         <tr style="height:18px">
           <td class="BackgroundClass">&nbsp;&nbsp;Data Centre <?php echo $i; ?> Layer 3 MPLS Connection
           </td>
         </tr>
         <tr>
           <td>
             <div style="padding: 4px">
               <table cellspacing="2" cellpadding="2" class="paddedtable"><tr><td><span class="bodyCopy">Data Centre:
               </span>
             </td>
             <td>
               <select style="font-size:9pt" id="datacentersite1location" name="datacentersitelocation[]">
                <?php foreach ($dataCentres as $key => $dataCentre) { ?>
                 <option value="<?php echo $dataCentre->Code; ?>"<?php echo ($dataCenterData->data_centre == $dataCentre->Code ? ' selected' : '');?>><?php echo $dataCentre->Name; ?></option>
                 <?php } ?>
               </select>
             </td>
             <td width="5">&nbsp;</td>
             <td>
              <span class="bodyCopy">Speed:</span>
            </td>
            <td>
              <select id="datacentersite1speed" name="datacentersitespeed[]">
                <option value="10"<?php echo ($dataCenterData->speed == '10' ? 'selected' : ''); ?> selected>10Mbps</option>
                <option value="100"<?php echo ($dataCenterData->speed == '100' ? 'selected' : '') ?> >100Mbps</option>
                <option value="1000"<?php echo ($dataCenterData->speed == '1000' ? 'selected' : ''); ?> >1000Mbps</option>
              </select>
            </td>
          </tr>
          <tr>

            <td colspan="4">

            </td>

            <td align="right">
              <button type="button" name="removedatacenter" onclick="removeDataCentreRow('<?php echo $i; ?>');"  class="BackgroundClass"><a href="#" class="BackgroundClass" style="text-decoration:none">Remove</a>
              </button>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</table>
</div>
</td>
</tr>

<?php $i++; } 
} ?>

<tr class="add_more_data_centre_div">
</tr>

<?php
$j=1;
 // echo '<pre>';
  // print_r($colocationDatas);
if(count($colocationDatas)>0){
  foreach ($colocationDatas as $colocationData){ ?>
  
  <tr id="remove_colocation_<?php echo $j; ?>" class="RemoveAll">
    <td>
      <table style="border: 1px solid #999999;border-collapse:separate;" border="0" cellpadding="2" cellspacing="0" width="100%" >
        <tbody>
          <tr>
            <td class="BackgroundClass" colspan="99" style="padding: 2px 0 2px 6px;">Colocation Quote</td>
          </tr>
          <tr>
            <td style="padding: 8px">
              <table border="0" cellpadding="2" cellspacing="2" width="100%" class="paddedtable">
                <tbody style="height: ">
                  <tr>
                    <td class="six_dg_form_label">
                      <span class="bodyCopy">Location:</span>
                    </td>
                    <td class="six_dg_form_input">
                      <select name="colocation_location[]" class="" >
                        <option value="" selected="selected">-- Please select --</option>
                        <?php foreach ($colocationLocations as $key => $colocationLocation) { ?>
                        <option value="<?php echo $key; ?>"<?php echo ($colocationData->location == $key) ? 'selected' : '' ?>><?php echo $colocationLocation; ?></option>

                       <?php } ?>
                      </select>
                      @if($errors->has('colocation_location.'))
                      &nbsp;<span class="text-danger ValidationSpan">{{ $errors->first('colocation_location.0') }}</span>
                      @endif 
                    </td>
                  </tr>
                  <tr>
                    <td class="six_dg_form_label">
                      <span class="bodyCopy">Number of Racks:</span>
                    </td>
                    <td class="six_dg_form_input">
                      <select name="colocation_racks_number[]" class="" >
                        <option value="" selected="selected">-- Please select --</option>
                      <?php foreach ($colocationRacks as $key => $colocationRack) { ?>
                        <option value="<?php echo $key; ?>"<?php echo ($colocationData->racks_number == $key ? 'selected' : ''); ?>><?php echo $colocationRack; ?></option>
                       <?php } ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td class="six_dg_form_label">
                      <span class="bodyCopy">Maximum Power Rating Per Rack:</span>
                    </td>
                    <td class="six_dg_form_input">
                      <select name="colocation_maxPoweRating[]" class="" >
                        <option value="" selected="selected">-- Please select --</option>
                       <?php foreach ($colocationPowerRatings as $key => $colocationPowerRating) { ?>
                        <option value="<?php echo $key; ?>"<?php echo ($colocationData->max_power_rating == $key ? 'selected' : ''); ?>><?php echo $colocationPowerRating; ?></option>
                        <?php } ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td class="six_dg_form_label">
                      <span class="bodyCopy">Power Regime:</span>
                    </td>
                    <td class="six_dg_form_input">
                      <select name="colocation_powerRegime[]" class="">
                        <option value="" selected="selected">-- Please select --</option>
                         <?php foreach ($colocationPowerRegimes as $key => $colocationPowerRegime) { ?>
                        <option value="<?php echo $key; ?>"<?php echo ($colocationData->power_regime == $key ? 'selected' : ''); ?>><?php echo $colocationPowerRegime; ?></option>
                         <?php } ?>
                     </select>
                    </td>
                  </tr>
                  <tr>
                    <td class="six_dg_form_label">
                      <span class="bodyCopy">Port to our Network Services and our other Colocation Sites:</span>
                    </td>
                    <td class="six_dg_form_input"><select name="colocation_NetworkServices[]" class="" >
                      <option value="" selected="selected">-- Please select --</option>
                      <?php foreach ($colocationNetworkServices as $key => $colocationNetworkService) { ?>
                      <option value="<?php echo $key; ?>"<?php echo ($colocationData->network_services == $key ? 'selected' : ''); ?>><?php echo $colocationNetworkService;?></option>
                     <?php } ?>

                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="six_dg_form_label">
                    <span class="bodyCopy">Internet Access Connectivity:
                    </span>
                  </td>
                  <td class="six_dg_form_input">
                    <select name="colocation_internetAccess[]" class="" >
                      <option value="" selected="selected">-- Please select --</option>
                 <?php foreach ($colocationAccessInternets as $key => $colocationAccessInternet) { ?>
                      <option value="<?php echo $key; ?>"<?php echo ($colocationData->internet_access == $key ? 'selected' : ''); ?>>
                      <?php echo $colocationAccessInternet; ?></option>
                      <?php } ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;
                  </td>
                </tr>
                <tr>
                  <td colspan="2" class="six_dg_form_label" >
                    <span class="bodyCopy"> I have High Density, High Security, Dedicated Cage or Dedicated Pod requirements</span>
                    <span>
                      <input name="formBody[colocation][0][data][dedicatedPodRequirements]" value="0" type="hidden" >
                      <input name="dedicatedPodRequirements[]" value="1"<?php echo ($colocationData->checkbox_value == '1' ? 'checked' : ''); ?> type="checkbox" >
                    </span><!-- <input type="checkbox"> --></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right" >
                      <button type="button" name="removecolocation" onclick="removeColocationRow('<?php echo $j; ?>');" class="BackgroundClass">
                        <a href="#" class="BackgroundClass" style="text-decoration:none">Remove</a>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
    </td>
  </tr>

  <?php $j++; } 
} ?>
<tr class="add_more_colocation_div">
</tr>
<tr>
 <td>
  <table border="0" width="100%">
    <!-- Please for drop down list -->
    <tr>
      <td><span class="bodyCopy">L3VPN QoS Level:</span></td>
      <td>  
        <select name="qoslevel" class="" style="font-size:11px;width:100px" >
          <option value="standard"<?php echo ($serviceData->qos_level== 'standard' ? ' selected' : ''); ?>>Standard</option>

          <option value="premium"<?php echo ($serviceData->qos_level== 'premium' ? ' selected' : ''); ?>>Premium</option> 
        </select>
      </td>
    </tr>

    <!-- /Please for drop down list -->
    <tr>
     <td><span class="bodyCopy">What speed Internet Gateway do you require?</span></td>
     <td>
       <select name="internet_getway_speed" style="font-size:11px;width:100px">
         <option value="" selected>Not required</option>
         <option value="2"<?php echo ($serviceData->gateway_speed== '2' ? ' selected' : ''); ?>>2 Mbps</option>
         <option value="10"<?php echo ($serviceData->gateway_speed== '10' ? ' selected' : ''); ?>>10 Mbps</option>
         <option value="20"<?php echo ($serviceData->gateway_speed== '20' ? ' selected' : ''); ?>>20 Mbps</option>
         <option value="30"<?php echo ($serviceData->gateway_speed== '30' ? ' selected' : ''); ?>>30 Mbps</option>
         <option value="50"<?php echo ($serviceData->gateway_speed== '50' ? ' selected' : ''); ?>>50 Mbps</option>
         <option value="100"<?php echo ($serviceData->gateway_speed== '100' ? ' selected' : ''); ?>>100 Mbps</option>
         <option value="1000"<?php echo ($serviceData->gateway_speed== '1000' ? ' selected' : ''); ?>>1000 Mbps</option>
       </select>
     </td>
   </tr>
   <tr>
     <td><span class="bodyCopy">Do you have more sites with which you’d like to connect?</span></td>
     <td><input type="submit" name="addanother" class="BackgroundClass add_field_button" value="Add another site" />
     </td>
     <td>
       <input type="hidden" name="counter_updated_val" id="counter_updated_val" value="<?php echo $counter; ?>">
       <input type="hidden" name="data_centre_counter_val" id="data_centre_counter_val" value="<?php echo $i; ?>">
       <input type="hidden" name="colocation_data_counter_val" id="colocation_data_counter_val" value="<?php echo $j; ?>">
     </td>
   </tr>
   <tr>
     <td><span class="bodyCopy">Do you have a Data Centre with which you’d like to connect?</span></td>
     <td><input type="submit" name="adddatacenter" class="adddatacenter BackgroundClass add_data_centre_button" value="Add a Data Centre connection" /></td>
   </tr>

   <tr>
     <td><span class="bodyCopy">Do you require colocation?</span></td>
     <td><input type="submit" name="addrackspace" class="BackgroundClass add_colocation_button" value="Add colocation" /></td>
   </tr>

 </table>
</td>
</tr>
</table>

<br/>
<div>
  <input type="button" name="back" value="Back"  onclick="window.location='{{ url("/service")}}'" class="BackgroundClass">
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
 var data_centre_counter_val = $("#data_centre_counter_val").val();
 var colocationdata = $('#colocation_data_counter_val').val();
 if(counter_updated_val >1){
  counter_updated_val--;
}
if(data_centre_counter_val>1){
  data_centre_counter_val--;
}
if(colocationdata>1){
  colocationdata--;
}

var counter_value = counter_updated_val;
 var x = counter_updated_val, y = data_centre_counter_val, z = colocationdata; //initlal text box count

 $(document).ready(function(){

  var max_fields      = 10; // maximum input boxes allowed
  var wrapper         = $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID for site details
  var clear_all_items = $(".ClearAllItems");

  var add_more_data_centre_div = $(".add_more_data_centre_div"); // Add more Data centres div id
  var add_data_centre_button = $(".add_data_centre_button"); // Add button for adding data centres.

  var add_more_colocation_div = $(".add_more_colocation_div");
  var add_colocation_button = $("add_colocation_button");


    $(add_button).click(function(e){ //on add input button click
     e.preventDefault();
        if(counter_value < max_fields){ //max input box allowed
x++; 
//text box increment
            $(wrapper).append('<div id="remove_item_'+(x)+'" class="RemoveAll"><td><td><input type="hidden" name="site1bearer" value="" /><input type="hidden" name="siteaccess" value="" /><input type="hidden" name="site1carrier" value="" /><div style="border: 1px solid #999999; margin-bottom:12px"><table cellpadding="2" cellspacing="0" width="100%"><tr style="height:18px"><td class="BackgroundClass">&nbsp;&nbsp;Site '+x+" Layer 3 MPLS Connection"+'</td></tr><tr><td><!-- Start connectedcities voucher promo --><!-- Start normal options --><div style="padding: 4px"><table cellspacing="0" cellpadding="0" class="paddedtable"><tr><td><span class="bodyCopy">Postcode:</span></td><td width="130"><input type="text" name="multisitepostcode[]"value=""style="width:110px" class="clearFieldsData" autofocus></td><td><span class="bodyCopy">Speed:</span></td><td><select name="multisitespeed[]"><?php foreach($sitespeedDatas as $key => $sitespeedData){ ?><option value="<?php echo $key; ?>"><?php echo $sitespeedData; ?></option><?php } ?></select></td></tr><tr><td><span class="bodyCopy">Resilience:</span></td><td colspan="2"><select name="multisiteresilient[]"><?php foreach($resilienceDatas as $key => $resilienceData){ ?><option value="<?php echo $key; ?>"><?php echo $resilienceData; ?></option><?php } ?></select></td><td align="right"><button type="button" onclick="removeSiteRow('+x+');" class="BackgroundClass"><a href="#" class="BackgroundClass" style="text-decoration:none">Remove</a></button></td><td align="right"></td></tr></table></div></td></tr></table></div></td></div>'); //add input box

            counter_value++;
            $(window).scrollTop(0);
          }
        });

    $(".add_data_centre_button").click(function(e){
      e.preventDefault();
      
      $(wrapper).append('<div id="remove_data_centre_'+(y)+'" class="RemoveAll"><tr><td><div style="border: 1px solid #999999"><table cellpadding="2" cellspacing="0" border="0" width="100%"><tr style="height:18px"><td class="BackgroundClass">&nbsp;&nbsp;Data Centre '+(y)+' Layer 3 MPLS Connection</td></tr><tr><td><div style="padding: 4px"><table cellspacing="2" cellpadding="2" class="paddedtable"><tr><td><span class="bodyCopy">Data Centre:</span></td><td><select style="font-size:9pt" id="datacentersite1location" name="datacentersitelocation[]"><!-- TODO: Make this dynamically generated --><?php foreach ($dataCentres as $key => $dataCentre) { ?><option value="<?php echo $dataCentre->Code; ?>"><?php echo $dataCentre->Name; ?></option><?php } ?></select></td><td width="5">&nbsp;</td><td><span class="bodyCopy">Speed:</span></td><td><select id="datacentersite1speed" name="datacentersitespeed[]"><option value="10" selected>10Mbps</option><option value="100" >100Mbps</option><option value="1000" >1000Mbps</option></select></td></tr><tr><td colspan="4"></td><td align="right"><button type="button" name="removedatacenter" onclick="removeDataCentreRow('+y+');"  class="BackgroundClass"><a href="#" class="BackgroundClass" style="text-decoration:none">Remove</a></button></td></tr></table></div></td></tr></table></div><br /></td></tr></div>');
      $(window).scrollTop(0);
      y++;
    });

    $(".add_colocation_button").click(function(e){
      e.preventDefault();  
      z++;    
      $(".add_more_colocation_div").append('<div id="remove_colocation_'+z+'" class="RemoveAll"><tr><td><table style="border: 1px solid #999999;border-collapse:separate;" border="0" cellpadding="2" cellspacing="0" width="100%" class="six_dg_form"><tbody><tr><td class="BackgroundClass" colspan="99" style="padding: 2px 0 2px 6px">Colocation Quote</td></tr><tr><td style="padding: 8px"><table border="0" cellpadding="2" cellspacing="2" width="100%" class="paddedtable"><tbody><tr><td class="six_dg_form_label"><span class="bodyCopy">Location:</span></td><td class="six_dg_form_input"><select name="colocation_location[]" class="" ><option value="" selected="selected">-- Please select --</option><?php foreach ($colocationLocations as $key => $colocationLocation) { ?><option value="<?php echo $key; ?>"><?php echo $colocationLocation; ?></option><?php } ?></select></td></tr><tr><td class="six_dg_form_label"><span class="bodyCopy">Number of Racks:</span></td><td class="six_dg_form_input"><select name="colocation_racks_number[]" class="" ><option value="" selected="selected">-- Please select --</option><?php foreach ($colocationRacks as $key => $colocationRack) { ?><option value="<?php echo $key; ?>"><?php echo $colocationRack; ?></option><?php } ?> </select></td></tr><tr><td class="six_dg_form_label"><span class="bodyCopy">Maximum Power Rating Per Rack:</span></td><td class="six_dg_form_input"><select name="colocation_maxPoweRating[]" class="" ><option value="" selected="selected">-- Please select --</option><?php foreach ($colocationPowerRatings as $key => $colocationPowerRating) { ?><option value="<?php echo $key; ?>"><?php echo $colocationPowerRating; ?></option><?php } ?></select></td></tr><tr><td class="six_dg_form_label"><span class="bodyCopy">Power Regime:</span></td><td class="six_dg_form_input"><select name="colocation_powerRegime[]" class="" ><option value="" selected="selected">-- Please select --</option><?php foreach ($colocationPowerRegimes as $key => $colocationPowerRegime) { ?><option value="<?php echo $key; ?>"><?php echo $colocationPowerRegime; ?></option><?php } ?></select></td></tr><tr><td class="six_dg_form_label"><span class="bodyCopy">Port to our Network Services and our other Colocation Sites:</span></td><td class="six_dg_form_input"><select name="colocation_NetworkServices[]" class="" ><option value="" selected="selected">-- Please select --</option><?php foreach ($colocationNetworkServices as $key => $colocationNetworkService) { ?><option value="<?php echo $key; ?>"><?php echo $colocationNetworkService;?></option><?php } ?></select></td></tr><tr><td class="six_dg_form_label"><span class="bodyCopy">Internet Access Connectivity:</span></td><td class="six_dg_form_input"><select name="colocation_internetAccess[]" class="" > <option value="" selected="selected">-- Please select --</option>      <?php foreach ($colocationAccessInternets as $key => $colocationAccessInternet) { ?><option value="<?php echo $key; ?>"><?php echo $colocationAccessInternet; ?></option><?php } ?></select></td></tr><tr><td colspan="2">&nbsp;</td></tr><tr><td colspan="2" class="six_dg_form_label" ><span class="bodyCopy"> I have High Density, High Security, Dedicated Cage or Dedicated Pod requirements</span><span><input name="formBody[colocation][0][data][dedicatedPodRequirements]" value="0" type="hidden" ><input name="dedicatedPodRequirements[]" value="1" type="checkbox" ></span><!-- <input type="checkbox"> --></td></tr><tr><td colspan="2">&nbsp;</td></tr><tr><td colspan="2" align="right" ><button type="button" name="removecolocation" onclick="removeColocationRow('+z+');" class="BackgroundClass"><a href="#" class="BackgroundClass" style="text-decoration:none">Remove</a></button></td></tr></tbody></table></td></tr></tbody></table></td></tr></br></div>');
      $(window).scrollTop($(document).height());
    });

$(clear_all_items).click(function(e){
  e.preventDefault();
          //if(x>1){
            $(".RemoveAll").remove();
            x = 2;
            y = 1;
            z = 1;
            counter_value = 1;
         // } 
         $(".clearFieldsData").val("");
         $(".ValidationSpan").hide();
         $(".ValidationSpan").val("");
       });
});

function removeSiteRow(value){
  $("#remove_item_"+value).remove();
  //counter_value--;
//  $(window).scrollTop(0);
}

function removeDataCentreRow(value){
  $("#remove_data_centre_"+value).remove();
}

function removeColocationRow(value){

  $("#remove_colocation_"+value).remove();
  $("html, body").animate({ scrollTop: $(document).height() });
}

</script>
@endsection