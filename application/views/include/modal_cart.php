
<!-- Modal -->
<div class="modal fade bs-modal-lg" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-shopping-cart hidden-xs fa-2x"></i> <?php echo $clabal_cart; ?></h4>
      </div>
      <div class="modal-body">
    	<div class="row">
        	<div class="col-lg-12" id="stage_one">
                <table id="grid-cartdetail" class="table table-responsive">
                    <thead>
                            <tr>
                            	<th align="center"><input type="checkbox" class="deleteAllCart" /></th>
                            	<th class="hidden-xs"><?php echo $plabel_image; ?></th>
                                <th class="hidden-xs"><?php echo $plabel_barcode; ?></th>
                                <th><?php echo $plabel_product; ?></th>
                                <th><?php echo $plabel_price; ?></th>
                                <th style="width:20px;"><?php echo $plabel_qty; ?></th>
                                <th class="text-right"><?php echo $plabel_total; ?></th>
                            </tr>
                    </thead>
                    <tbody class="cartdetail_tr">
                            <tr class="footer_grid">
                            	<td></td>
                            	<td colspan="2" class="hidden-xs"></td>
                                <td colspan="2" align="right"><?php echo $plabel_subtotal; ?></td>
                                <td colspan="2" align="right">
                                	<input type="hidden" id="cart_subtotal" name="subtotal" />
                                	<input type="hidden" id="cart_subweight" name="subweight" />
                                	<span class="text_subtotal"></span>
                            	</td>
                            </tr>
                            <tr class="footer_grid cartdetail_shipprice">
                            	<td></td>
                            	<td colspan="2" class="hidden-xs"></td>
                                <td colspan="2" class="text-right"><?php echo $plabel_shipprice; ?></td>
                                <td colspan="2" class="text-right"><input type="hidden" id="cart_shipprice" name="shipprice" /><span class="text_shipprice"></span></td>
                            </tr>
                            <tr class="footer_grid cartdetail_grandtotal">
                            	<td></td>
                            	<td colspan="2" class="hidden-xs"></td>
                                <td colspan="2" class="text-right"><?php echo $plabel_grandtotal; ?></td>
                                <td colspan="2" class="text-right"><input type="hidden" id="cart_grandtotal" name="grandtotal" /><span class="text_grandtotal"></span></td>
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
		                <label for="email" class="col-sm-3 control-label text-right"><?php echo $label_email; ?></label>
		                <div class="col-sm-8">
		                    <input type="text" name="email" class="form-control col-md-8" id="ship_email" placeholder="<?php echo $label_email; ?>" value="<?php echo $email; ?>">
		                </div>
		            </div>
		            
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
			
			<div class="col-lg-12" id="stage_three" style="display: none;">
				<div class="panel panel-success">
				  <div class="panel-heading">
				    <h3 class="panel-title"><?php echo $clabal_shipment; ?></h3>
				  </div>
				  <div class="panel-body">
				  	<p> 
				 		<b><?php echo $label_email; ?></b> <span class="ftxt_email"></span>
					</p>
				  	<p> 
				 		<b class="ftxt_salutation"></b> <span class="ftxt_firstname"></span> <b><?php echo $label_lastname; ?></b> <span class="ftxt_lastname"></span>
					</p>
					<p>
						<b><?php echo $label_address1; ?></b> <span class="ftxt_address1"></span> 
				    </p>
				    <p>
					    <b><?php echo $label_address2; ?></b> <span class="ftxt_address2"></span>
					    <b><?php echo $label_address3; ?></b> <span class="ftxt_address3"></span>
					    <b><?php echo $label_address4; ?></b> <span class="ftxt_address4"></span>
				    </p>
				    <p>
				    	<b><?php echo $label_city; ?></b> <span class="ftxt_city"></span>
				    	<b><?php echo $label_state; ?></b> <span class="ftxt_state"></span>
				    	<b><?php echo $label_zipcode; ?></b> <span class="ftxt_zipcode"></span>
				    	<b><?php echo $label_country; ?></b> <span class="ftxt_country"></span>
				    </p>
				    <p>
				    	<b><?php echo $label_mobile; ?></b> <span class="ftxt_mobile"></span>
				    	<b><?php echo $label_telephone; ?></b> <span class="ftxt_telephone"></span>
				    	<b><?php echo $label_fax; ?></b> <span class="ftxt_fax"></span>
				    	<b><?php echo $label_ext; ?></b> <span class="ftxt_fax_ext"></span>
				    </p>
				  </div>
				</div>
				
				<div class="panel panel-success">
				  <div class="panel-heading">
				    <h3 class="panel-title"><?php echo $clabal_shipment_head; ?></h3>
				  </div>
				  <div class="panel-body">
				  		<span class="success_shipment"></span>
				  </div>
				</div>
				
				<div class="panel panel-success">
				  <div class="panel-heading">
				    <h3 class="panel-title"><?php echo $clabal_payment_head; ?></h3>
				  </div>
				  <div class="panel-body">
				  		<span class="success_payment"></span>
				  </div>
				</div>
				
				<div class="panel panel-success">
				  <div class="panel-heading">
				    <h3 class="panel-title"><?php echo $clabal_cartdetail; ?> <?php echo $clabal_order_number; ?> <span class="order_number"></span></h3>
				  </div>
				  <div class="panel-body">
				  		<table id="success-cartdetail" class="table table-responsive">
		                    <thead>
		                            <tr>
		                            	<th align="center"></th>
		                            	<th class="hidden-xs"><?php echo $plabel_image; ?></th>
		                                <th class="hidden-xs"><?php echo $plabel_barcode; ?></th>
		                                <th><?php echo $plabel_product; ?></th>
		                                <th><?php echo $plabel_price; ?></th>
		                                <th style="width:20px;"><?php echo $plabel_qty; ?></th>
		                                <th class="text-right"><?php echo $plabel_total; ?></th>
		                            </tr>
		                    </thead>
		                    <tbody class="cartdetail_success">
		                            <tr class="footer_success">
		                            	<td></td>
		                            	<td colspan="2" class="hidden-xs"></td>
		                                <td colspan="2" align="right"><?php echo $plabel_subtotal; ?></td>
		                                <td colspan="2" align="right">
		                                	<span class="success_subtotal"></span>
		                            	</td>
		                            </tr>
		                            <tr class="footer_success">
		                            	<td></td>
		                            	<td colspan="2" class="hidden-xs"></td>
		                                <td colspan="2" class="text-right"><?php echo $plabel_shipprice; ?></td>
		                                <td colspan="2" class="text-right"><span class="success_shipprice"></span></td>
		                            </tr>
		                            <tr class="footer_success">
		                            	<td></td>
		                            	<td colspan="2" class="hidden-xs"></td>
		                                <td colspan="2" class="text-right"><?php echo $plabel_grandtotal; ?></td>
		                                <td colspan="2" class="text-right"><span class="success_grandtotal"></span></td>
		                            </tr>
		                    </tbody>
		                </table>
				  </div>
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
	        <input type="reset" id="closeBtn" data-dismiss="modal" class="btn btn-default" value="<?php echo $clabal_close; ?>" />
	        <a href="#" id="goStage1" class="btn btn-default hide"><i class="fa fa-arrow-left"></i> <?php echo $clabal_step1; ?></a>
	        <a href="#" id="goStage2" class="btn btn-default hide"><i class="fa fa-arrow-left"></i> <?php echo $clabal_step2; ?></a>
	        <a href="#"  id="stage2Btn" class="btn btn-success"><?php echo $clabal_step2; ?> <i class="fa fa-arrow-right"></i></a>
	        <input type="submit" id="btnSave" class="btn btn-success hide" value="<?php echo $clabal_order; ?>"/>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
function queryProduct(){
    var thisClass = this;
    var urlini = '<?php echo base_url() ?>processajax/';
    var formId = $("#shipModalForm");
    thisClass.limitPage = 5;
    
    this.buildMenuStep3Click = function(){
    	var html = '';
    	$(".menuStep3 li").remove();
        $.each(thisClass.buildMenuStep3Obj, function(ini, val){
        	if(ini == 0){
             	html += '<li class="active"><a data-toggle="tab" class="menuStep3Click" data-id="'+val.id+'" href="#">'+val.name+'</a></li>';
            }else{
            	html += '<li class=""><a data-toggle="tab" class="menuStep3Click" data-id="'+val.id+'" href="#">'+val.name+'</a></li>';
            }
        });
        $(".menuStep3").append(html);
        
        thisClass.menuStepEvent();
        return false;
    }
    
    this.buildMenuStep3Select = function(){
    	var html = '';
    	$("#menuStep3Select option").remove();
    	html += '<option value="">Please Select</option>';
        $.each(thisClass.buildMenuStep3Obj, function(ini, val){	
    		html += '<option value="'+val.id+'">'+val.name+'</option>';
        });
        $("#menuStep3Select").append(html);
    }
    
    this.buildMenuStep2 = function(){
        var url = urlini+ 'buildMenuStep2';
        var html = '';
        $.getJSON( url, {  id: thisClass.menuid },
            function(result){
            	if(result.rows != null){
			    	var html = '';
			    	html += '<option value="">Please Select</option>';
			    	$("#menuStep2Select option").remove();
			        $.each(result.rows, function(ini, val){
			        	if(ini == 0){
			        		thisClass.buildMenuStep3(val.id);
			        	}
			    		html += '<option value="'+val.id+'">'+val.name+'</option>';
			        });
			        $("#menuStep2Select").append(html);
            	}
        });
    }
    
    this.buildMenuStep3 = function(){
        var url = urlini+ 'buildMenuStep3';
        var html = '';
        $.getJSON( url, {  id: thisClass.menuid },
            function(result){
            	if(result.rows != null){
            		thisClass.buildMenuStep3Obj = result.rows;
            		thisClass.buildMenuStep3Select();
            		thisClass.buildMenuStep3Click();
            	}
        });
    }
    
    this.getProduct = function(){
    	var url = urlini+ 'getProduct';
    	var html = '';
    	var image,volumn,unit;
    	
    	if(thisClass.pageSelect == undefined){
    		thisClass.pageSelect = 1;
    	}
    	
        $.getJSON( url, {step : thisClass.step, menuid : thisClass.menuid , keyword: thisClass.keyword, page : thisClass.pageSelect },
            function(result){
            	thisClass.pagerNumber = result.page;
            	thisClass.getPager();
            	if(result.rows !== undefined){
            	
	            	$.each(result.rows, function(ini, val){
	            		if(val.unit == null){
	            			unit = '';
	            		}else{
	            			unit = val.unit;
	            		}
	            		if(val.volumn == null){
	            			volumn = '';
	            		}else{
	            			volumn = val.volumn;
	            		}
	            		if(val.image == ''){
	            			image = 'no_image.jpg';
	            		}else{
	            			image = 'large/'+val.image;
	            		}
	            		var productName = val.name+" "+volumn+" "+unit;
	            		
	            		html += '<div class="col-sm-6 col-md-4">';
	            		html += '<div class="thumbnail">';
	            		html += '<img alt="'+productName+'" data-toggle="modal" data-target="#imageProductModal" class="imageProductQuery" date-image="'+image+'" data-id="'+val.pid+'" style="width: 300px; height: 200px;" src="<?php echo base_url('pimage/') ?>'+image+'">';
	            		html += '<div class="caption">';
	            		html += '<p class="text-muted"><?php echo $plabel_barcode; ?> : <span class="product_barcode" data-id="'+val.pid+'">'+val.barcode+'</span></p>';
	            		html += '<b><span class="product_name" data-id="'+val.pid+'">'+productName+'</span></b>';
	            		html += '<p><?php echo $plabel_price; ?> : <span class="product_price" data-id="'+val.pid+'">'+val.price+'</span> <?php echo $plabel_baht; ?> </p>';
	            		html += '<p><?php echo $plabel_qty; ?> : ';
	            		html += thisClass.buildSelectQty(val.stock, val.pid)+' <a role="button" class="btn btn-primary product_buy" data-id="'+val.pid+'" href="#buy"><?php echo $plabel_buy; ?></a>';
	            		html += '<input type="hidden" class="product_stock" data-id="'+val.pid+'" value="'+val.stock+'">';
	            		html += '<input type="hidden" class="product_weight" data-id="'+val.pid+'" value="'+val.weight+'">';
	            		html += '</p>';
	            		html += '</div>';
	            		html += '</div>';
	            		html += '</div>';
	            	});
				}
	         	//$("#productQuery").remove();
				$("#productQuery").html(html);
				thisClass.equalHeight();
				
				//product event
				thisClass.productQueryEvent();
        });
    	
    }
    
    this.getPager = function(){
    	var startpage,endpage;
    	var len = thisClass.pagerNumber;
    	var html = '';
    	var htmlMini = '';
    	
		if(thisClass.pageSelect > 1){
			html += '<li><a class="pagerNumber" data-number="prev" href="#page">&laquo;</a></li>';
			htmlMini += '<li class="previous"><a class="pagerNumber" data-number="prev" href="#page">&larr; Older</a></li>';
		}

    	
    	if(thisClass.pagerNumber > thisClass.limitPage){
			if(thisClass.pagerNumber > (thisClass.pageSelect + thisClass.limitPage -1)){
				startpage = thisClass.pageSelect;
				endpage = thisClass.pageSelect + thisClass.limitPage -1;
			}else if(thisClass.pagerNumber <= (thisClass.pageSelect + thisClass.limitPage -1)){
				startpage = thisClass.pagerNumber - thisClass.limitPage+1;
				endpage = thisClass.pagerNumber;
			}
		}else if(thisClass.pagerNumber == thisClass.limitPage){
			startpage = 1;
			endpage = thisClass.limitPage;
		}else if(thisClass.pagerNumber < thisClass.limitPage){
			startpage = 1;
			endpage = thisClass.pagerNumber;
		}
    	
        for (var i=startpage;i<=endpage;i++)
        {
        	html += '<li data-id="'+i+'"><a class="pagerNumber" data-number="'+i+'" href="#page">'+i+'</a></li>'
        }
        
    	if(thisClass.pageSelect < thisClass.pagerNumber){
    		html += '<li><a class="pagerNumber" data-number="next" href="#page">&raquo;</a></li>';
    		htmlMini += '<li class="next"><a class="pagerNumber" data-number="next" href="#page">Next &rarr;</a></li>';
    	}
        
        $(".pagerProduct").html(html);
        $(".pagerProductMini").html(htmlMini);
        
        $(".pagerProduct li[data-id='"+thisClass.pageSelect+"']").addClass('active');
        
		thisClass.pagerEvent();
    	
    }
    
    this.buildSelectCartQty = function(qty, pid, stock){
        var len = stock;
        var option = '';
        option += "<select class='productCart_qty' data-id='"+pid+"'>";
        if(len > 0){
	        for (var i=1;i<len;i++)
	        {
	            if(i == qty){
	                option += "<option value='"+i+"' selected>"+i+"</option>";
	            }else{
	                option += "<option value='"+i+"'>"+i+"</option>";
	            }
	        }
        }
        option += "</select>";
        return option;
    }
    
    this.buildSelectQty = function(qty, pid){
        var len = qty;
        var option = '';
        option += "<select class='product_qty' data-id='"+pid+"'>";
        if(len > 0){
	        for (var i=1;i<len;i++)
	        {
	                option += "<option value='"+i+"'>"+i+"</option>";
	        }
        }
        option += "</select>";
        return option;
    }
    
    this.buildCartDetailGrid = function(){
        $(".detail_grid").remove();
        var tr = '';
        var i = 0;
        var subtotal = 0;
        var weightTotal = 0;
        var obj = [];
        if(thisClass.objProductCart != null){
            $.each(thisClass.objProductCart, function(ini, val){
                subtotal += val.price * val.qty;
                weightTotal += val.weight * val.qty;
                obj.push({id : val.id, qty : val.qty});
                tr +=  "<tr class='detail_grid'>";
                tr += "<td class='text-center'><a href='#del' class='product_remove' data-id='"+val.id+"'><i class='fa fa-times'></i></a></td>";
                tr += "<td class='hidden-xs'><img style='width: 60px; height: 40px;' src='"+val.image+"'/></td>";
                tr += "<td class='hidden-xs'>"+val.barcode+"</td>";
                tr += "<td>"+val.name+"</td>";
                tr += "<td class='text-center'>"+val.price+"</td>";
                tr += "<td>"+thisClass.buildSelectCartQty(val.qty, val.id, val.stock)+"</td>";
                tr += "<td class='text-right'>"+val.total+"</td>";
                tr += "</tr>";
            });
        }
        
        thisClass.saveSessionCart(obj);

        $(tr).insertBefore(".footer_grid:first-child");
        //subtotal
        $("#cart_subtotal").val(subtotal);
        $(".text_subtotal").text(subtotal);
        
        //subweight
        $("#cart_subweight").val(weightTotal);
        
        $(".cartNotify").text(thisClass.objProductCart.length);
        
        if(thisClass.objProductCart.length == 0){
        	$('#stage2Btn').addClass('hide');
        	
        }else{
        	$('#stage2Btn').removeClass('hide').show();
        }
        thisClass.getRatePrice(subtotal, weightTotal);
        //thisClass.orderDetailGridevent();
        
        $(".product_remove").click(function(){
        	var id = $(this).data('id');
        	var obj = [];
            $.each(thisClass.objProductCart, function(ini, val){
                    if(val.id != id){
                        obj.push(val);
                    }
            });
            thisClass.objProductCart = obj;
            
            thisClass.buildCartDetailGrid();
            return false;
        });
        
        $(".productCart_qty").change(function(){
        	var id = $(this).data('id');
        	var qty = $(this).val();
        	var obj = [];
        	
            $.each(thisClass.objProductCart, function(ini, val){
                    if(val.id == id){
                    	val.qty = qty;
                    	val.total =  val.price * qty;
                        obj.push(val);
                    }else{
                    	obj.push(val);
                    }
            });
            thisClass.objProductCart = obj;
            
            thisClass.buildCartDetailGrid();
        });
        

    }
    
	this.buildCartDetailSuccess = function(){
        $(".detail_grid_success").remove();
        var tr = '';
        var i = 0;
        var subtotal = 0;
        var weightTotal = 0;
        var obj = [];
        if(thisClass.objProductCart != null){
            $.each(thisClass.objProductCart, function(ini, val){
                subtotal += val.price * val.qty;
                weightTotal += val.weight * val.qty;
                obj.push({id : val.id, qty : val.qty});
                tr +=  "<tr class='detail_grid_success'>";
                tr += "<td class='text-center'></td>";
                tr += "<td class='hidden-xs'><img style='width: 60px; height: 40px;' src='"+val.image+"'/></td>";
                tr += "<td class='hidden-xs'>"+val.barcode+"</td>";
                tr += "<td>"+val.name+"</td>";
                tr += "<td class='text-center'>"+val.price+"</td>";
                tr += "<td class='text-center'>"+val.qty+"</td>";
                tr += "<td class='text-right'>"+val.total+"</td>";
                tr += "</tr>";
            });
        }
        
        $(tr).insertBefore(".footer_success:first-child");

        $(".success_subtotal").text(subtotal);
        $(".success_shipprice").text($("#cart_shipprice").val());
        $(".success_grandtotal").text($("#cart_grandtotal").val());

    }
    
    this.saveSessionCart = function(obj){
    	var url = urlini+ 'saveSessionCart';
    	var o_data = { json: JSON.stringify(obj) }
    	$.post( url, o_data, 
    		function(result){
    			
    		});
    }
    
    this.getSessionCart = function(obj){
    	var url = urlini+ 'getSessionCart';
    	var obj = [];
    	$.getJSON( url, 
    		function(result){
        		if(result.rows !== undefined){
	            	$.each(result.rows, function(ini, val){
	            		if(val.unit == null){
	            			unit = '';
	            		}else{
	            			unit = val.unit;
	            		}
	            		if(val.volumn == null){
	            			volumn = '';
	            		}else{
	            			volumn = val.volumn;
	            		}
	            		var productName = val.name+" "+volumn+" "+unit;
	            		
						if(val.stock > 0){
							obj.push({ 
		        		 		 id : val.id,
								 barcode : val.barcode,
								 name : productName,
								 price : val.price,
								 qty : val.qty,
								 total : val.price * val.qty,
								 stock : val.stock,
								 weight : val.weight
								});
						}
	            	});
            	}
	            	thisClass.objProductCart = obj;
	            	thisClass.buildCartDetailGrid();
    		});
    }
    
    this.getRatePrice = function(subtotal, weight){
        var url = urlini+ 'getRatePrice';
        var htmlTrShip = '';
        var htmlRadioShip = '';
        var htmlTrPay = '';
        var htmlRadioPay = '';
        var grandtotal=0;
        var obj,objShipType,objPayment;
    	$.getJSON(
                    url,
                    {
                        subtotal : subtotal,
                        city : $("#ship_city").val(),
                        state : $("#ship_state").val(),
                        country : $("#ship_country").val(),
                        weight : weight
                    },
                    function(result){
                        
                     	if(result !== null && result !==''){
                     		obj = [];
                     		objShipType = [];
                     		objPayment = [];
			        		htmlTrShip += "<tr><th><h4 class='shipLabel'><?php echo $clabal_shipment_head; ?></h4></th></tr>";
			        		$.each(result.shipprice, function(ini, val){
								if(obj.indexOf(val.id) == -1){
				                    htmlTrShip += "<tr><td class='cartShipLabel' data-num='"+val.id+"'><h4>"+val.name+"</h4></td></tr>";
				                    obj.push(val.id);    
				                }
				                objShipType.push(parseInt(val.shiptype_id));
			        		});
			        		$(".cartShipment").html(htmlTrShip);
			        		$.each(result.shipprice, function(ini, val){
			        			if(thisClass.shiptype != undefined && thisClass.shiptype == val.shiptype_id){
									htmlRadioShip = '<div class="radio"><label><input type="radio" name="optionsShipment" class="optionsShipment" data-ship="'+val.shiptype_id+'" id="optionsShipment'+val.shiptype_id+'" value="'+val.shipprice+'" checked>';
						    	}else{
						    		htmlRadioShip = '<div class="radio"><label><input type="radio" name="optionsShipment" class="optionsShipment" data-ship="'+val.shiptype_id+'" id="optionsShipment'+val.shiptype_id+'" value="'+val.shipprice+'">';
						    	}
						    	htmlRadioShip += val.shiptype_name + " " + val.shipprice + " บาท";
						  		htmlRadioShip += '</label>';
						  		htmlRadioShip += '</div>';
						  		$(".cartShipLabel[data-num='"+val.id+"']").append(htmlRadioShip);
			        		});
			        		
			        		obj = [];
			        		htmlTrPay += "<tr><th><h4 class='payLabel'><?php echo $clabal_payment_head; ?></h4></th></tr>";
			        		$.each(result.payment, function(ini, val){
								if(obj.indexOf(val.id) == -1){
				                    htmlTrPay += "<tr><td class='cartPayLabel' data-num='"+val.id+"'><h4>"+val.name+"</h4></td></tr>";
				                    obj.push(val.id);    
				                }
				                objPayment.push(parseInt(val.id));
			        		});
			        		$(".cartPayment").html(htmlTrPay);
			        		$.each(result.payment, function(ini, val){
			        			if(thisClass.paytype != undefined && thisClass.paytype == val.id){
									htmlRadioPay = '<div class="radio"><label><input type="radio" name="optionsPayment" class="optionsPayment" id="optionsPayment'+val.id+'" data-pay="'+val.id+'" value="'+val.id+'" checked>';
						    	}else{
						    		htmlRadioPay = '<div class="radio"><label><input type="radio" name="optionsPayment" class="optionsPayment" id="optionsPayment'+val.id+'" data-pay="'+val.id+'" value="'+val.id+'">';
						    	}
						    	htmlRadioPay += val.description;
						  		htmlRadioPay += '</label>';
						  		htmlRadioPay += '</div>';
						  		$(".cartPayLabel[data-num='"+val.id+"']").append(htmlRadioPay);
			        		});	
			        		
	        		        if($(".optionsShipment:checked").val() != undefined){
					    		$(".cartdetail_shipprice").show();
					        	$(".cartdetail_grandtotal").show();
					        	
						        $("#cart_shipprice").val($(".optionsShipment:checked").val());
					        	$(".text_shipprice").text($(".optionsShipment:checked").val());
					        	grandtotal = parseInt($(".optionsShipment:checked").val()) + parseInt(subtotal)
						        $("#cart_grandtotal").val(grandtotal);
					        	$(".text_grandtotal").text(grandtotal);
					        	
					        }else{
					        	$(".cartdetail_shipprice").hide();
					        	$(".cartdetail_grandtotal").hide();
					        }		        		
					        
					        if(thisClass.shiptype != undefined && thisClass.paytype != undefined){
						        if(objShipType.indexOf(thisClass.shiptype) == -1 && objPayment.indexOf(thisClass.paytype) !== -1){
									$("<label class='error'><?php echo $clabal_shiperror; ?></label>").insertAfter('.shipLabel');
	        			       	}else if(objShipType.indexOf(thisClass.shiptype) !== -1 && objPayment.indexOf(thisClass.paytype) == -1){
		       						$("<label class='error'><?php echo $clabal_payerror; ?></label>").insertAfter('.payLabel');
	        			       	}else if(objShipType.indexOf(thisClass.shiptype) == -1 && objPayment.indexOf(thisClass.paytype) == -1){
		       						$("<label class='error'><?php echo $clabal_payerror; ?></label>").insertAfter('.payLabel');
									$("<label class='error'><?php echo $clabal_shiperror; ?></label>").insertAfter('.shipLabel');
	        			       	}
        			       	}
        			       	
			        	}else{
			        		$(".cartShipment").html('');
			        		$(".cartPayment").html('');
		        		
					        $("#cart_shipprice").val('');
				        	$(".text_shipprice").text('');
		        		
			        		$("#cart_grandtotal").val('');
				        	$(".text_grandtotal").text('');
				        	
				        	$(".cartdetail_shipprice").hide();
				        	$(".cartdetail_grandtotal").hide();
			        	}
			        	
	        	        $(".optionsShipment").click(function(){
				        	var shiptype = $(this).data('ship');
				        	thisClass.shiptype = shiptype;
				        	thisClass.buildCartDetailGrid();
				        	return false;
				        });
				        
				        $(".optionsPayment").click(function(){
			        		var paytype = $(this).data('pay');
				        	thisClass.paytype = paytype;
				        	thisClass.buildCartDetailGrid();
				        });
		});
    }
    
    this.validateRatePrice = function(subtotal, weight){
        var url = urlini+ 'getRatePrice';
        var objShipType,objPayment;
    	$.getJSON(
                    url,
                    {
                        subtotal : subtotal,
                        city : $("#ship_city").val(),
                        state : $("#ship_state").val(),
                        country : $("#ship_country").val(),
                        weight : weight
                    },
                    function(result){
                        
                     	if(result !== null && result !==''){
                     		thisClass.shipAddressSession();
                     		objShipType = [];
                     		objPayment = [];
			        		$.each(result.shipprice, function(ini, val){
			        			objShipType.push(parseInt(val.shiptype_id));
			        		});
			        		
			        		$.each(result.payment, function(ini, val){
			        			objPayment.push(parseInt(val.id));
			        		});	
			        		
        			       	if(objShipType.indexOf(thisClass.shiptype) !== -1 && objPayment.indexOf(thisClass.paytype) !== -1){
			       					$('#cartModal .modal-title').html('<i class="fa fa-shopping-cart hidden-xs fa-2x"></i> <?php echo $clabal_thank; ?>');
			
									$('#closeBtn').show();
									$('#stage_two').hide();
									$("#stage_three").show();
									$('#btnSave').addClass('hide');
									$('#goStage1').addClass('hide');
									
									thisClass.saveOrder();
        			       	}else if(objShipType.indexOf(thisClass.shiptype) == -1 && objPayment.indexOf(thisClass.paytype) !== -1){
        			       		thisClass.backToCart();
        			       		thisClass.buildCartDetailGrid();
        			       	}else if(objShipType.indexOf(thisClass.shiptype) !== -1 && objPayment.indexOf(thisClass.paytype) == -1){
        			       		thisClass.backToCart();
        			       		thisClass.buildCartDetailGrid();
        			       	}else if(objShipType.indexOf(thisClass.shiptype) == -1 && objPayment.indexOf(thisClass.paytype) == -1){
        			       		thisClass.backToCart();
        			       		thisClass.buildCartDetailGrid();
        			       	}
			        	}

		});
    }
    
    this.saveOrder = function(){
		var odata = { 
						subtotal : $("#cart_subtotal").val(),
		                shipprice : $("#cart_shipprice").val(),
		                grandtotal : $("#cart_grandtotal").val(),
		                shipment_id : thisClass.shiptype,
		                payment_id : thisClass.paytype,
		                json: JSON.stringify(thisClass.objProductCart)
		            };
    	var url = urlini+ 'saveOrder';
    	odata = thisClass.oData(odata);
    	$.getJSON(
            url, odata,
            function(result){
            	$(".ftxt_email").text($("#ship_email").val());
              	$(".ftxt_salutation").text($("#ship_salutation option:selected").text());
		    	$(".ftxt_firstname").text($("#ship_firstname").val());
		    	$(".ftxt_lastname").text($("#ship_lastname").val());
		    	
		    	$(".ftxt_address1").text($("#ship_address1").val());
		    	$(".ftxt_address2").text($("#ship_address2").val());
		    	$(".ftxt_address3").text($("#ship_address3").val());
		    	$(".ftxt_address4").text($("#ship_address4").val());
		        
		        $(".ftxt_city").text($("#ship_city").val());
		        $(".ftxt_state").text($("#ship_state").val());
		        $(".ftxt_zipcode").text($("#ship_zipcode").val());
		        $(".ftxt_country").text($("#ship_country option:selected").text());
		        
		        $(".ftxt_mobile").text($("#ship_mobile").val());
		        $(".ftxt_telephone").text($("#ship_telephone").val());
		        $(".ftxt_fax").text($("#ship_fax").val());
		        $(".ftxt_fax_ext").text($("#ship_fax_ext").val());
		        
		        $(".success_shipment").text($(".optionsShipment:checked").parent('label').text());
		        $(".success_payment").text($(".optionsPayment:checked").parent('label').text());
		        
		        $(".order_number").text(result.order[0].id);
		        thisClass.buildCartDetailSuccess();
		        thisClass.objProductCart = [];
		        thisClass.buildCartDetailGrid();
		});
    }
    
    this.getAutoCity = function(add){
        var url = urlini+ 'getAutoCity';
    	var keyword = $("#ship_city").val();
    	var country = $("#ship_country").val();
    	var state = $("#ship_state").val();
    	$.getJSON(
			url,
			{       country: country,
				state: state,
				keyword : keyword },
			function(result){
                            var suggestions = [];
                            if(result != null){
				$.each(result.rows, function(ini, val){
					suggestions.push(val.name);
				});
                            }
                            add(suggestions);
                            $(".ui-autocomplete:visible").css({'z-index': '2000'});
		});
    }

    this.getAutoState = function(add){
    	var url = urlini+ 'getAutoState';
    	var keyword = $("#ship_state").val();
    	var country = $("#ship_country").val();
    	$.getJSON(
                    url,
                    {       country: country,
                            keyword : keyword },
                    function(result){
                        var suggestions = [];
                        if(result != null){
                            $.each(result.rows, function(ini, val){
                                    suggestions.push(val.name);
                            });
                        }
                        add(suggestions);
                        $(".ui-autocomplete:visible").css({'z-index': '2000'});
		});
    }

    this.getAutoZipcode = function(){
    	var url = urlini+ 'getAutoZipcode';
        var city = $("#ship_city").val();
    	var state = $("#ship_state").val();
    	var country = $("#ship_country").val();
    	$.getJSON( url, {   country: country,
                            state : state,
                            city : city },
                    function(result){
                        $("#ship_zipcode").val(result.zipcode['zipcode']);
		});
    }
    
    this.equalHeight = function() {    
	    var tallest = 0;    
	    $(".thumbnail").each(function() {       
	        thisHeight = $(this).height();       
	        if(thisHeight > tallest) {          
	            tallest = thisHeight;       
	        }    
	    });    
	    $(".thumbnail").each(function() { $(this).height(tallest); });
	} 
    
    this.menuStepEvent = function(){
    	$(".menuStep3Click").click(function(){
            var id = $(this).data('id');
            thisClass.step = 3;
            thisClass.menuid = id;
            thisClass.pageSelect = 1;
            thisClass.getProduct(); 
            return false;
        });
    }
    
    this.pagerEvent = function(){
        //page event
        $(".pagerNumber").click(function(){
        	var number = $(this).data('number');
        	if(number == 'prev'){
        		thisClass.pageSelect = thisClass.pageSelect-1;
        	}else if(number == 'next'){
        		thisClass.pageSelect = thisClass.pageSelect+1;
        	}else{
        		thisClass.pageSelect = number;	
        	}
        	thisClass.getProduct();
        	return false;
        });
    }
    
    this.countProduct = function(id){
		var url = urlini+ 'countProduct';
    	$.post( url, { id:id });
    }
    
    this.productQueryEvent = function(){
		$(".imageProductQuery").click(function(){
			var id = $(this).attr('data-id');
			var src = $(this).attr('src');
			var alt = $(this).attr('alt');
			$("#imageModalLabel").text(alt);
			$(".pimage").attr('src', src);
			thisClass.countProduct(id);
		});
		
		$('#imageProductModal').on('shown.bs.modal', function() {
		    var initModalWidth = $('.modal-body:visible').outerWidth(); //give an id to .mobile-dialog
		    //var initModalPadding = $('.modal-body:visible').css('padding-left').split("px")[0];
		    var initModalPadding = 30;
		    var iniImageWidth = $('.pimage').outerWidth();
		    var iniImageHeight = $('.pimage').outerHeight();
		    //if(iniImageHeight > iniImageWidth){
		        $('.pimage').css('margin-left', 
		        (initModalWidth/2) - (iniImageWidth / 2) - initModalPadding); //center it if it does fit
	       	//}else{
	       		//$('.pimage').css('margin-left', '');
	       	//}
	       	$( window ).resize(function(){
			    var initModalWidth = $('.modal-body:visible').outerWidth(); //give an id to .mobile-dialog
			    //var initModalPadding = $('.modal-body:visible').css('padding-left').split("px")[0];
			    var initModalPadding = 30;
			    var iniImageWidth = $('.pimage').outerWidth();
			    var iniImageHeight = $('.pimage').outerHeight();
			    //if(iniImageHeight > iniImageWidth){
			        $('.pimage').css('margin-left', 
			        (initModalWidth/2) - (iniImageWidth / 2) - initModalPadding); //center it if it does fit
	       		
	       	});
		});
		
		$('.product_buy').click(function(){
			var id = $(this).attr('data-id');
			var barcode = $(".product_barcode[data-id='"+id+"']").text();
			//var qty = $(".product_qty[data-id='"+id+"']").val();
			var name = $(".product_name[data-id='"+id+"']").text();
			var price = parseInt($(".product_price[data-id='"+id+"']").text());
			var image = $(".imageProductQuery[data-id='"+id+"']").attr('src');
			//var stock = $(".product_stock[data-id='"+id+"']").val();
			var weight = $(".product_weight[data-id='"+id+"']").val();
			
			var stock = 99;
			var qty = 1;
			if(qty !== null){
				var obj= { 
		        		 	id : id,
							 barcode : barcode,
							 name : name,
							 price : price,
							 qty : qty,
							 image : image,
							 total : price * qty,
							 stock : stock,
							 weight : weight
							};
				//console.log(thisClass.objProductCart);
				if(thisClass.objProductCart != undefined || thisClass.objProductCart != null){
					var inArray = [];
					thisClass.objProductCartAdd = [];
					$.each(thisClass.objProductCart, function(ini, val){
						inArray.push(val.id);
					});
	                $.each(thisClass.objProductCart, function(ini, val){
		                    if(val.id == id){
		                        thisClass.objProductCartAdd.push(obj);
		                    }else{
		                    	thisClass.objProductCartAdd.push(val);
		                    }   
	                });
	                
					if(inArray.indexOf(id) == -1){
	                        thisClass.objProductCartAdd.push(obj);
	                }
	                
	                thisClass.objProductCart = thisClass.objProductCartAdd;
					
				}else{
					thisClass.objProductCart = [obj];
				}
				thisClass.buildCartDetailGrid();
			}
			return false;
		});
    }
    
    this.deleteAllCart = function(){
    	 $("#confirmModal").modal('show');
    }

	this.shipAddressSession = function(){
        var odata = {};
        var url = urlini+ 'shipAddressSession';

        odata = thisClass.oData(odata);
        $.post(url,odata,
        function(result){

        });
	}
	
    this.oData = function(odata){
        $("[id^='ship_']").each(function(){
            var attrName = $(this).attr("name");
            var thisType = $(this).attr("type");

            var thisVal;
            if(thisType == 'checkbox'){
                if($(this).prop('checked')){
                        thisVal = 'Y';
                }else{
                        thisVal = 'N';
                }
            }else{
                thisVal = $(this).val();
            }

            if(attrName !== undefined){
                var data = {};
                if(thisVal !== null){
                    if(typeof thisVal == 'object'){
                            data[attrName] = thisClass.objToStr(thisVal);
                    }else{
                            data[attrName] = thisVal;
                    }
                }
            }
            $.extend(odata, data);
        })

        return odata;
    }
    
    this.initValidateForm = function(){
		  formId.validate({
		    rules: {
		      firstname:{
		      	required: true
		      },
              fax:{
		      	required: false,
		      	number: true,
		      	rangelength: [4, 20]
		      },
                      zipcode:{
                        required: false,
		      	number: true
                      },
                      telephone:{
		      	required: false,
		      	number: true,
		      	rangelength: [4, 20]
		      },
		      mobile:{
		      	required: true,
		      	number: true,
		      	rangelength: [4, 20]
		      },
		      email: {
		        required: true,
		        email: true
		      }
		    },
			 invalidHandler: function(event, validator) {
			// 'this' refers to the form
				thisClass.submitForm = false;
			}
		  });
    }

    this.resetValidatForm = function(){
            var validator = formId.validate();
            validator.resetForm();
            $(".error").removeClass('error');
    }

    this.initValidateFormEvent = function(){
            thisClass.submitForm = true;
            formId.validate().form();
    }
    
    this.backToCart = function(){
		$('#cartModal .modal-title').html('<i class="fa fa-shopping-cart hidden-xs fa-2x"></i> <?php echo $clabal_cart; ?>');
		$('#stage2Btn').show();
		$('#closeBtn').show();
		$('#stage3Btn').addClass('hide');
		$('#stage_two').hide();
		$('#stage_one').show();
		$("#stage_three").hide();
		
		$('#goStage1').addClass('hide');
		$('#btnSave').addClass('hide');
    }
    
    this.productQuery = function(keyword){
    	thisClass.pageSelect = 1;
        thisClass.keyword = keyword;
        thisClass.getProduct();
    }
	
    this.productFirstQuery = function(){
    	thisClass.pageSelect = 1;
        thisClass.getProduct();
    }
	
    this.iniControl = function(){
        $(".menuStep2Click").click(function(){
            var id = $(this).data('id');
            thisClass.step = 2;
            thisClass.menuid = id;
            thisClass.pageSelect = 1;
            thisClass.keyword = '';
            thisClass.buildMenuStep3();
            thisClass.getProduct();
            return false;
        });
        
        thisClass.menuStepEvent();
        
        $("#menuStep1Select").change(function(){
            var id = $(this).val();
            thisClass.step = 1;
            thisClass.menuid = id;
            thisClass.pageSelect = 1;
            thisClass.keyword = '';
            thisClass.buildMenuStep2();
            thisClass.getProduct();
        });
        
        $("#menuStep2Select").change(function(){
            var id = $(this).val();
            thisClass.step = 2;
            thisClass.menuid = id;
            thisClass.pageSelect = 1;
            thisClass.keyword = '';
            thisClass.buildMenuStep3();
            thisClass.getProduct();
        });
        
        $("#menuStep3Select").change(function(){
            var id = $(this).val();
			thisClass.step = 3;
			thisClass.menuid = id;
			thisClass.pageSelect = 1;
			thisClass.keyword = '';
            thisClass.buildMenuStep3();
            thisClass.getProduct();
        });
        
        $(".search_form").submit(function(){
        	thisClass.pageSelect = 1;
            thisClass.keyword = $(".search_input").val();
            thisClass.getProduct();
            $(".search_input").val('');
        	return false;
        });
        
        $(".deleteAllCart").click(function(){
        	if($(this).prop('checked')){
        		thisClass.deleteAllCart();
        	}
        	return false;
        });
        
        $(".confirmModalOK").click(function(){
        	thisClass.objProductCart = [];
        	thisClass.buildCartDetailGrid();
        	$("#confirmModal").modal('hide');
        	return false;
        });
        
        
        $('#confirmModal').on('hidden.bs.modal', function (e) {
		  // do something...
		  $(".deleteAllCart").prop('checked',false);
		});
		
        $('#cartModal').on('hidden.bs.modal', function (e) {
			thisClass.backToCart();
		});
		
		$('#stage2Btn').click(function () {
			if(thisClass.shiptype != undefined && thisClass.paytype != undefined){
				$('#cartModal .modal-title').html('<i class="fa fa-shopping-cart hidden-xs fa-2x"></i> <?php echo $clabal_shipment; ?>');
				
				$('#closeBtn').hide();
				
				$('#stage_one').hide();
				$('#stage_two').show();
				
				$(this).hide();
				
				$('#btnSave').removeClass('hide');
				$('#goStage1').removeClass('hide');
			}else if(thisClass.shiptype != undefined && thisClass.paytype == undefined){
				$(".error").remove();
				$("<label class='error'><?php echo $clabal_payerror; ?></label>").insertAfter('.payLabel');
			}else if(thisClass.shiptype == undefined && thisClass.paytype != undefined){
				$(".error").remove();
				$("<label class='error'><?php echo $clabal_shiperror; ?></label>").insertAfter('.shipLabel');
			}else if(thisClass.shiptype == undefined && thisClass.paytype == undefined){
				$(".error").remove();
				$("<label class='error'><?php echo $clabal_payerror; ?></label>").insertAfter('.payLabel');
				$("<label class='error'><?php echo $clabal_shiperror; ?></label>").insertAfter('.shipLabel');
			}
			return false;
		});
		
		$('#btnSave').click(function() {
			
            thisClass.initValidateFormEvent();
            if(thisClass.submitForm){
            	thisClass.validateRatePrice($("#cart_subtotal").val(), $("#cart_subweight").val());
                //thisClass.saveData();
            }
            return false;
		});
		
		$('#goStage1').click(function () {
			$('#cartModal .modal-title').html('<i class="fa fa-shopping-cart hidden-xs fa-2x"></i> <?php echo $clabal_cart; ?>');
			$('#stage2Btn').show();
			$('#closeBtn').show();
			$('#btnSave').addClass('hide');
			$('#stage_two').hide();
			$('#stage_one').show();
			
			$(this).addClass('hide');
			return false;
		});
		
		$('#goStage2').click(function () {
			$('#cartModal .modal-title').html('<i class="fa fa-shopping-cart hidden-xs fa-2x"></i> <?php echo $clabal_shipment; ?>');
			
			$('#closeBtn').hide();
			
			$('#stage_three').hide();
			$('#stage_two').show();
			
			$(this).hide();
			
			$('#goStage1').removeClass('hide');
			return false;
		});
		
        $( "#ship_city" ).autocomplete({
			source: function(req, add){
				thisClass.getAutoCity(add);
            }
        });

        $( "#ship_state" ).autocomplete({
		source: function(req, add){
			thisClass.getAutoState(add);
                }
        });

        $( "#ship_zipcode" ).focus(function(){
        	if($(this).val() == ''){
        		thisClass.getAutoZipcode();
        	}
        });
		
		thisClass.getSessionCart();
       	thisClass.initValidateForm();
    }


    thisClass.iniControl();
}
</script>
