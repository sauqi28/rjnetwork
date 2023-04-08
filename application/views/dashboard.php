<?php $this->load->view('project/element/header'); ?>
<?php $this->load->view('project/element/sidebar'); ?>

<div class="page-wrapper">
  <!-- <?php $this->load->view('data/user/navbar'); ?> -->



  <!-- 
  <script>
    window.onload = function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      Swal.fire({
        icon: 'success',
        title: 'Berhasil Login!',
        timer: 1500,
        timerProgressBar: true,


      })
    }
  </script> -->

  <?php
  echo $this->session->flashdata('success');
  ?>


</div>

<?php $this->load->view('project/element/footer'); ?>

</body>

</html>