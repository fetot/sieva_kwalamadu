    <div class="container margin-b70">
      <div class="row">
        <div class="col-md-12">
          <h1>Data Akhir</h1>

          <div id="body">
          <a  class="btn btn-primary" href="<?php echo base_url(); ?>supplier/generate_rata">Proses Data Rata-Rata</a> <a  class="btn btn-success" href="<?php echo base_url(); ?>supplier/generate_centroid">Proses Data Akhir</a><br><br>
          <div class="table-responsive">
            <table  id="table_data" class="table table-bordered table-striped table-admin">
            <tr><td>Centroid 1</td><td>Baik</td><td><?php echo $c1; ?></td></tr>
            <tr><td>Centroid 2</td><td>Cukup</td><td><?php echo $c2; ?></td></tr>
            <tr><td>Centroid 3</td><td>Kurang</td><td><?php echo $c3; ?></td></tr>
          </table>
          </div>
          <br>
          <br>
          <div class="table-responsive">
            <table id="table_data" class="table table-bordered table-striped table-admin">
            <tr align="center"><td>No</td><td>Nomor Petak</td><td>Kebun</td><td>Luas</td><td>Rata-Rata</td><td>Jumlah Panen per Kebun</td><td colspan="3">Distance</td><td>Predikat</td></tr>
            <?php $i=1; foreach($data_hasilpanen->result_array() as $s){ ?>
            <tr>
              <td><?php
                    echo $i;
                    $i++;
                ?></td>
                <td><?php echo $s['nomor_petak']; ?></td>
                <td><?php echo $s['nama_kebun']; ?></td>
                <td><?php echo $s['luas']; ?></td>
                <td><?php echo $s['rata_rata']; ?></td>
                <td><?php echo $s['jumlahpanen']; ?></td>
                <td><?php echo $s['d1']; ?></td>
                <td><?php echo $s['d2']; ?></td>
                <td><?php echo $s['d3']; ?></td>
                <td><?php echo $s['predikat']; ?></td>
              </tr>
            <?php } ?>
          </table>
          </div>
          </div>

          <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
        </div>
      </div>
    </div>
