<?php

add_action( 'woocommerce_after_shop_loop_item_title', 'custom_field_display_below_title', 2 );
function custom_field_display_below_title(){
     
    global $product;
 
    
    
    // Get the custom field value
    $c_weight_in = get_post_meta( $product->get_id(), 'c_weight_in', true );
     $c_weight = get_post_meta( $product->get_id(), 'c_weight', true );

    // Display
    if( $c_weight ){
        echo "<p class='my-custom-field'> Approx $c_weight $c_weight_in per pack. </p>";
    }
    
}