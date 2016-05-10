<?php
/*
Plugin Name: JQuery Html5 File Upload
Plugin URI: http://wordpress.org/extend/plugins/jquery-html5-file-upload/
Description: This plugin adds a file upload functionality to the front-end screen. It allows multiple file upload asynchronously along with upload status bar.
Version: 1.3
Author: Anwar Swabiri
Author URI: 
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


/**The URL of the plugin directory*/
define('JQHFUPLUGINDIRURL',plugin_dir_url(__FILE__));

/* Runs when plugin is activated */
register_activation_hook(__FILE__,'jquery_html5_file_upload_install'); 

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'jquery_html5_file_upload_remove' );

function jquery_html5_file_upload_install() {
    add_option("jqhfu_accepted_file_types", 'gif|jpeg|jpg|png', '', 'yes');
    add_option("jqhfu_inline_file_types", 'gif|jpeg|jpg|png', '', 'yes');
    add_option("jqhfu_maximum_file_size", '5', '', 'yes');
    add_option("jqhfu_thumbnail_width", '80', '', 'yes');
    add_option("jqhfu_thumbnail_height", '80', '', 'yes');
    add_option("pheditor_price_per_image", '1', '', 'yes');
    
    $upload_array = wp_upload_dir();
    $upload_dir=$upload_array['basedir'].'/files/';
    /* Create the directory where you upoad the file */
    if (!is_dir($upload_dir)) {
        $is_success=mkdir($upload_dir, '0755', true);
        if(!$is_success)
            die('Unable to create a directory within the upload folder');
    }
    global $wpdb;

    $table_name = $wpdb->prefix . "order";

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        created_date VARCHAR(10) DEFAULT '',
        name VARCHAR(255) DEFAULT '' NOT NULL,
        email VARCHAR(100) DEFAULT '' NOT NULL,
        contact VARCHAR(50) DEFAULT '',
        download_link VARCHAR(255) DEFAULT '',
        instruction VARCHAR(1000) DEFAULT '',
        status int DEFAULT 0,
        user_id int,
        discount_code VARCHAR(50) DEFAULT '',
        payment_id int,
        UNIQUE KEY id (id)
    );";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

function jquery_html5_file_upload_remove() {
    /* Deletes the database field */
    delete_option('jqhfu_accepted_file_types');
    delete_option('jqhfu_inline_file_types');
    delete_option('jqhfu_maximum_file_size');
    delete_option('jqhfu_thumbnail_width');
    delete_option('jqhfu_thumbnail_height');
    delete_option('pheditor_price_per_image');
}

if(isset($_POST['savesetting']) && $_POST['savesetting']=="Save Setting")
{
    update_option("jqhfu_accepted_file_types", $_POST['accepted_file_types']);
    update_option("jqhfu_inline_file_types", $_POST['inline_file_types']);
    update_option("jqhfu_maximum_file_size", $_POST['maximum_file_size']);
    update_option("jqhfu_thumbnail_width", $_POST['thumbnail_width']);
    update_option("jqhfu_thumbnail_height", $_POST['thumbnail_height']);
    update_option("pheditor_price_per_image", $_POST['price_per_image']);
}

// Add settings link on plugin page
function jquery_html5_file_upload_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=jquery-html5-file-upload-setting.php">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'jquery_html5_file_upload_settings_link' );

if ( is_admin() ){

/* Call the html code */
add_action('admin_menu', 'jquery_html5_file_upload_admin_menu');


function jquery_html5_file_upload_admin_menu() {
    add_options_page('JQuery HTML5 File Upload Setting', 'JQuery HTML5 File Upload Setting', 'administrator',
    'jquery-html5-file-upload-setting', 'jquery_html5_file_upload_html_page');
    add_menu_page("Orders", "Orders", 'level_10', 'photo_order', jqhfu_load_order_page, home_url('/wp-content/plugins/paypal-express-checkout/static/images/icon.png'));
}
}

function jquery_html5_file_upload_html_page() {
$args = array(
    'orderby'                 => 'display_name',
    'order'                   => 'ASC',
    'selected'                => $_POST['user']
);
?>
<h2>JQuery HTML5 File Upload Setting</h2>

<form method="post" >
<?php wp_nonce_field('update-options'); ?>

<table >
<tr >
<td>Price per image</td>
<td >
<input type="text" name="price_per_image" value="<?php print(get_option('pheditor_price_per_image')); ?>" />&nbsp;$
</td>
</tr>
<tr >
<td>Accepted File Types</td>
<td >
<input type="text" name="accepted_file_types" value="<?php print(get_option('jqhfu_accepted_file_types')); ?>" />&nbsp;filetype seperated by | (e.g. gif|jpeg|jpg|png)
</td>
</tr>
<tr >
<td>Inline File Types</td>
<td >
<input type="text" name="inline_file_types" value="<?php print(get_option('jqhfu_inline_file_types')); ?>" />&nbsp;filetype seperated by | (e.g. gif|jpeg|jpg|png)
</td>
</tr>
<tr >
<td>Maximum File Size</td>
<td >
<input type="text" name="maximum_file_size" value="<?php print(get_option('jqhfu_maximum_file_size')); ?>" />&nbsp;MB
</td>
</tr>
<tr >
<td>Thumbnail Width </td>
<td >
<input type="text" name="thumbnail_width" value="<?php print(get_option('jqhfu_thumbnail_width')); ?>" />&nbsp;px
</td>
</tr
<tr >
<td>Thumbnail Height </td>
<td >
<input type="text" name="thumbnail_height" value="<?php print(get_option('jqhfu_thumbnail_height')); ?>" />&nbsp;px
</td>
</tr>
<tr>
<td colspan="2">
<input type="submit" name="savesetting" value="Save Setting" />
</td>
</tr>
</table>
<br/>
<hr/>
<h2>View Uploaded Files</h2>
<table >
<tr >
<td>Select User</td>
<td >
<?php wp_dropdown_users($args); ?> 
</td>
<td>
<input type="submit" name="viewfiles" value="View Files" /> &nbsp; <input type="submit" name="viewguestfiles" value="View Guest Files" />
</td>
</tr>
<tr>
</table>
<table>
<tr>
<td>
<?php
if(isset($_POST['viewfiles']) && $_POST['viewfiles']=='View Files')
{
if ($_POST['user']) {
    $upload_array = wp_upload_dir();
    $imgpath=$upload_array['basedir'].'/files/'.$_POST ['user'].'/';
    $filearray=glob($imgpath.'*');
    if($filearray && is_array($filearray))
    {
        foreach($filearray as $filename){
            if(basename($filename)!='thumbnail'){
            print('<a href="'.$upload_array['baseurl'].'/files/'.$_POST ['user'].'/'.basename($filename).'" target="_blank"/>'.basename($filename).'</a>');
            print('<br/>');
            }
        }
    }
} 
}
else
if(isset($_POST['viewguestfiles']) && $_POST['viewguestfiles']=='View Guest Files')
{
    $upload_array = wp_upload_dir();
    $imgpath=$upload_array['basedir'].'/files/guest/';
    $filearray=glob($imgpath.'*');
    if($filearray && is_array($filearray))
    {
        foreach($filearray as $filename){
            if(basename($filename)!='thumbnail'){
            print('<a href="'.$upload_array['baseurl'].'/files/guest/'.basename($filename).'" target="_blank"/>'.basename($filename).'</a>');
            print('<br/>');
            }
        }
    }
}
?>
</td>
</tr>
</table>
</form>
<?php
}


function jqhfu_enqueue_scripts() {
    $stylepath=JQHFUPLUGINDIRURL.'css/';
    $scriptpath=JQHFUPLUGINDIRURL.'js/';

    wp_enqueue_style ( 'jquery-ui-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/themes/base/jquery-ui.css' );
    wp_enqueue_style ( 'jquery-image-gallery-style', $stylepath . 'jquery.image-gallery.min.css');
    wp_enqueue_style ( 'jquery-fileupload-ui-style', $stylepath . 'jquery.fileupload-ui.css');
    wp_enqueue_style ( 'bootstrap-ui-style', $stylepath . 'bootstrap.css');
    wp_enqueue_script ( 'enable-html5-script', $scriptpath . 'html5.js');
    wp_enqueue_script ( 'enable-html5-script', $scriptpath . 'bootstrap.js');
    if(!wp_script_is('jquery')) {
        wp_enqueue_script ( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js',array(),'',false);
    }
    wp_enqueue_script ( 'jquery-ui-script', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js',array('jquery'),'',true);
    wp_enqueue_script ( 'tmpl-script', $scriptpath . 'tmpl.min.js',array('jquery'),'',true);
    wp_enqueue_script ( 'load-image-script', $scriptpath . 'load-image.min.js',array('jquery'),'',true);
    wp_enqueue_script ( 'canvas-to-blob-script', $scriptpath . 'canvas-to-blob.min.js',array('jquery'),'',true);
    wp_enqueue_script ( 'jquery-image-gallery-script', $scriptpath . 'jquery.image-gallery.min.js',array('jquery'),'',true);
    wp_enqueue_script ( 'jquery-iframe-transport-script', $scriptpath . 'jquery.iframe-transport.js',array('jquery'),'',true);
    wp_enqueue_script ( 'jquery-fileupload-script', $scriptpath . 'jquery.fileupload.js',array('jquery'),'',true);
    wp_enqueue_script ( 'jquery-fileupload-fp-script', $scriptpath . 'jquery.fileupload-fp.js',array('jquery'),'',true);
    wp_enqueue_script ( 'jquery-fileupload-ui-script', $scriptpath . 'jquery.fileupload-ui.js',array('jquery'),'',true);
    wp_enqueue_script ( 'jquery-fileupload-jui-script', $scriptpath . 'jquery.fileupload-jui.js',array('jquery'),'',true);
    wp_enqueue_script ( 'transport-script', $scriptpath . 'cors/jquery.xdr-transport.js',array('jquery'),'',true);
    wp_enqueue_script ( 'custom-script', $scriptpath . 'custom.js');
}    

function jqhfu_load_ajax_function()
{
    /* Include the upload handler */
    require 'UploadHandler.php';
    global $current_user;
    get_currentuserinfo();
    $current_user_id=$current_user->ID;
    if(!isset($current_user_id) || $current_user_id=='')
        $current_user_id='guest';
    $upload_handler = new UploadHandler(null,$current_user_id,true);
    die(); 
}

function jqhfu_add_inline_script() {
?>
<script type="text/javascript">
/*
 * jQuery File Upload Plugin JS Example 7.0
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
jQuery(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    jQuery('#fileupload').fileupload({
        url: '<?php print(admin_url('admin-ajax.php'));?>',
        autoUpload:true,
    });

    // Enable iframe cross-domain access via redirect option:
    jQuery('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            <?php
            $absoluteurl=str_replace(home_url(),'',JQHFUPLUGINDIRURL);
            print("'".$absoluteurl."cors/result.html?%s'");
            ?>
        )
    );

    if(jQuery('#fileupload')) {
        // Load existing files:
        jQuery.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: jQuery('#fileupload').fileupload('option', 'url'),
            data : {action: "load_ajax_function"},
            acceptFileTypes: /(\.|\/)(<?php print(get_option('jqhfu_accepted_file_types')); ?>)$/i,
            dataType: 'json',
            context: jQuery('#fileupload')[0]
            
            
        }).done(function (result) {
            jQuery(this).fileupload('option', 'done')
                        .call(this, null, {result: result});
        });
    }

    // Initialize the Image Gallery widget:
    jQuery('#fileupload .files').imagegallery();

    // Initialize the theme switcher:
    jQuery('#theme-switcher').change(function () {
        var theme = jQuery('#theme');
        theme.prop(
            'href',
            theme.prop('href').replace(
                /[\w\-]+\/jquery-ui.css/,
                jQuery(this).val() + '/jquery-ui.css'
            )
        );
    });

});

</script>
<?php
}

/* creates a compressed zip file */
function create_zip($path = '',$destination = '',$overwrite = true) {
    //if the zip file already exists and overwrite is false, return false
    if(file_exists($destination) && !$overwrite) { return false; }
    //vars
    $valid_files = array();
    //if files were passed in...
    $filearray=glob($path.'*');
    if($filearray && is_array($filearray))
    {
        foreach($filearray as $filename) {
            if(file_exists($filename)) {
                $valid_files[] = $filename;
            }
        }
    }
    /*if(is_array($files)) {
        //cycle through each file
        foreach($files as $file) {
            //make sure the file exists
            if(file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }*/
    //if we have good files...
    if(count($valid_files)) {
        //create the archive
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        //add the files
        foreach($valid_files as $file) {
            $zip->addFile($file, basename($file));
        }
        //debug
        //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
        
        //close the zip -- done!
        $zip->close();
        
        //check to make sure the file exists
        return file_exists($destination);
    }
    else
    {
        return false;
    }
}

/* Block of code that need to be printed to the form*/
function jquery_html5_file_upload_hook() {
    global $current_user;
    global $wpdb;
    get_currentuserinfo();
    $table_name = $wpdb->prefix . "order";
    $existing_order = $wpdb->get_row("SELECT * FROM $table_name WHERE status = 0 AND user_id = " . $current_user->ID);
    $result = '<div id="image-upload-form-wrapper">';
    $result .= '<form id="fileupload" action="'. admin_url().'admin-ajax.php'.'" method="POST" enctype="multipart/form-data">';
        $result .= '<input type="hidden" id="image_price" name="price" value="'.get_option('pheditor_price_per_image').'"/>';
        $result .= '<input type="hidden" name="action" value="load_ajax_function" />';
        $result .= '<table class="custData">';
            $result .= '<tbody>';
            $result .= '<tr>';
                $result .= '<td>';
                    $result .= '<div style="display: block; font-family: Lato,sans-serif; text-align: center; font-size: 14px;" id="welcomeMessage" class="alert alert-success">Welcome! Looks like it\'s your first time here. Have a free image on us.</div>';
                $result .= '</td>';
            $result .= '</tr>';
            $result .= '<tr>';
                $result .= '<th align="left">Your Email *</th>';
            $result .= '</tr>';
            $result .= '<tr>';
                $result .= '<td colspan="">';
                    $result .= '<input type="text" placeholder="Email" name="email" id="email" value="' . $current_user->user_email .'">';
                    $result .= '<input type="hidden" placeholder="trialOrder" name="trialOrder" id="trialOrder" value="Yes">';
                $result .= '</td>';
            $result .= '</tr>';
            $result .= '<tr>';
                $result .= '<th align="left">Your Name *</th>';
            $result .= '</tr>';
            $result .= '<tr>';
                $result .= '<td>';
                    $result .= '<input type="text" placeholder="Name" id="name" name="name" value="'.$current_user->user_login.'">';
                $result .= '</td>';
            $result .= '</tr>';
            $result .= '<tr>';
                $result .= '<th align="left">Contact Number</th>';
            $result .= '</tr>';
            $result .= '<tr>';
                $result .= '<td>';
                $phone = !empty($existing_order) ? $existing_order->contact : "";
                    $result .= '<input type="text" placeholder="Contact" id="phone" name="phone" value="'.$phone.'">';
                $result .= '</td>';
            $result .= '</tr>';
            $result .= '<tr>';
                $result .= '<th align="left">Promotional Code</th>';
            $result .= '</tr>';
            $result .= '<tr>';
                $result .= '<td>';
                    $result .= '<input type="text" placeholder="Leave blank if you don\'t have one" id="discount_code" name="discount_code">';
                    $result .= '<div id="codeValid"></div>';
                    $result .= '<input type="hidden" placeholder="validPromoCode" name="validPromoCode" id="validPromoCode">';
                $result .= '</td>';
            $result .= '</tr>';                        
            $result .= '<tr>';
                $result .= '<th align="left" colspan="2">Paste your download link bellow ( Dropbox, GoogleDrive, etc )</th>';
            $result .= '</tr>';
             $result .= '<tr>';
                $result .= '<td>';
                    $storeurl = !empty($existing_order) ? $existing_order->download_link : "";
                    $result .= '<input type="text" placeholder="Store URL" id="store_url" name="store_url" value="'.$storeurl.'">';
                $result .= '</td>';
            $result .= '</tr>';                       
            $result .= '<tr>';
                $result .= '<th align="left">Special Instructions</th>';
            $result .= '</tr>';
            $result .= '<tr>';
                $result .= '<td>';
                    $instruction = !empty($existing_order) ? $existing_order->instruction : "";
                    $result .= '<textarea placeholder="Please let us know any requirements you have" name="instructions" id="instructions" rows="5" cols="50">'.$instruction.'</textarea>';
                $result .= '</td>';
            $result .= '</tr>';
            $result .= '<tr>';
                $result .= '<td colspan="3">&nbsp;</td>';
            $result .= '</tr>';
            $result .= '<tr>';
                $result .= '<td align="center" colspan="2">';
$current_user_id=$current_user->ID;
if(!isset($current_user_id) || $current_user_id=='') {
                    $result .= '<input type="button" value="Add your files" onclick="window.location.href=\'/login\'" id="enableUpload" class="btn btn-small btn-primary">';    
} else {
                    $result .= '<input type="button" value="Add your files" onclick="enableUploading();" id="enableUpload" class="btn btn-small btn-primary">';
}
                    $result .= '<br><br>';
                $result .= '</td>';
            $result .= '</tr>';
            $result .= '</tbody>';
        $result .= '</table>';
        $result .= '<div class="uploadArea" id="uploadArea" style="display: none;">';
            $result .= '<div style="margin-left:105%;" class="span5 ">';
                $result .= '<span class="btn btn-success fileinput-button" style="border: none;border-radius: 0px;">';
                $result .= '<span>Choose files</span>';
                $result .= '<input type="file" id="file_system" multiple="" name="files[]" style="display: block;">';
                $result .= '</span>';
            $result .= '</div>';
            $result .= '<div id="drag_drop">Drag and drop your files here to upload...<br>';
                $result .= '<span style="font-size: 13px;"><em>(Maximum file size is 5MB per image)</em></span>';
            $result .= '</div>';
            $result .= '<input type="hidden" value="load_ajax_function" name="action">';
            $result .= '<div class="fileupload-loading"></div>';
            $result .= '<br>';
            $result .= '<table class="table table-striped" role="presentation" id="imageTable"><tbody data-target="#modal-gallery" data-toggle="modal-gallery" class="files"></tbody></table>';
        $result .= '</div>';
        $result .= '<br>';
    $result .= '</form>';
$result .= '</div>';
$result .= '<script type="text/javascript">';
$result .= 'function addDeleteHandler() {';
$result .= 'var price = jQuery("#image_price").val();';
$result .= 'var count = jQuery(\'.files .template-download\').length - 1;';
$result .= 'jQuery(\'#paypal-wrapper [name="AMT"]\').val(price * count);';
$result .= 'jQuery("#totalAmount").val("$"+(price*count));';
$result .= '}';
$result .= '</script>';
$result .= '<script id="template-upload" type="text/x-tmpl">';
$result .= '{% for (var i=0, file; file=o.files[i]; i++) { %}';
    $result .= '<tr class="template-upload fade">';
        $result .= '<td class="preview"><span class="fade"></span></td>';
       
        $result .= '{% if (file.error) { %}';
            $result .= '<td class="error" colspan="2"><span class="label label-important">Error: </span> {%=file.error%}</td>';
        $result .= '{% } else if (o.files.valid && !i) { %}';
            $result .= '<td >';
                $result .= '<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>';
            $result .= '</td>';
            $result .= '<td class="start" colspan="3">{% if (!o.options.autoUpload) { %}';
                $result .= '<button class="btn btn-primary">';
                    $result .= '<i class="icon-upload icon-white"></i>';
                    $result .= '<span>Start</span>';
                $result .= '</button>';
            $result .= '{% } %}</td>';
        $result .= '{% } else { %}';
            $result .= '<td colspan="2"></td>';
        $result .= '{% } %}';
        $result .= '<td class="cancel">{% if (!i) { %}';
            $result .= '<button class="btn btn-warning">';
                $result .= '<i class="icon-ban-circle icon-white"></i>';
                $result .= '<span>Cancel</span>';
            $result .= '</button>';
        $result .= '{% } %}</td>';
    $result .= '</tr>';
$result .= '{% } %}';
$result .= '</script>';
$result .= '<script id="template-download" type="text/x-tmpl">';
$result .= '{% for (var i=0, file; file=o.files[i]; i++) { %}';
    $result .= '<tr class="template-download fade">';
        $result .= '{% if (file.error) { %}';
        $result .= '<td class="error" colspan="5"><span class="label label-important">Error: </span> {%=file.error%} ({%=file.name.substring(4)%})</td>            ';
            
        $result .= '{% } else { %}';
            $result .= '<td class="preview">{% if (file.thumbnail_url) { %}';
                $result .= '<a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>';
            $result .= '{% } %}</td>';
            $result .= '<td class="name" style="width:200px;">';
$result .= '<div style="width:190px;overflow-x:hidden;">';
                $result .= '<a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&\'gallery\'%}" download="{%=file.name%}">{%=file.name%}</a>';
           $result .= '</div> </td>';
            $result .= '<td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>';
            $result .= '<td colspan="2"></td>';
        $result .= '{% } %}';
        $result .= '<td class="delete">';
            $result .= '<button class="btn btn-danger" onclick="addDeleteHandler()" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}&action=load_ajax_function"{% if (file.delete_with_credentials) { %} data-xhr-fields=\'{"withCredentials":true}\'{% } %}>';
                $result .= '<i class="icon-trash icon-white"></i>';
                $result .= '<span>Delete</span>';
            $result .= '</button>';
        $result .= '</td>';
    $result .= '</tr>';
$result .= '{% } %}';
$result .= '</script>';
    return $result;
}

/* Add the resources */
add_action( 'wp_enqueue_scripts', 'jqhfu_enqueue_scripts' );

/* Load the inline script */
add_action( 'wp_footer', 'jqhfu_add_inline_script' );

/* Hook on ajax call */
add_action('wp_ajax_load_ajax_function', 'jqhfu_load_ajax_function');
add_action('wp_ajax_nopriv_load_ajax_function', 'jqhfu_load_ajax_function');

add_shortcode ('jquery_file_upload', 'jquery_html5_file_upload_hook');
add_shortcode ('custom_my_order', 'jqhfu_hook_my_order');

function jqhfu_save_ajax_function()
{
    global $wpdb;
    global $current_user;
    get_currentuserinfo();
    $current_user_id=$current_user->ID;
    if(!isset($current_user_id) || $current_user_id=='')
        $current_user_id='guest';
    
    $name = $current_user->user_login;
    $email = $current_user->user_email;
    $contact = $_REQUEST['contact'];
    $discount_code = $_REQUEST['discount'];
    $store_url = $_REQUEST['storelink'];
    $instruction = $_REQUEST['instructions'];
    
    $table_name = $wpdb->prefix . "order";
    $existing_order = $wpdb->get_row("SELECT * FROM $table_name WHERE status = 0 AND user_id = " . $current_user_id);
    $data = array(
        'name' => $name,
        'email' => $email,
        'contact' => $contact,
        'discount_code' => $discount_code,
        'instruction' => $instruction,
        'download_link' => $store_url,
        'user_id' => $current_user_id,
        'created_date' => date('Y-m-d'),
    );
    
    if ( !empty($existing_order) ) {
        $where = array("id" => $existing_order->id);
        $wpdb->update($table_name, $data, $where);
    } else {
        $wpdb->insert($table_name, $data);
    }
    die(); 
}

function send_email_to_users($order_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . "order";
    $order = $wpdb->get_row("SELECT * FROM $table_name WHERE id = " . $order_id);
    $upload_array = wp_upload_dir();
    $result_file = $upload_array['basedir'].'/result/result_'.$order_id.'.zip';
    //define the receiver of the email
    $to = $order->email;
    //define the subject of the email
    $subject = 'Result Images from Clip Etch';
    //create a boundary string. It must be unique
    //so we use the MD5 algorithm to generate a random hash
    $random_hash = md5(date('r', time()));
    //define the headers we want passed. Note that they are separated with \r\n
    $headers = "From: webmaster@webfactional.com\r\nReply-To: webmaster@webfactional.com";
    //add boundary string and mime type specification
    $headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";
    //read the atachment file contents into a string,
    //encode it with MIME base64,
    //and split it into smaller chunks
    $attachment = chunk_split(base64_encode(file_get_contents($result_file)));
    //define the body of the message.
    ob_start(); //Turn on output buffering
    ?>
    --PHP-mixed-<?php echo $random_hash; ?> 
    Content-Type: multipart/alternative; boundary="PHP-alt-<?php echo $random_hash; ?>"

    --PHP-alt-<?php echo $random_hash; ?> 
    Content-Type: text/plain; charset="iso-8859-1"
    Content-Transfer-Encoding: 7bit

    Hello World!!!
    This is simple text email message.

    --PHP-alt-<?php echo $random_hash; ?> 
    Content-Type: text/html; charset="iso-8859-1"
    Content-Transfer-Encoding: 7bit

    <h2>Hello, </h2>
    <p>This is result images.</p>

    --PHP-alt-<?php echo $random_hash; ?>--

    --PHP-mixed-<?php echo $random_hash; ?> 
    Content-Type: application/zip; name="result.zip" 
    Content-Transfer-Encoding: base64 
    Content-Disposition: attachment 

    <?php echo $attachment; ?>
    --PHP-mixed-<?php echo $random_hash; ?>--

    <?php
    //copy current buffer contents into $message variable and delete current output buffer
    $message = ob_get_clean();
    //send the email
    $mail_sent = @mail( $to, $subject, $message, $headers );
    return $mail_sent; 
}

add_action('wp_ajax_save_ajax_function', 'jqhfu_save_ajax_function');
add_action('wp_ajax_nopriv_save_ajax_function', 'jqhfu_save_ajax_function');
                                                               
function jqhfu_load_order_page() {
    global $wpdb;
    global $current_user;
    get_currentuserinfo();
    $uid = $current_user->ID;
    
    $order_id = $_REQUEST['id'];
    
    if ( $order_id == null ) {
        $table_name = $wpdb->prefix . "order";
        $rows = $wpdb->get_results("SELECT * FROM $table_name WHERE status > 0");
        require 'order-history.php';
    } else {
        $order_id = base64_decode($order_id);
        $table_name = $wpdb->prefix . "order";
        
        if ( isset($_FILES['upload-file']) ) {
            $upload_array = wp_upload_dir();
            $path=$upload_array['basedir'].'/result/'.$order_id.'/';
            if (!is_dir($path)) {
                $is_success=mkdir($path);
                if(!$is_success)
                    die('Unable to create a directory within the upload folder');
            }
            move_uploaded_file($_FILES['upload-file']['tmp_name'], $path.$_FILES['upload-file']['name']);
        }
        if ( isset($_REQUEST['complete']) ) {   // completed status
            $data = array(
                'status' => 2,
            );
            $where = array("id" => $order_id);
            $wpdb->update($table_name, $data, $where);
            
            $upload_array = wp_upload_dir();
            $imgpath = $upload_array['basedir'].'/result/'.$order_id.'/';
            create_zip($imgpath, $upload_array['basedir'].'/result/result_'.$order_id.'.zip');
            $test = send_email_to_users($order_id);
        }
        if ( isset($_REQUEST['edit']) ) {   // edit status
            $data = array(
                'status' => 1,
            );
            $where = array("id" => $order_id);
            $wpdb->update($table_name, $data, $where);
        }
        $order = $wpdb->get_row("SELECT * FROM $table_name WHERE id = " . $order_id);
        require 'order-images.php';
    }
}

function jqhfu_hook_my_order() {
    global $wpdb;
    global $current_user;
    get_currentuserinfo();
    $uid = $current_user->ID;
    
    $table_name = $wpdb->prefix . "order";
    $rows = $wpdb->get_results("SELECT * FROM $table_name WHERE status > 0 AND user_id=".$uid);
    
    require 'my-order.php';
}

add_action('wp_ajax_get_payment_detail', 'jqhfu_get_payment_detail');
add_action('wp_ajax_nopriv_get_payment_detail', 'jqhfu_get_payment_detail');

function jqhfu_get_payment_detail() {
    global $wpdb;
    global $current_user;
    get_currentuserinfo();
    $uid = $current_user->ID;
    $pid = base64_decode($_REQUEST['id']);
    
    $table_name = "hccoder_paypal";
    $details = $wpdb->get_row("SELECT * FROM $table_name WHERE id = ".$pid);
    require 'payment-detail.php';
}

add_action('wp_ajax_get_download_page', 'jqhfu_get_download_page');
add_action('wp_ajax_nopriv_get_download_page', 'jqhfu_get_download_page');

function jqhfu_get_download_page() {
    global $wpdb;
    global $current_user;
    get_currentuserinfo();
    $uid = $current_user->ID;
    $oid = base64_decode($_REQUEST['id']);
    
    $table_name = $wpdb->prefix . "order";
    $order = $wpdb->get_row("SELECT * FROM $table_name WHERE id = " . $oid);
    require 'download.php';
}
