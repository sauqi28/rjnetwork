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
  <style>
    .table thead {
      background-color: #FFFFFF;
      /* warna putih */
      font-weight: bold;
      /* membuat header tabel tebal */
    }

    .table td,
    .table th {
      font-size: 11px;
      padding: 5px;
      font-family: 'Ubuntu', sans-serif;
    }

    .table tr:nth-child(odd) {
      background-color: #FFFFFF;
      /* warna abu-abu muda */
    }

    .table tr:nth-child(even) {
      background-color: #F9F9F9;
      /* warna abu-abu agak muda */
    }

    .table th {
      text-align: left;
    }
  </style>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#approveAllButton').click(function() {
        // Menampilkan sweet alert loading
        Swal.fire({
          title: 'Loading...',
          text: 'Please wait for a moment.',
          showConfirmButton: false,
          allowOutsideClick: false,
          onBeforeOpen: function() {
            setTimeout(function() {
              Swal.showLoading();
            }, 2000);
          }
        });

        // Menampilkan sweet alert konfirmasi
        Swal.fire({
          title: 'Are you sure?',
          text: 'All Documents will be approved automatically!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, approve all!',
          cancelButtonText: 'No, cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            // Mendapatkan semua baris data pada tabel
            var rows = $('#staging tbody tr');
            var count = rows.length;
            var success_count = 0;
            var failed_count = 0;

            // Mengirimkan data pada setiap baris menggunakan metode AJAX POST
            rows.each(function() {
              var id = $(this).find('.id').text();
              var token = $(this).find('.token').text();
              var uri = $(this).find('.uri').text();

              var uri_parts = uri.split('/');
              uri_parts[2] = 'single_approve';
              var new_uri = uri_parts.join('/');

              $.ajax({
                url: '<?php echo base_url() ?>' + new_uri,
                type: 'POST',
                data: {
                  id: id,
                  token: token,
                  <?php echo $this->security->get_csrf_token_name(); ?>: "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                success: function(response) {
                  success_count++;

                  if (success_count + failed_count == count) {
                    // Menampilkan sweet alert berhasil
                    if (failed_count == 0) {
                      Swal.fire({
                        title: 'Success!',
                        text: 'All data has been approved.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.reload();
                        }
                      });
                      // Menampilkan sweet alert gagal
                    } else {
                      Swal.fire({
                        title: 'Failed!',
                        text: 'Some data failed to approve.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.reload();
                        }
                      });
                    }
                  }
                },
                error: function(xhr, status, error) {
                  failed_count++;

                  if (success_count + failed_count == count) {
                    // Menampilkan sweet alert berhasil
                    if (failed_count == 0) {
                      Swal.fire({
                        title: 'Success!',
                        text: 'All data has been approved.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.reload();
                        }
                      });
                      // Menampilkan sweet alert gagal
                    } else {
                      Swal.fire({
                        title: 'Failed!',
                        text: 'Some data failed to approve.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.reload();
                        }
                      });
                    }
                  }
                }
              });
            });
          } else {
            // Menutup sweet alert loading
            Swal.close();
          }
        });
      });
    });
  </script>




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
                        <li class="list-inline-item">
                          <div class="ps-3">
                            <!-- <i class="mdi mdi-web"></i> -->
                            <p class="text-muted mb-0"> <button type="button" id="approveAllButton" class="btn btn-danger btn-square  btn-lg btn-outline-dashed">Approve All Documents</button></p>
                            <!-- <p class="text-muted mb-0">PLN UP3 Teluknaga</p> -->
                          </div>
                        </li>

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



                      <?php if ($form_id == 1) { ?>
                        <div>
                          <iframe id="pdfViewer" src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= urlencode(base_url(ltrim($folder_name, './') . "/" . $tug4_unsigned_file)); ?>" frameborder="0"></iframe>


                        </div>


                      <?php } ?>
                      <?php if ($form_id == 2) { ?>
                        <div>
                          <iframe id="pdfViewer" src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= urlencode(base_url(ltrim($folder_name, './') . "/" .  $tug3_karantina_unsigned_file)); ?>" frameborder="0"></iframe>

                        </div>



                      <?php } ?>
                      <?php if ($form_id == 3) { ?>
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
                          <a href="#" onclick="showConfirmation('<?php echo $id_sign; ?>','<?php echo $title; ?>','<?php echo $token; ?>')" class="btn btn-success btn-sm">Approve This Document</a>
                          <a href="#" class="btn btn-secondary btn-sm">Reject</a> <?php } else {
                                                                                  echo "Sudah Ditandatangani : " . $approved_time . "WIB";
                                                                                } ?>
                      </div>
                    </div><!--end col-->
                  </div><!--end row-->

                  <hr>

                  <p class="mt-2 mb-0"><strong>Dokumen Siap Ditandatangani</strong>
                    <hr>

                  <div class="table-responsive">
                    <table class="table table-bordered mb-0 table-centered" id="staging">
                      <thead>
                        <tr>
                        <tr>
                          <th hidden></th>
                          <th hidden></th>
                          <th hidden></th>
                          <th>Judul</th>
                          <th>Desc</th>
                          <th>Status</th>
                          <th>Tgl</th>
                          <th>Lihat</th>
                        </tr>

                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data_queue_sign as $queue) : ?>
                          <?php $i = 1;
                          foreach ($queue->details as $detail) : ?>

                            <tr>
                              <td hidden class="id"><span hidden><?= $detail->id ?></span></td>
                              <td hidden class="token"><span hidden><?= $detail->token ?></span></td>
                              <td hidden class="uri"><span hidden><?= $detail->uri ?></span></td>
                              <td><?= $detail->title ?></td>
                              <td><?= $detail->desc ?></td>
                              <td><span class="badge rounded-pill bg-info">Menunggu Approval</span></td>
                              <td><?= $detail->request_at ?></td>
                              <td>
                                <div class="float-end d-print-none mt-2 mt-md-0"><a href="<?= base_url($detail->uri) . $detail->token ?>" class="btn btn-warning btn-xs">Detail</a></div>
                              </td>
                            </tr>
                          <?php endforeach ?>
                        <?php endforeach ?>
                      </tbody>
                    </table>

                  </div><!--end card-body-->

                  <hr>





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
            $.post("<?php echo base_url('digitalsign/single_approve'); ?>", {
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