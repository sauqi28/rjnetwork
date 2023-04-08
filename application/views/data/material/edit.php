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


                    <?php $this->load->view('data/material/navbar'); ?>



                  </div>
              </nav>
            </div>

            <!-- CONTENT -->




            <div class="card-body">

              <div class="row">
                <div class="col-lg-6">
                  <form action="<?= site_url('data_material/edit/' . $user['id']); ?>" method="post">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="mb-3 row">
                      <label for="id" class="col-sm-2 col-form-label text-end">ID Material (System)</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('id') != "") ? 'is-invalid' : ''; ?>" type="text" name="id" value="<?= set_value('id', $user['id']); ?>" id="id" disabled>
                        <?php echo form_error('id', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="material_number" class="col-sm-2 col-form-label text-end">Material Number</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('material_number') != "") ? 'is-invalid' : ''; ?>" type="text" name="material_number" value="<?= set_value('material_number', $user['material_number']); ?>" id="material_number">
                        <?php echo form_error('material_number', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="material_description" class="col-sm-2 col-form-label text-end">Material Desc</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('material_description') != "") ? 'is-invalid' : ''; ?>" type="text" name="material_description" value="<?= set_value('material_description', $user['material_description']); ?>" id="material_description">
                        <?php echo form_error('material_description', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="company_code" class="col-sm-2 col-form-label text-end">Company Code</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('company_code') != "") ? 'is-invalid' : ''; ?>" type="text" name="company_code" value="<?= set_value('company_code', $user['company_code']); ?>" id="company_code">
                        <?php echo form_error('company_code', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="plant" class="col-sm-2 col-form-label text-end">Plant</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('plant') != "") ? 'is-invalid' : ''; ?>" type="text" name="plant" value="<?= set_value('plant', $user['plant']); ?>" id="plant">
                        <?php echo form_error('plant', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="storage_location" class="col-sm-2 col-form-label text-end">Storage Location</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('storage_location') != "") ? 'is-invalid' : ''; ?>" type="text" name="storage_location" value="<?= set_value('storage_location', $user['storage_location']); ?>" id="storage_location">
                        <?php echo form_error('storage_location', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="material_type" class="col-sm-2 col-form-label text-end">Material Type</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('material_type') != "") ? 'is-invalid' : ''; ?>" type="text" name="material_type" value="<?= set_value('material_type', $user['material_type']); ?>" id="material_type">
                        <?php echo form_error('material_type', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>



                    <div class="mb-3 row">
                      <label for="material_group" class="col-sm-2 col-form-label text-end">Material Group</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('material_group') != "") ? 'is-invalid' : ''; ?>" type="text" name="material_group" value="<?= set_value('material_group', $user['material_group']); ?>" id="material_group">
                        <?php echo form_error('material_group', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="base_unit_of_measure" class="col-sm-2 col-form-label text-end">UOM</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('base_unit_of_measure') != "") ? 'is-invalid' : ''; ?>" type="text" name="base_unit_of_measure" value="<?= set_value('base_unit_of_measure', $user['base_unit_of_measure']); ?>" id="base_unit_of_measure">
                        <?php echo form_error('base_unit_of_measure', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="valuation_type" class="col-sm-2 col-form-label text-end">Valuation Type</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('valuation_type') != "") ? 'is-invalid' : ''; ?>" type="text" name="valuation_type" value="<?= set_value('valuation_type', $user['valuation_type']); ?>" id="valuation_type">
                        <?php echo form_error('valuation_type', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="valuation_class" class="col-sm-2 col-form-label text-end">Valuation Class</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('valuation_class') != "") ? 'is-invalid' : ''; ?>" type="text" name="valuation_class" value="<?= set_value('valuation_class', $user['valuation_class']); ?>" id="valuation_class">
                        <?php echo form_error('valuation_class', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="unrestricted_use_stock" class="col-sm-2 col-form-label text-end">unrestricted use stock</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('unrestricted_use_stock') != "") ? 'is-invalid' : ''; ?>" type="text" name="unrestricted_use_stock" value="<?= set_value('unrestricted_use_stock', $user['unrestricted_use_stock']); ?>" id="unrestricted_use_stock">
                        <?php echo form_error('unrestricted_use_stock', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="quality_inspection_stock" class="col-sm-2 col-form-label text-end">Quality Inspection Stock</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('quality_inspection_stock') != "") ? 'is-invalid' : ''; ?>" type="text" name="quality_inspection_stock" value="<?= set_value('quality_inspection_stock', $user['quality_inspection_stock']); ?>" id="quality_inspection_stock">
                        <?php echo form_error('quality_inspection_stock', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="blocked_stock" class="col-sm-2 col-form-label text-end">Blocket Stock</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('blocked_stock') != "") ? 'is-invalid' : ''; ?>" type="text" name="blocked_stock" value="<?= set_value('blocked_stock', $user['blocked_stock']); ?>" id="blocked_stock">
                        <?php echo form_error('blocked_stock', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>


                    <div class="mb-3 row">
                      <label for="in_transit_stock" class="col-sm-2 col-form-label text-end">InTransit Stock</label>
                      <div class="col-sm-10">
                        <input placeholder="" class="form-control <?php echo (form_error('in_transit_stock') != "") ? 'is-invalid' : ''; ?>" type="text" name="in_transit_stock" value="<?= set_value('in_transit_stock', $user['in_transit_stock']); ?>" id="in_transit_stock">
                        <?php echo form_error('in_transit_stock', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>




                    <div class="mb-3 row">
                      <div class="col-sm-10 offset-sm-2">
                        <input type="submit" value="Update Material" class="btn btn-primary">
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