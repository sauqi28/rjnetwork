     <!-- leftbar-tab-menu -->
     <div class="left-sidebar">
         <!-- LOGO -->
         <div class="brand">
             <a href="index.html" class="logo">
                 <span>
                     <img src="<?php echo base_url('assets/images/Logo_PLN.png'); ?>" width="50" height="70">
                 </span>
             </a>
         </div>
         <!-- <div class="sidebar-user-pro media border-end">
             <div class="position-relative mx-auto">
                 <img src="<?php echo base_url('assets/images/logos/fit.png'); ?>" alt="user" class="rounded-circle thumb-xs">
                 <span class="online-icon position-absolute end-0"><i class="mdi mdi-record text-success"></i></span>
             </div>
             <div class="media-body ms-2 user-detail align-self-center">
                 <h5 class="font-14 m-0 fw-bold"><?php echo $this->session->userdata('fullname'); ?></h5>
                 <p class="opacity-50 mb-0"><?php echo $this->session->userdata('fullname'); ?></p>
             </div>
         </div> -->


         <!--end logo-->
         <div class="menu-content h-100" data-simplebar>
             <div class="menu-body navbar-vertical">
                 <div class="collapse navbar-collapse tab-content" id="sidebarCollapse">

                     <!-- Navigation -->
                     <ul class="navbar-nav tab-pane active" id="Main" role="tabpanel">
                         <li class="menu-label mt-0 text-primary font-12 fw-semibold">P<span>engeluaran</span><br><span class="font-10 text-secondary fw-normal">Material</span></li>
                         <li class="nav-item">
                             <a class="nav-link" href="#sidebarAnalytics" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAnalytics">
                                 <i class="ti ti-stack menu-icon"></i>
                                 <span>Analytics</span>
                             </a>
                             <div class="collapse " id="sidebarAnalytics">
                                 <ul class="nav flex-column">
                                     <li class="nav-item">
                                         <a class="nav-link" href="<?php echo base_url('/dashboard'); ?>">Dashboard</a>
                                     </li><!--end nav-item-->
                                     <li class="nav-item">
                                         <a href="<?php echo base_url('/dashboard/report'); ?>" class="nav-link ">Report</a>
                                     </li><!--end nav-item-->

                                 </ul><!--end nav-->
                             </div><!--end sidebarAnalytics-->
                         </li><!--end nav-item-->
                         <li class="nav-item">
                             <a class="nav-link" href="<?php echo base_url('data_reksis'); ?>"><i class="ti ti-calendar menu-icon"></i><span>Reksis</span></a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#"><i class="ti ti-calendar menu-icon"></i><span>SPK</span></a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#"><i class="ti ti-calendar menu-icon"></i><span>Good Issue</span></a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#"><i class="ti ti-calendar menu-icon"></i><span>Surat Jalan</span></a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#"><i class="ti ti-calendar menu-icon"></i><span>Pemakaian Material</span></a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#"><i class="ti ti-calendar menu-icon"></i><span>Intracompany</span></a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#"><i class="ti ti-calendar menu-icon"></i><span>Retur</span></a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#"><i class="ti ti-calendar menu-icon"></i><span>Material Pinjam</span></a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#"><i class="ti ti-calendar menu-icon"></i><span>Material Retrofit</span></a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#"><i class="ti ti-calendar menu-icon"></i><span>Laporan Gangguan</span></a>
                         </li>



                         <li class="menu-label mt-0 text-primary font-12 fw-semibold">P<span>enerimaan</span><br><span class="font-10 text-secondary fw-normal">Material</span></li>
                         <li class="nav-item">
                         <li class="nav-item">
                             <a class="nav-link" href="#sidebarAnalytics" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAnalytics">
                                 <i class="ti ti-stack menu-icon"></i>
                                 <span>Penerimaan SAP</span>
                             </a>
                             <div class="collapse " id="sidebarAnalytics">
                                 <ul class="nav flex-column">
                                     <li class="nav-item">
                                         <a class="nav-link" href="<?php echo base_url('/penerimaan_sap_pengadaan'); ?>">Pengadaan</a>
                                     </li><!--end nav-item-->
                                     <li class="nav-item">
                                         <a href="<?php echo base_url('/penerimaan_sap_retur'); ?>" class="nav-link ">Retur Pekerjaan</a>
                                     </li><!--end nav-item-->
                                     <li class="nav-item">
                                         <a href="<?php echo base_url('/penerimaan_sap_intracompany'); ?>" class="nav-link ">Intracompany</a>
                                     </li><!--end nav-item-->

                                 </ul><!--end nav-->
                             </div><!--end sidebarAnalytics-->
                         </li><!--end nav-item-->
                         <li class="nav-item">
                             <a class="nav-link" href="<?php echo base_url('/penerimaan_marketplace'); ?>"><i class="ti ti-calendar menu-icon"></i><span>Penerimaan Marketplace</span></a>
                         </li>

                         <li class="menu-label mt-0 text-primary font-12 fw-semibold">M<span>aster</span><br><span class="font-10 text-secondary fw-normal">Data</span></li>
                         <li class="nav-item">
                             <?php if ($this->session->userdata('role') === 'Superadmin') : ?>
                         <li class="nav-item">
                             <a class="nav-link" href="#sidebarProjects" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProjects">
                                 <i class="ti ti-brand-asana menu-icon"></i>
                                 <span>Data</span>
                             </a>
                             <div class="collapse " id="sidebarProjects">

                                 <ul class="nav flex-column">
                                     <li class="nav-item">
                                         <a class="nav-link" href="<?php echo base_url('data_user'); ?>"><span>Pengguna</span></a>
                                     </li>
                                     <li class="nav-item">
                                         <a class="nav-link" href="<?php echo base_url('data_customer'); ?>"><span>Pelanggan</span></a>
                                     </li>
                                     <li class="nav-item">
                                         <a class="nav-link" href="<?php echo base_url('data_vendor'); ?>"><span>Vendor</span></a>
                                     </li>
                                     <li class="nav-item">
                                         <a class="nav-link" href="<?php echo base_url('data_material'); ?>"><span>Material</span></a>
                                     </li>


                                 </ul><!--end nav-->
                             </div><!--end sidebarProjects-->
                         </li><!--end nav-item-->

                         <li class="nav-item">
                             <a class="nav-link" href="#setting" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProjects">
                                 <i class="ti ti-brand-asana menu-icon"></i>
                                 <span>Pengaturan</span>
                             </a>
                             <div class="collapse " id="setting">

                                 <ul class="nav flex-column">

                                     <li class="nav-item">
                                         <a class="nav-link" href="projects-index.html">User Penerimaan</a>
                                     </li><!--end nav-item-->
                                     <li class="nav-item">
                                         <a class="nav-link" href="projects-clients.html">Lainnya</a>
                                     </li><!--end nav-item-->

                                 </ul><!--end nav-->
                             </div><!--end sidebarProjects-->
                         </li><!--end nav-item-->
                     <?php endif; ?>
                     </ul>

                 </div><!--end sidebarCollapse-->
             </div>
         </div>
     </div>
     <!-- end left-sidenav-->
     <!-- end leftbar-menu-->

     <!-- Top Bar Start -->
     <!-- Top Bar Start -->
     <div class="topbar">
         <!-- Navbar -->
         <nav class="navbar-custom" id="navbar-custom">
             <ul class="list-unstyled topbar-nav float-end mb-0">
                 <li class="dropdown">
                     <!-- <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                         <img src="<?php echo base_url('assets/images/flags/us_flag.jpg'); ?>" alt="" class="thumb-xxs rounded">
                     </a> -->
                     <div class="dropdown-menu">
                         <a class="dropdown-item" href="#"><img src="<?php echo base_url('assets/images/flags/us_flag.jpg'); ?>" alt="" height="15" class="me-2">English</a>
                         <a class="dropdown-item" href="#"><img src="<?php echo base_url('assets/images/flags/spain_flag.jpg'); ?>" alt="" height="15" class="me-2">Spanish</a>
                         <a class="dropdown-item" href="#"><img src="<?php echo base_url('assets/images/flags/germany_flag.jpg'); ?>" alt="" height="15" class="me-2">German</a>
                         <a class="dropdown-item" href="#"><img src="<?php echo base_url('assets/images/flags/french_flag.jpg'); ?>" alt="" height="15" class="me-2">French</a>
                     </div>
                 </li><!--end topbar-language-->

                 <li class="dropdown notification-list">
                     <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                         <i class="ti ti-mail"></i>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end dropdown-lg pt-0">

                         <h6 class="dropdown-item-text font-15 m-0 py-3 border-bottom d-flex justify-content-between align-items-center">
                             Emails <span class="badge bg-soft-primary badge-pill">3</span>
                         </h6>
                         <div class="notification-menu" data-simplebar>
                             <!-- item-->
                             <a href="#" class="dropdown-item py-3">
                                 <small class="float-end text-muted ps-2">2 min ago</small>
                                 <div class="media">
                                     <div class="avatar-md bg-soft-primary">
                                         <img src="<?php echo base_url('assets/images/users/user-1.jpg'); ?>" alt="" class="thumb-sm rounded-circle">
                                     </div>
                                     <div class="media-body align-self-center ms-2 text-truncate">
                                         <h6 class="my-0 fw-normal text-dark">Your order is placed</h6>
                                         <small class="text-muted mb-0">Dummy text of the printing and industry.</small>
                                     </div><!--end media-body-->
                                 </div><!--end media-->
                             </a><!--end-item-->
                             <!-- item-->
                             <a href="#" class="dropdown-item py-3">
                                 <small class="float-end text-muted ps-2">10 min ago</small>
                                 <div class="media">
                                     <div class="avatar-md bg-soft-primary">
                                         <img src="<?php echo base_url('assets/images/users/user-4.jpg'); ?>" alt="" class="thumb-sm rounded-circle">
                                     </div>
                                     <div class="media-body align-self-center ms-2 text-truncate">
                                         <h6 class="my-0 fw-normal text-dark">Meeting with designers</h6>
                                         <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                     </div><!--end media-body-->
                                 </div><!--end media-->
                             </a><!--end-item-->
                             <!-- item-->
                             <a href="#" class="dropdown-item py-3">
                                 <small class="float-end text-muted ps-2">40 min ago</small>
                                 <div class="media">
                                     <div class="avatar-md bg-soft-primary">
                                         <img src="<?php echo base_url('assets/images/users/user-2.jpg'); ?>" alt="" class="thumb-sm rounded-circle">
                                     </div>
                                     <div class="media-body align-self-center ms-2 text-truncate">
                                         <h6 class="my-0 fw-normal text-dark">UX 3 Task complete.</h6>
                                         <small class="text-muted mb-0">Dummy text of the printing.</small>
                                     </div><!--end media-body-->
                                 </div><!--end media-->
                             </a><!--end-item-->
                             <!-- item-->
                             <a href="#" class="dropdown-item py-3">
                                 <small class="float-end text-muted ps-2">1 hr ago</small>
                                 <div class="media">
                                     <div class="avatar-md bg-soft-primary">
                                         <img src="<?php echo base_url('assets/images/users/user-5.jpg'); ?>" alt="" class="thumb-sm rounded-circle">
                                     </div>
                                     <div class="media-body align-self-center ms-2 text-truncate">
                                         <h6 class="my-0 fw-normal text-dark">Your order is placed</h6>
                                         <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                     </div><!--end media-body-->
                                 </div><!--end media-->
                             </a><!--end-item-->
                             <!-- item-->
                             <a href="#" class="dropdown-item py-3">
                                 <small class="float-end text-muted ps-2">2 hrs ago</small>
                                 <div class="media">
                                     <div class="avatar-md bg-soft-primary">
                                         <img src="<?php echo base_url('assets/images/users/user-3.jpg'); ?>" alt="" class="thumb-sm rounded-circle">
                                     </div>
                                     <div class="media-body align-self-center ms-2 text-truncate">
                                         <h6 class="my-0 fw-normal text-dark">Payment Successfull</h6>
                                         <small class="text-muted mb-0">Dummy text of the printing.</small>
                                     </div><!--end media-body-->
                                 </div><!--end media-->
                             </a><!--end-item-->
                         </div>
                         <!-- All-->
                         <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                             View all <i class="fi-arrow-right"></i>
                         </a>
                     </div>
                 </li>

                 <li class="dropdown notification-list">
                     <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                         <i class="ti ti-bell"></i>
                         <span class="alert-badge"></span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end dropdown-lg pt-0">

                         <h6 class="dropdown-item-text font-15 m-0 py-3 border-bottom d-flex justify-content-between align-items-center">
                             Notifications <span class="badge bg-soft-primary badge-pill">2</span>
                         </h6>
                         <div class="notification-menu" data-simplebar>
                             <!-- item-->
                             <a href="#" class="dropdown-item py-3">
                                 <small class="float-end text-muted ps-2">2 min ago</small>
                                 <div class="media">
                                     <div class="avatar-md bg-soft-primary">
                                         <i class="ti ti-chart-arcs"></i>
                                     </div>
                                     <div class="media-body align-self-center ms-2 text-truncate">
                                         <h6 class="my-0 fw-normal text-dark">Your order is placed</h6>
                                         <small class="text-muted mb-0">Dummy text of the printing and industry.</small>
                                     </div><!--end media-body-->
                                 </div><!--end media-->
                             </a><!--end-item-->
                             <!-- item-->
                             <a href="#" class="dropdown-item py-3">
                                 <small class="float-end text-muted ps-2">10 min ago</small>
                                 <div class="media">
                                     <div class="avatar-md bg-soft-primary">
                                         <i class="ti ti-device-computer-camera"></i>
                                     </div>
                                     <div class="media-body align-self-center ms-2 text-truncate">
                                         <h6 class="my-0 fw-normal text-dark">Meeting with designers</h6>
                                         <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                     </div><!--end media-body-->
                                 </div><!--end media-->
                             </a><!--end-item-->
                             <!-- item-->
                             <a href="#" class="dropdown-item py-3">
                                 <small class="float-end text-muted ps-2">40 min ago</small>
                                 <div class="media">
                                     <div class="avatar-md bg-soft-primary">
                                         <i class="ti ti-diamond"></i>
                                     </div>
                                     <div class="media-body align-self-center ms-2 text-truncate">
                                         <h6 class="my-0 fw-normal text-dark">UX 3 Task complete.</h6>
                                         <small class="text-muted mb-0">Dummy text of the printing.</small>
                                     </div><!--end media-body-->
                                 </div><!--end media-->
                             </a><!--end-item-->
                             <!-- item-->
                             <a href="#" class="dropdown-item py-3">
                                 <small class="float-end text-muted ps-2">1 hr ago</small>
                                 <div class="media">
                                     <div class="avatar-md bg-soft-primary">
                                         <i class="ti ti-drone"></i>
                                     </div>
                                     <div class="media-body align-self-center ms-2 text-truncate">
                                         <h6 class="my-0 fw-normal text-dark">Your order is placed</h6>
                                         <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                     </div><!--end media-body-->
                                 </div><!--end media-->
                             </a><!--end-item-->
                             <!-- item-->
                             <a href="#" class="dropdown-item py-3">
                                 <small class="float-end text-muted ps-2">2 hrs ago</small>
                                 <div class="media">
                                     <div class="avatar-md bg-soft-primary">
                                         <i class="ti ti-users"></i>
                                     </div>
                                     <div class="media-body align-self-center ms-2 text-truncate">
                                         <h6 class="my-0 fw-normal text-dark">Payment Successfull</h6>
                                         <small class="text-muted mb-0">Dummy text of the printing.</small>
                                     </div><!--end media-body-->
                                 </div><!--end media-->
                             </a><!--end-item-->
                         </div>
                         <!-- All-->
                         <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                             View all <i class="fi-arrow-right"></i>
                         </a>
                     </div>
                 </li>

                 <li class="dropdown">
                     <a class="nav-link dropdown-toggle nav-user" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                         <div class="d-flex align-items-center">
                             <img src="<?php echo base_url('assets/images/logos/fit.png'); ?>" alt="profile-user" class="rounded-circle me-2 thumb-sm" />
                             <div>
                                 <small class="d-none d-md-block font-11">Admin</small>
                                 <span class="d-none d-md-block fw-semibold font-12">User <i class="mdi mdi-chevron-down"></i></span>
                             </div>
                         </div>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end">
                         <a class="dropdown-item" href="#"><i class="ti ti-user font-16 me-1 align-text-bottom"></i> Profile</a>
                         <a class="dropdown-item" href="#"><i class="ti ti-settings font-16 me-1 align-text-bottom"></i> Settings</a>
                         <div class="dropdown-divider mb-0"></div>
                         <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>"><i class="ti ti-power font-16 me-1 align-text-bottom"></i> Logout</a>
                     </div>
                 </li><!--end topbar-profile-->
                 <li class="notification-list">
                     <a class="nav-link arrow-none nav-icon offcanvas-btn" href="#" data-bs-toggle="offcanvas" data-bs-target="#Appearance" role="button" aria-controls="Rightbar">
                         <i class="ti ti-settings ti-spin"></i>
                     </a>
                 </li>
             </ul><!--end topbar-nav-->

             <ul class="list-unstyled topbar-nav mb-0">
                 <li>
                     <button class="nav-link button-menu-mobile nav-icon" id="togglemenu">
                         <i class="ti ti-menu-2"></i>
                     </button>
                 </li>
                 <li class="hide-phone app-search">
                     <!-- <form role="search" action="#" method="get">
                         <input type="search" name="search" class="form-control top-search mb-0" placeholder="Type text...">
                         <button type="submit"><i class="ti ti-search"></i></button>
                     </form> -->
                 </li>
             </ul>
         </nav>
         <!-- end navbar-->
     </div>
     <!-- Top Bar End -->
     <!-- Top Bar End -->