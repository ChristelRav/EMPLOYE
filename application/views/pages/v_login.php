
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url("assets/vendors/mdi/css/materialdesignicons.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/vendors/ti-icons/css/themify-icons.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/vendors/css/vendor.bundle.base.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/vendors/font-awesome/css/font-awesome.min.css"); ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.png"); ?>" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="<?php echo base_url("assets/images/logo.svg"); ?>">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>

                <?php if (isset($error)) { ?>
                                <div class="alert alert-danger alert-dismissible fade show position-relative" role="alert">
                                    <?php echo $error; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } ?>

                <form class="pt-3"  action="<?php echo site_url('CT_Login/login')?>"  method="POST">
                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" value="john.doe@example.com"  placeholder="Email">
                  </div>
                  <div class="form-group">
                    <input type="password" name="mdp" class="form-control form-control-lg" id="exampleInputPassword1" value="123" placeholder="Mot de passe">
                  </div>
                  <div class="mt-3 d-grid gap-2">
                    <button type="submit"  class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >SIGN IN</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url("assets/vendors/js/vendor.bundle.base.js"); ?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url("assets/js/off-canvas.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/misc.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/settings.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/todolist.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/jquery.cookie.js"); ?>"></script>
    <!-- endinject -->
  </body>
</html>