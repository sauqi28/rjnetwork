<?php $this->load->view('project/element/header'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php $this->load->view('project/element/sidebar'); ?>


<div class="page-wrapper">

  <div class="page-content-tab">

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="page-title-box">
            <div class="float-end">
              <ol class="breadcrumb">

              </ol>
            </div>
            <!-- <h4 class="page-title">Navbar</h4> -->
          </div>
          <!--end page-title-box-->
        </div>
        <!--end col-->
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><?php echo $title; ?></h4>
              <p class="text-muted mb-0"><?php echo $subtitle; ?>
                <!-- <code class="highlighter-rouge">background-color</code> utilities. -->
              </p>
            </div><!--end card-header-->
            <div class="card-body">

              <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">

                  <div class="collapse navbar-collapse" id="navbarSupportedContent6">


                    <?php $this->load->view('data/user/navbar'); ?>


                    <form class="d-flex" method="get" action="<?php echo base_url('data_user/index'); ?>">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2" name="search" value="<?php echo $this->input->get('search'); ?>" autofocus id="search-input">
                        <button class="btn btn-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                      </div>
                    </form>
                    <script>
                      function moveCursorToPosition(el, pos) {
                        el.selectionStart = el.selectionEnd = pos;
                        el.focus();
                      }
                      document.addEventListener("DOMContentLoaded", function() {
                        const searchInput = document.getElementById("search-input");
                        moveCursorToPosition(searchInput, searchInput.value.length);
                      });
                    </script>
                  </div>
              </nav>
            </div>

            <!-- CONTENT -->
            <?php if ($this->session->flashdata('message')) : ?>
              <script>
                window.onload = function() {
                  const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })
                  Swal.fire({
                    icon: '<?php echo $this->session->flashdata('status'); ?>',
                    title: '<?php echo $this->session->flashdata('message'); ?>',
                    timer: 1500,
                    timerProgressBar: true,
                  })
                }
              </script>
            <?php endif; ?>



            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered mb-0 table-centered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP/Username</th>
                      <th>Nama</th>
                      <th>Posisi/Jabatan</th>
                      <th>Role</th>
                      <th>Verified</th>
                      <th>Signature</th>
                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($users as $user) : ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $user['nip'] . "/" . $user['username']; ?></td>
                        <td><?php echo $user['fullname']; ?></td>
                        <td><?php echo $user['position_name']; ?></td>
                        <td><span class="badge badge-soft-success"><?php echo $user['role_name']; ?></span></td>
                        <td>
                          <button type="button" class="btn btn-soft-<?php echo ($user['verified_wa'] == 0) ? 'danger' : 'success'; ?> btn-icon-circle btn-icon-circle-sm me-2 position-relative" onclick="<?php echo ($user['verified_wa'] == 0) ? 'confirmVerifyUser(' . $user['no_wa'] . ', ' . $user['id'] . ')' : 'confirmResendVerifyUser(' . $user['no_wa'] . ', ' . $user['id'] . ')'; ?>">
                            <?php echo ($user['verified_wa'] == 0) ? '<i class="fas fa-exclamation"></i>' : '<i class="mdi mdi-checkbox-marked-circle-outline"></i>'; ?>
                            <span class="badge badge-dot online d-flex align-items-center position-absolute end-0 top-50"></span>
                          </button>
                        </td>
                        <td>
                          <button type="button" class="btn btn-soft-<?php echo ($user['signature'] == NULL) ? 'danger' : 'success'; ?> btn-icon-circle btn-icon-circle-sm me-2 position-relative" onclick="<?php echo ($user['signature'] == NULL) ? 'confirmVerifySignature(' . $user['no_wa'] . ', ' . $user['id'] . ')' : 'confirmResendVerifySignature(' . $user['no_wa'] . ', ' . $user['id'] . ')'; ?>">
                            <?php echo ($user['signature'] == NULL) ? '<i class="fas fa-exclamation"></i>' : '<i class="mdi mdi-checkbox-marked-circle-outline"></i>'; ?>
                            <span class="badge badge-dot online d-flex align-items-center position-absolute end-0 top-50"></span>
                          </button>
                        </td>
                        <script>
                          function confirmVerifyUser(no_wa, id) {
                            if (confirm('Apakah Anda yakin ingin memverifikasi pengguna ini? Jika Iya, user akan menerima Link WhatsApp untuk verifikasi nomor wa.')) {
                              verify_user(no_wa, id);
                            }
                          }

                          function confirmVerifySignature(no_wa, id) {
                            if (confirm('Apakah Anda yakin ingin memverifikasi tanda tangan pengguna ini? Jika Iya, user akan menerima Link WhatsApp untuk pengambilan E-signature')) {
                              verify_signature(no_wa, id);
                            }
                          }

                          function confirmResendVerifyUser(no_wa, id) {
                            if (confirm('Apakah Anda yakin ingin mengirim ulang verifikasi nomor wa ke pengguna ini?')) {
                              verify_user(no_wa, id);
                            }
                          }

                          function confirmResendVerifySignature(no_wa, id) {
                            if (confirm('Apakah Anda yakin ingin mengirim ulang verifikasi tanda tangan ke pengguna ini?')) {
                              verify_signature(no_wa, id);
                            }
                          }
                        </script>



                        <td class="text-end">
                          <div class="button-items">
                            <button type="button" class="btn btn-xs btn-primary btn-icon-square-sm" onclick="goView('<?php echo $user['id']; ?>')"><i class="fas fa-eye"></i></button>
                            <button type="button" class="btn btn-xs btn-warning btn-icon-square-sm" onclick="goEdit('<?php echo $user['id']; ?>')"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-xs btn-danger btn-icon-square-sm" onclick="showConfirmation('<?php echo $user['id']; ?>','<?php echo $user['fullname']; ?>')"><i class="fas fa-exclamation"></i></button>



                          </div>
                        </td>

                      </tr>
                    <?php endforeach; ?>



                  </tbody>
                </table><!--end /table-->

              </div><!--end /tableresponsive-->
              </br>
              <?php echo $pagination; ?>

            </div>

            <!-- END OF CONTENT -->
          </div>
        </div>
      </div>

    </div>
    <script>
      function showConfirmation(var1, var2) {
        Swal.fire({
          title: 'User ' + var2,
          text: "akan dinonaktifkan?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Nonaktifkan User!'
        }).then(function(result) {
          if (result.isConfirmed) {
            window.location.href = '<?php echo base_url('data_user/update_status/1/'); ?>' + var1;
          }
        });
      }

      function goEdit(var1) {
        window.location.href = '<?php echo base_url('data_user/edit/'); ?>' + var1;
      }

      function goView(var1) {
        window.location.href = '<?php echo base_url('data_user/view/'); ?>' + var1;
      }

      function goVerified(var1) {
        window.location.href = '<?php echo base_url('data_user/verified/'); ?>' + var1;
      }

      function verify_user(no_wa, id) {
        // if (confirm('Yakin Kirim pesan WhatsApp ke User Ini?')) {
        Swal.fire({
          title: 'Loading...',
          html: 'Sedang mengirim pesan WhatsApp. Mohon tunggu sebentar...',
          allowOutsideClick: false,
          allowEscapeKey: false,
          onOpen: function() {
            Swal.showLoading();
          }
        });

        $.post("<?php echo base_url('data_user/verify_user'); ?>", {
          no_wa: no_wa,
          id: id,
          <?php echo $this->security->get_csrf_token_name(); ?>: "<?php echo $this->security->get_csrf_hash(); ?>"
        }, function(response) {
          console.log(response.trim()) // Add this line to log the response
          if (response == 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil dikirim',
              text: 'Pesan sudah berhasil dikirimkan'
            }).then((result) => {
              // if (result.isConfirmed) {
              //   window.location.href = "<?php echo base_url('data_user/index'); ?>";
              // }
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal dikirim',
              text: 'Terjadi kesalahan saat mengirim pesan WhatsApp.'
            });
          }
        });

      }


      function verify_signature(no_wa, id) {
        Swal.fire({
          title: 'Loading...',
          html: 'Sedang mengirim pesan WhatsApp. Mohon tunggu sebentar...',
          allowOutsideClick: false,
          allowEscapeKey: false,
          onOpen: function() {
            Swal.showLoading();
          }
        });

        $.post("<?php echo base_url('data_user/verify_signature'); ?>", {
          no_wa: no_wa,
          id: id,
          <?php echo $this->security->get_csrf_token_name(); ?>: "<?php echo $this->security->get_csrf_hash(); ?>"
        }, function(response) {
          console.log(response.trim()) // Add this line to log the response
          if (response == 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil dikirim',
              text: 'Pesan sudah berhasil dikirimkan'
            }).then((result) => {
              // if (result.isConfirmed) {
              //   window.location.href = "<?php echo base_url('data_user/index'); ?>";
              // }
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal dikirim',
              text: 'Terjadi kesalahan saat mengirim pesan WhatsApp.'
            });
          }
        });

      }
    </script>
    <!-- <script>
                      window.onload = function() {
                        const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                          }
                        })

                        Toast.fire({
                          icon: 'success',
                          title: 'Signed in successfully'
                        })
                      }
                    </script> -->









    <?php $this->load->view('project/element/footer1'); ?>
  </div>



</div>

<?php $this->load->view('project/element/footer'); ?>

</body>

</html>