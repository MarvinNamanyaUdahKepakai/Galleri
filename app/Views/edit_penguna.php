


        <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('/home/aksi_edit_penguna/?')?>"method="post">
          
          <input type="hidden" name="id" value="<?php echo $rizkan->id_user ?>">
          <input type="hidden" name="id2" value="<?php echo $jojo->user ?>">
      
       

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="username" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="username" placeholder="Isi Username" required="required" type="text" value="<?php echo $rizkan->username?>">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="password" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="password" placeholder="Isi Password" required="required" type="password" value="<?php echo $rizkan->password?>">
            </div>
          </div>

         <!--  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="password" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="password" placeholder="Isi password" required="required" type="text"value="<?php echo $rizkan->password?>">
            </div>
          </div> -->

          <!--  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level">Level<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" id="level" placehoder="Enter Jabatan" name="level" >
                <option value="<?php echo $jojo->level?>">-PILIH-</option>
                <?php

                foreach ($jess as $evan) {
                  ?>
                  <option value ="<?= $evan->id_level?>"><?php echo $evan->nama_level?>

                </option>
              <?php } ?>
            </select>
          </div>
        </div> -->

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Penguna<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="nama" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nama" placeholder="Isi nama Penguna" required="required" type="text" value="<?php echo $jojo->nama?>">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ttl">Tanggal Lahir<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="ttl" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="ttl" placeholder="Isi Tanggal Lahir" required="required" type="date" value="<?php echo $jojo->ttl?>">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenis">Jenis Kelamin<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name ="jk">
                <option value="<?php echo $jojo->jk?>">Pilih</option>
                <option value="Laki-laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
          </div>

           <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="alamat" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="alamat" placeholder="Isi alamat" required="required" type="text" value="<?php echo $jojo->alamat?>">
            </div>
          </div>

           <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp">No HP<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="nohp" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nohp" placeholder="Isi nohp" required="required" type="text" value="<?php echo $jojo->nohp?>">
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