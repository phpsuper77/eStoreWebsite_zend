<div class="wrap" id="my-order-wrapper">
  <h2>My Orders</h2>
  
  <?php if ( ! count($rows) ) { ?>
    <div class="updated" id="message">
          <p><strong>Order history is empty.</strong></p>
        </div>
  <?php } else { ?> 
    <p>
      Here you can see all orders on your website.
    </p>
    <table cellspacing="0" class="wp-list-table widefat fixed">
      <thead>
        <tr>
          <th class="manage-column">Name</th>
          <th class="manage-column">E-mail</th>
          <th class="manage-column">Contact</th>
          <th class="manage-column">Description</th>
          <th class="manage-column">Date</th>
          <th class="manage-column">Status</th>
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
            <td class="username column-username">
                <strong style="<?php echo $row->status == 2 ? 'color:#339900;' : ''; ?>"><?php echo $row->status == 2 ? 'done' : 'pending'; ?></strong>
                <?php if ( $row->status == 2 ): ?>
                <br/>
                <!--<a href="javascript:;" onclick="getDownloadPage('<?=base64_encode($row->id)?>')">Download</a>-->
                <a href="<?php echo '/wp-content/uploads/result/result_' . $row->id . '.zip'; ?>">Download</a>
                <?php endif; ?>
            </td>
            <td class="username column-username">
              <div>
                <span class="edit"><a href="javascript:;" onclick="getPaymentDetail('<?=base64_encode($row->payment_id)?>')">View details</a></span>
              </div>
            </td>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>
</div><!-- .wrap -->