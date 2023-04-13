<?php $this->load->view('project/element/header'); ?>
<?php $this->load->view('project/element/sidebar'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>


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


                    <?php $this->load->view('data/penerimaan_sap/navbar'); ?>



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
                    timer: 1000,
                    timerProgressBar: false,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })
                  Swal.fire({
                    icon: '<?php echo $this->session->flashdata('status'); ?>',
                    title: '<?php echo $this->session->flashdata('message'); ?>',
                    timer: 1000,
                    timerProgressBar: false,
                  })
                }
              </script>
            <?php endif; ?>



            <div class="card-body">




              <div class="row">
                <div class="col-lg-6">


                  <form action="<?= site_url('penerimaan_sap_return/create'); ?>" method="post">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                    <div class="mb-3 row">
                      <label for="spk_number" class="col-sm-2 col-form-label text-end">No SPK</label>
                      <div class="col-sm-10">
                        <input class="form-control <?php echo (form_error('spk_number') != "") ? 'is-invalid' : ''; ?>" type="text" name="spk_number" required value="<?= set_value('spk_number'); ?>" id="spk_number" autocomplete="off">
                        <?php echo form_error('spk_number', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="pabrikan" class="col-sm-2 col-form-label text-end">Pabrikan</label>
                      <div class="col-sm-10">
                        <input class="form-control <?php echo (form_error('pabrikan') != "") ? 'is-invalid' : ''; ?>" type="text" name="pabrikan" required value="<?= set_value('pabrikan'); ?>" id="pabrikan" autocomplete="off">
                        <?php echo form_error('pabrikan', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="material" class="col-sm-2 col-form-label text-end">Material</label>
                      <div class="col-sm-10">
                        <input class="form-control <?php echo (form_error('material') != "") ? 'is-invalid' : ''; ?>" type="text" name="material" required value="<?= set_value('material'); ?>" id="material" autocomplete="off">
                        <?php echo form_error('material', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <label for="tgl_penerimaan" class="col-sm-2 col-form-label text-end">Tgl Penerimaan</label>
                      <div class="col-sm-10">
                        <input class="form-control <?php echo (form_error('tgl_penerimaan') != "") ? 'is-invalid' : ''; ?>" type="text" name="tgl_penerimaan" required value="<?= set_value('tgl_penerimaan'); ?>" id="tgl_penerimaan" autocomplete="off">
                        <?php echo form_error('tgl_penerimaan', '<div class="invalid-feedback">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <div class="col-sm-10 offset-sm-2">
                        <input type="submit" value="Tambah Penerimaan" class="btn btn-primary">
                      </div>
                    </div>
                  </form>


                </div>
              </div>

              </br>

            </div>

            <!-- END OF CONTENT -->
          </div>
        </div>
      </div>

    </div>

    <script>
      $(document).ready(function() {
        // tangkap elemen label dan dropdown "Kategori User" dan "Pilih Vendor"
        var kategoriLabel = $('label[for="kategori"]');
        var kategoriDropdown = $('#kategori');
        var pilihVendorLabel = $('label[for="pilihvendor"]');
        var pilihVendorDropdown = $('#pilihvendor');

        // sembunyikan label dan dropdown "Pilih Vendor"
        pilihVendorLabel.hide();
        pilihVendorDropdown.hide();

        // ketika terjadi perubahan pada dropdown "Kategori User"
        kategoriDropdown.change(function() {
          // jika "External" dipilih
          if (kategoriDropdown.val() == 2) {
            // kirim permintaan AJAX untuk mendapatkan data pilihan vendor
            $.ajax({
              url: '<?= base_url('data_user/get_vendor_options'); ?>', // ganti dengan URL file PHP yang mengembalikan data pilihan vendor
              method: 'POST',
              data: {
                kategori: kategoriDropdown.val(), // kirim nilai kategori user yang dipilih
                <?= $this->security->get_csrf_token_name(); ?>: '<?= $this->security->get_csrf_hash(); ?>' // tambahkan CSRF token
              },
              dataType: 'json',
              success: function(data) {
                // kosongkan dropdown pilihan vendor
                pilihVendorDropdown.empty();

                // tambahkan pilihan vendor ke dropdown
                $.each(data, function(index, option) {
                  pilihVendorDropdown.append($('<option>').val(option.id).text(option.name));
                });

                // tampilkan label dan dropdown "Pilih Vendor"
                pilihVendorLabel.show();
                pilihVendorDropdown.show();
              }
            });
          } else {
            // jika kategori selain "External" dipilih, kosongkan dan sembunyikan label dan dropdown "Pilih Vendor"
            pilihVendorDropdown.empty().hide();
            pilihVendorLabel.hide();
          }
        });
      });
    </script>





    <?php $this->load->view('project/element/footer1'); ?>
  </div>



</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var datepickerElement = document.getElementById('tgl_penerimaan');

    var picker = new Pikaday({
      field: datepickerElement,
      format: 'DD/MM/YYYY',
      i18n: {
        previousMonth: 'Bulan Sebelumnya',
        nextMonth: 'Bulan Berikutnya',
        months: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        weekdays: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        weekdaysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab']
      },
      toString: function(date, format) {
        return moment(date).format(format);
      },
      parse: function(dateString, format) {
        return moment(dateString, format).toDate();
      }
    });
  });
</script>

<?php $this->load->view('project/element/footer'); ?>

</body>

</html>