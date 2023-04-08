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


                    <?php $this->load->view('data/customer/navbar'); ?>


                    <form class="d-flex" method="get" action="<?php echo base_url('data_customer/import_customer'); ?>">
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

            <div class="card">
              <div class="card-header">
                <div class="alert custom-alert custom-alert-warning icon-custom-alert shadow-sm fade show" role="alert">
                  <i class="mdi mdi-alert-outline alert-icon text-warning align-self-center font-30 me-3"></i>
                  <div class="alert-text my-1">
                    <h5 class="mb-1 fw-bold mt-0">Upload Data Customer</h5>
                    <span>Halaman ini digunakan untuk upload data customer secara massal, Download contoh file excel disini : <a href="<?php echo base_url('assets/files/file_customer_mass_upload.xlsx'); ?>" style="color: blue;">file_customer_mass_upload.xlsx</a></span>
                  </div>
                  <div class="alert-close">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
                <p class="text-muted mb-0">
              </div><!--end card-header-->
              <div class="row">
                <div class="col-4">
                  <div class="card-body">
                    <form action="<?php echo base_url(); ?>data_customer/import" method="post" enctype="multipart/form-data" form="myform">
                      <div class="input-group">
                        <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" accept=".xlsx" name="file" required>
                        <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Upload File</button>
                      </div>
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    </form>
                  </div>
                </div>
                <?php if (!$is_mst_customer_temp_empty) : ?>
                  <div class="col-1">
                    <div class="card-body">
                      <form id="submit-form" action="<?php echo base_url(); ?>data_customer/commit_data" method="post" enctype="multipart/form-data" form="myform">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="button-items">
                          <button type="button" class="btn btn-success btn-square btn-outline-dashed" onclick="showConfirmDialog('Apakah Anda yakin ingin menyimpan data?', 'submit-form')">Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-1">
                    <div class="card-body">
                      <form id="reset-form" action="<?php echo base_url(); ?>data_customer/reset_data" method="post" enctype="multipart/form-data" form="myform">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="button-items">
                          <button type="button" class="btn btn-secondary btn-square btn-outline-dashed" onclick="showConfirmDialog('Apakah Anda yakin ingin mereset data?', 'reset-form')">Reset</button>
                        </div>
                      </form>
                    </div><!--end card-body-->
                  </div>

                  <script>
                    function showConfirmDialog(message, formId) {
                      if (confirm(message)) {
                        // Jika user menekan tombol "OK", submit form yang bersangkutan
                        document.getElementById(formId).submit();
                      } else {
                        // Jika user menekan tombol "Cancel", batalkan aksi
                        return false;
                      }
                    }
                  </script>

                <?php endif; ?>
              </div>
            </div>



            <div class="card-body">

              <div class="table-responsive">
                <table class="table table-bordered mb-0 table-centered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pelanggan</th>
                      <th>Alamat Pelanggan</th>
                      <th>No Telp</th>
                      <th>Kategori</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($users as $user) : ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo  $user['customer_name']; ?></td>
                        <td><?php echo  $user['customer_address']; ?></td>
                        <td><?php echo  $user['telp']; ?></td>
                        <td><?php echo  $user['category_name']; ?></td>
                        <td><span class="badge rounded-pill badge-soft-warning">Belum Disimpan</span></td>

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
      function goEdit(var1) {
        window.location.href = '<?php echo base_url('data_customer/edit/'); ?>' + var1;
      }

      function goView(var1) {
        window.location.href = '<?php echo base_url('data_customer/view/'); ?>' + var1;
      }
    </script>


    <?php $this->load->view('project/element/footer1'); ?>
  </div>



</div>

<?php $this->load->view('project/element/footer'); ?>

</body>

</html>