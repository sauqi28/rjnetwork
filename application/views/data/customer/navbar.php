  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item ">
      <a class="nav-link mdi mdi-format-list-bulleted-type <?php if ($navbar == "data_customer") {
                                                              echo "active";
                                                            } ?>" href="<?php echo base_url('data_customer/'); ?>">Daftar Pelanggan</a>
    </li>

    <li class="nav-item ">
      <a class="nav-link mdi mdi-format-list-bulleted-type <?php if ($navbar == "data_category") {
                                                              echo "active";
                                                            } ?>" href="<?php echo base_url('data_customer/customer_category'); ?>">Kategori Pelanggan</a>
    </li>

    <li class="nav-item">
      <a class="nav-link mdi mdi-account-plus <?php if ($navbar == "data_customer_add") {
                                                echo "active";
                                              } ?>" href="<?php echo base_url('data_customer/create/'); ?>">Tambah Pelanggan</a>
    </li>
    <li class="nav-item">
      <a class="nav-link mdi mdi-file-upload <?php if ($navbar == "data_customer_import") {
                                                echo "active";
                                              } ?>" href="<?php echo base_url('data_customer/import_customer/'); ?>">Import Pelanggan</a>
    </li>
  </ul>