<!DOCTYPE html>
<html>

<head>
  <title>Signature Pad</title>
  <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/app.min.css'); ?>" rel="stylesheet" type="text/css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
      text-align: center;
    }

    canvas {
      border: 3px solid #ccc;
    }

    button {
      margin-top: 10px;
      padding: 10px;
      font-size: 16px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }

    button:hover {
      background-color: #3e8e41;
    }

    #clear {
      background-color: #f44336;
    }

    #clear:hover {
      background-color: #d32f2f;
    }

    h1 {
      font-size: 24px;
      margin-top: 30px;
      margin-bottom: 10px;
    }

    p {
      font-size: 16px;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>

  <div class="container">

    <div class="card">
      <div class="card-body p-0 ">
        <div class="text-center p-3">
          <a href="index.html" class="logo logo-admin">
            <img src="<?php echo base_url('assets/images/pln-logo1.png'); ?>" height="50" alt="logo" class="auth-logo">
          </a>
          <h4 class="mt-3 mb-1 fw-semibold text-dark font-18">Spesimen E-Signature,</h4>
          <p class="text-muted  mb-0">Untuk pembubuhan dokumen approval,</p>
        </div>
      </div>
      <div class="card-body">
        <div class="ex-page-content text-center">
          <p>Nama: <?php echo $user->fullname; ?></p>
          <p>Token: <?php echo $user->wa_token; ?></p>
        </div>
        <div class="alert alert-info border-0" role="alert">
          <strong>Pastikan!</strong> Tandatangan tidak melebihi baris dan maksimalkan pada area yang tersedia. Tandatangan ini akan digunakan secara otomatis ketika melakukan approval dokumen.
        </div>

      </div><!--end card-body-->

      <canvas id="signature-pad" width="1000" height="600"></canvas>

      <div>
        <button id="clear">Clear Signature</button>
        <button id="save">Save Signature</button>
      </div><br />
      <div class="card-body bg-light-alt text-center">
        &copy; <script>
          document.write(new Date().getFullYear())
        </script> PT PLN (Persero) UP3 Teluk Naga
      </div><!--end card-body-->
    </div><!--end card-->



  </div>

  <script>
    $(document).ready(function() {
      const canvas = document.getElementById('signature-pad');
      const signaturePad = new SignaturePad(canvas, {
        penColor: 'rgb(0, 0, 0)', // warna hitam
        minWidth: 3, // ketebalan minimal 3
        velocityFilterWeight: 0.7 // kecepatan filter saat menggambar
      });

      $('#save').on('click', function() {
        const dataURL = signaturePad.toDataURL();
        const formData = new FormData();
        formData.append('signature', dataURL);
        formData.append('id', <?php echo $user->id; ?>);
        formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');



        const xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= base_url("publicaccess/save_signature") ?>', true);
        xhr.responseType = 'text'; // response type set to text instead of blob

        xhr.onload = function() {
          if (xhr.status === 200) {
            try {
              const response = JSON.parse(xhr.responseText);
              if (response.status === 'success') {
                Swal.fire({
                  icon: 'success',
                  title: 'Tanda tangan berhasil disimpan ke database',
                  text: 'Nama file: ' + response.file_name,
                  timer: 1500, // menampilkan pesan selama 3 detik
                  timerProgressBar: true,
                  showConfirmButton: false,
                }).then(() => {
                  // Setelah beberapa detik, arahkan ke halaman login
                  window.location.replace("<?php echo base_url('auth/login'); ?>");
                });
              } else {
                alert('Terjadi kesalahan saat menyimpan tanda tangan.');
              }
            } catch (e) {
              console.error('Error parsing JSON response:', e);
              console.log('Response text:', xhr.responseText);
              alert('Terjadi kesalahan saat menyimpan tanda tangan.');
            }
          } else {
            alert('Terjadi kesalahan saat menyimpan tanda tangan.');
          }
        };



        xhr.send(formData);
      });


      $('#clear').on('click', function() {
        signaturePad.clear();
      });
    });
  </script>


</body>

</html>