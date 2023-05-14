<?php $this->load->view('project/element/header'); ?>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    $('#proses').click(function() {
      // Menampilkan sweet alert loading


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
            var key = $(this).find('.key').text();
            var uri = $(this).find('.uri').text();

            $.ajax({
              url: '<?php echo base_url() ?>' + uri,
              // url: '<?php echo base_url('penerimaan_sap/sign_document') ?>',
              type: 'POST',
              data: {
                key: key,
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
              </br>

              <div class="row align-items-center">
                <div class="col">
                  <button type="button" id="proses" disabled class="btn btn-success btn-square btn-outline-dashed">Ajukan Tandatangan</button>
                </div><!--end col-->
              </div> <!--end row-->
            </div><!--end card-header-->
            <div class="card-body">

              <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">

                  <div class="collapse navbar-collapse" id="navbarSupportedContent6">


                    <?php $this->load->view('data/penerimaan_sap/navbar'); ?>


                    <form class="d-flex" method="get" action="<?php echo base_url('penerimaan_sap/index'); ?>">
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
              </nav> -->
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
                <table class="table table-bordered mb-0 table-centered" id="staging">
                  <thead>

                    <tr>
                      <th><input type="checkbox" id="select-all"></th>
                      <th>No</th>
                      <th>No SPK / PO</th>
                      <th>Pabrikan / Unit</th>
                      <th>Tgl Penerimaan</th>
                      <th>Status</th>
                      <th hidden></th>
                      <th hidden></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($users as $user) : ?>
                      <tr>
                        <td><input type="checkbox" id="select-all"></td>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $user['spk_number']; ?></td>
                        <td><?php echo $user['pabrikan']; ?></td>
                        <td><?php echo $user['tgl_penerimaan']; ?></td>
                        <td>
                          <?php
                          if ($user['tug_unsigned_locked'] == 1 && $user['tug_signed_request'] == 0) {
                            echo '<span class="badge rounded-pill bg-warning">Dokumen Terverifikasi</span>';
                          } else if ($user['tug_unsigned_locked'] == 1 && $user['tug_signed_request'] == 1) {
                            echo '<span class="badge rounded-pill bg-info">Proses Sirkulir</span>';
                          } else if ($user['tug_unsigned_locked'] == 0 && $user['tug_signed_request'] == 0) {
                            echo '<span class="badge rounded-pill bg-danger">Menunggu Validasi</span>';
                          }
                          ?>
                        </td>
                        <td hidden class="uri"><span hidden><?= $user['uri'] ?></span></td>
                        <td hidden class="key"><span hidden><?= $user['key'] ?></span></td>



                      </tr>
                    <?php endforeach; ?>



                  </tbody>
                  <script>
                    // Ambil referensi checkbox "Select All"
                    var selectAll = document.getElementById("select-all");

                    // Ambil referensi semua checkbox dalam tabel
                    var checkboxes = document.querySelectorAll("tbody input[type='checkbox']");

                    // Ambil referensi tombol "Proses"
                    var prosesButton = document.getElementById("proses");

                    // Tambahkan event listener untuk checkbox "Select All"
                    selectAll.addEventListener("click", function() {
                      checkboxes.forEach(function(checkbox) {
                        checkbox.checked = selectAll.checked;
                      });
                      toggleProsesButton();
                    });

                    // Tambahkan event listener untuk setiap checkbox di dalam tabel
                    checkboxes.forEach(function(checkbox) {
                      checkbox.addEventListener("click", function() {
                        toggleProsesButton();
                      });
                    });

                    // Fungsi untuk mengaktifkan atau menonaktifkan tombol "Proses"
                    function toggleProsesButton() {
                      var anyChecked = false;
                      checkboxes.forEach(function(checkbox) {
                        if (checkbox.checked) {
                          anyChecked = true;
                        }
                      });
                      if (anyChecked) {
                        prosesButton.disabled = false;
                      } else {
                        prosesButton.disabled = true;
                      }
                    }
                  </script>

                  <script>
                    // Ambil referensi checkbox "Select All"
                    var selectAll = document.getElementById("select-all");

                    // Ambil referensi semua checkbox dalam tabel
                    var checkboxes = document.querySelectorAll("tbody input[type='checkbox']");

                    // Tambahkan event listener untuk checkbox "Select All"
                    selectAll.addEventListener("click", function() {
                      checkboxes.forEach(function(checkbox) {
                        checkbox.checked = selectAll.checked;
                      });
                    });

                    // Tambahkan event listener untuk setiap checkbox di dalam tabel
                    checkboxes.forEach(function(checkbox) {
                      checkbox.addEventListener("click", function() {
                        // Jika salah satu checkbox di dalam tabel tidak dicentang, hapus centang pada checkbox "Select All"
                        if (!checkbox.checked) {
                          selectAll.checked = false;
                        }
                        // Jika semua checkbox di dalam tabel dicentang, centang checkbox "Select All"
                        else {
                          var allChecked = true;
                          checkboxes.forEach(function(checkbox) {
                            if (!checkbox.checked) {
                              allChecked = false;
                            }
                          });
                          selectAll.checked = allChecked;
                        }
                      });
                    });
                  </script>
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
          title: 'Penerimaan Marketplace SPK: ' + var2,
          text: "akan dihapus?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus SPK!'
        }).then(function(result) {
          if (result.isConfirmed) {
            window.location.href = '<?php echo base_url('penerimaan_sap/update_status/1/'); ?>' + var1;
          }
        });
      }

      function goEdit(var1) {
        window.location.href = '<?php echo base_url('penerimaan_sap/edit/'); ?>' + var1;
      }

      function goView(var1) {
        window.location.href = '<?php echo base_url('penerimaan_sap/view/'); ?>' + var1;
      }
    </script>



    <?php $this->load->view('project/element/footer1'); ?>
  </div>



</div>

<?php $this->load->view('project/element/footer'); ?>

</body>

</html>