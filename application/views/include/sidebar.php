<div class="container bs-docs-container">
	<div class="row">
      		<div class="col-md-3">
	      		<div class="panel-group hidden-xs" id="accordion" style="margin-bottom: 15px;">
                                <?php foreach ($root as $item):?>
				  <div class="panel panel-default">
				    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $item['id'];?>">
				      <h4 class="panel-title">
				          	<span><?php echo $item['name'];?></span>
					        <i class="pull-right fa fa-chevron-down"></i>
				      </h4>
				    </div>
                                    
                                    <ul id="collapse<?php echo $item['id'];?>" class="panel-collapse collapse list-group">
                                        <?php foreach ($parent[$item['id']] as $item2):?>
                                        <li class="list-group-item"><a class="menuStep2Click" data-id="<?php echo $item2['id'];?>" href="#<?php echo $item2['id'];?>"><?php echo $item2['name'];?><span class="badge pull-right"><?php echo $item2['count'];?></span></a></li>
                                        <?php endforeach;?>
				    </ul>
                                    
				  </div>
                                  <?php endforeach;?>
                        </div>
				
                        <div class="form-group visible-xs">
                          <label class="control-label" for="menuStep1Select">Menu Step 1 Select</label>
                          <select class="form-control" id="menuStep1Select">
                              <?php foreach ($root as $item):?>
                              <option value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
                              <?php endforeach;?>
                          </select>
                        </div>

                        <div class="form-group visible-xs">
                          <label class="control-label" for="menuStep2Select">Menu Step 2 Select</label>
                          <select class="form-control" id="menuStep2Select"></select>
                        </div>
      		</div>
      		<div class="col-md-9">