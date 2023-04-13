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


                    <?php $this->load->view('data/penerimaan_sap_intracompany/navbar'); ?>



                  </div>
              </nav>
            </div>

            <!-- CONTENT -->

            <!-- CONTENT -->
            <?php if ($this->session->flashdata('message')) : ?>
              <script>
                window.onload = function() {
                  const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })
                  Swal.fire({
                    icon: '<?php echo $this->session->flashdata('status'); ?>',
                    title: '<?php echo $this->session->flashdata('message'); ?>',
                    timer: 1500,
                    timerProgressBar: true,
                  })
                }
              </script>
            <?php endif; ?>



            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">




                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="true">File TUG</a>
                    </li>

                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div class="tab-pane p-3 active" id="home" role="tabpanel">
                      <p class="mb-0 text-muted">
                      </p></br>
                      <?php if ($user['tug_unsigned_locked'] != 1) { ?>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card">
                              <div class="card-header">
                                <div class="row align-items-center">
                                  <div class="col">
                                    <h4 class="card-title">Upload Files</h4>
                                    <p class="text-muted mb-0">Upload file PDF untuk TUG 4, TUG 3 Karantina & TUG 3 Persediaan</p>
                                  </div><!--end col-->
                                </div> <!--end row-->
                              </div><!--end card-header-->
                              <form action="<?php echo base_url(); ?>penerimaan_sap_intracompany/upload_tug4" method="post" enctype="multipart/form-data"></br>
                                <div class="form-group">
                                  <label for="file_tug4">Upload TUG 4:</label>
                                  <div class="input-group">
                                    <input type="file" class="form-control-file" id="file_tug4" name="file" accept=".pdf" required>
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                    <input type="hidden" name="spk_number" value="<?php echo $user['spk_number']; ?>">
                                    <input type="hidden" name="key" value="<?php echo $user['key']; ?>">
                                    <button type="submit" class="btn btn-warning btn-sm">Upload</button>
                                  </div>
                                </div>
                              </form>

                              <form action="<?php echo base_url(); ?>penerimaan_sap_intracompany/upload_tug3k" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label for="file_tug3k">Upload TUG 3 Karantina:</label>
                                  <div class="input-group">
                                    <input type="file" class="form-control-file" id="file_tug3k" name="file" accept=".pdf" required>
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                    <input type="hidden" name="spk_number" value="<?php echo $user['spk_number']; ?>">
                                    <input type="hidden" name="key" value="<?php echo $user['key']; ?>">
                                    <button type="submit" class="btn btn-info btn-sm">Upload</button>
                                  </div>
                                </div>
                              </form>

                              <form action="<?php echo base_url(); ?>penerimaan_sap_intracompany/upload_tug3" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label for="file_tug3">Upload TUG 3 Persediaan:</label>
                                  <div class="input-group">
                                    <input type="file" class="form-control-file" id="file_tug3" name="file" accept=".pdf" required>
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                    <input type="hidden" name="spk_number" value="<?php echo $user['spk_number']; ?>">
                                    <input type="hidden" name="key" value="<?php echo $user['key']; ?>">
                                    <button type="submit" class="btn btn-success btn-sm">Upload</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>

                        </div> <?php } ?>




                      <style>
                        .table thead {
                          background-color: #FFFFFF;
                          /* warna putih */
                          font-weight: bold;
                          /* membuat header tabel tebal */
                        }

                        .table td,
                        .table th {
                          font-size: 12px;
                          padding: 5px;
                          font-family: 'Ubuntu', sans-serif;
                        }

                        .table tr:nth-child(odd) {
                          background-color: #FFFFFF;
                          /* warna abu-abu muda */
                        }

                        .table tr:nth-child(even) {
                          background-color: #F9F9F9;
                          /* warna abu-abu agak muda */
                        }

                        .table th {
                          text-align: left;
                        }
                      </style>
                      <?php if (!empty($user['tug4_unsigned_file']) or !empty($user['tug3_karantina_unsigned_file']) or !empty($user['tug3_unsigned_file'])) { ?>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card">
                              <div class="card-header">
                                <div class="row align-items-center">
                                  <div class="col">
                                    <h4 class="card-title">Daftar File Upload</h4>
                                    <p class="text-muted mb-0">Daftar file hasil upload TUG. <?php if ($user['tug_unsigned_locked'] == 1) { ?>
                                        <?php echo 'Sudah diverifikasi oleh ' . $user['fullname'] . ' Pada tanggal ' . $user['tug_unsigned_locked_update_formatted']; ?>
                                      <?php } ?></p>
                                  </div><!--end col-->
                                </div> <!--end row-->
                              </div><!--end card-header-->

                              <?php if ($user['tug_unsigned_locked'] == 1) { ?>

                                <div class="alert icon-custom-alert alert-outline-success alert-dismissible fade show" role="alert">
                                  <i class="mdi mdi-check-all alert-icon"></i>
                                  <div class="alert-text">
                                    <strong>Dokumen Asli</strong> Sudah di verifikasi
                                  </div>
                                </div>
                              <?php } else if ($user['tug_unsigned_locked'] == null || $user['tug_unsigned_locked'] == 0) { ?>
                                <div class="alert icon-custom-alert alert-outline-danger alert-dismissible fade show" role="alert">
                                  <i class="mdi mdi-check-all alert-icon"></i>
                                  <div class="alert-text">
                                    <strong>Penting!</strong> Lihat file setelah upload keseluruhan dan pastikan file sudah sesuai.
                                  </div>
                                </div>
                              <?php } ?>

                              <div class="table-responsive">
                                <table class="table table-bordered mb-0 table-centered">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Kategori File</th>
                                      <th>Nama File</th>
                                      <th>Tgl Upload</th>
                                      <th>Lihat File</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <tr>
                                      <td>1</td>
                                      <td>TUG 4</td>
                                      <td><i class="mdi <?php echo ($user['tug_unsigned_locked'] == 1) ? 'mdi-file-lock' : ''; ?>"></i>
                                        <?php echo $user['tug4_unsigned_file']; ?></td>
                                      <td><?php echo $user['tug4_unsigned_upload_time_formatted']; ?></td>
                                      <td>
                                        <div class=" button-items">
                                          <button type="button" class="btn btn-xs btn-primary btn-icon-square-sm" onclick="goView('<?php echo $user['key']; ?>')"><i class="fas fa-eye"></i></button>
                                        </div>

                                      </td>
                                    </tr>
                                    <tr>
                                      <td>2</td>
                                      <td>TUG 3 Karantina</td>
                                      <td><i class="mdi <?php echo ($user['tug_unsigned_locked'] == 1) ? 'mdi-file-lock' : ''; ?>"></i>
                                        <?php echo $user['tug3_karantina_unsigned_file']; ?></td>
                                      <td><?php echo $user['tug3_karantina_unsigned_upload_time_formatted']; ?></td>
                                      <td>
                                        <div class="button-items">
                                          <button type="button" class="btn btn-xs btn-primary btn-icon-square-sm" onclick="goView('<?php echo $user['key']; ?>')"><i class="fas fa-eye"></i></button>
                                        </div>

                                      </td>
                                    </tr>

                                    <tr>
                                      <td>3</td>
                                      <td>TUG 3 Persediaan</td>
                                      <td><i class="mdi <?php echo ($user['tug_unsigned_locked'] == 1) ? 'mdi-file-lock' : ''; ?>"></i>
                                        <?php echo $user['tug3_unsigned_file']; ?></td>
                                      <td><?php echo $user['tug3_unsigned_upload_time_formatted']; ?></td>
                                      <td>
                                        <div class="button-items">
                                          <button type="button" class="btn btn-xs btn-primary btn-icon-square-sm" onclick="goView('<?php echo $user['key']; ?>')"><i class="fas fa-eye"></i></button>
                                        </div>

                                      </td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td>

                                      </td>
                                      <td></td>
                                      <td></td>
                                      <td>

                                        <div class="button-items">
                                          <button type="button" class="btn btn-xs btn-success btn-icon-square-sm" onclick="goPdf('<?php echo $user['key']; ?>')"><i class="far fa-file-pdf"></i></button>
                                        </div>
                                      </td>
                                    </tr>

                                    <script>
                                      function goPdf(var1) {
                                        window.location.href = '<?php echo base_url('penerimaan_sap_intracompany/merge_document/'); ?>' + var1;
                                      }
                                    </script>

                                    <script>
                                      function goView(var1) {
                                        window.location.href = '<?php echo base_url('penerimaan_sap_intracompany/view_pdf/'); ?>' + var1;
                                      }
                                    </script>


                                  </tbody>
                                </table><!--end /table-->

                              </div><!--end /tableresponsive-->
                            </div>
                          </div>
                        </div>
                      <?php } ?>

                      <?php if (!empty($user['tug4_unsigned_file']) and !empty($user['tug3_karantina_unsigned_file']) and !empty($user['tug3_unsigned_file']) and $user['tug_unsigned_locked'] != 1) { ?>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card">
                              <div class="card-header">
                                <div class="row align-items-center">
                                  <div class="col">
                                    <h4 class="card-title">Verifikasi Berkas</h4>
                                    <p class="text-muted mb-0">Mengunci dokumen sebelum proses penandatanganan secara digital</p>
                                  </div><!--end col-->
                                </div> <!--end row-->
                              </div><!--end card-header-->
                              <div class="card-body">
                                <div class="button-items">
                                  <button type="button" class="mdi mdi-shield-lock-outline btn btn-success btn-square btn-outline-dashed" onclick="showConfirmation('<?php echo $user['key']; ?>')">Verifikasi Berkas</button>

                                  <script>
                                    function showConfirmation(var1) {
                                      Swal.fire({
                                        title: 'Yakin Seluruh Dokumen ',
                                        text: "akan Diverifikasi?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya, Verifikasi Dokumen'
                                      }).then(function(result) {
                                        if (result.isConfirmed) {
                                          window.location.href = '<?php echo base_url('penerimaan_sap_intracompany/verify/'); ?>' + var1;
                                        }
                                      });
                                    }
                                  </script>
                                </div>
                              </div><!--end card-body-->
                            </div><!--end card-->
                          </div><!--end col-->

                        </div><!--end row-->
                      <?php } ?>


                      <?php if ($user['tug_unsigned_locked'] == 1 and $user['tug_signed_request'] != 1) { ?>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card">
                              <div class="card-header">
                                <div class="row align-items-center">
                                  <div class="col">
                                    <h4 class="card-title">Ajukan Penandatanganan</h4>
                                    <p class="text-muted mb-0">Mengirimkan dokumen untuk ditandatangani secara digital ke user yang sudah ditetapkan</p>
                                  </div><!--end col-->
                                </div> <!--end row-->
                              </div><!--end card-header-->
                              <div class="card-body">
                                <div class="button-items">
                                  <button type="button" class="mdi mdi-grease-pencil btn btn-warning btn-square btn-outline-dashed" onclick="showConfirmationSign('<?php echo $user['key']; ?>')">Ajukan Penandatanganan</button>

                                  <script>
                                    function showConfirmationSign(var1) {
                                      Swal.fire({
                                        title: 'Dokumen TUG4, TUG 3 Karantina & Persediaan',
                                        text: "akan dikirimkan untuk ditandatangani secara digital",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Kirim Sekarang'
                                      }).then(function(result) {
                                        if (result.isConfirmed) {
                                          window.location.href = '<?php echo base_url('penerimaan_sap_intracompany/sign_document/'); ?>' + var1;
                                        }
                                      });
                                    }
                                  </script>
                                </div>
                              </div><!--end card-body-->
                            </div><!--end card-->
                          </div><!--end col-->

                        </div><!--end row-->
                      <?php } ?>

                      <?php if ($user['tug_signed_request'] == 1) { ?>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card">
                              <div class="card-header">
                                <div class="row align-items-center">
                                  <div class="col">
                                    <h4 class="card-title">Proses Penandatangan</h4>
                                    <p class="text-muted mb-0">Pemantauan proses penandatanganan dokumen</p>
                                  </div><!--end col-->
                                </div> <!--end row-->
                              </div><!--end card-header-->
                              <div class="card-body">
                                <div class="alert alert-success alert-dismissible fade show border-0 b-round" role="alert">
                                  <strong>Well done!</strong> 👍 Dokumen dalam proses penandatanganan oleh Approval secara sirkulir
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                              </div><!--end card-body-->
                            </div><!--end card-->
                          </div><!--end col-->

                        </div><!--end row-->
                      <?php } ?>


                      <?php if ($user['tug_unsigned_locked'] == 1 and $user['tug_signed_request'] != 1) { ?>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card">
                              <div class="card-header">
                                <div class="row align-items-center">
                                  <div class="col">
                                    <h4 class="card-title">Daftar Approval</h4>
                                    <p class="text-muted mb-0">Mohon pastikan approval sudah sesuai, apabila terdapat perubahan, dapat dilakukan pengaturan ke link <a href="#"> >>DISINI<< </a>sebelum melakukan pengajuan tandatangan</p>
                                  </div><!--end col-->
                                </div> <!--end row-->
                              </div><!--end card-header-->
                              <div class="card-body">
                                <div class="table-responsive">
                                  <table class="table table-bordered mb-0 table-centered">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Kategori File</th>
                                        <th>Nama Approval</th>
                                        <th>Keterangan</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                      <tr>
                                        <td>1</td>
                                        <td>TUG 4</td>
                                        <td><?php echo $tug4['u_sign_1_fullname']; ?></td>
                                        <td><?php echo $tug4['desc_sign_1']; ?></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $tug4['u_sign_2_fullname']; ?></td>
                                        <td><?php echo $tug4['desc_sign_2']; ?></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $tug4['u_sign_3_fullname']; ?></td>
                                        <td><?php echo $tug4['desc_sign_3']; ?></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $tug4['u_sign_4_fullname']; ?></td>
                                        <td><?php echo $tug4['desc_sign_4']; ?></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $tug4['u_sign_5_fullname']; ?></td>
                                        <td><?php echo $tug4['desc_sign_5']; ?></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $tug4['u_sign_6_fullname']; ?></td>
                                        <td><?php echo $tug4['desc_sign_6']; ?></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $tug4['u_sign_7_fullname']; ?></td>
                                        <td><?php echo $tug4['desc_sign_7']; ?></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $tug4['u_sign_8_fullname']; ?></td>
                                        <td><?php echo $tug4['desc_sign_8']; ?></td>
                                      </tr>
                                      </br>
                                      <tr>
                                        <td>2</td>
                                        <td>TUG 3 Karantina</td>
                                        <td><?php echo $tug3k['u_sign_1_fullname']; ?></td>
                                        <td><?php echo $tug3k['desc_sign_1']; ?></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $tug3k['u_sign_2_fullname']; ?></td>
                                        <td><?php echo $tug3k['desc_sign_2']; ?></td>
                                      </tr>

                                      </br>
                                      <tr>
                                        <td>3</td>
                                        <td>TUG 3 Persediaan</td>
                                        <td><?php echo $tug3['u_sign_1_fullname']; ?></td>
                                        <td><?php echo $tug3['desc_sign_1']; ?></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $tug3['u_sign_2_fullname']; ?></td>
                                        <td><?php echo $tug3['desc_sign_2']; ?></td>
                                      </tr>
                                      <script>
                                        function goView(var1) {
                                          window.location.href = '<?php echo base_url('penerimaan_sap_intracompany/view_pdf/'); ?>' + var1;
                                        }
                                      </script>


                                    </tbody>
                                  </table><!--end /table-->

                                </div><!--end /tableresponsive-->
                              </div><!--end card-body-->
                            </div><!--end card-->
                          </div><!--end col-->

                        </div><!--end row-->
                      <?php } ?>

                      <?php if ($user['tug_signed_request'] == 1) { ?>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card">
                              <div class="card-header">
                                <div class="row align-items-center">
                                  <div class="col">
                                    <h4 class="card-title">Monitoring Proses Approval</h4>
                                    <p class="text-muted mb-0">Pemantauan proses penandatanganan dokumen</p>
                                  </div><!--end col-->
                                </div> <!--end row-->
                              </div><!--end card-header-->
                              <div class="card-body">

                                <div class="task-box" id="#monitoring">
                                  <!-- <div class="task-priority-icon"><i class="fas fa-circle text-success"></i></div>
                                  <p class="text-muted float-end">
                                    <span class="text-muted">01:33</span> /
                                    <span class="text-muted">9:30</span>
                                    <span class="mx-1">·</span>
                                    <span><i class="far fa-fw fa-clock"></i> June 06</span>
                                  </p> -->
                                  <!-- <h5 class="mt-0">Organic Farming</h5>
                                  <p class="text-muted mb-1">There are many variations of passages of Lorem Ipsum available,
                                    but the majority have suffered alteration in some form.
                                  </p> -->
                                  <p class=" text-end mb-1"><?php echo number_format($percentage, 0); ?>% Complete</p>
                                  <div class="progress" style="height: 14px;">
                                    <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo number_format($percentage, 0); ?>%;" aria-valuenow="<?php echo number_format($percentage, 0); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  </br>
                                  <div class="table-responsive">
                                    <table class="table table-bordered mb-0 table-centered">
                                      <thead>
                                        <tr>
                                          <th>Dokumen</th>
                                          <th>Form</th>
                                          <th>Nama Approval</th>
                                          <th>Keterangan</th>
                                          <th>Urutan TTD</th>
                                          <th>Tgl Request</th>
                                          <th>Tgl Approve</th>
                                          <th>Status Approval</th>
                                          <th>Status Notifikasi</th>
                                          <th>Kirim Ulang</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach ($get_sign_data_tug4 as $row) : ?>
                                          <tr>
                                            <td><?php echo $row['desc']; ?></td>
                                            <td>
                                              <?php
                                              if ($row['form_name'] == 'tug4_penerimaan_sap_intracompany') {
                                                echo 'TUG 4 Berita Acara';
                                              } elseif ($row['form_name'] == 'tug3_karantina_sap_intracompany') {
                                                echo 'TUG 3 Karantina';
                                              } elseif ($row['form_name'] == 'tug3_persediaan_sap_intracompany') {
                                                echo 'TUG 3 Persediaan';
                                              } else {
                                                echo $row['form_name'];
                                              }
                                              ?>
                                            </td>
                                            <td><?php echo $row['fullname']; ?></td>
                                            <td><?php echo $row['keterangan']; ?></td>
                                            <td><?php echo "Ttd Ke " . $row['sequence']; ?></td>
                                            <td><?php echo $row['formatted_request_at']; ?></td>
                                            <td><?php echo $row['formatted_approved_time']; ?></td>
                                            <td>
                                              <?php if ($row['approved'] == 0) {
                                                $status = "";
                                                $color = "";
                                              } elseif ($row['approved'] == 1) {
                                                $status = "Disetujui";
                                                $color = "bg-success";
                                              } elseif ($row['approved'] == 2) {
                                                $status = "Ditolak";
                                                $color = "bg-warning";
                                              } elseif ($row['approved'] == 3) {
                                                $status = "Gagal Dikirim";
                                                $color = "bg-danger";
                                              } ?>

                                              <span class="badge rounded-pill <?php echo $color; ?>"><?php echo $status; ?></span>


                                            </td>
                                            <td>

                                              <?php if ($row['request_status'] == 0) {
                                                $judul = "Menunggu";
                                                $warna = "bg-secondary";
                                              } elseif ($row['request_status'] == 1) {
                                                $judul = "Dalam Antrian";
                                                $warna = "bg-info";
                                              } elseif ($row['request_status'] == 2) {
                                                $judul = "Terkirim";
                                                $warna = "bg-success";
                                              } elseif ($row['request_status'] == 3) {
                                                $judul = "Gagal Dikirim";
                                                $warna = "bg-danger";
                                              } ?>

                                              <span class="badge rounded-pill <?php echo $warna; ?>"><?php echo $judul; ?></span>

                                            </td>
                                            <td>
                                              <?php if ($row['approved'] != 1) { ?>
                                                <button type="button" class="btn btn-soft-<?php echo ($row['request_status'] == 0) ? 'danger' : 'success'; ?> btn-icon-circle btn-icon-circle-sm me-2 position-relative" onclick="confirmSendWA('<?php echo $row['token']; ?>')">
                                                  <?php echo ($row['request_status'] == 0) ? '<i class="fas fa-exclamation"></i>' : '<i class="mdi mdi-whatsapp"></i>'; ?>
                                                  <span class="badge badge-dot online d-flex align-items-center position-absolute end-0 top-50"></span>
                                                </button>
                                              <?php } else { ?><button type="button" class="btn btn-outline-success btn-icon-circle btn-icon-circle-sm" onclick="alert('Permintaan tidak dapat diproses, dikarenakan Dokumen Sudah Ditandatangani Oleh Bpk/Ibu. <?php echo $row['fullname']; ?> Sebagai <?php echo $row['keterangan']; ?>, Pada Tanggal <?php echo $row['approved_time']; ?> WIB')">
                                                  <i class="mdi mdi-check"></i>
                                                </button>
                                              <?php } ?>

                                              <script>
                                                function confirmSendWA(token) {
                                                  if (confirm('Kirim pesan WhatsApp ke User Ini?')) {
                                                    send_message(token);
                                                  }
                                                }
                                              </script>




                                            </td>
                                          </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                        </tr>

                                        <?php foreach ($get_sign_data_tug3k as $row) : ?>
                                          <tr>
                                            <td><?php echo $row['desc']; ?></td>
                                            <td>
                                              <?php
                                              if ($row['form_name'] == 'tug4_penerimaan_sap_intracompany') {
                                                echo 'TUG 4 Berita Acara';
                                              } elseif ($row['form_name'] == 'tug3_karantina_sap_intracompany') {
                                                echo 'TUG 3 Karantina';
                                              } elseif ($row['form_name'] == 'tug3_persediaan_sap_intracompany') {
                                                echo 'TUG 3 Persediaan';
                                              } else {
                                                echo $row['form_name'];
                                              }
                                              ?>
                                            </td>
                                            <td><?php echo $row['fullname']; ?></td>
                                            <td><?php echo $row['keterangan']; ?></td>
                                            <td><?php echo "Ttd Ke " . $row['sequence']; ?></td>
                                            <td><?php echo $row['formatted_request_at']; ?></td>
                                            <td><?php echo $row['formatted_approved_time']; ?></td>
                                            <td>
                                              <?php if ($row['approved'] == 0) {
                                                $status = "";
                                                $color = "";
                                              } elseif ($row['approved'] == 1) {
                                                $status = "Disetujui";
                                                $color = "bg-success";
                                              } elseif ($row['approved'] == 2) {
                                                $status = "Ditolak";
                                                $color = "bg-warning";
                                              } elseif ($row['approved'] == 3) {
                                                $status = "Gagal Dikirim";
                                                $color = "bg-danger";
                                              } ?>

                                              <span class="badge rounded-pill <?php echo $color; ?>"><?php echo $status; ?></span>


                                            </td>
                                            <td>

                                              <?php if ($row['request_status'] == 0) {
                                                $judul = "Menunggu";
                                                $warna = "bg-secondary";
                                              } elseif ($row['request_status'] == 1) {
                                                $judul = "Dalam Antrian";
                                                $warna = "bg-info";
                                              } elseif ($row['request_status'] == 2) {
                                                $judul = "Terkirim";
                                                $warna = "bg-success";
                                              } elseif ($row['request_status'] == 3) {
                                                $judul = "Gagal Dikirim";
                                                $warna = "bg-danger";
                                              } ?>

                                              <span class="badge rounded-pill <?php echo $warna; ?>"><?php echo $judul; ?></span>

                                            </td>
                                            <td>

                                              <?php if ($row['approved'] != 1) { ?>
                                                <button type="button" class="btn btn-soft-<?php echo ($row['request_status'] == 0) ? 'danger' : 'success'; ?> btn-icon-circle btn-icon-circle-sm me-2 position-relative" onclick="confirmSendWA('<?php echo $row['token']; ?>')">
                                                  <?php echo ($row['request_status'] == 0) ? '<i class="fas fa-exclamation"></i>' : '<i class="mdi mdi-whatsapp"></i>'; ?>
                                                  <span class="badge badge-dot online d-flex align-items-center position-absolute end-0 top-50"></span>
                                                </button>
                                              <?php } else { ?><button type="button" class="btn btn-outline-success btn-icon-circle btn-icon-circle-sm" onclick="alert('Permintaan tidak dapat diproses, dikarenakan Dokumen Sudah Ditandatangani Oleh Bpk/Ibu. <?php echo $row['fullname']; ?> Sebagai <?php echo $row['keterangan']; ?>, Pada Tanggal <?php echo $row['approved_time']; ?> WIB')">
                                                  <i class="mdi mdi-check"></i>
                                                </button>
                                              <?php } ?>

                                              <script>
                                                function confirmSendWA(token) {
                                                  if (confirm('Kirim pesan WhatsApp ke User Ini?')) {
                                                    send_message(token);
                                                  }
                                                }
                                              </script>




                                            </td>
                                          </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                        </tr>

                                        <?php foreach ($get_sign_data_tug3 as $row) : ?>
                                          <tr>
                                            <td><?php echo $row['desc']; ?></td>
                                            <td>
                                              <?php
                                              if ($row['form_name'] == 'tug4_penerimaan_sap_intracompany') {
                                                echo 'TUG 4 Berita Acara';
                                              } elseif ($row['form_name'] == 'tug3_karantina_sap_intracompany') {
                                                echo 'TUG 3 Karantina';
                                              } elseif ($row['form_name'] == 'tug3_persediaan_sap_intracompany') {
                                                echo 'TUG 3 Persediaan';
                                              } else {
                                                echo $row['form_name'];
                                              }
                                              ?>
                                            </td>
                                            <td><?php echo $row['fullname']; ?></td>
                                            <td><?php echo $row['keterangan']; ?></td>
                                            <td><?php echo "Ttd Ke " . $row['sequence']; ?></td>
                                            <td><?php echo $row['formatted_request_at']; ?></td>
                                            <td><?php echo $row['formatted_approved_time']; ?></td>
                                            <td>
                                              <?php if ($row['approved'] == 0) {
                                                $status = "";
                                                $color = "";
                                              } elseif ($row['approved'] == 1) {
                                                $status = "Disetujui";
                                                $color = "bg-success";
                                              } elseif ($row['approved'] == 2) {
                                                $status = "Ditolak";
                                                $color = "bg-warning";
                                              } elseif ($row['approved'] == 3) {
                                                $status = "Gagal Dikirim";
                                                $color = "bg-danger";
                                              } ?>

                                              <span class="badge rounded-pill <?php echo $color; ?>"><?php echo $status; ?></span>


                                            </td>
                                            <td>

                                              <?php if ($row['request_status'] == 0) {
                                                $judul = "Menunggu";
                                                $warna = "bg-secondary";
                                              } elseif ($row['request_status'] == 1) {
                                                $judul = "Dalam Antrian";
                                                $warna = "bg-info";
                                              } elseif ($row['request_status'] == 2) {
                                                $judul = "Terkirim";
                                                $warna = "bg-success";
                                              } elseif ($row['request_status'] == 3) {
                                                $judul = "Gagal Dikirim";
                                                $warna = "bg-danger";
                                              } ?>

                                              <span class="badge rounded-pill <?php echo $warna; ?>"><?php echo $judul; ?></span>

                                            </td>
                                            <td>

                                              <?php if ($row['approved'] != 1) { ?>
                                                <button type="button" class="btn btn-soft-<?php echo ($row['request_status'] == 0) ? 'danger' : 'success'; ?> btn-icon-circle btn-icon-circle-sm me-2 position-relative" onclick="confirmSendWA('<?php echo $row['token']; ?>')">
                                                  <?php echo ($row['request_status'] == 0) ? '<i class="fas fa-exclamation"></i>' : '<i class="mdi mdi-whatsapp"></i>'; ?>
                                                  <span class="badge badge-dot online d-flex align-items-center position-absolute end-0 top-50"></span>
                                                </button>
                                              <?php } else { ?><button type="button" class="btn btn-outline-success btn-icon-circle btn-icon-circle-sm" onclick="alert('Permintaan tidak dapat diproses, dikarenakan Dokumen Sudah Ditandatangani Oleh Bpk/Ibu. <?php echo $row['fullname']; ?> Sebagai <?php echo $row['keterangan']; ?>, Pada Tanggal <?php echo $row['approved_time']; ?> WIB')">
                                                  <i class="mdi mdi-check"></i>
                                                </button>
                                              <?php } ?>

                                              <script>
                                                function confirmSendWA(token) {
                                                  if (confirm('Kirim pesan WhatsApp ke User Ini?')) {
                                                    send_message(token);
                                                  }
                                                }
                                              </script>


                                              <script>
                                                function confirmSendWA(token) {
                                                  if (confirm('Kirim pesan WhatsApp ke User Ini?')) {
                                                    Swal.fire({
                                                      title: 'Loading...',
                                                      html: 'Sedang mengirim pesan WhatsApp. Mohon tunggu sebentar...',
                                                      allowOutsideClick: false,
                                                      allowEscapeKey: false,
                                                      onOpen: function() {
                                                        Swal.showLoading();
                                                      }
                                                    });
                                                    $.post("<?php echo base_url('penerimaan_sap_intracompany/send_message'); ?>", {
                                                      token: token,
                                                      <?php echo $this->security->get_csrf_token_name(); ?>: "<?php echo $this->security->get_csrf_hash(); ?>"
                                                    }, function(response) {
                                                      console.log(response.trim()) // Add this line to log the response
                                                      if (response == 'success') {
                                                        Swal.fire({
                                                          icon: 'success',
                                                          title: 'Berhasil dikirim',
                                                          text: 'Pesan sudah berhasil dikirimkan'
                                                        }).then((result) => {
                                                          if (result.isConfirmed) {
                                                            window.location.href = "<?php echo base_url('penerimaan_sap_intracompany/view/' . $this->uri->segment(3)); ?>";
                                                          }
                                                        });
                                                      } else {
                                                        Swal.fire({
                                                          icon: 'error',
                                                          title: 'Gagal dikirim',
                                                          text: 'Terjadi kesalahan saat mengirim pesan WhatsApp.'
                                                        });
                                                      }
                                                    });
                                                  }
                                                }
                                              </script>







                                            </td>
                                          </tr>
                                        <?php endforeach; ?>


                                      </tbody>

                                    </table><!--end /table-->
                                  </div><!--end task-box-->
                                  <!-- <script>
                                    function send_message(token) {
                                      $.ajax({
                                        url: "<?php echo base_url('penerimaan_sap_intracompany/send_message'); ?>",
                                        type: "POST",
                                        data: {
                                          token: token,
                                          <?php echo $this->security->get_csrf_token_name(); ?>: "<?php echo $this->security->get_csrf_hash(); ?>"
                                        },
                                        success: function(response) {
                                          // Redirect ke halaman view
                                          window.location.href = "<?php echo base_url('penerimaan_sap_intracompany/view/' . $this->uri->segment(3)); ?>";
                                        },
                                        error: function() {
                                          // alert("Terjadi kesalahan saat mengirim pesan WhatsApp.");
                                          window.location.href = "<?php echo base_url('penerimaan_sap_intracompany/view/' . $this->uri->segment(3)); ?>";
                                        }
                                      });
                                    }
                                  </script> -->



                                </div><!--end card-->
                              </div><!--end col-->

                            </div><!--end row-->
                          </div><!--end row-->
                        </div><!--end row-->
                      <?php } ?>




                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>


      <script>
        function goEdit(var1) {
          window.location.href = '<?php echo base_url('penerimaan_sap_intracompany/edit/'); ?>' + var1;
        }
      </script>


      <?php $this->load->view('project/element/footer1'); ?>
    </div>



  </div>

  <?php $this->load->view('project/element/footer'); ?>

  </body>

  </html>