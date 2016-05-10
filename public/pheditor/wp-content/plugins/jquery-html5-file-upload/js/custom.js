function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
} 

function enableUploading() {
    var oname = jQuery('#fileupload #name');
    if (oname.val().length < 2)
    {
        alert ('Please enter correct Name.');
        oname.focus();
        return;
    }
    var omail = jQuery('#fileupload #email');
    if (!IsEmail(omail.val()))
    {
        alert ('Please enter correct Email id.');
        omail.focus();
        return;
    }
    var contact = jQuery('#fileupload #phone').val();
    var discount = jQuery('#fileupload #discount_code').val();
    var storelink = jQuery('#fileupload #store_url').val();
    var instructions = jQuery('#fileupload #instructions').val();
    jQuery('#uploadArea').css('display', 'block');
    var data = {
        action: 'save_ajax_function',
        name: oname.val(),
        email: omail.val(),
        contact: contact,
        discount: discount,
        storelink: storelink,
        instructions: instructions,
    };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    var ajaxurl = '/pheditor/wp-admin/admin-ajax.php';
    jQuery.post(ajaxurl, data, function(response) {
        //console.log(response);
    });
}

function getPaymentDetail(pid){
    var ajaxurl = '/pheditor/wp-admin/admin-ajax.php';
    var data = {
        action: 'get_payment_detail',
        id: pid,
    };
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#my-order-wrapper').html(response);
    });
}

function getDownloadPage(oid){
    var ajaxurl = '/pheditor/wp-admin/admin-ajax.php';
    var data = {
        action: 'get_download_page',
        id: oid,
    };
    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#my-order-wrapper').html(response);
    });
}