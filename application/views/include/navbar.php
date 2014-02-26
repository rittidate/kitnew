<div role="navigation" class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="badge cartNotify" style="position: absolute; top:-5px; left:30px; background-color: #FF0000;">0</span>
          </button>
          
          <a href="<?php echo base_url(); ?>" class="navbar-brand">Kittivate</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url(); ?>"><?php echo $home; ?></a></li>
            <li><a href="#" data-toggle="modal" data-target="#paymentModal"><?php echo $payment; ?></a></li>
            <!--
            <li><a href="#about"><?php echo $about; ?></a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
            -->
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" data-toggle="modal" data-target="#mapModal"><i class="fa fa-map-marker hidden-xs fa-2x"></i><span class="fa fa-map-marker visible-xs"> <?php echo $map; ?></span></a></li>
            <li>
            	<a href="#" data-toggle="modal" data-target="#userModal" title="<?php echo $user; ?>">
            		<i class="fa fa-user hidden-xs fa-2x"></i>
            		<span class="fa fa-user visible-xs"> <?php echo $user; ?></span>
            		</a>
    		</li>
            <li class="dropdown">
            	<a data-toggle="dropdown" class="dropdown-toggle" href="#">
            	<i class="fa fa-clipboard hidden-xs fa-2x"></i>
            	<span class="fa fa-clipboard visible-xs"> <?php echo $order; ?></span>
            	<span class="badge hidden-xs orderNotify" style="position: absolute; top:8px; left:35px; background-color: #FF0000;">0</span>
            	</a>
                <ul class="dropdown-menu order_member">
                </ul>
        	</li>
            <li>
            	<a href="#"  data-toggle="modal" data-target="#cartModal">
            		<i class="fa fa-shopping-cart hidden-xs fa-2x"></i>
            		<span class="fa fa-shopping-cart visible-xs"> <?php echo $cart; ?></span>
            		<span class="badge hidden-xs cartNotify" style="position: absolute; top:8px; left:35px; background-color: #FF0000;">0</span>
        		</a>
        		
    		</li>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                	<i class="fa fa-cogs hidden-xs fa-2x"><b class="caret"></b></i>
                	<span class="fa fa-cogs visible-xs"> <?php echo $config; ?><b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url().'language'; ?>">EN / TH</a></li>
                    <?php echo $logout; ?>
                </ul>
            </li>
            <?php echo $profile; ?>

          </ul>
          
        <div class="col-sm-3 col-md-3 visible-lg visible-md pull-right">
	        <form class="navbar-form search_form" role="search">
	            <input type="text" class="form-control search_input" placeholder="Search" name="srch-term">
                <button class="btn btn-default search_submit" type="submit"><i class="fa fa-search"></i></button>
	        </form>
        </div>
        </div><!--/.nav-collapse -->
      </div>
    </div>
      