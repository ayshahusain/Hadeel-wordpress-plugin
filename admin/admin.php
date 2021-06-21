<?php

/***************************************
 Display Custome field with new Tab
 *********************************************/
add_filter( 'woocommerce_product_data_tabs', 'wk_custom_product_tab', 10, 1 );
 function wk_custom_product_tab( $default_tabs ) {
    $default_tabs['subscribe_tab'] = array(
        'label'   =>  __( 'Combo box', 'domain' ),
        'target'  =>  'wk_subscribe_tab_data',
        'priority' => 60,
        'class'   => array()
    );
    return $default_tabs;
}

 add_action( 'woocommerce_product_data_panels', 'wk_subscribe_tab_data' );
function wk_subscribe_tab_data() {
	global $post;
	$current_id =  $post->ID;
 // Check for the custom field value
 $product = wc_get_product( $current_id );
 $titles = $product->get_meta( 'custom_text_field_title' );
 $limit = $product->get_meta( 'custom_product_limit' );
 $custom_subscribe = $product->get_meta( 'custom_subscribe' );
 $custom_number_of_subscription = $product->get_meta( 'custom_number_of_subscription' );
 $c_weight = $product->get_meta( 'c_weight' );
 $c_weight_in = $product->get_meta( 'c_weight_in' );
 $title = array();
 $title = json_decode($titles);
 $shodisplay = $display = 'none';
 $Combo = null;
 $Subscription = null;
 $gift = null;
 $kg = $gm = $shop = null;
 if($c_weight_in == 'kg'){$kg = 'selected';}elseif($c_weight_in == 'GM'){$gm = 'selected'; }
 if($custom_subscribe == 'Combo'){ $Combo ='selected'; $display = 'none';}
 if($custom_subscribe == 'shop'){ $shop ='selected'; $shodisplay = 'block';}
 else if($custom_subscribe == 'Subscription'){$Subscription ='selected'; $display = 'block'; }
  else if($custom_subscribe == 'gift'){$gift ='selected'; $display = 'block'; }
	$args = array(
                'post_type'      => 'product',
                'posts_per_page' => -1,
				 'post_status' => 'publish'
            );

            $loop = new WP_Query( $args );
			$opton = null;
	 while ( $loop->have_posts() ) : $loop->the_post();
	 global $product;
	 $sele = null;
	if(!empty($title)){
	if(in_array($product->get_id(),$title)){$sele = 'checked';}
	}
	 
	  if($current_id != $product->get_id())
	 {
if(get_post_meta( $product->get_id(), 'custom_subscribe', true ) == "shop"){		 
 
 $opton .='<p style="margin:0; border-bottom:1px solid #ddd;"> <input type="checkbox" '.$sele.'  name="custom_text_field_title[]" value="'. $product->get_id() .'" /> '.$product->get_name().' </p>';
}
	 }
	 endwhile;
   echo '<div id="wk_subscribe_tab_data" class="panel woocommerce_options_panel"> 
   
    <p class="form-field _regular_price_field ">
		<label for="_regular_price">Product Type</label>
		
		<select name="custom_subscribe" id="custom_subscribe" >
		<option value="">Select Product type</option>		
		<option value="Subscription" '. $Subscription .' >Subscription</option>
		<!--<option value="Gift" '. $gift .' >Gift</option>
		<option value="Combo" '. $Combo .' >Custom Combo</option>-->
		<option value="shop" '. $shop .' >Shop</option>
		</select>  </p>
		
		<div id="weight_type" style="display:'.$shodisplay.'">
	    <p class="form-field _regular_price_field " >
		<label for="_regular_price">Weight</label>
		
		<select name="c_weight_in" id="c_weight_in" >
		<option value="kg" '. $kg .' >KG.</option>
		<option value="GM" '. $gm .' >Gram</option>
		</select>  </p>	
		
		<p class="form-field _regular_price_field "  >
		<input type="text" class="short wc_input_price" style="" name="c_weight" id="c_weight" value="'.$c_weight.'" placeholder="">  </p>	
		</div>
   
    <p class="form-field _regular_price_field " id="custom_number_of_subscription"  style="display:'.$display.'">
		<label for="_number_of_subscription">Number of Subscription</label>
		<input type="number" class="short wc_input_price" style="" name="custom_number_of_subscription" id="_number_of_subscription" value="'.$custom_number_of_subscription.'" placeholder=""> </p>
		
		
   <p class="form-field _regular_price_field " id="productlimitkg" style="display:'.$display.'">
		<label for="custom_product_limit">Products Limit in KG</label>
		<input type="number" class="short wc_input_price" style="" name="custom_product_limit" id="custom_product_limit" value="'.$limit.'" placeholder=""  > </p>
	
	<div class="form-field _regular_price_field " id="selectpro" style="display:'.$display.'">
		 <table><tr><td width="150" valign="top"><p> Select Products</p>  </td>
		 <td>
		<div class="multiselect" style="width:300px; height:150px; overflow:auto; border: 1px solid #ddd;"> '. $opton.'</div> 
		</td>
		</tr>
		</table>
		</div>
		
    
    </div>';
}




/*************************************** 
Save custome Field 
***************************************/

function cfwc_save_custom_field( $post_id ) {
 $product = wc_get_product( $post_id );
 $title = isset( $_POST['custom_text_field_title'] ) ? $_POST['custom_text_field_title'] : '';
 $limit = isset( $_POST['custom_product_limit'] ) ? $_POST['custom_product_limit'] : '';
 $subscribe_status=isset( $_POST['custom_subscribe'] ) ? $_POST['custom_subscribe'] : '';
 $c_weight_in=isset( $_POST['c_weight_in'] ) ? $_POST['c_weight_in'] : '';
 $c_weight=isset( $_POST['c_weight'] ) ? $_POST['c_weight'] : '';
 $subscribe_limit=isset( $_POST['custom_number_of_subscription'] ) ? $_POST['custom_number_of_subscription']: '';
 
 
 $titles = json_encode($title);
 $product->update_meta_data( 'custom_text_field_title', sanitize_text_field( $titles ) );
 $product->update_meta_data( 'custom_product_limit', sanitize_text_field( $limit ) );
 $product->update_meta_data( 'custom_subscribe', sanitize_text_field( $subscribe_status ) );
 $product->update_meta_data( 'c_weight_in', sanitize_text_field( $c_weight_in ) );
 $product->update_meta_data( 'c_weight', sanitize_text_field( $c_weight ) );
 $product->update_meta_data( 'custom_number_of_subscription', sanitize_text_field( $subscribe_limit ) );
 $product->save();
}
add_action( 'woocommerce_process_product_meta', 'cfwc_save_custom_field' );