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
