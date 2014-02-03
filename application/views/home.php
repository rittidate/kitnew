<script>
function queryProduct(){
    var thisClass = this;
    var urlini = 'processajax/';
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
	            		html += '<img alt="'+productName+'" data-toggle="modal" data-target="#imageProductModal" class="imageProductQuery" style="width: 300px; height: 200px;" src="<?php echo base_url('pimage/') ?>'+image+'">';
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
        //var len = 99;
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
        var len = 99;
        //var len = qty;
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
                tr += "<td align='center'><a href='#del' class='product_remove' data-id='"+val.id+"'><i class='fa fa-times'></i></a></td>";
                tr += "<td class='hidden-xs'>"+val.barcode+"</td>";
                tr += "<td>"+val.name+"</td>";
                tr += "<td align='center'>"+val.price+"</td>";
                tr += "<td>"+thisClass.buildSelectCartQty(val.qty, val.id, val.stock)+"</td>";
                tr += "<td align='right'>"+val.total+"</td>";
                tr += "</tr>";
            });
        }
        
        thisClass.saveSessionCart(obj);

        $(tr).insertBefore(".cartdetail_tr");
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
        var obj;
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
			        		htmlTrShip += "<tr><th><h4 class='shipLabel'>Shipment</h4></th></tr>";
			        		$.each(result.shipprice, function(ini, val){
								if(obj.indexOf(val.id) == -1){
				                    htmlTrShip += "<tr><td class='cartShipLabel' data-num='"+val.id+"'><h4>"+val.name+"</h4></td></tr>";
				                    obj.push(val.id);    
				                }
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
			        		htmlTrPay += "<tr><th><h4 class='payLabel'>Payment</h4></th></tr>";
			        		$.each(result.payment, function(ini, val){
								if(obj.indexOf(val.id) == -1){
				                    htmlTrPay += "<tr><td class='cartPayLabel' data-num='"+val.id+"'><h4>"+val.name+"</h4></td></tr>";
				                    obj.push(val.id);    
				                }
			        		});
			        		$(".cartPayment").html(htmlTrPay);
			        		$.each(result.payment, function(ini, val){
			        			if(thisClass.paytype != undefined && thisClass.paytype == val.id){
									htmlRadioPay = '<div class="radio"><label><input type="radio" name="optionsPayment" id="optionsPayment'+val.id+'" data-pay="'+val.id+'" value="'+val.id+'" checked>';
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
				        });
				        
				        $(".optionsPayment").click(function(){
			        		var paytype = $(this).data('pay');
				        	thisClass.paytype = paytype;
				        	thisClass.buildCartDetailGrid();
				        });
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
        });
    }
    
    this.productQueryEvent = function(){
		$(".imageProductQuery").click(function(){
			var src = $(this).attr('src');
			var alt = $(this).attr('alt');
			$("#imageModalLabel").text(alt);
			$(".pimage").attr('src', src);
		});
		
		$('#imageProductModal').on('shown.bs.modal', function() {
		    var initModalWidth = $('.modal-body:visible').outerWidth(); //give an id to .mobile-dialog
		    //var initModalPadding = $('.modal-body:visible').css('padding-left').split("px")[0];
		    var initModalPadding = 30;
		    var iniImageWidth = $('.pimage').outerWidth();
		    var iniImageHeight = $('.pimage').outerHeight();
		    if(iniImageHeight > iniImageWidth){
		        $('.pimage').css('margin-left', 
		        (initModalWidth/2) - (iniImageWidth / 2) - initModalPadding); //center it if it does fit
	       	}else{
	       		$('.pimage').css('margin-left', '');
	       	}
		});
		
		$('.product_buy').click(function(){
			var id = $(this).attr('data-id');
			var barcode = $(".product_barcode[data-id='"+id+"']").text();
			var qty = $(".product_qty[data-id='"+id+"']").val();
			var name = $(".product_name[data-id='"+id+"']").text();
			var price = parseInt($(".product_price[data-id='"+id+"']").text());
			//var stock = $(".product_stock[data-id='"+id+"']").val();
			var stock = 99;
			var weight = $(".product_weight[data-id='"+id+"']").val();
			if(qty !== null){
				var obj= { 
		        		 	id : id,
							 barcode : barcode,
							 name : name,
							 price : price,
							 qty : qty,
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
	
    this.iniControl = function(){
        $(".menuStep2Click").click(function(){
            var id = $(this).data('id');
            thisClass.step = 2;
            thisClass.menuid = id;
            thisClass.pageSelect = 1;
            thisClass.keyword = '';
            thisClass.buildMenuStep3();
            thisClass.getProduct();
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
        });
        
        $(".confirmModalOK").click(function(){
        	thisClass.objProductCart = [];
        	thisClass.buildCartDetailGrid();
        	$("#confirmModal").modal('hide');
        });
        
        
        $('#confirmModal').on('hidden.bs.modal', function (e) {
		  // do something...
		  $(".deleteAllCart").prop('checked',false);
		});
		
		$('#stage2Btn').click(function () {
			if(thisClass.shiptype != undefined && thisClass.paytype != undefined){
				$('#cartModal .modal-title').text('New Unit - Stage 2 - Assessment Evidence');
				
				$('#closeBtn').hide();
				
				$('#stage_one').hide();
				$('#stage_two').show();
				
				$(this).hide();
				
				$('#stage3Btn').removeClass('hide');
				$('#goStage1').removeClass('hide');
			}else if(thisClass.shiptype != undefined && thisClass.paytype == undefined){
				$(".error").remove();
				$("<label class='error'>Payment Not Select</label>").insertAfter('.payLabel');
			}else if(thisClass.shiptype == undefined && thisClass.paytype != undefined){
				$(".error").remove();
				$("<label class='error'>Shipment Not Select</label>").insertAfter('.shipLabel');
			}else if(thisClass.shiptype == undefined && thisClass.paytype == undefined){
				$(".error").remove();
				$("<label class='error'>Payment Not Select</label>").insertAfter('.payLabel');
				$("<label class='error'>Shipment Not Select</label>").insertAfter('.shipLabel');
			}
			
		});
		
		$('#stage3Btn').click(function() {
			$('#cartModal .modal-title').text('New Unit - Stage 3 - Activity Creation');
			
			$('#closeBtn').hide();
			$('#stage_two').hide();
			$('#stage_three').show();
			$(this).hide();
			
			$('#goStage2').removeClass('hide').show();
			$('#goStage1').addClass('hide');
			$('#stage3Btn').addClass('hide');
			
			thisClass.shipAddressSession();
		});
		
		$('#goStage1').click(function () {
			$('#new_unit_modal .modal-title').text('New Unit - Stage 1 - Desired Results');
			$('#stage2Btn').show();
			$('#closeBtn').show();
			$('#stage3Btn').addClass('hide');
			$('#stage_two').hide();
			$('#stage_one').show();
			
			$(this).addClass('hide');
			
		});
		
		$('#goStage2').click(function () {
			$('#new_unit_modal .modal-title').text('New Unit - Stage 2 - Assessment Evidence');
			
			$('#closeBtn').hide();
			
			$('#stage_three').hide();
			$('#stage_two').show();
			
			$(this).hide();
			
			$('#stage3Btn').removeClass('hide');
			$('#stage3Btn').show();
			$('#goStage1').removeClass('hide');
			
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
       
    }


    thisClass.iniControl();
}
</script>
<script>
        $(document).ready(function() {
                var qp = new queryProduct();
        });
</script>

<!-- menu step 3 -->
<div class="row">
	<ul class="nav nav-tabs hidden-xs menuStep3">
	</ul>
	<div class="container">
	<div class="form-group visible-xs">
	  <label class="control-label" for="menu_step_3">Menu Step 3 Select</label>
	  <select class="form-control" id="menuStep3Select"></select>
	</div>
	</div>
</div>
<div class="bs-example">
	<div class="row">
		<div class="hidden-xs pull-right">
			<ul class="pagination pagerProduct">
			</ul>
		</div>
		<div class="container">
			<div class="visible-xs">
				<ul class="pager pagerProductMini">
				</ul>
			</div>
		</div>		
	</div>
      <div id="productQuery" class="row"></div>
	<div class="row">
		<div class="hidden-xs pull-right">
			<ul class="pagination pagerProduct">
			</ul>
		</div>
		<div class="container">
			<div class="visible-xs">
				<ul class="pager pagerProductMini">
				</ul>
			</div>
		</div>		
	</div>
	
</div>