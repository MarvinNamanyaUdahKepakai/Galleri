 
<div class="container">
  <form action="<?= base_url('/home/aksi_edit_barang/?')?>"method="post">
    <input type="hidden" name="id" value="<?php echo $jojo->id_barang?>">

    <div class="mb-3 mt-3">
      <label for="nama_brg" class="form-label">Nama Barang</label>
      <input type="text" class="form-control" id="nama_brg" placeholder="Isi nama_brg" name="nama_brg" value="<?php echo $jojo->nama_brg?>">
    </div>

    <div class="mb-3 mt-3">
      <label for="kode_brg" class="form-label">Kode Barang</label>
      <input type="text" class="form-control" id="kode_brg" placeholder="Isi kode_brg" name="kode_brg" value="<?php echo $jojo->kode_brg?>">
    </div>

    <div class="mb-3 mt-3">
      <label for="stock" class="form-label">Stock</label>
      <input type="text" class="form-control" id="stock" placeholder="Isi stock" name="stock" value="<?php echo $jojo->stock?>">
    </div>

     <div class="mb-3 mt-3">
      <label for="harga" class="form-label">Harga</label>
      <input type="text" class="form-control" id="harga" placeholder="Isi harga" name="harga" value="<?php echo $jojo->harga?>">
    </div>



    

    <button type="submit" class="btn btn-primary">Submit</button>
    
  </form>
</div>

</tr>
</body>
</html>