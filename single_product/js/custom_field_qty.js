
function customcount(qty, id){
    var wiight = jQuery('#c_weight_'+id).val();
    var wiight_in = jQuery('#c_weight_in_'+id).val();
    var total_weight = wiight * qty; 
    var p_weight = total_weight;
     if(wiight_in == 'GM'){ p_weight = total_weight / 1000; } 
      jQuery('#p_weight_'+id).val(p_weight);
}


function count(str){

    
var element = jQuery('#qutyc input');
var p = element.map(function () {
    return this.value
}).get();
 var total = 0;
 
  jQuery.each( p, function( key, value ) {
   total =  (total)+  +  (value);
});
 
 var vali = jQuery("#validte").val();
 var subslimit = jQuery("#subscribelimit").val();
 var producttype = jQuery("#producttype").val();
 
 if(producttype == 'Subscription'){
	
var dates = jQuery('#mdp-demo').val();
 var len = dates.split(',').length;
 console.log(total +'>'+ vali);
 if((total == vali) && (len == subslimit) ){
	 jQuery(".single_add_to_cart_button").prop("disabled",false);
	 jQuery("#verror").html('');
 }else{
	 jQuery(".single_add_to_cart_button").prop("disabled",true);
	 jQuery("#verror").html('<p style="color:red">Limitation is only ' + vali + "KG and Select the "+ subslimit +" Delivery date  </p>");
 }
 
  
 
 }else{
	if(total == vali   ){
	 jQuery(".single_add_to_cart_button").prop("disabled",false);
	 jQuery("#verror").html('');
 }else{
	 jQuery(".single_add_to_cart_button").prop("disabled",true);
	 jQuery("#verror").html('<p style="color:red">Limitation is only ' + vali + "KG and Select the "+ subslimit +" Delivery date </p>");
 } 
	 
	 
 }
 
}


/********* for Edit **/
function countupdate(str,id){
   customcount(str,id);
 
  
    
   
var element = jQuery('#qutyc .qty  input');
var p = element.map(function () {
    return this.value
    
}).get();
 var total = 0;
  
  jQuery('input.mqu').each(function(index){ 
        total =  (total)+  +  (jQuery(this).val());
         });
 /* jQuery.each( p, function( key, value ) {
   total =  (total)+  +  (value);
});*/
 
 var vali = jQuery("#validte").val();
 
 
 
 console.log(total +'>'+ vali);
 if(total == vali ){
	 jQuery(".single_add_to_cart_button").prop("disabled",false);
	 jQuery("#verror").html('');
 }else{
    
num = total.toFixed(3); // 12.545
console.log(num);
	 jQuery(".single_add_to_cart_button").prop("disabled",true);
	 jQuery("#verror").html('<p style="color:red">Limitation  is only ' + vali + "KG, You have selected <b> "   + total + " Kg.</b></p>");
 }
}