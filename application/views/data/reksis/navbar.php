  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item ">
      <a class="nav-link mdi mdi-format-list-bulleted-type <?php if ($navbar == "data_material") {
                                                              echo "active";
                                                            } ?>" href="<?php echo base_url('data_reksis/'); ?>">Daftar Reksis</a>
    </li>

    <li class="nav-item">
      <a class="nav-link mdi mdi-account-plus <?php if ($navbar == "data_material_add") {
                                                echo "active";
                                              } ?>" href="<?php echo base_url('data_reksis/create/'); ?>">Tambah Reksis</a>
    </li>
    <li class="nav-item">
      <a class="nav-link mdi mdi-file-upload <?php if ($navbar == "data_material_import") {
                                                echo "active";
                                              } ?>" href="<?php echo base_url('data_reksis/import_material/'); ?>">Import Reksis</a>
    </li>




  </ul>