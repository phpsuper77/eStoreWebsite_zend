<style type="text/css">
table#order-list tr:nth-child(2n) {
    background-color: #FDFDFD;
}
</style>
<div class="wrap">
  <h2>Photo Order History</h2>
  
  <?php if ( ! count($rows) ) { ?>
    <div class="updated" id="message">
          <p><strong>Order history is empty.</strong></p>
        </div>
  <?php } else { ?> 
    <p>
      Here you can see all orders on your website.
    </p>
    <table id="order-list" cellspacing="0" class="wp-list-table widefat fixed">
      <thead>
        <tr>
          <th class="manage-column">Name</th>
          <th class="manage-column">E-mail</th>
          <th class="manage-column">Contact</th>
          <th class="manage-column">Description</th>
          <th class="manage-column">Date</th>
          <th class="manage-column">Status</th>
          <th class="manage-column"></th>
          <th class="manage-column">View Payment</th>
        </tr>
      </thead>
    
      <tfoot>
        <tr>
          <th class="manage-column">Name</th>
          <th class="manage-column">E-mail</th>
          <th class="manage-column">Contact</th>
          <th class="manage-column">Description</th>
          <th class="manage-column">Date</th>
          <th class="manage-column">Status</th>
          <th class="manage-column"></th>
          <th class="manage-column">View Payment</th>
        </tr>
      </tfoot>
    
      <tbody class="list:user" id="the-list">
        <?php foreach ( $rows as $row ) { ?>
          <tr class="alternate">
            <td class="role column-role"><?php echo $row->name; ?></td>
            <td class="role column-role"><?php echo $row->email; ?></td>
            <td class="role column-role"><?php echo $row->contact; ?></td>
            <td class="role column-role"><?php echo $row->instruction; ?></td>
            <td class="role column-role"><?php echo $row->created_date; ?></td>
            <td class="role column-role">
                <?php if($row->status==1): ?>
                    Pending
                <?php elseif($row->status==2): ?>
                    Complete
                <?php endif; ?>
            </td>
            <td class="role column-role"><a href="<?php echo admin_url('admin.php?page=photo_order&id='.base64_encode($row->id)); ?>">View Images</a></td>
            <td class="username column-username">
<!--              <strong style="<?php echo $row->status == 'success' ? 'color:#339900;' : ''; ?>"><?php echo $row->status; ?></strong><br />-->
              <div>
                <span class="edit"><a href="<?php echo admin_url( 'admin.php?page=paypal-express-checkout-history&action=details&id='.$row->payment_id, 'http' ); ?>">View details</a></span>
              </div>
            </td>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>
</div><!-- .wrap -->