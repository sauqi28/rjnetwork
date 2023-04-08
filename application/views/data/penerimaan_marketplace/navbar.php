  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item ">
      <a class="nav-link mdi mdi-format-list-bulleted-type <?php if ($navbar == "penerimaan_marketplace") {
                                                              echo "active";
                                                            } ?>" href="<?php echo base_url('penerimaan_marketplace/'); ?>">Daftar Penerimaan Marketplace</a>
    </li>

    <li class="nav-item">
      <a class="nav-link mdi mdi-account-plus <?php if ($navbar == "penerimaan_marketplace_add") {
                                                echo "active";
                                              } ?>" href="<?php echo base_url('penerimaan_marketplace/create/'); ?>">Tambah Penerimaan</a>
    </li>

  </ul>