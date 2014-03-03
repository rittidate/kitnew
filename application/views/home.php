<script>
        $(document).ready(function() {
                var qp = new queryProduct();
                <?php if(empty($step) && empty ($pmenu)){ ?>
                    qp.productFirstQuery();
                <?php }else if($step == 1){ ?>
                    qp.productFirstStep1(<?php echo $pmenu; ?>);
                <?php }else if($step > 1){ ?>
                    qp.productFirstStep2(<?php echo $step; ?>, <?php echo $pmenu; ?>);
                <?php } ?>
                $(".navbar-nav li").hover(function(){
                	$(this).addClass("active");
                }, function(){
                	$(this).removeClass("active");
                });
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