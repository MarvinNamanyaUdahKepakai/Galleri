
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="<?php echo  base_url('img/logo/logo.png" rel="icon')?>">
  <title>Penjadwalan- Dashboard</title>
  <link href="<?php echo  base_url('vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo  base_url('vendor/bootstrap/css/bootstrap.min.css')?>"rel="stylesheet" type="text/css">
  <link href="<?php echo  base_url('css/ruang-admin.min.css')?>" rel="stylesheet">
  <link href="<?php echo  base_url('css/ruang-admin.min.css')?>"rel="stylesheet">
</head>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <!-- x -->
         <!--  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li> -->
          <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content"> -->


        <form class="form-horizontal form-label-left" novalidate action="<?= base_url('/home/aksi_tambah_penguna/?')?>"method="post" enctype="multipart/form-data">
        <!--   <p>For alternative validation library <code>parsleyJS</code> check out in the <a href="form.html">form page</a>
          </p> -->
          
         <!--  <span class="section">Personal Info</span> -->
        <!--  <div class="col-md-6 col-12">
                            <div class="form-group">
                              <label for="first-name-column">Foto</label>
                              <input type="file" class="form-control" placeholder="Foto" name="foto" id="foto" onchange="previewImage()">
                            <img id="preview" src="" alt="" style="max-width: 100px; margin-top: 10px;">
                            </div>
                          </div> -->
         <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="username" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="username" placeholder="Isi username" required="required" type="text">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="password" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="password" placeholder="Isi password" required="required" type="password">
            </div>
          </div>

         <!--  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level">Level<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" id="level" placehoder="Enter level" name="level">
                <option value="<?php echo $jojo->level?>">-PILIH-</option>
                <?php

                foreach ($okta as $evan) {
                  ?>
                  <option value ="<?= $evan->id_level?>"><?php echo $evan->nama_level?>

                </option>
              <?php } ?>
            </select>
          </div>
        </div>
 -->
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Penguna<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="nama" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nama" placeholder="Isi nama " required="required" type="text">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ttl">Tanggal Lahir<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="ttl" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="ttl" placeholder="Isi Tanggal Lahir" required="required" type="date">
            </div>
          </div>

         <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jk">Jenis Kelamin<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name ="jk">
                <option>Pilih</option>
                <option value="Laki-laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="alamat" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="alamat" placeholder="Isi alamat" required="required" type="text">
            </div>
          </div>

            <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp">NO HP<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="nohp" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nohp" placeholder="Isi nohp" required="required" type="text">
            </div>
          </div>
           
           
          
               
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-md-offset-3">
            <button type="submit" class="btn btn-primary">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<script>

function previewImage() {
  var preview = document.querySelector('#preview');
  var file = document.querySelector('#foto').files[0];
  var reader = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
}
</script>

 </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
       <!--  <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
            </span>
          </div>
        </div> -->

        <!-- <div class="container my-auto py-2">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - distributed by
              <b><a href="https://themewagon.com/" target="_blank">themewagon</a></b>
            </span>
          </div>
        </div>
      </footer> -->
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="<?php echo  base_url('vendor/jquery/jquery.min.js')?>"></script>
  <script src="<?php echo  base_url('vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <script src="<?php echo  base_url('vendor/jquery-easing/jquery.easing.min.js')?>"></script>
  <script src="<?php echo  base_url('js/ruang-admin.min.js')?>"></script>
  <script src="<?php echo  base_url('vendor/chart.js/Chart.min.js')?>"></script>
  <script src="<?php echo  base_url('js/demo/chart-area-demo.js')?>"></script>  
</body>

</html>