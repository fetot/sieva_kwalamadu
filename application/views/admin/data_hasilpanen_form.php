    
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
                  echo "</i> Tambah Data Hasil Panen</a>";
                  }
                  else {
                  echo "</i> Edit Data Hasil Panen</a>";
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
              <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>administrasi/data_hasilpanen/save" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="no_hasilpanen" value="<?=$no_hasilpanen ?>" />
                <input type="hidden" class="form-control" name="status" value="<?=$status ?>" />
                <div class="form-group">
                  <label for="inputKK" class="col-sm-3 control-label">Nomor SPTA</label>
                  <div class="col-sm-6">
                      <input type="text" name="no_spta" value="<?php echo $no_spta ?>" required class="form-control" id="inputKK" placeholder="Nomor SPTA" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputNama" class="col-sm-3 control-label">Nomor Petak</label>
                  <div class="col-sm-6">
                      <input type="text" name="nomor_petak" required class="form-control" value="<?php echo $nomor_petak?>"id="inputNama" placeholder="Nomor Petak" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputNama" class="col-sm-3 control-label">Bruto (Kg)</label>
                  <div class="col-sm-6">
                      <input type="text" name="bruto" required class="form-control" value="<?php echo $bruto ?>"id="inputNama" placeholder="Bruto" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputNama" class="col-sm-3 control-label">Tara (Kg)</label>
                  <div class="col-sm-6">
                      <input type="text" name="tara" required class="form-control" value="<?php echo $tara ?>"id="inputNama" placeholder="Tara" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputNama" class="col-sm-3 control-label">Netto (Kg)</label>
                  <div class="col-sm-6">
                      <input type="text" name="netto" required class="form-control" value="<?php echo $netto ?>"id="inputNama" placeholder="Netto" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputTanggal" class="col-sm-3 control-label">Tanggal Timbang</label>
                  <div class="col-sm-6">
                      <input class="form-control" type="datetime-local" value="<?php echo $tgl_timbang ?>" id="inputTanggal" name="tgl_timbang">
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
                    </button>&nbsp;&nbsp;<a href="<?php echo base_url() ?>administrasi/data_hasilpanen" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>