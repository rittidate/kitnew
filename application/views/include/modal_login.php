
<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Sign In</h4>
      </div>
      <div class="modal-body">
          <form method="post" action="<?php echo base_url().'/login/form' ?>">
              <div class="row">
                <p class="text-center">Sign in using your registered account:</p>
              </div>
            <div class="row">
                    <div class="form-group col-md-8 col-md-offset-2">
                        <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                              <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                            </div>
                    </div>
            </div>

            <div class="row">
                    <div class="form-group col-md-8 col-md-offset-2">
                        <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-key"></i></span>
                              <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
            </div>

            <div class="row">
                <div class="form-group col-md-8 col-md-offset-2">
                    <button type="submit" class="btn btn-warning col-md-12 col-xs-12">Login</button>
                </div>
            </div>
        </form>
            <!--
            <div class="row">
                <div class="form-group col-md-8 col-md-offset-2">
                    <a href="<?php echo base_url().'login/twitter' ?>" class="btn btn-info col-md-12 col-xs-12"><i class="fa fa-twitter fa-2x"></i> Login with Twitter</a>
                </div>
            </div>
            -->

            <div class="row">
                <div class="form-group col-md-8 col-md-offset-2">
                    <a href="<?php echo base_url().'login/facebook' ?>" class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-facebook-square fa-2x"></i> Login with Facebook</a>
                </div>
            </div>
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


