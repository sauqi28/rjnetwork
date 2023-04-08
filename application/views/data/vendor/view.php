<?php $this->load->view('project/element/header'); ?>
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


                    <?php $this->load->view('data/vendor/navbar'); ?>



                  </div>
              </nav>
            </div>

            <!-- CONTENT -->




            <div class="card-body">






              <div class="row">
                <div class="col-lg-6">
                  <form>
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                    <div class="mb-3 row">
                      <label for="id" class="col-sm-2 col-form-label text-end">ID Vendor</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="nip" value="<?= $user['id'] ?>" id="nip" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="vendor_name" class="col-sm-2 col-form-label text-end">Nama Vendor</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="username" value="<?= $user['vendor_name'] ?>" id="vendor_name" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="telp" class="col-sm-2 col-form-label text-end">No Telp</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="telp" value="<?= $user['telp'] ?>" id="telp" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="email" class="col-sm-2 col-form-label text-end">Email</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" disabled value="<?= $user['vendor_address'] ?>"></textarea>
                      </div>
                    </div>




                    <div class="mb-3 row">
                      <div class="col-sm-10 offset-sm-2">
                        <a class="btn btn-primary" onclick="goEdit('<?php echo $user['id']; ?>')">Edit</a>
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
                      </div>
                    </div>
                  </form>


                  <!-- END OF CONTENT -->
                </div>

              </div>

            </div>
          </div>
        </div>
      </div>

      <script>
        function goEdit(var1) {
          window.location.href = '<?php echo base_url('data_vendor/edit/'); ?>' + var1;
        }
      </script>


      <?php $this->load->view('project/element/footer1'); ?>
    </div>



  </div>

  <?php $this->load->view('project/element/footer'); ?>

  </body>

  </html>