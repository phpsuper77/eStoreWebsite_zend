<style type="text/css">
    ul.order-image-wrapper {
        clear: both;
    }
    ul.order-image-wrapper li {
        margin: 0;
        padding: 6px;
    }
    ul.order-image-wrapper li:nth-child(2n+1) {
        background-color: #F9F9F9;
    }
    ul.order-image-wrapper li:nth-child(2n) {
        background-color: #FFF;
    }
    ul.order-image-wrapper li a {
        text-decoration: none;
    }
    ul.order-image-wrapper li a:hover {
        text-decoration: underline;
    }
    .upload-result-wrapper {
        margin: 5px 0 15px;
        background-color: #FFFFFF;
        border-left: 4px solid #7AD03A;
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    h2.order-image-header {
        width: 300px; 
        float: left; 
        margin-bottom: 20px; 
        padding: 0px;
    }
</style>
<?php 
    $upload_array = wp_upload_dir();
    $imgpath = $upload_array['basedir'].'/photos/'.$order_id.'/';
    $download_path = '/wp-content/uploads/photos/photo_'.$order_id.'.zip';
?>
<div class="wrap">
    <div style="clear:both;"><a href="<?php echo admin_url('admin.php?page=photo_order'); ?>" class="button button-primary">Back</a></div>
    <br/>
  <nobr><h2 class="order-image-header">Order Images from <?=$order->name?></h2><a href="<?=$download_path?>" class="button button-primary">Download all</a>
  <ul class="order-image-wrapper">
<?php
    $filearray=glob($imgpath.'*');
    $idx = 1;
    if($filearray && is_array($filearray))
    {
        foreach($filearray as $filename) {
?>
            <li>
                <a href="<?php echo '/wp-content/uploads/photos/'.$order_id.'/'.basename($filename); ?>"><?php echo $idx . '. ' . basename($filename); ?></a>
            </li>
<?php            
            $idx++; 
        }
    }
?>
    </ul>
</div>
<div style="clear:both;"></div>
<br/>
<div class="wrap">
  <h2>Result Images for <?=$order->name?></h2><br>
  <?php if ( $order->status != 2 ): ?>
  <div class="upload-result-wrapper" style="padding: 9px;">
    <form name="upload-form" enctype="multipart/form-data" method="post" action="">
        <label for="upload-file">Please upload result files : </label>
        <input type="file" name="upload-file" id="upload-file" />
        <input type="submit" name="submit" value="Upload" class="button action" style="margin-top: 2px;"/>
    </form>
  </div>
  <?php endif; ?>
  <ul class="order-image-wrapper">
<?php
    $imgpath=$upload_array['basedir'].'/result/'.$order_id.'/';
    $filearray=glob($imgpath.'*');
    $idx = 1;
    if($filearray && is_array($filearray))
    {
        foreach($filearray as $filename) {
?>
            <li>
                <a href="<?php echo '/wp-content/uploads/result/'.$order_id.'/'.basename($filename); ?>"><?php echo $idx . '. ' . basename($filename); ?></a>
            </li>
<?php            
            $idx++;
        }
    }
?>
    </ul>
    
    <div style="clear: both;">
        <?php if ( $order->status != 2 ): ?>
        <form action="" name="complete-form" method="post">
            <input type="hidden" name="complete" value="1" />
            <label>If you uploaded all result files, please click this button! : </label><input type="submit" name="btn-complete" value="Complete" class="button button-primary"/>
        </form>
        <?php else: ?>
        <form action="" name="edit-form" method="post">
            <input type="hidden" name="edit" value="1" />
            <label>If you need to edit files, please click this button! : </label><input type="submit" name="btn-edit" value="Edit" class="button button-primary"/>
        </form>
        <?php endif; ?>
    </div>
    <br/>
    <div style="clear:both;"><a href="<?php echo admin_url('admin.php?page=photo_order'); ?>" class="button button-primary">Back</a></div>
</div>