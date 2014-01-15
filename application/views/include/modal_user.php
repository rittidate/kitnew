
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
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <label for="firstname" class="col-sm-2 col-sm-offset-1 control-label">Firstname</label>
                <div class="col-sm-8">
                  <input type="text" name="firstname" class="form-control col-md-8" id="firstname" placeholder="Firstname" value="<?php echo $firstname; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 col-sm-offset-1 control-label">Lastname</label>
                <div class="col-sm-8">
                  <input type="text" name="lastname" class="form-control col-md-8" id="lastname" placeholder="Lastname" value="<?php echo $lastname; ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                  <button type="submit" class="btn btn-warning col-md-12 col-xs-12">Submit</button>
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


