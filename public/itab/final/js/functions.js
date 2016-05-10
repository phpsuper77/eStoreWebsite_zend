var curID = 1;
$(document).ready(function() {
    $("#content").find("[id^='tab']").hide(); // Hide all content
    $("#tabs li:first").attr("id","current"); // Activate the first tab
    $("#content #tab1").fadeIn(); // Show first tab's content
    
    $('#tabs a').click(function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
         return;       
        }             
        $("#content").find("[id^='tab']").hide(); // Hide all content
        $("#tabs li").attr("id",""); //Reset id's
        $(this).parent().attr("id","current"); // Activate this
        var tabName = $(this).attr('name');
        $('#' + tabName).fadeIn(); // Show content for the current tab
        curID = parseInt(tabName.substring(3,4));
    });

	$('#btn_bold').on('click', onBold);
	$('#btn_italic').on('click', onItalic);
	$('#btn_underline').on('click', onUnderline);
	$('#btn_ordered').on('click', onOrdered);
	$('#btn_unordered').on('click', onUnordered);
    $('#text_size').on('change', onTextSize);
	$('#text_font').on('change', onTextFont);
    $('#btn_textcolor').colpick({
        onSubmit:onTextcolor
    });
    $('#btn_bordercolor').colpick({
        onSubmit:onBordercolor
    });
    $('#btn_bgcolor').colpick({
        onSubmit:onBgcolor
    });
    $('#btn_addimg').on('click', onAddImage);
	$('#btn_addmap').on('click', onAddMap);
	$('#btn_undo').on('click', onUndo);
	$('#btn_redo').on('click', onRedo);
	$('#btn_edit').on('click', onEdit);
	$('#btn_save').on('click', onSave);
});
// Bold function
function onBold() {
	CKEDITOR.instances['editor' + curID]._.commands.bold.exec();
}
// Italic function
function onItalic() {
	CKEDITOR.instances['editor' + curID]._.commands.italic.exec();
}
// Underline function
function onUnderline() {
	CKEDITOR.instances['editor' + curID]._.commands.underline.exec();
}
// Ordered function
function onOrdered() {
	CKEDITOR.instances['editor' + curID].execCommand("numberedlist");
}
// Unordered function
function onUnordered() {
	CKEDITOR.instances['editor' + curID].execCommand("bulletedlist");
}
// Text size function
function onTextSize() {
    var size = $('#text_size').val();
    CKEDITOR.instances['editor' + curID].focus();
    CKEDITOR.instances['editor' + curID].fire( 'saveSnapshot' );

    var vars = {};
    var style = new CKEDITOR.style({ element : 'span', attributes : { 'style' : 'font-size:'+size+'px' } });

    /*if ( this.getValue() == value )
        style.remove( CKEDITOR.instances['editor' + curID].document );
    else */
        style.apply( CKEDITOR.instances['editor' + curID].document );

    CKEDITOR.instances['editor' + curID].fire( 'saveSnapshot' );
}
// Text font function
function onTextFont() {
	var family = $('#text_font').val();
    CKEDITOR.instances['editor' + curID].focus();
    CKEDITOR.instances['editor' + curID].fire( 'saveSnapshot' );

    var vars = {};
    var style = new CKEDITOR.style({ element : 'span', attributes : { 'style' : 'font-family: '+family } });

    /*if ( this.getValue() == value )
        style.remove( CKEDITOR.instances['editor' + curID].document );
    else */
        style.apply( CKEDITOR.instances['editor' + curID].document );

    CKEDITOR.instances['editor' + curID].fire( 'saveSnapshot' );
}
// Text color function
function onTextcolor(hsb,hex,rgb,el) {
    $(el).colpickHide();
    CKEDITOR.instances['editor' + curID].focus();
    CKEDITOR.instances['editor' + curID].fire( 'saveSnapshot' );

    var vars = {};
    var style = new CKEDITOR.style({ element : 'span', attributes : { 'style' : 'color: #'+hex } });

    /*if ( this.getValue() == value )
        style.remove( CKEDITOR.instances['editor' + curID].document );
    else */
        style.apply( CKEDITOR.instances['editor' + curID].document );

    CKEDITOR.instances['editor' + curID].fire( 'saveSnapshot' );
}
// Border color function
function onBordercolor(hsb,hex,rgb,el) {
	$(el).colpickHide();
    CKEDITOR.instances['editor' + curID].setUiColor('#' + hex);
}
// Background color function
function onBgcolor(hsb,hex,rgb,el) {
    $(el).colpickHide();
	CKEDITOR.instances['editor' + curID].document.getBody().setStyle('background-color', '#'+hex);
}
// Add Image function
function onAddImage() {
    CKEDITOR.instances['editor' + curID]._.commands.image.exec()
}
// Add Map function
function onAddMap() {
	CKEDITOR.instances['editor' + curID].execCommand('gmap');
}
// Undo function
function onUndo() {
	CKEDITOR.instances['editor' + curID]._.commands.undo.exec();
}
// Redo function
function onRedo() {
	CKEDITOR.instances['editor' + curID]._.commands.redo.exec();
}
// Edit function
function onEdit() {
	alert("Edit");
}
// Save function
function onSave() {
	alert("Save");
} 