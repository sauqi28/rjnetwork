<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <title>Penandatangan Digital <?php echo $title; ?></title>
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="<?php echo $desc; ?>" name="description" />
  <meta content="" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/pln-1.png'); ?>">
  <!-- <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>"> -->
  <link href="<?php echo base_url('assets/plugins/sweet-alert2/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css" />
  <!-- App css -->
  <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/app.min.css'); ?>" rel="stylesheet" type="text/css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.worker.min.js"></script>
  <!-- <style>
    #pdfViewer {
      width: 100%;
      max-height: 800px;
      overflow-y: scroll;
      border: 0px solid black;
    }
  </style> -->
  <!-- <style>
    #pdfViewer {
      width: 100%;
      height: 100vh;
      /* Tinggi maksimum kontainer disesuaikan dengan tinggi layar */
      overflow-y: hidden;
      border: 0px solid black;
    }
  </style> -->
  <style>
    #pdfViewer {
      width: 100%;
      height: 50vh;
      /* Tinggi maksimum kontainer disesuaikan dengan tinggi layar */
      border: 0px solid black;
    }
  </style>

</head>


<body id="body" class="auth-page" style="background-image: url('<?php echo base_url('assets/images/p-1.png'); ?>'); background-size: cover; background-position: center center;">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Log In page -->
  <div class="container-md">
    <div class="row vh-100 d-flex justify-content-center">
      <div class="col-12 align-self-center">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <div class="card">
                <div class="card-body invoice-head">
                  <div class="row">
                    <div class="col-md-6 align-self-center">
                      <img src="<?php echo base_url('assets/images/pln-logo1.png'); ?>" alt="logo-small" class="logo-sm me-1" height="35">
                      <!-- <img src="<?php echo base_url('assets/images/logo-dark.png'); ?>" alt="logo-large" class="logo-lg brand-dark" height="16"> -->
                      <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="logo-large" class="logo-lg brand-light" height="16">
                      <p class="mt-2 mb-0"><strong><?php echo $title; ?></strong>,</br>Mohon untuk melakukan review dan penandatanganan dokumen secara digital.</p>

                    </div><!--end col-->
                    <div class="col-md-6">

                      <ul class="list-inline mb-0 contact-detail float-end">
                        <!-- <li class="list-inline-item">
                          <div class="ps-3">
                            <i class="mdi mdi-web"></i>
                            <p class="text-muted mb-0">www.abcdefghijklmno.com</p>
                            <p class="text-muted mb-0">www.qrstuvwxyz.com</p>
                          </div>
                        </li>
                        <!-- <li class="list-inline-item"> -->
                        <!-- <div class="ps-3">
                            <i class="mdi mdi-phone"></i>
                            <p class="text-muted mb-0">+123 123456789</p>
                            <p class="text-muted mb-0">+123 123456789</p>
                          </div>
                        </li>
                        <li class="list-inline-item">
                          <div class="ps-3">
                            <i class="mdi mdi-map-marker"></i>
                            <p class="text-muted mb-0">2821 Kensington Road,</p>
                            <p class="text-muted mb-0">Avondale Estates, GA 30002 USA.</p>
                          </div>
                        </li> -->
                      </ul>
                    </div><!--end col-->
                  </div><!--end row-->
                </div><!--end card-body-->
                <div class="card-body">
                  <div class="row row-cols-3 d-flex justify-content-md-between">
                    <div class="col-md-3 d-print-flex">
                      <div class="">
                        <h6 class="mb-0"><b>Tgl :</b> <?php echo $tgl_penerimaan_formatted; ?></h6>
                        <h6><b>Pabrikan :</b> <?php echo $pabrikan; ?></h6>
                      </div>
                    </div><!--end col-->
                    <div class="col-md-3 d-print-flex">
                      <div class="">
                        <address class="font-13">
                          <strong class="font-14">No SPK :</strong><br>
                          <?php echo $spk_number; ?><br>
                        </address>
                      </div>
                    </div><!--end col-->
                    <div class="col-md-3 d-print-flex">
                      <div class="">
                        <address class="font-13">
                          <strong class="font-14">Penandatangan:</strong><br>
                          <?php echo $fullname; ?><br>
                          <?php echo $keterangan; ?><br>
                        </address>
                      </div>
                    </div> <!--end col-->
                  </div><!--end row-->

                  <div class="row">
                    <div class="col-lg-12">
                      <span> Refresh browser apabila dokumen pdf tidak tampil</span></br>



                      <?php if ($form_id == 7) { ?>
                        <div>
                          <iframe id="pdfViewer" src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= urlencode(base_url(ltrim($folder_name, './') . "/" . $tug4_unsigned_file)); ?>" frameborder="0"></iframe>


                        </div>


                      <?php } ?>
                      <?php if ($form_id == 8) { ?>
                        <div>
                          <iframe id="pdfViewer" src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= urlencode(base_url(ltrim($folder_name, './') . "/" .  $tug3_karantina_unsigned_file)); ?>" frameborder="0"></iframe>

                        </div>



                      <?php } ?>
                      <?php if ($form_id == 9) { ?>
                        <div>
                          <iframe id="pdfViewer" src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= urlencode(base_url(ltrim($folder_name, './') . "/" . $tug3_unsigned_file)); ?>" frameborder="0"></iframe>

                        </div>


                      <?php } ?>



                    </div> <!--end col-->
                  </div><!--end row-->

                  <div class="row">
                    <div class="col-lg-6">
                      <h5 class="mt-4">Informasi :</h5>
                      <ul class="ps-3">
                        <li><small class="font-12">Setelah dilakukan approval, notifikasi akan otomatis dikirim ke user / approval selanjutnya atau akan di proses oleh bagian terkait</small></li>
                        <li><small class="font-12">Proses penandatanganan secara digital akan direkam oleh sistem dan dapat dilakukan tracking melalui sistem ini di kemudian hari</small></li>
                        <li><small class="font-12">Disclaimer: Proses tandatangan ini belum terintegrasi dengan Penyelenggara Sertifikasi Elektronik (PSrE) yang diakui di Indonesia</small></li>
                      </ul>
                    </div> <!--end col-->
                    </br>
                    <div class="col-lg-6 align-self-center">
                      <div class="float-none float-md-end" style="width: 30%;">
                        <small><?php echo $keterangan; ?></small>
                        <img src="<?php echo base_url('assets/signatures/' . $signature); ?>" alt="" class="mt-2 mb-1" height="80">
                        <p class="border-top"><?php echo $fullname; ?></p>
                      </div>
                    </div><!--end col-->
                  </div><!--end row-->
                  <hr>
                  <div class="row d-flex justify-content-center">
                    <div class="col-lg-12 col-xl-4 ms-auto align-self-center">
                      <div class="text-center"><small id="server-time" class="font-12"></small></div>
                    </div><!--end col-->
                    <div class="col-lg-12 col-xl-4">
                      <div class="float-end d-print-none mt-2 mt-md-0">
                        <!-- <a href="javascript:window.print()" class="btn btn-info btn-sm">Print</a> -->
                        <?php if ($approved != 1) { ?>
                          <a href="#" onclick="showConfirmation('<?php echo $id_sign; ?>','<?php echo $title; ?>','<?php echo $token; ?>')" class="btn btn-success btn-lg">Approve</a>
                          <a href="#" class="btn btn-secondary btn-lg">Reject</a> <?php } else {
                                                                                  echo "Sudah Ditandatangani : " . $approved_time . "WIB";
                                                                                } ?>
                      </div>
                    </div><!--end col-->
                  </div><!--end row-->
                </div><!--end card-body-->
              </div><!--end card-->
            </div><!--end col-->
          </div><!--end row-->
        </div><!--end card-body-->
      </div><!--end col-->
    </div><!--end row-->
  </div><!--end container-->

  <script>
    function showConfirmation(var1, var2, var3) {
      Swal.fire({
        title: 'Yakin dokumen ' + var2,
        text: "akan ditandatangani secara digital?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Tandatangani Sekarang'
      }).then(function(result) {
        if (result.isConfirmed) {
          $.post("<?php echo base_url('signsap2receivement/single_approve'); ?>", {
            id: var1,
            token: var3,
            <?php echo $this->security->get_csrf_token_name(); ?>: "<?php echo $this->security->get_csrf_hash(); ?>"
          }, function(response) {
            console.log(response.trim()) // Add this line to log the response
            if (response.trim() == 'Success') {
              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Dokumen telah ditandatangani secara digital'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.reload();
                }
              });
            } else {
              Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Penandatanganan Untuk Dokumen Ini Dalam Proses Development'
              });
            }
          });
        }
      });
    }


    // Fungsi untuk mendapatkan nilai cookie
    function getCookie(name) {
      var value = '; ' + document.cookie;
      var parts = value.split('; ' + name + '=');
      if (parts.length == 2) {
        return parts.pop().split(';').shift();
      }
    }


    function updateTime() {
      var options = {
        timeZone: "Asia/Jakarta",
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
        second: "numeric",
        hour12: false
      };
      var serverTime = new Date().toLocaleString("en-US", options); // 8 April 2023, 11:00:00

      // Tampilkan waktu server di halaman
      document.getElementById("server-time").innerHTML = serverTime;
    }

    // Panggil updateTime() setiap 1 detik
    setInterval(updateTime, 1000);
  </script>


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