
<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Profile</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">


            <div class="form-group">
                <label for="firstname" class="col-sm-3 control-label text-right"><?php echo $label_salutation; ?></label>
                <div class="col-sm-8">
                    <?php echo $salutation; ?>
                </div>
            </div>

            <div class="form-group">
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <label for="firstname" class="col-sm-3 control-label text-right"><?php echo $label_firstname; ?></label>
                <div class="col-sm-8">
                  <input type="text" name="firstname" class="form-control col-md-8" id="firstname" placeholder="<?php echo $label_firstname; ?>" value="<?php echo $firstname; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-3 control-label text-right"><?php echo $label_lastname; ?></label>
                <div class="col-sm-8">
                  <input type="text" name="lastname" class="form-control col-md-8" id="lastname" placeholder="<?php echo $label_lastname; ?>" value="<?php echo $lastname; ?>">
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
                    <input type="date" name="birth" class="form-control col-md-8" id="birth" placeholder="<?php echo $label_birth; ?>" value="<?php echo $birth; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="address1" class="col-sm-3 control-label text-right"><?php echo $label_address1; ?></label>
                <div class="col-sm-8">
                    <input type="text" name="address1" class="form-control col-md-8" id="address1" placeholder="<?php echo $label_address1; ?>" value="<?php echo $address1; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="address2" class="col-sm-3 control-label text-right"><?php echo $label_address2; ?></label>
                <div class="col-sm-8">
                    <input type="text" name="address2" class="form-control col-md-8" id="address2" placeholder="<?php echo $label_address2; ?>" value="<?php echo $address2; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="address3" class="col-sm-3 control-label text-right"><?php echo $label_address3; ?></label>
                <div class="col-sm-8">
                    <input type="text" name="address3" class="form-control col-md-8" id="address3" placeholder="<?php echo $label_address3; ?>" value="<?php echo $address3; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="address4" class="col-sm-3 control-label text-right"><?php echo $label_address4; ?></label>
                <div class="col-sm-8">
                    <input type="text" name="address4" class="form-control col-md-8" id="address4" placeholder="<?php echo $label_address4; ?>" value="<?php echo $address4; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="city" class="col-sm-3 control-label text-right"><?php echo $label_city; ?></label>
                <div class="col-sm-8">
                    <input type="text" name="city" class="form-control col-md-8" id="city" placeholder="<?php echo $label_city; ?>" value="<?php echo $city; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="state" class="col-sm-3 control-label text-right"><?php echo $label_state; ?></label>
                <div class="col-sm-8">
                    <input type="text" name="state" class="form-control col-md-8" id="state" placeholder="<?php echo $label_state; ?>" value="<?php echo $state; ?>">
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
                    <input type="text" name="zipcode" class="form-control col-md-8" id="zipcode" placeholder="<?php echo $label_zipcode; ?>" value="<?php echo $zipcode; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="mobile" class="col-sm-3 control-label text-right"><?php echo $label_mobile; ?></label>
                <div class="col-sm-8">
                    <input type="text" name="mobile" class="form-control col-md-8" id="mobile" placeholder="<?php echo $label_mobile; ?>" value="<?php echo $mobile; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="telephone" class="col-sm-3 control-label text-right"><?php echo $label_telephone; ?></label>
                <div class="col-sm-5">
                    <input type="text" name="telephone" class="form-control col-md-5" id="telephone" placeholder="<?php echo $label_telephone; ?>" value="<?php echo $telephone; ?>">
                </div>
                <div class="col-sm-3">
                    <input type="text" name="telephone_ext" class="form-control col-md-3" id="telephone_ext" placeholder="<?php echo $label_ext; ?>" value="<?php echo $telephone_ext; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="fax" class="col-sm-3 control-label text-right"><?php echo $label_fax; ?></label>
                <div class="col-sm-5">
                    <input type="text" name="fax" class="form-control col-md-5" id="fax" placeholder="<?php echo $label_fax; ?>" value="<?php echo $fax; ?>">
                </div>
                <div class="col-sm-3">
                    <input type="text" name="fax_ext" class="form-control col-md-3" id="fax_ext" placeholder="<?php echo $label_ext; ?>" value="<?php echo $fax_ext; ?>">
                </div>
            </div>



            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                  <button type="submit" class="btn btn-warning col-md-12 col-xs-12"><?php echo $label_submit; ?></button>
                </div>
            </div>

        </form>
      </div>
      <!--
      <div class="modal-footer">
          <div class="row">
            
            
          </div>
      </div>
      -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
function modelUser(){
    var thisClass = this;
    var urlini = 'processajax/'

    this.getAutoCity = function(add){
        var url = urlini+ 'getAutoCity';
    	var keyword = $("#city").val();
    	var country = $("#country").val();
    	var state = $("#state").val();
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
    	var keyword = $("#state").val();
    	var country = $("#country").val();
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
        var city = $("#city").val();
    	var state = $("#state").val();
    	var country = $("#country").val();
    	$.getJSON( url, {   country: country,
                            state : state,
                            city : city },
                    function(result){
                        $("#zipcode").val(result.zipcode);
		});
    }

    this.initControl = function(){
        $( "#city" ).autocomplete({
		source: function(req, add){
			thisClass.getAutoCity(add);
                }
        });

        $( "#state" ).autocomplete({
		source: function(req, add){
			thisClass.getAutoState(add);
                }
        });

        $( "#zipcode" ).focus(function(){
        	if($(this).val() == ''){
        		thisClass.getAutoZipcode();
        	}
        });
    }

    thisClass.initControl();
}
</script>