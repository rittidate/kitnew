
<!-- Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Cart</h4>
      </div>
      <div class="modal-body">
                <table id="grid-cartdetail" class="table">
                    <thead>
                            <tr>
                            	<th></th>
                                <th><?php echo $plabel_barcode; ?></th>
                                <th><?php echo $plabel_product; ?></th>
                                <th><?php echo $plabel_price; ?></th>
                                <th style="width:20px;"><?php echo $plabel_qty; ?></th>
                                <th><?php echo $plabel_total; ?></th>
                            </tr>
                    </thead>
                    <tbody class="cartdetail_tr">
                            <tr class="footer_grid">
                                <td colspan="4" align="right"><?php echo $plabel_subtotal; ?></td>
                                <td colspan="2"><input type="hidden" id="cart_subtotal" name="subtotal" /><span class="text_subtotal"></span></td>
                            </tr>
                            <tr class="footer_grid cartdetail_shipprice">
                                <td colspan="4" align="right"><?php echo $plabel_shipprice; ?></td>
                                <td colspan="2"><input type="hidden" id="cart_shipprice" name="shipprice" /><span class="text_shipprice"></span></td>
                            </tr>
                            <tr class="footer_grid">
                                <td colspan="4" align="right"><?php echo $plabel_grandtotal; ?></td>
                                <td colspan="2"><input type="hidden" id="cart_grandtotal" name="grandtotal" /><span class="text_grandtotal"></span></td>
                            </tr>
                    </tbody>
                </table>

      </div>
      <div class="modal-footer">

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
