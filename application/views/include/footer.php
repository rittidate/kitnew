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
   <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
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
