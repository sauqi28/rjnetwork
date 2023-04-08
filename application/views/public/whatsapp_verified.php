<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <title>Verifikasi Whatsapp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
  <meta content="" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App favicon -->
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
  <!-- App css -->
  <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/app.min.css'); ?>" rel="stylesheet" type="text/css" />

</head>


<body id="body" class="auth-page" style="background-image: url('<?php echo base_url('assets/images/p-1.png'); ?>'); background-size: cover; background-position: center center;">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Log In page -->
  <div class="container-md">
    <div class="row vh-100 d-flex justify-content-center">
      <div class="col-12 align-self-center">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-5 mx-auto">
              <div class="card">
                <div class="card-body p-0 ">
                  <div class="text-center p-3">
                    <a href="index.html" class="logo logo-admin">
                      <img src="<?php echo base_url('assets/images/pln-logo1.png'); ?>" height="50" alt="logo" class="auth-logo">
                    </a>
                    <h4 class="mt-3 mb-1 fw-semibold text-dark font-18">Verifikasi Nomor WhatsApp Anda,</h4>
                    <p class="text-muted  mb-0">Sebelum menggunakan aplikasi</p>
                  </div>
                </div>
                <div class="card-body">
                  <div class="ex-page-content text-center">
                    <p>Nama: <?php echo $user->fullname; ?></p>
                    <p>No WA: <?php echo $user->no_wa; ?></p>
                  </div>
                  <a class="btn btn-success w-100" href="#" id="verify-btn" onclick="verify_user('<?php echo $user->id; ?>')">Verifikasi Sekarang! <i class="fab fa-whatsapp ml-1"></i></a>

                </div><!--end card-body-->
                <div class="card-body bg-light-alt text-center">
                  &copy; <script>
                    document.write(new Date().getFullYear())
                  </script> PT PLN (Persero) UP3 Teluk Naga
                </div><!--end card-body-->
              </div><!--end card-->
            </div><!--end col-->
          </div><!--end row-->
        </div><!--end card-body-->
      </div><!--end col-->
    </div><!--end row-->
  </div><!--end container-->
  <script>
    function verify_user(id) {
      $.ajax({
        url: "<?php echo base_url('publicaccess/verify_wa'); ?>",
        type: "POST",
        data: {
          id: id,
          <?php echo $this->security->get_csrf_token_name(); ?>: "<?php echo $this->security->get_csrf_hash(); ?>"
        },
        dataType: "json",
        success: function(response) {
          if (response.success) {
            Swal.fire({
              title: "Sukses",
              text: "Verifikasi berhasil!",
              icon: "success",
              timer: 3000,
              showConfirmButton: false,
            }).then(() => {
              // Setelah beberapa detik, arahkan ke halaman login
              window.location.href = "<?php echo base_url('auth/login'); ?>";
            });
          } else {
            Swal.fire({
              title: "Gagal",
              text: "Verifikasi gagal!",
              icon: "error",
            });
          }
        }
      });
    }
  </script>

  <!-- App js -->

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>

</body>

</html>