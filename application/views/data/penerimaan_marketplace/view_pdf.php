<?php $this->load->view('project/element/header'); ?>
<?php $this->load->view('project/element/sidebar'); ?>
<style>
  #pdf-viewer {
    width: 100%;
    height: 90vh;
  }
</style>



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

              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $_SERVER['HTTP_REFERER']; ?>" aria-selected="false">
                    <<< Back </a>

                </li>
                <li class="nav-item">
                  <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="true">TUG 4</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab" aria-selected="false">TUG 3 Karantina</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#settings" role="tab" aria-selected="false">TUG 3 Persediaan</a>
                </li>

              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane p-3 active" id="home" role="tabpanel">

                  <div class="alert icon-custom-alert alert-outline-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all alert-icon"></i>
                    <div class="alert-text">
                      <strong>Info!</strong> Berikut adalah tampilan file asli dan belum dilakukan pembubuhan tandatangan secara sirkulir, pastikan file yang diupload sudah sesuai
                    </div>

                  </div>

                  <div id="pdf-viewer">
                    <object data="<?php echo $pdf_file_tug4; ?>" type="application/pdf" width="100%" height="100%">
                      <p>Browser anda tidak mendukung PDF Viewer. Silahkan download PDF file di <a href="<?php echo $pdf_file_tug4; ?>">link ini</a>.</p>
                    </object>
                    <!-- <iframe id="pdf-viewer" src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= urlencode(($pdf_file_tug4)); ?>" frameborder="0"></iframe> -->
                  </div>
                </div>
                <div class="tab-pane p-3" id="profile" role="tabpanel">
                  <div class="alert icon-custom-alert alert-outline-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all alert-icon"></i>
                    <div class="alert-text">
                      <strong>Info!</strong> Berikut adalah tampilan file asli dan belum dilakukan pembubuhan tandatangan secara sirkulir, pastikan file yang diupload sudah sesuai
                    </div>

                  </div>
                  <div id="pdf-viewer">
                    <object data="<?php echo $pdf_file_tug3k; ?>" type="application/pdf" width="100%" height="100%">
                      <p>Browser anda tidak mendukung PDF Viewer. Silahkan download PDF file di <a href="<?php echo $pdf_file_tug3k; ?>">link ini</a>.</p>
                    </object>
                    <!-- <iframe id="pdf-viewer" src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= urlencode(($pdf_file_tug3k)); ?>" frameborder="0"></iframe> -->
                  </div>
                </div>
                <div class="tab-pane p-3" id="settings" role="tabpanel">
                  <div class="alert icon-custom-alert alert-outline-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all alert-icon"></i>
                    <div class="alert-text">
                      <strong>Info!</strong> Berikut adalah tampilan file asli dan belum dilakukan pembubuhan tandatangan secara sirkulir, pastikan file yang diupload sudah sesuai
                    </div>

                  </div>
                  <div id="pdf-viewer">
                    <object data="<?php echo $pdf_file_tug3; ?>" type="application/pdf" width="100%" height="100%">
                      <p>Browser anda tidak mendukung PDF Viewer. Silahkan download PDF file di <a href="<?php echo $pdf_file_tug3; ?>">link ini</a>.</p>
                    </object>
                    <!-- <iframe id="pdf-viewer" src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= urlencode(($pdf_file_tug3)); ?>" frameborder="0"></iframe> -->
                  </div>
                </div>

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