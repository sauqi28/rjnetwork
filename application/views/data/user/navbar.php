  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item ">
      <a class="nav-link mdi mdi-format-list-bulleted-type <?php if ($navbar == "data_user") {
                                                              echo "active";
                                                            } ?>" href="<?php echo base_url('data_user/'); ?>">Daftar User Aktif</a>
    </li>
    <li class="nav-item ">
      <a class="nav-link mdi mdi-format-list-bulleted-type <?php if ($navbar == "data_user_nonaktif") {
                                                              echo "active";
                                                            } ?>" href="<?php echo base_url('data_user/non_aktif'); ?>">Daftar User Non Aktif</a>
    </li>
    <li class="nav-item">
      <a class="nav-link mdi mdi-account-plus <?php if ($navbar == "data_user_add") {
                                                echo "active";
                                              } ?>" href="<?php echo base_url('data_user/create/'); ?>">Tambah User</a>
    </li>

  </ul>