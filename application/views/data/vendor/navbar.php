  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item ">
      <a class="nav-link mdi mdi-format-list-bulleted-type <?php if ($navbar == "data_vendor") {
                                                              echo "active";
                                                            } ?>" href="<?php echo base_url('data_vendor/'); ?>">Daftar Vendor</a>
    </li>

    <li class="nav-item">
      <a class="nav-link mdi mdi-account-plus <?php if ($navbar == "data_vendor_add") {
                                                echo "active";
                                              } ?>" href="<?php echo base_url('data_vendor/create/'); ?>">Tambah Vendor</a>
    </li>
    <li class="nav-item">
      <a class="nav-link mdi mdi-file-upload <?php if ($navbar == "data_vendor_import") {
                                                echo "active";
                                              } ?>" href="<?php echo base_url('data_vendor/import_vendor/'); ?>">Import Vendor</a>
    </li>
  </ul>