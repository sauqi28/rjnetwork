<?php $this->load->view('project/element/header'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        <!--end col--->
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


                    <?php $this->load->view('data/penerimaan_sap_return/navbar'); ?>


                    <form class="d-flex" method="get" action="<?php echo base_url('penerimaan_sap_return/index'); ?>">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2" name="search" value="<?php echo $this->input->get('search'); ?>" autofocus id="search-input">
                        <button class="btn btn-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                      </div>
                    </form>
                    <script>
                      function moveCursorToPosition(el, pos) {
                        el.selectionStart = el.selectionEnd = pos;
                        el.focus();
                      }
                      document.addEventListener("DOMContentLoaded", function() {
                        const searchInput = document.getElementById("search-input");
                        moveCursorToPosition(searchInput, searchInput.value.length);
                      });
                    </script>
                  </div>
              </nav>
            </div>

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
              <div class="table-responsive">
                <table class="table table-bordered mb-0 table-centered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No SPK</th>
                      <th>Pabrikan</th>
                      <th>Material</th>
                      <th>Tgl Penerimaan</th>
                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($users as $user) : ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $user['spk_number']; ?></td>
                        <td><?php echo $user['pabrikan']; ?></td>
                        <td><?php echo $user['material']; ?></td>
                        <td><?php echo $user['tgl_penerimaan']; ?></td>




                        <td class="text-end">
                          <div class="button-items">
                            <button type="button" class="btn btn-xs btn-primary btn-icon-square-sm" onclick="goView('<?php echo $user['key']; ?>')"><i class="fas fa-eye"></i></button>
                            <button type="button" class="btn btn-xs btn-warning btn-icon-square-sm" onclick="goEdit('<?php echo $user['key']; ?>')"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-xs btn-danger btn-icon-square-sm" onclick="showConfirmation('<?php echo $user['key']; ?>','<?php echo $user['spk_number']; ?>')"><i class="fas fa-exclamation"></i></button>



                          </div>
                        </td>

                      </tr>
                    <?php endforeach; ?>



                  </tbody>
                </table><!--end /table-->

              </div><!--end /tableresponsive-->
              </br>
              <?php echo $pagination; ?>

            </div>

            <!-- END OF CONTENT -->
          </div>
        </div>
      </div>

    </div>
    <script>
      function showConfirmation(var1, var2) {
        Swal.fire({
          title: 'Penerimaan Marketplace SPK: ' + var2,
          text: "akan dihapus?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus SPK!'
        }).then(function(result) {
          if (result.isConfirmed) {
            window.location.href = '<?php echo base_url('penerimaan_sap_return/update_status/1/'); ?>' + var1;
          }
        });
      }

      function goEdit(var1) {
        window.location.href = '<?php echo base_url('penerimaan_sap_return/edit/'); ?>' + var1;
      }

      function goView(var1) {
        window.location.href = '<?php echo base_url('penerimaan_sap_return/view/'); ?>' + var1;
      }
    </script>



    <?php $this->load->view('project/element/footer1'); ?>
  </div>



</div>

<?php $this->load->view('project/element/footer'); ?>

</body>

</html>