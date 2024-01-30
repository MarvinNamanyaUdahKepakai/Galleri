<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <form class="form-horizontal form-label-left" novalidate action="<?= base_url('/home/aksi_tambah_barang/?')?>"method="post" enctype="multipart/form-data">
 
           <div class="col-md-6 col-12">
                            <div class="form-group">
                              <label for="first-name-column">Foto</label>
                              <input type="file" class="form-control" placeholder="Foto" name="foto" id="foto" onchange="previewImage()">
                            <img id="preview" src="" alt="" style="max-width: 100px; margin-top: 10px;">
                            </div>
                          </div>


          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_brg">Nama Barang<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="nama_brg" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nama_brg" placeholder="Isi nama brg" required="required" type="text">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kode_brg">Kode Barang<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="kode_brg" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="kode_brg" placeholder="Isi kode brg" required="required" type="text">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stock">Stock<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="stock" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="stock" placeholder="Isi stock" required="required" type="text">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="harga" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="harga" placeholder="Isi harga" required="required" type="text">
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