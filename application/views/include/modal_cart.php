
<!-- Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-shopping-cart hidden-xs fa-2x"></i> Cart</h4>
      </div>
      <div class="modal-body">
    	<div class="row">
        	<div class="col-lg-12" id="stage_one">
                <table id="grid-cartdetail" class="table table-responsive">
                    <thead>
                            <tr>
                            	<th align="center"><input type="checkbox" class="deleteAllCart" /></th>
                                <th class="hidden-xs"><?php echo $plabel_barcode; ?></th>
                                <th><?php echo $plabel_product; ?></th>
                                <th><?php echo $plabel_price; ?></th>
                                <th style="width:20px;"><?php echo $plabel_qty; ?></th>
                                <th><?php echo $plabel_total; ?></th>
                            </tr>
                    </thead>
                    <tbody class="cartdetail_tr">
                            <tr class="footer_grid">
                                <td colspan="4" align="right"><?php echo $plabel_subtotal; ?></td>
                                <td colspan="2" align="right">
                                	<input type="hidden" id="cart_subtotal" name="subtotal" />
                                	<input type="hidden" id="cart_subweight" name="subweight" />
                                	<span class="text_subtotal"></span>
                            	</td>
                            </tr>
                            <tr class="footer_grid cartdetail_shipprice">
                                <td colspan="4" align="right"><?php echo $plabel_shipprice; ?></td>
                                <td colspan="2" align="right"><input type="hidden" id="cart_shipprice" name="shipprice" /><span class="text_shipprice"></span></td>
                            </tr>
                            <tr class="footer_grid cartdetail_grandtotal">
                                <td colspan="4" align="right"><?php echo $plabel_grandtotal; ?></td>
                                <td colspan="2" align="right"><input type="hidden" id="cart_grandtotal" name="grandtotal" /><span class="text_grandtotal"></span></td>
                            </tr>
                    </tbody>
                </table>
                
                <table class="table table-responsive table-striped cartShipment">
                </table>
                
                <table class="table table-responsive table-striped cartPayment">
                </table>
			</div>
			
			<div class="col-lg-12" id="stage_two" style="display: none;">
				<form class="form-horizontal" id="shipModalForm" role="form">
		            <div class="form-group">
		                <label for="firstname" class="col-sm-3 control-label text-right"><?php echo $label_salutation; ?></label>
		                <div class="col-sm-8">
		                    <?php echo $salutation; ?>
		                </div>
		            </div>
		
		            <div class="form-group">
		                <label for="firstname" class="col-sm-3 control-label text-right"><?php echo $label_firstname; ?></label>
		                <div class="col-sm-8">
		                  <input type="text" name="firstname" class="form-control col-md-8" id="ship_firstname" placeholder="<?php echo $label_firstname; ?>" value="<?php echo $firstname; ?>">
		                </div>
		            </div>
		
		            <div class="form-group">
		                <label for="lastname" class="col-sm-3 control-label text-right"><?php echo $label_lastname; ?></label>
		                <div class="col-sm-8">
		                  <input type="text" name="lastname" class="form-control col-md-8" id="ship_lastname" placeholder="<?php echo $label_lastname; ?>" value="<?php echo $lastname; ?>">
		                </div>
		            </div>
		
		            <div class="form-group">
		               <label for="gender" class="col-sm-3 control-label text-right"><?php echo $label_gender; ?></label>
		                <div class="col-sm-8">
		                    <?php echo $gender; ?>
		                </div>
		            </div>
		
		            <div class="form-group">
		                <label for="birth" class="col-sm-3 control-label text-right"><?php echo $label_birth; ?></label>
		                <div class="col-sm-8">
		                    <input type="date" name="birth" class="form-control col-md-8" id="ship_birth" placeholder="<?php echo $label_birth; ?>" value="<?php echo $birth; ?>">
		                </div>
		            </div>
		
		            <div class="form-group">
		                <label for="address1" class="col-sm-3 control-label text-right"><?php echo $label_address1; ?></label>
		                <div class="col-sm-8">
		                    <input type="text" name="address1" class="form-control col-md-8" id="ship_address1" placeholder="<?php echo $label_address1; ?>" value="<?php echo $address1; ?>">
		                </div>
		            </div>
		
		            <div class="form-group">
		                <label for="address2" class="col-sm-3 control-label text-right"><?php echo $label_address2; ?></label>
		                <div class="col-sm-8">
		                    <input type="text" name="address2" class="form-control col-md-8" id="ship_address2" placeholder="<?php echo $label_address2; ?>" value="<?php echo $address2; ?>">
		                </div>
		            </div>
		
		            <div class="form-group">
		                <label for="address3" class="col-sm-3 control-label text-right"><?php echo $label_address3; ?></label>
		                <div class="col-sm-8">
		                    <input type="text" name="address3" class="form-control col-md-8" id="ship_address3" placeholder="<?php echo $label_address3; ?>" value="<?php echo $address3; ?>">
		                </div>
		            </div>
		
		            <div class="form-group">
		                <label for="address4" class="col-sm-3 control-label text-right"><?php echo $label_address4; ?></label>
		                <div class="col-sm-8">
		                    <input type="text" name="address4" class="form-control col-md-8" id="ship_address4" placeholder="<?php echo $label_address4; ?>" value="<?php echo $address4; ?>">
		                </div>
		            </div>
		
		            <div class="form-group">
		                <label for="city" class="col-sm-3 control-label text-right"><?php echo $label_city; ?></label>
		                <div class="col-sm-8">
		                    <input type="text" name="city" class="form-control col-md-8" id="ship_city" placeholder="<?php echo $label_city; ?>" value="<?php echo $city; ?>">
		                </div>
		            </div>
		
		            <div class="form-group">
		                <label for="state" class="col-sm-3 control-label text-right"><?php echo $label_state; ?></label>
		                <div class="col-sm-8">
		                    <input type="text" name="state" class="form-control col-md-8" id="ship_state" placeholder="<?php echo $label_state; ?>" value="<?php echo $state; ?>">
		                </div>
		            </div>
		
		            <div class="form-group">
		               <label for="country" class="col-sm-3 control-label text-right"><?php echo $label_country; ?></label>
		                <div class="col-sm-8">
		                    <?php echo $country; ?>
		                </div>
		            </div>
		
		            <div class="form-group">
		                <label for="zipcode" class="col-sm-3 control-label text-right"><?php echo $label_zipcode; ?></label>
		                <div class="col-sm-8">
		                    <input type="text" name="zipcode" class="form-control col-md-8" id="ship_zipcode" placeholder="<?php echo $label_zipcode; ?>" value="<?php echo $zipcode; ?>">
		                </div>
		            </div>
		
		            <div class="form-group">
		                <label for="mobile" class="col-sm-3 control-label text-right"><?php echo $label_mobile; ?></label>
		                <div class="col-sm-8">
		                    <input type="text" name="mobile" class="form-control col-md-8" id="ship_mobile" placeholder="<?php echo $label_mobile; ?>" value="<?php echo $mobile; ?>">
		                </div>
		            </div>
		
		            <div class="form-group">
		                <label for="telephone" class="col-sm-3 control-label text-right"><?php echo $label_telephone; ?></label>
		                <div class="col-sm-5">
		                    <input type="text" name="telephone" class="form-control col-md-5" id="ship_telephone" placeholder="<?php echo $label_telephone; ?>" value="<?php echo $telephone; ?>">
		                </div>
		                <div class="col-sm-3">
		                    <input type="text" name="telephone_ext" class="form-control col-md-3" id="ship_telephone_ext" placeholder="<?php echo $label_ext; ?>" value="<?php echo $telephone_ext; ?>">
		                </div>
		            </div>
		
		            <div class="form-group">
		                <label for="fax" class="col-sm-3 control-label text-right"><?php echo $label_fax; ?></label>
		                <div class="col-sm-5">
		                    <input type="text" name="fax" class="form-control col-md-5" id="ship_fax" placeholder="<?php echo $label_fax; ?>" value="<?php echo $fax; ?>">
		                </div>
		                <div class="col-sm-3">
		                    <input type="text" name="fax_ext" class="form-control col-md-3" id="ship_fax_ext" placeholder="<?php echo $label_ext; ?>" value="<?php echo $fax_ext; ?>">
		                </div>
		            </div>
		        </form>
			</div>
		</div>
      </div>
      <div class="modal-footer">
	        <input type="reset" id="closeBtn" data-dismiss="modal" class="btn btn-default" value="Close" />
	        <a href="#" id="goStage1" class="btn btn-default hide"><i class="fa fa-arrow-left"></i> Stage 1</a>
	        <a href="#" id="goStage2" class="btn btn-default hide"><i class="fa fa-arrow-left"></i> Stage 2</a>
	        <input type="submit" id="btnSave" class="btn btn-primary hide" value="Save Unit" />
	        <input type="button" id="stage2Btn" class="btn btn-success" value="Go to stage 2 "/>
	        <input type="button" id="stage3Btn" class="btn btn-success hide" value="Go to stage 3"/>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
