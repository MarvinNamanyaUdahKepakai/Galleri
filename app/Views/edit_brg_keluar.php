
<div class="container">
  <form action="<?= base_url('/home/aksi_edit_brg_keluar/?')?>"method="post">
    <input type="hidden" name="id" value="<?php echo $jojo->id_brg_keluar?>">

<div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Barang<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" id="barang" placehoder="Enter barang" name="barang" >
                <option value="<?php echo $jojo->barang?>">-PILIH-</option>
                <?php

                foreach ($jess as $evan) {
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
              <input id="jumlah" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="jumlah" placeholder="Isi jumlah" required="required" type="text" value="<?php echo $jojo->jumlah?>">
            </div>
          </div>

        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal Masuk<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="tanggal" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="tanggal" placeholder="Isi Tanggal " required="required" type="date" value="<?php echo $jojo->tanggal?>">
            </div>
          </div>

          
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kode_brg">Kode Barang<span class="required">*</span>
            </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" id="kode_brg" placehoder="Enter kode_brg" name="kode_brg" >
                <option value="<?php echo $jojo->kode_brg?>">-PILIH-</option>
                <?php

                foreach ($jess as $evan) {
                  ?>
                  <option value ="<?= $evan->kode_brg?>"><?php echo $evan->kode_brg?>

                </option>
              <?php } ?>
            </select>
          </div>
        </div>

         
    <button type="submit" class="btn btn-primary">Submit</button>
    
  </form>
</div>

</tr>
</body>
</html>

