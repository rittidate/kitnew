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
	            		html += '<b>'+productName+'</b>';
	            		html += '<p>ราคา '+val.price+' บาท</p>'
	            		html += '<p><a role="button" class="btn btn-primary" href="#">Buy</a> <a role="button" class="btn btn-default" href="#">Button</a></p>';
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
			html += '<li><a class="pagerNumber" data-number="prev" href="#pagerNumber">&laquo;</a></li>';
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
        	html += '<li data-id="'+i+'"><a class="pagerNumber" data-number="'+i+'" href="#pagerNumber">'+i+'</a></li>'
        }
        
    	if(thisClass.pageSelect < thisClass.pagerNumber){
    		html += '<li><a class="pagerNumber" data-number="next" href="#pagerNumber">&raquo;</a></li>';
    	}
        
        $(".pagerProduct").html(html);
        
        $(".pagerProduct li[data-id='"+thisClass.pageSelect+"']").addClass('active');
        
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
    
    this.buildSelectQty = function(qty, pid){
        var len = 99;
        var option = '';
        option += "<select class='select_orderDetail span1' data-id='"+pid+"'>";
        for (var i=1;i<len;i++)
        {
            if(i == qty){
                option += "<option value='"+i+"' selected>"+i+"</option>";
            }else{
                option += "<option value='"+i+"'>"+i+"</option>";
            }
        }
        option += "</select>";
        return option;
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
    
    this.productQueryEvent = function(){
		$(".imageProductQuery").click(function(){
			var src = $(this).attr('src');
			var alt = $(this).attr('alt');
			$("#imageModalLabel").text(alt);
			$(".pimage").attr('src', src);
		});
		
		$('#imageProductModal').on('shown.bs.modal', function() {
		    var initModalWidth = $('.modal-body:visible').outerWidth(); //give an id to .mobile-dialog
		    var initModalPadding = $('.modal-body:visible').css('padding-left').split("px")[0];
		    var iniImageWidth = $('.pimage').outerWidth();
		    var iniImageHeight = $('.pimage').outerHeight();
		    if(iniImageHeight > iniImageWidth){
		        $('.pimage').css('margin-left', 
		        (initModalWidth/2) - (iniImageWidth / 2) - initModalPadding); //center it if it does fit
	       	}else{
	       		$('.pimage').css('margin-left', '');
	       	}
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