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


                    <?php $this->load->view('data/vendor/navbar'); ?>


                    <form class="d-flex" method="get" action="<?php echo base_url('data_vendor/index'); ?>">
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
                      <th>ID Vendor</th>
                      <th>Nama Vendor</th>
                      <th>Alamat Vendor</th>
                      <th>No Telp</th>
                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($users as $user) : ?>
                      <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo  $user['vendor_name']; ?></td>
                        <td><?php echo  $user['vendor_address']; ?></td>
                        <td><?php echo  $user['telp']; ?></td>

                        <td class="text-end">
                          <div class="button-items">
                            <button type="button" class="btn btn-xs btn-primary btn-icon-square-sm" onclick="goView('<?php echo $user['id']; ?>')"><i class="fas fa-eye"></i></button>
                            <button type="button" class="btn btn-xs btn-warning btn-icon-square-sm" onclick="goEdit('<?php echo $user['id']; ?>')"><i class="fas fa-edit"></i></button>


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
      function goEdit(var1) {
        window.location.href = '<?php echo base_url('data_vendor/edit/'); ?>' + var1;
      }

      function goView(var1) {
        window.location.href = '<?php echo base_url('data_vendor/view/'); ?>' + var1;
      }
    </script>


    <?php $this->load->view('project/element/footer1'); ?>
  </div>



</div>

<?php $this->load->view('project/element/footer'); ?>

</body>

</html>