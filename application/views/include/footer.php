</div>
</div>
<hr/>
   <div id="footer">
      <div class="container">
        <p class="text-muted"><i class="fa fa-magic fa-3x"></i> Design by arraieot</p>
      </div>
    </div>
   <script src="<?php echo base_url('assets/jqui/js/jquery-1.9.1.js') ?>"></script>
   <!--<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/1.3.1/lodash.min.js"></script>-->
   <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/jqui/js/jquery-ui-1.10.3.custom.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/jqvalidate/jquery.validate.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
<script>
function modelUser(){
    var thisClass = this;
    var urlini = 'processajax/'

    this.saveData = function(){
        
    }

    this.getAutoCity = function(add){
        var url = urlini+ 'getAutoCity';
    	var keyword = $("#user_city").val();
    	var country = $("#user_country").val();
    	var state = $("#user_state").val();
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
    	var keyword = $("#user_state").val();
    	var country = $("#user_country").val();
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
        var city = $("#user_city").val();
    	var state = $("#user_state").val();
    	var country = $("#user_country").val();
    	$.getJSON( url, {   country: country,
                            state : state,
                            city : city },
                    function(result){
                        $("#user_zipcode").val(result.zipcode);
		});
    }

        this.initValidateForm = function(){
		  $("#user_modal_form").validate({
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

    this.initValidateFormEvent = function(){
            thisClass.submitForm = true;
            $("#user_modal_form").validate().form();
    }

    this.initControl = function(){
        $( "#user_city" ).autocomplete({
		source: function(req, add){
			thisClass.getAutoCity(add);
                }
        });

        $( "#user_state" ).autocomplete({
		source: function(req, add){
			thisClass.getAutoState(add);
                }
        });

        $( "#user_zipcode" ).focus(function(){
        	if($(this).val() == ''){
        		thisClass.getAutoZipcode();
        	}
        });

        $("#user_submit").click(function() {
        	thisClass.initValidateFormEvent();
            if(thisClass.submitForm){
        		thisClass.saveData();
    		}
    	});

        thisClass.initValidateForm();
    }

    thisClass.initControl();
}
</script>
<script>
        $.getScript('<?php echo base_url('assets/datepicker/js/bootstrap-datepicker.js') ?>',function(){
	$('#birth').datepicker({
            format: 'yyyy-mm-dd'
            });
        });

        $(document).ready(function() {
                var mu = new modelUser();
        });
</script>
</body>
</html>
