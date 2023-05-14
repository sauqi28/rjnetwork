  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item ">
      <a class="nav-link mdi mdi-format-list-bulleted-type <?php if ($navbar == "monitor/index") {
                                                              echo "active";
                                                            } ?>" href="<?php echo base_url('monitor/index'); ?>">Daftar User</a>
    </li>
    <li class="nav-item ">
      <a class="nav-link mdi mdi-format-list-bulleted-type <?php if ($navbar == "monitor/nonaktif") {
                                                              echo "active";
                                                            } ?>" href="<?php echo base_url('monitor/nonaktif'); ?>">Daftar User Non Aktif</a>
    </li>


  </ul>