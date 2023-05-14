<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>

  <meta charset=" utf-8" />
  <title>RJNetwork Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Logistic" name="description" />
  <meta content="" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- App favicon -->
  <!-- App favicon -->
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/pln-1.png'); ?>">
  <!-- <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>"> -->

  <link href="<?php echo base_url('assets/plugins/sweet-alert2/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/plugins/animate/animate.min.css'); ?>" rel="stylesheet" type="text/css" />

  <!-- App css -->
  <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/app.min.css'); ?>" rel="stylesheet" type="text/css" />

</head>

<body id="body" class="auth-page" style="background-image: url('<?php echo base_url('assets/images/4239587_90460.jpg'); ?>'); background-size: cover; background-position: center center;">
  <!-- Log In page -->
  <div class="container-md">
    <div class="row vh-100 d-flex justify-content-center">
      <div class="col-12 align-self-center">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4 mx-auto">
              <div class="card">
                <div class="card-body ">
                  <div class="text-center p-3">
                    <a href="index.html" class="logo logo-admin">
                      <img src="<?php echo base_url('assets/images/antares.png'); ?>" height="50" alt="logo" class="auth-logo">
                    </a>
                    <h4 class="mt-3 mb-1 fw-semibold text-blue font-18">Let's Get Started!</h4>
                    <p class="text-muted  mb-0">Sign in to continue.</p>
                  </div>
                </div>
                <div class="card-body pt-0">
                  <?php if ($this->session->flashdata('error')) : ?>
                    <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                  <?php endif; ?>
                  <?php echo form_open('auth/login', ['class' => 'my-4']); ?>
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                  <div class="form-group mb-2">
                    <label class="form-label" for="email">NIP/Username</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required value="<?php echo set_value('email'); ?>">
                    <p style="color: red;"><?php echo form_error('email'); ?></p>
                  </div><!--end form-group-->

                  <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required placeholder="Enter password">
                    <p style="color: red;"><?php echo form_error('password'); ?></p>
                  </div><!--end form-group-->


                  <hr class="hr-dashed mt-4">
                  <div class="form-group">
                    <div class="row">
                      <label class="form-label" for="captcha">Captcha</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" required id="captcha" name="captcha" placeholder="Enter captcha" />
                        <p style="color: red;"><?php echo form_error('captcha'); ?></p>
                      </div>
                      <div class="col-md-6">
                        <?php echo $captcha; ?>
                      </div>
                    </div>
                  </div>



                  <!-- <div class="form-group row mt-3">
                    <!-- <div class="col-sm-6">
                      <div class="form-check form-switch form-switch-success">
                        <input class="form-check-input" type="checkbox" id="remember_me" value="1">
                        <label class="form-check-label" for="remember_me">Remember me</label>
                      </div>
                    </div>end col -->
                  <!-- <div class="col-sm-6 text-end">
                      <a href="auth-recover-pw.html" class="text-muted font-13"><i class="dripicons-lock"></i> Forgot password?</a>
                    </div>
                  </div> -->

                  <div class="form-group mb-0 row">
                    <div class="col-12">
                      <div class="d-grid mt-3">
                        <button class="btn btn-blue" type="submit">Log In <i class="fas fa-sign-in-alt ms-1"></i></button>
                      </div>
                    </div><!--end col-->
                  </div> <!--end form-group-->
                  <?php echo form_close(); ?>
                  <div class="m-3 text-center text-muted">
                    <p class="mb-0">Don't have an account ? <a href="<?php echo base_url('auth/register'); ?>" class="text-primary ms-2">Free Resister</a></p>
                  </div>
                  <!-- <hr class="hr-dashed mt-4"> -->
                  <!-- <div class="text-center mt-n5">
                    <h6 class="card-bg px-3 my-4 d-inline-block">Or Login With</h6>
                  </div>
                  <div class="d-flex justify-content-center mb-1">
                    <a href="" class="d-flex justify-content-center align-items-center thumb-sm bg-soft-primary rounded-circle me-2">
                      <i class="fab fa-facebook align-self-center"></i>
                    </a>
                    <a href="" class="d-flex justify-content-center align-items-center thumb-sm bg-soft-info rounded-circle me-2">
                      <i class="fab fa-twitter align-self-center"></i>
                    </a>
                    <a href="" class="d-flex justify-content-center align-items-center thumb-sm bg-soft-danger rounded-circle">
                      <i class="fab fa-google align-self-center"></i>
                    </a>
                  </div> -->
                </div><!--end card-body-->
              </div><!--end card-->
            </div><!--end col-->
          </div><!--end row-->
        </div><!--end card-body-->
      </div><!--end col-->
    </div><!--end row-->
  </div><!--end container-->

  <!-- App js -->
  <script src="<?php echo base_url('assets/plugins/sweet-alert2/sweetalert2.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/pages/sweet-alert.init.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>

</body>

</html>