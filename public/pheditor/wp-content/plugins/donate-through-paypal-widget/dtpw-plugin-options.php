<?php

/********************
* dtpw plugin Options*
********************/


/********************
creates function*****
********************/

function dtpw_options_page() {

     global $dtpw_options;
     ob_start(); ?>
	 
	 <div class="wrap">
	 <h2> donate through paypal widget options</h2>
	 <p> Here You can change your settings for donate through paypal widget plugin </p>
	 
	 <form method="post" action="options.php">
	 
	 <?php settings_fields('dtpw_settings_group'); ?>
	 
	 <h4> <?php _e('Enter Your Paypal Email Id','dtpw_email') ?> </h4>
	 
	 <p> <label class="description" for="dtpw_settings[paypal_id]"> <?php _e('Enter Your Paypal Email id on which you want to recieve donations','dtpw_email')?> </label> <br />
	 
	 <input id="dtpw_settings[paypal_id]" name="dtpw_settings[paypal_id]" type="email" value="<?php echo $dtpw_options['paypal_id'] ?>" />
	 
	 <p> <label class="description" for="dtpw_settings[paypal_textarea]"> <?php _e('Enter the text you want to display above donation banner','paypal_text')?> </label> <br />
	 
	 <textarea id="dtpw_settings[paypal_textarea]" name="dtpw_settings[paypal_textarea]" type="text" value="<?php echo $dtpw_options['paypal_textarea'] ?>" cols=30 rows=04> <?php echo $dtpw_options['paypal_textarea'] ?>  </textarea>
	 
	 
	 </p>
	 <p class="submit">
	 <input type="submit" class="button-primary" value="<?php _e('save options','dtpw_email') ?>" />
	 </p>
	 
	 </form>
	 <div align="center"><form method="post" action="https://www.paypal.com/cgi-bin/webscr">
<div class="paypal-donations">
<input type="hidden" value="_donations" name="cmd"/>
<input type="hidden" value="admin@fastanswers.net" name="business"/>
<input type="hidden" value="http://fastanswers.net/thank-you.html" name="return"/>
<input type="hidden" value="You found the information helpful and want to say thanks? Your donation is enough to inspire us to do more. Thanks a bunch!" name="item_name"/>
<input type="hidden" value="USD" name="currency_code"/>
<input type="image" alt="PayPal – The safer, easier way to pay online." name="submit" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif"/><img width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" alt=""/></div></form></div>
	 </div>
	 
	  <br />

	 <?php
	 
	 echo ob_get_clean();
}  
     function dtpw_add_options_link() {
	 
	 add_options_page('donate through paypal widget options','donate through paypal widget ','manage_options','dtpw-options','dtpw_options_page');
	 }
	 add_action('admin_menu','dtpw_add_options_link');
	 
	 function dtpw_register_settings() {
	   register_setting('dtpw_settings_group','dtpw_settings');
	 }
	 
	 add_action ('admin_init','dtpw_register_settings');
	 
	 function dtpw_plugin_action_links( $links, $file ) {
	if ( $file == plugin_basename( dirname(__FILE__).'/Donate-through-paypal-widget.php' ) ) {
		$links[] = '<a href="admin.php?page=dtpw-options">'.__('Settings').'</a>';
	}

	return $links;
}

add_filter( 'plugin_action_links', 'dtpw_plugin_action_links', 10, 2 );
	 
	 
?>