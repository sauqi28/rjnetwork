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


                    <?php $this->load->view('data/customer/navbar'); ?>



                  </div>
              </nav>
            </div>

            <!-- CONTENT -->




            <div class="card-body">

              <div class="row">
                <div class="col-lg-6">
                  <form action="<?= site_url('data_customer/edit/' . $user['id']); ?>" method="post">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="mb-3 row">
                      <label for="customer_name" class="col-sm-2 col-form-label text-end">Nama Pelanggan</label>
                      <div class="col-sm-10">
                        <input placeholder="ex PT Mitra Abadi Jaya" class="form-control <?php echo (form_error('customer_name') != "") ? 'is-invalid' : ''; ?>" type="text" name="customer_name" value="<?= set_value('customer_name', $user['customer_name']); ?>" id="customer_name">
                        <?php echo form_error('customer_name', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="telp" class="col-sm-2 col-form-label text-end">No Telp</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <div class="input-group-text">+</div>
                          <input class="form-control <?php echo (form_error('telp') != "") ? 'is-invalid' : ''; ?>" type="number" name="telp" value="<?= set_value('telp', $user['telp']); ?>" id="telp" placeholder="6281387xxxxx">
                          <?php echo form_error('telp', '<div class="invalid-feedback">', '</div>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="customer_address" class="col-sm-2 col-form-label text-end">Address</label>
                      <div class="col-sm-10">
                        <textarea class="form-control <?php echo (form_error('customer_address') != "") ? 'is-invalid' : ''; ?>" name="customer_address" id="customer_address"><?= set_value('customer_address', $user['customer_address']); ?></textarea>
                        <?php echo form_error('customer_address', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="customer_category" class="col-sm-2 col-form-label text-end">Kategori User</label>
                      <div class="col-sm-10">
                        <select class="form-select <?php echo (form_error('customer_category') != "") ? 'is-invalid' : ''; ?>" name="customer_category" id="customer_category">
                          <?php foreach ($customer_category as $position) : ?>
                            <option value="<?= $position->id ?>" <?= set_select('customer_category', $position->id, ($user['customer_category'] == $position->id)); ?>><?= $position->category_name ?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php echo form_error('customer_category', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <div class="col-sm-10 offset-sm-2">
                        <input type="submit" value="Update Pelanggan" class="btn btn-primary">
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


    <?php $this->load->view('project/element/footer1'); ?>
  </div>



</div>

<?php $this->load->view('project/element/footer'); ?>

</body>

</html>