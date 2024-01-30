 <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pendataan Barang </h1>
            
          </div>


 <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pendataan Barang </h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                   <thead class="green-header">
  <a href="<?= base_url('/home/tambah_barang') ?>"><button class="btn btn-success"><i class="fa fa-plus "></i>Tambah</button></a>
  <tr>
    <th>NO</th>
     <th>Foto</th>
    <th>Nama Barang</th>
    <th>Kode Barang</th>
    <th>Stock</th>
    <th>Harga</th>
  <th>Action</th>
  </tr>
</thead>
<style>
  .green-header {
    background-color: blue;
    color: white; /* You can adjust the text color as needed */
  }
</style>



       <style>      

@keyframes slideDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.animated-header {
    animation: slideDown 0.5s ease-in-out forwards;
    /* Adjust animation duration and easing as needed */
}
</style>      

           <tbody>
                        <?php
      $no=1;
      foreach ($okta as $evan) {

        ?>

        <tr>

          <td><?php echo $no++ ?></td>
           <td><img src="<?=base_url('images/'.$evan->foto)?>" height="100px"></td>
          <td><?php echo $evan->nama_brg?> </td>
          <td><?php echo $evan->kode_brg?> </td>
          <td><?php echo $evan->stock?> </td>
          <td><?php echo $evan->harga?> </td>

          
          
          
           <td> 
            <a href="<?=base_url('/home/edit_barang/'.$evan->id_barang)?>"> <button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>

            <a href="<?=base_url('/home/hapus_barang/'.$evan->id_barang)?>"> <button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>

          </td> 
          

        </tr>
        <?php
      }
      ?>
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>