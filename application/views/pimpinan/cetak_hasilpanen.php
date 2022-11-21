  
    <div class="container margin-b70">
      <div class="row">
        <div class="col-md-12">
          <nav class="navbar navbar-default navbar-utama nav-admin-data" role="navigation">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Daftar Hasil Panen</a>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">
                  <li><a href="<?php echo base_url() ?>pimpinan/cetak_hasilpanen/view" target="_blank"><i class="fa fa-print"></i> CETAK DATA</a></li>
                </ul>
                
                </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
              
            </div>
          </div>
          <div class="table-responsive">
            <table id="table_data" class="table table-bordered table-striped table-admin">
            <thead><tr><th>No</th><th>Nomor SPTA</th><th>Nomor Petak</th><th>Kebun</th><th>Blok</th><th>Luas (Hektar)</th><th>Bruto (Kg)</th><th>Tara (Kg)</th><th>Netto (Kg)</th><th>Tanggal Timbang</th></tr></thead>
            <tbody>
            <?php foreach ($data_hasilpanen as $p): ?>    
            <tr>
            <td><?=$p['no_hasilpanen'] ?></td>
            <td><?=$p['no_spta'] ?></td>
            <td><?=$p['nomor_petak'] ?></td>
            <td><?=$p['nama_kebun'] ?></td>
            <td><?=$p['blok'] ?></td>
            <td><?=$p['luas'] ?></td>
            <td><?=number_format($p['bruto']) ?></td>
            <td><?=number_format($p['tara']) ?></td>
            <td><?=number_format($p['netto']) ?></td>
            <td><?=$p['tgl_timbang'] ?></td>
            </tr>
            <?php endforeach ?>
            </tbody>
            </table>

          </div>

        </div>
        
