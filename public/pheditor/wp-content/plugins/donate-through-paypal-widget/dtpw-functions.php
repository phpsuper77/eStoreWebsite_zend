<?php
class PaypalDonateWidget extends WP_Widget {
 
    function PaypalDonateWidget() {
        parent::WP_Widget( false, $name = 'Paypal donate widget' );
    }
 
    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
 
        // Display RSS info
        PaypalDonateDisplay();
        echo $after_widget;
    }
 
    
 
    
}
 
function PaypalDonateDisplay() {

global $dtpw_options;
?>
     
	 <b><?php echo $dtpw_options['paypal_textarea'] ?></b>
	 <div align="center"><form method="post" action="https://www.paypal.com/cgi-bin/webscr">
<div class="paypal-donations">
<input type="hidden" value="_donations" name="cmd"/>
<input type="hidden" value="<?php echo $dtpw_options['paypal_id'] ?> " name="business"/>

<input type="hidden" value="You found the information helpful and want to say thanks? Your donation is enough to inspire us to do more. Thanks a bunch!" name="item_name"/>
<input type="hidden" value="USD" name="currency_code"/>
<input type="image" alt="PayPal – The safer, easier way to pay online." name="submit" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif"/><img width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" alt=""/></div></form></div>
	 
	 
	
	<?php
	 
	 
} 
add_action( 'widgets_init', 'PaypalDonateWidgetInit' );
 
function PaypalDonateWidgetInit() {
    register_widget( 'PaypalDonateWidget' );
}
 
?>