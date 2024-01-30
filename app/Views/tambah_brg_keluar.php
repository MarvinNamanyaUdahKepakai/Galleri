<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <form class="form-horizontal form-label-left" novalidate action="<?= base_url('/home/aksi_tambah_brg_keluar/?')?>"method="post">

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Nama Barang <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" id="barang" placehoder="Enter barang" name="barang" >
                <option value="<?php echo $jojo->barang?>">-PILIH-</option>
                <?php 

                foreach ($okta as $evan) {
                  ?>
                  <option value ="<?= $evan->id_barang?>"><?php echo $evan->nama_brg?>

                </option>
              <?php } ?>
            </select>
          </div>
        </div>

         <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">Jumlah<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="jumlah" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="jumlah" placeholder="Isi jumlah" required="required" type="text">
            </div>
          </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal Masuk<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="tanggal" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="tanggal" placeholder="Isi Tanggal masuk" required="required" type="date">
            </div>
          </div>

        


        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kode_brg">Kode Barang<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" id="kode_brg" placehoder="Enter blok" name="kode_brg">
                <option value="<?php echo $jojo->kode_brg?>">-PILIH-</option>
                <?php

                foreach ($okta as $evan) {
                  ?>
                  <option value ="<?= $evan->kode_brg?>"><?php echo $evan->kode_brg?>

                </option>
              <?php } ?>
            </select>
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