
<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $payment_head; ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="paymentModalForm" role="form">
            <div class="form-group">
               	<label for="payment_order" class="col-sm-5 control-label text-right"><?php echo $payment_order_number; ?></label>
                <div class="col-sm-6">
                	<input type="text" name="payment_order" class="form-control col-md-8" id="payment_order" placeholder="<?php echo $payment_order_number; ?>">
                </div>
            </div>
            
            <div class="form-group">
               	<label for="payment_select" class="col-sm-5 control-label text-right"><?php echo $payment_select; ?></label>
                <div class="col-sm-6">
                	<?php echo $payment_input_select; ?>                	
                </div>
            </div>

            <div class="form-group">
               	<label for="payment_grandtotal" class="col-sm-5 control-label text-right"><?php echo $payment_grandtotal; ?></label>
                <div class="col-sm-6">
                	<input type="text" name="payment_grandtotal" class="form-control col-md-8" id="payment_grandtotal" placeholder="<?php echo $payment_grandtotal; ?>">
                </div>
            </div>
            
            <div class="form-group">
               	<label for="payment_date" class="col-sm-5 control-label text-right"><?php echo $payment_date; ?></label>
                <div class="col-sm-6">
                	<input type="date" name="payment_date" class="form-control col-md-8" id="payment_date" placeholder="<?php echo $payment_date; ?>" value="<?php echo date('d/m/Y')?>">             	
                </div>
            </div>
            
            <div class="form-group">
               	<label for="payment_time" class="col-sm-5 control-label text-right"><?php echo $payment_time; ?></label>
                <div class="col-sm-3">
                	<?php echo $payment_input_time_hour;?> <?php echo $payment_hour;?>           	
                </div>
                <div class="col-sm-3">
                	<?php echo $payment_input_time_minute;?> <?php echo $payment_minute;?>        	
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                  <button type="submit" id="payment_submit" class="btn btn-warning col-md-12 col-xs-12"><?php echo $label_submit; ?></button>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                  <input type="reset" data-dismiss="modal" class="btn btn-default col-md-12 col-xs-12" value="<?php echo $label_close; ?>" />
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
function modelPayment(){
    var thisClass = this;
    var urlini = '<?php echo base_url() ?>processajax/';
    var formId = $("#paymentModalForm");

    this.saveData = function(){
        var odata = {};
        var url = urlini+ 'savePayment';

        odata = thisClass.oData(odata);
        $.getJSON(url,odata,
                function(result){
                    if(result.status == "success")
                        $('#paymentModal').modal('hide')
                    else{
                        $('<label class="error" for="payment_order">This payment already send data!!!</label>').insertAfter('#payment_order');
                    }

                });

    }

    this.oData = function(odata){
        $("[id^='payment_']").each(function(){
            var attrName = $(this).attr("name");
            var thisType = $(this).attr("type");

            var thisVal;
            if(thisType == 'checkbox'){
                if($(this).prop('checked')){
                        thisVal = 'Y';
                }else{
                        thisVal = 'N';
                }
            }else{
                thisVal = $(this).val();
            }

            if(attrName !== undefined){
                var data = {};
                if(thisVal !== null){
                    if(typeof thisVal == 'object'){
                            data[attrName] = thisClass.objToStr(thisVal);
                    }else{
                            data[attrName] = thisVal;
                    }
                }
            }
            $.extend(odata, data);
        })

        return odata;
    }
    
    this.initValidateForm = function(){
		  formId.validate({
		    rules: {
		      payment_order:{
		      	required: true,
		      	number: true,
		      },
                      payment_grandtotal:{
		      	required: true,
                        number: true,
		      },
                      payment_date:{
                        required: true,
                      }
		    },
			 invalidHandler: function(event, validator) {
			// 'this' refers to the form
				thisClass.submitForm = false;
			}
		  });
    }

    this.resetValidatForm = function(){
            var validator = formId.validate();
            validator.resetForm();
            $(".error").removeClass('error');
    }

    this.initValidateFormEvent = function(){
            thisClass.submitForm = true;
            formId.validate().form();
    }

    this.initControl = function(){
        $("#payment_submit").click(function() {
            thisClass.initValidateFormEvent();
            if(thisClass.submitForm){
                thisClass.saveData();
            }
    	});

        $("#paymentModal").click(function(){
            thisClass.resetValidatForm();
        });

        formId.submit(function(event){
        	event.preventDefault();
        });

        thisClass.initValidateForm();
    }

    thisClass.initControl();
}
</script>
<script>
        $(document).ready(function() {
                var mp = new modelPayment();
        });
</script>
