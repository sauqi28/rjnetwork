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


                    <?php $this->load->view('data/material/navbar'); ?>



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
                      <label for="id" class="col-sm-2 col-form-label text-end">ID Material</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="id" value="<?= $user['id'] ?>" id="id" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="material_number" class="col-sm-2 col-form-label text-end">Material Number</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="id" value="<?= $user['material_number'] ?>" id="material_number" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="material_description" class="col-sm-2 col-form-label text-end">Material Desc</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="material_description" value="<?= $user['material_description'] ?>" id="material_description" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="company_code" class="col-sm-2 col-form-label text-end">Company Code</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="company_code" value="<?= $user['company_code'] ?>" id="company_code" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="plant" class="col-sm-2 col-form-label text-end">Plant</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="plant" value="<?= $user['plant'] ?>" id="plant" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="material_description" class="col-sm-2 col-form-label text-end">Storage Location</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="storage_location" value="<?= $user['storage_location'] ?>" id="storage_location" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="material_type" class="col-sm-2 col-form-label text-end">Material Type</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="material_type" value="<?= $user['material_type'] ?>" id="material_type" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="material_group" class="col-sm-2 col-form-label text-end">Material Group</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="material_group" value="<?= $user['material_group'] ?>" id="material_group" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="base_unit_of_measure" class="col-sm-2 col-form-label text-end">UOM</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="base_unit_of_measure" value="<?= $user['base_unit_of_measure'] ?>" id="base_unit_of_measure" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="valuation_type" class="col-sm-2 col-form-label text-end">Valuation Type</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="valuation_type" value="<?= $user['valuation_type'] ?>" id="valuation_type" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="valuation_class" class="col-sm-2 col-form-label text-end">Valuation Class</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="valuation_class" value="<?= $user['valuation_class'] ?>" id="valuation_class" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="unrestricted_use_stock" class="col-sm-2 col-form-label text-end">Unrestricted Use Stock</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="number" name="unrestricted_use_stock" value="<?= $user['unrestricted_use_stock'] ?>" id="unrestricted_use_stock" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="quality_inspection_stock" class="col-sm-2 col-form-label text-end">Quality Inspection Stock</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="number" name="quality_inspection_stock" value="<?= $user['quality_inspection_stock'] ?>" id="quality_inspection_stock" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="blocked_stock" class="col-sm-2 col-form-label text-end">Blocked Stock</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="number" name="blocked_stock" value="<?= $user['blocked_stock'] ?>" id="blocked_stock" disabled>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="in_transit_stock" class="col-sm-2 col-form-label text-end">Intransit Stock</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="number" name="in_transit_stock" value="<?= $user['in_transit_stock'] ?>" id="in_transit_stock" disabled>
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
          window.location.href = '<?php echo base_url('data_material/edit/'); ?>' + var1;
        }
      </script>


      <?php $this->load->view('project/element/footer1'); ?>
    </div>



  </div>

  <?php $this->load->view('project/element/footer'); ?>

  </body>

  </html>