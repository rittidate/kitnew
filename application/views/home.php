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
    
    this.getProduct = function(menuid){
    	var url = urlini+ 'getProduct';
    	var html = '';
    	var image,volumn,unit;
    	
    	if(thisClass.pageSelect == undefined){
    		thisClass.pageSelect = 1;
    	}
    	
        $.getJSON( url, {step : thisClass.step, menuid : thisClass.menuid , page : thisClass.pageSelect },
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
	            		var productName = val.name_th+" "+volumn+" "+unit;
	            		
	            		html += '<div class="col-sm-6 col-md-4">';
	            		html += '<div class="thumbnail">';
	            		html += '<img alt="'+productName+'" data-toggle="modal" data-target="#imageProductModal" class="imageProductQuery" style="width: 300px; height: 200px;" src="<?php echo base_url('pimage/') ?>'+image+'">';
	            		html += '<div class="caption">';
	            		html += '<p class="text-muted"><?php echo $plabel_barcode; ?> : <span class="product_barcode" data-id="'+val.pid+'">'+val.barcode+'</span></p>';
	            		html += '<b><span class="product_name" data-id="'+val.pid+'">'+productName+'</span></b>';
	            		html += '<p><?php echo $plabel_price; ?> : <span class="product_price" data-id="'+val.pid+'">'+val.price+'</span> <?php echo $plabel_baht; ?> </p>';
	            		html += '<p><?php echo $plabel_qty; ?> : '+thisClass.buildSelectQty(val.stock, val.pid)+' <a role="button" class="btn btn-primary product_buy" data-id="'+val.pid+'" href="#buy"><?php echo $plabel_buy; ?></a></p>';
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
    	
		if(thisClass.pageSelect > 1){
			html += '<li><a class="pagerNumber" data-number="prev" href="#page">&laquo;</a></li>';
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
    	}
        
        $(".pagerProduct").html(html);
        
        $(".pagerProduct li[data-id='"+thisClass.pageSelect+"']").addClass('active');
        
		thisClass.pagerEvent();
    	
    }
    
    this.buildSelectQty = function(qty, pid){
        var len = 99;
        //var len = qty;
        var option = '';
        option += "<select class='product_qty' data-id='"+pid+"'>";
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
    
    this.buildCartDetailGrid = function(){
        $(".detail_grid").remove();
        var tr = '';
        var i = 0;
        var subtotal = 0;
        var weightTotal = 0;
        if(thisClass.objProductCart != null){
            
            $.each(thisClass.objProductCart, function(ini, val){
                subtotal += val.price * val.qty;
                weightTotal += val.weight * val.qty;
                tr +=  "<tr class='detail_grid'>";
                tr += "<td><i class='icon-remove podRemove' data-id='"+val.pid+"'></i></td>";
                tr += "<td>"+val.barcode+"</td>";
                tr += "<td>"+val.name+"</td>";
                tr += "<td>"+val.price+"</td>";
                tr += "<td>"+val.qty+"</td>";
                //tr += "<td>"+thisClass.buildSelectQty(val.qty, val.pid)+"</td>";
                tr += "<td>"+val.total+"</td>";
                tr += "</tr>";
            });
        }
        $(tr).insertBefore(".cartdetail_tr");
        $("#txt_subtotal").val(subtotal);
        
        $(".cartNotify").text(thisClass.objProductCart.length);
        
        //thisClass.getRatePrice(subtotal, weightTotal);
        //thisClass.orderDetailGridevent();
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
        	//thisClass.getPager();
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
			console.log(id);
			var barcode = $(".product_barcode[data-id='"+id+"']").text();
			var qty = $(".product_qty[data-id='"+id+"']").val();
			var name = $(".product_name[data-id='"+id+"']").text();
			var price = parseInt($(".product_price[data-id='"+id+"']").text());
			var obj= { 
	        		 	id : id,
						 barcode : barcode,
						 name : name,
						 price : price,
						 qty : qty,
						 total : price * qty
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
		});
    }

    this.iniControl = function(){
        $(".menuStep2Click").click(function(){
            var id = $(this).data('id');
            thisClass.step = 2;
            thisClass.menuid = id;
            thisClass.pageSelect = 1;
            thisClass.buildMenuStep3();
            thisClass.getProduct();
            
        });
        
        thisClass.menuStepEvent();
        
        $("#menuStep1Select").change(function(){
            var id = $(this).val();
            thisClass.step = 1;
            thisClass.menuid = id;
            thisClass.pageSelect = 1;
            thisClass.buildMenuStep2();
            thisClass.getProduct();
        });
        
        $("#menuStep2Select").change(function(){
            var id = $(this).val();
            thisClass.step = 2;
            thisClass.menuid = id;
            thisClass.pageSelect = 1;
            thisClass.buildMenuStep3();
            thisClass.getProduct();
        });
        
        $("#menuStep3Select").change(function(){
            var id = $(this).val();
			thisClass.step = 3;
			thisClass.menuid = id;
			thisClass.pageSelect = 1;
            thisClass.buildMenuStep3();
            thisClass.getProduct();
        });
       
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
				<ul class="pager">
				  <li class="previous"><a href="#">&larr; Older</a></li>
				  <li class="next"><a href="#">Newer &rarr;</a></li>
				</ul>
			</div>
		</div>		
	</div>
      <div id="productQuery" class="row"></div>
	
</div>