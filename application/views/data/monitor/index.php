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
        <div class="col-lg-3 col-md-6">
          <div class="card overflow-hidden">
            <div class="card-body">
              <div class="row d-flex">
                <div class="col-3">
                  <i class="ti ti-users font-36 align-self-center text-dark"></i>
                </div><!--end col-->
                <div class="col-12 ms-auto align-self-center">
                  <div id="dash_spark_1" class="mb-3"></div>
                </div><!--end col-->
                <div class="col-12 ms-auto align-self-center">
                  <h3 class="text-dark my-0 font-22 fw-bold">24000</h3>
                  <p class="text-muted mb-0 fw-semibold">Sessions</p>
                </div><!--end col-->
              </div><!--end row-->
            </div><!--end card-body-->
          </div><!--end card-->
        </div> <!--end col-->
        <div class="col-lg-3 col-md-6">
          <div class="card overflow-hidden">
            <div class="card-body">
              <div class="row d-flex">
                <div class="col-3">
                  <i class="ti ti-clock font-36 align-self-center text-dark"></i>
                </div><!--end col-->
                <div class="col-auto ms-auto align-self-center">
                  <span class="badge badge-soft-success px-2 py-1 font-11">Active</span>
                </div><!--end col-->
                <div class="col-12 ms-auto align-self-center">
                  <div id="dash_spark_2" class="mb-3"></div>
                </div><!--end col-->
                <div class="col-12 ms-auto align-self-center">
                  <h3 class="text-dark my-0 font-22 fw-bold">00:18</h3>
                  <p class="text-muted mb-0 fw-semibold">Avg.Sessions</p>
                </div><!--end col-->
              </div><!--end row-->
            </div><!--end card-body-->
          </div><!--end card-->
        </div> <!--end col-->
        <div class="col-lg-3 col-md-6">
          <div class="card overflow-hidden">
            <div class="card-body">
              <div class="row d-flex">
                <div class="col-3">
                  <i class="ti ti-activity font-36 align-self-center text-dark"></i>
                </div><!--end col-->
                <div class="col-12 ms-auto align-self-center">
                  <div id="dash_spark_3" class="mb-3"></div>
                </div><!--end col-->
                <div class="col-12 ms-auto align-self-center">
                  <h3 class="text-dark my-0 font-22 fw-bold">$2400</h3>
                  <p class="text-muted mb-0 fw-semibold">Bounce Rate</p>
                </div><!--end col-->
              </div><!--end row-->
            </div><!--end card-body-->
          </div><!--end card-->
        </div> <!--end col-->
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


                    <?php $this->load->view('data/monitor/navbar'); ?>


                    <form class="d-flex" method="get" action="<?php echo base_url('monitor/users'); ?>">
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
                      <th>Status</th>
                      <th>Lokasi</th>
                      <th>Nama</th>
                      <th>User PPPOE</th>
                      <th>IP Address</th>
                      <th>Last Check</th>

                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($users as $user) : ?>
                      <tr>
                        <td>
                          <?php if ($user['ping_status'] == 1) : ?>
                            <span class="badge badge-soft-success">OK<?php echo " | " . $user['Latency'] . "ms"; ?></span>
                          <?php elseif ($user['ping_status'] == 0) : ?>
                            <span class="badge badge-soft-danger">DC</span>
                          <?php endif; ?>
                        </td>

                        <td><?php echo $user['LocationName']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['user_pppoe']; ?></td>
                        <td><?php echo $user['ip_address']; ?></td>
                        <td><?php echo $user['formatted_timestamp']; ?></td>



                        <td class="text-end">
                          <div class="button-items">
                            <!-- <button type="button" class="btn btn-xs btn-primary btn-icon-square-sm" onclick="goView('<?php echo $user['id']; ?>')"><i class="fas fa-eye"></i></button> -->




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