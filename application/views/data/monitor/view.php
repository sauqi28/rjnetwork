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


                    <?php $this->load->view('data/user/navbar'); ?>



                  </div>
              </nav>
            </div>

            <!-- CONTENT -->




            <div class="card-body">






              <div class="row">
                <div class="col-lg-6">
                  <form action="<?= site_url('data_user/create'); ?>" method="post">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                    <div class="mb-3 row">
                      <label for="nip" class="col-sm-2 col-form-label text-end">NIP</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="nip" value="<?= $user['nip'] ?>" id="nip" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="username" class="col-sm-2 col-form-label text-end">Username</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="username" value="<?= $user['username'] ?>" id="username" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="fullname" class="col-sm-2 col-form-label text-end">Fullname</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="fullname" value="<?= $user['fullname'] ?>" id="fullname" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="email" class="col-sm-2 col-form-label text-end">Email</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="email" name="email" value="<?= $user['email'] ?>" id="email" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="number" class="col-sm-2 col-form-label text-end">No WA</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <div class="input-group-text">+</div>
                          <input class="form-control" type="number" name="no_wa" value="<?= $user['no_wa'] ?>" id="no_wa" placeholder="6281387xxxxx" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="position" class="col-sm-2 col-form-label text-end">Position</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="email" name="email" value="<?= $user['position_name'] ?>" id="email" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="role" class="col-sm-2 col-form-label text-end">Role</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="email" name="email" value="<?= $user['role_name'] ?>" id="email" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="kategori" class="col-sm-2 col-form-label text-end">Kategori User</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="email" name="email" value="<?= $user['category_name'] ?>" id="email" disabled>
                      </div>
                    </div>
                    <?php if (!empty($user['vendor_name'])) : ?>
                      <div class="mb-3 row">
                        <label for="kategori" class="col-sm-2 col-form-label text-end">Vendor</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="email" name="email" value="<?= $user['vendor_name'] ?>" id="email" disabled>
                        </div>
                      </div>
                    <?php endif; ?>




                    <div class="mb-3 row">
                      <div class="col-sm-10 offset-sm-2">
                        <a class="btn btn-primary" onclick="goEdit('<?php echo $user['id']; ?>')">Edit</a>
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
                      </div>
                    </div>
                  </form>


                  <!-- END OF CONTENT -->
                </div>
                <div class="col-lg-6">
                  <?php if (!empty($user['signature'])) : ?>
                    <div class="mb-3 row">
                      <label for="signature" class="col-sm-2 col-form-label text-end">Signature</label>
                      <div class="col-sm-10">
                        <img src="<?= base_url('assets/signatures/' . $user['signature']) ?>" alt="User Signature" style="max-width: 300px; max-height: 166px;">
                      </div>

                    </div>
                    <div class="mb-3 row">
                      <label for="signature" class="col-sm-2 col-form-label text-end"></label>
                      <div class="col-sm-10">
                        <p> Verified at : <?= $user['verified_at'] ?> </p>
                      </div>

                    </div>
                  <?php endif; ?>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <script>
        function goEdit(var1) {
          window.location.href = '<?php echo base_url('data_user/edit/'); ?>' + var1;
        }
      </script>


      <?php $this->load->view('project/element/footer1'); ?>
    </div>



  </div>

  <?php $this->load->view('project/element/footer'); ?>

  </body>

  </html>