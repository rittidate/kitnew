</div>
</div>
<hr/>
   <div id="footer">
      <div class="container">
        <p class="text-muted"><i class="fa fa-magic fa-3x"></i> Design by arraieot</p>
      </div>
    </div>

<script>
        $.getScript('<?php echo base_url('assets/datepicker/js/bootstrap-datepicker.js') ?>',function(){
			$('#user_birth').datepicker({
            	format: 'yyyy-mm-dd'
            });
            
            $('#ship_birth').datepicker({
            	format: 'yyyy-mm-dd'
            });
            
                        
            $('#payment_date').datepicker({
            	format: 'dd/mm/yyyy'
            });
        });
</script>
</body>
</html>
