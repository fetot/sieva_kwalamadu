    
    <div class="container margin-b50 margin-t50">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <nav class="navbar navbar-default navbar-utama nav-admin-data" role="navigation">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <a class="navbar-brand" href="#"><i class="fa fa-plus-circle">
                <?php
                  if($status == 'baru'){
                  echo "</i> Tambah Data Kebun</a>";
                  }
                  else {
                  echo "</i> Edit Data Kebun</a>";
                  }
                ?>
              </div>
              
              </div><!-- /.container-fluid -->
            </nav>
            
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="well">
              <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>administrasi/data_kebun/save" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="no" value="<?=$no ?>" />
                <input type="hidden" class="form-control" name="status" value="<?=$status ?>" />
                <div class="form-group">
                  <label for="inputKK" class="col-sm-3 control-label">Nomor Petak</label>
                  <div class="col-sm-6">
                      <input type="text" name="nomor_petak" value="<?php echo $nomor_petak ?>" required class="form-control" id="inputKK" placeholder="Nomor Petak" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputNama" class="col-sm-3 control-label">Kebun</label>
                  <div class="col-sm-6">
                      <input type="text" name="nama_kebun" required class="form-control" value="<?php echo $nama_kebun ?>"id="inputNama" placeholder="Kebun" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputNama" class="col-sm-3 control-label">Blok</label>
                  <div class="col-sm-6">
                      <input type="text" name="blok" required class="form-control"  value="<?php echo $blok ?>" id="inputNama" placeholder="Blok" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputNama" class="col-sm-3 control-label">Luas (Hektar)</label>
                  <div class="col-sm-6">
                      <input name="luas" required type="text" class="form-control" id="inputNama" value="<?php echo $luas ?>" placeholder="Luas dalam satuan hektar" />
                  </div>
                </div>
                
                <hr class="hr1">
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary bold"><i class="fa fa-save"></i>
                      <?php
                        if($status == 'baru'){
                          echo "Simpan";
                        }
                        else {
                          echo "Update";
                        }
                      ?>
                    </button>&nbsp;&nbsp;<a href="<?php echo base_url() ?>administrasi/data_kebun" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>