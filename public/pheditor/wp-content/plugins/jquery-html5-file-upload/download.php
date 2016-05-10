<style type="text/css">
    ul.order-image-wrapper li {
        
    }
</style>
<div class="wrap">
  <h2>Result Images for <?=$order->name?></h2>
  <p>Right click the image and select "Save As"</p>
  <ul class="order-image-wrapper">
<?php
    $upload_array = wp_upload_dir();
    $imgpath=$upload_array['basedir'].'/result/'.$oid.'/';
    $filearray=glob($imgpath.'*');
    if($filearray && is_array($filearray))
    {
        foreach($filearray as $filename) {
?>
            <li>
                <a href="<?php echo '/wp-content/uploads/result/'.$oid.'/'.basename($filename); ?>"><?php echo basename($filename); ?></a>
            </li>
<?php            
        }
    }
?>
    </ul>
    <div style="clear:both;"><a href="/my-order/">Back</a></div>
</div>