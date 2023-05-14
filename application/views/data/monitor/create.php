<?php $this->load->view('project/element/header'); ?>
<?php $this->load->view('project/element/sidebar'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



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
                        <input class="form-control <?php echo (form_error('nip') != "") ? 'is-invalid' : ''; ?>" type="text" name="nip" value="<?= set_value('nip'); ?>" id="nip">
                        <?php echo form_error('nip', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="username" class="col-sm-2 col-form-label text-end">Username</label>
                      <div class="col-sm-10">
                        <input class="form-control <?php echo (form_error('username') != "") ? 'is-invalid' : ''; ?>" type="text" name="username" value="<?= set_value('username'); ?>" id="username">
                        <?php echo form_error('username', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="fullname" class="col-sm-2 col-form-label text-end">Fullname</label>
                      <div class="col-sm-10">
                        <input class="form-control <?php echo (form_error('fullname') != "") ? 'is-invalid' : ''; ?>" type="text" name="fullname" value="<?= set_value('fullname'); ?>" id="fullname">
                        <?php echo form_error('fullname', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="email" class="col-sm-2 col-form-label text-end">Email</label>
                      <div class="col-sm-10">
                        <input class="form-control <?php echo (form_error('email') != "") ? 'is-invalid' : ''; ?>" type="email" name="email" value="<?= set_value('email'); ?>" id="email">
                        <?php echo form_error('email', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="number" class="col-sm-2 col-form-label text-end">No WA</label>

                      <div class="col-sm-10">
                        <div class="input-group">
                          <div class="input-group-text">+</div>
                          <input class="form-control <?php echo (form_error('no_wa') != "") ? 'is-invalid' : ''; ?>" type="number" name="no_wa" value="<?= set_value('no_wa'); ?>" id="no_wa" placeholder="6281387xxxxx">
                          <?php echo form_error('no_wa', '<div class="invalid-feedback">', '</div>'); ?>
                        </div>
                      </div>
                    </div>


                    <div class="mb-3 row">
                      <label for="position" class="col-sm-2 col-form-label text-end">Position</label>
                      <div class="col-sm-10">
                        <select class="form-select <?php echo (form_error('position') != "") ? 'is-invalid' : ''; ?>" name="position" id="position">
                          <?php foreach ($user_positions as $position) : ?>
                            <option value="<?= $position->id ?>" <?= set_select('position', $position->id); ?>><?= $position->position_name ?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php echo form_error('position', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="role" class="col-sm-2 col-form-label text-end">Role</label>
                      <div class="col-sm-10">
                        <select class="form-select <?php echo (form_error('role') != "") ? 'is-invalid' : ''; ?>" name="role" id="role">
                          <?php foreach ($user_roles as $role) : ?>
                            <option value="<?= $role->id ?>" <?= set_select('role', $role->id); ?>><?= $role->role_name ?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php echo form_error('role', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="role" class="col-sm-2 col-form-label text-end">Kategori User</label>
                      <div class="col-sm-10">
                        <select class="form-select <?php echo (form_error('role') != "") ? 'is-invalid' : ''; ?>" name="kategori" id="kategori">
                          <?php foreach ($user_category as $kategori) : ?>
                            <option value="<?= $kategori->id ?>" <?= set_select('kategori', $kategori->id); ?>><?= $kategori->category_name ?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php echo form_error('kategori', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>


                    <div class="mb-3 row">
                      <label for="pilihvendor" class="col-sm-2 col-form-label text-end">Pilih Vendor</label>
                      <div class="col-sm-10">
                        <select class="form-select" name="pilihvendor" id="pilihvendor"></select>
                      </div>
                    </div>


                    <div class="mb-3 row">
                      <label for="password" class="col-sm-2 col-form-label text-end">Password</label>
                      <div class="col-sm-10">
                        <input class="form-control <?php echo (form_error('password') != "") ? 'is-invalid' : ''; ?>" type="password" name="password" id="password">
                        <?php echo form_error('password', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>


                    <div class="mb-3 row">
                      <div class="col-sm-10 offset-sm-2">
                        <input type="submit" value="Tambah User" class="btn btn-primary">
                      </div>
                    </div>
                  </form>


                </div>
              </div>

              </br>

            </div>

            <!-- END OF CONTENT -->
          </div>
        </div>
      </div>

    </div>
    <script>
      $(document).ready(function() {
        // tangkap elemen label dan dropdown "Kategori User" dan "Pilih Vendor"
        var kategoriLabel = $('label[for="kategori"]');
        var kategoriDropdown = $('#kategori');
        var pilihVendorLabel = $('label[for="pilihvendor"]');
        var pilihVendorDropdown = $('#pilihvendor');

        // sembunyikan label dan dropdown "Pilih Vendor"
        pilihVendorLabel.hide();
        pilihVendorDropdown.hide();

        // ketika terjadi perubahan pada dropdown "Kategori User"
        kategoriDropdown.change(function() {
          // jika "External" dipilih
          if (kategoriDropdown.val() == 2) {
            // kirim permintaan AJAX untuk mendapatkan data pilihan vendor
            $.ajax({
              url: '<?= base_url('data_user/get_vendor_options'); ?>', // ganti dengan URL file PHP yang mengembalikan data pilihan vendor
              method: 'POST',
              data: {
                kategori: kategoriDropdown.val(), // kirim nilai kategori user yang dipilih
                <?= $this->security->get_csrf_token_name(); ?>: '<?= $this->security->get_csrf_hash(); ?>' // tambahkan CSRF token
              },
              dataType: 'json',
              success: function(data) {
                // kosongkan dropdown pilihan vendor
                pilihVendorDropdown.empty();

                // tambahkan pilihan vendor ke dropdown
                $.each(data, function(index, option) {
                  pilihVendorDropdown.append($('<option>').val(option.id).text(option.name));
                });

                // tampilkan label dan dropdown "Pilih Vendor"
                pilihVendorLabel.show();
                pilihVendorDropdown.show();
              }
            });
          } else {
            // jika kategori selain "External" dipilih, kosongkan dan sembunyikan label dan dropdown "Pilih Vendor"
            pilihVendorDropdown.empty().hide();
            pilihVendorLabel.hide();
          }
        });
      });
    </script>





    <?php $this->load->view('project/element/footer1'); ?>
  </div>



</div>

<?php $this->load->view('project/element/footer'); ?>

</body>

</html>