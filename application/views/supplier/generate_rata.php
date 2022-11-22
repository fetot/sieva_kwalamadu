    <div class="container margin-b70">
      <div class="row">
        <div class="col-md-12">
          <h1>Data Nilai Rata-Rata</h1>

          <div id="body">
          <a class="btn btn-primary" href="<?php echo base_url(); ?>supplier/generate_centroid">Proses Data Akhir</a><br><br>
          <div class="table-responsive">
            <table  id="table_data" class="table table-bordered table-striped table-admin">
            <tr><td>No</td><td>Nomor Petak</td><td>Kebun</td><td>Luas (Hektar)</td><td>Rata-Rata Netto (Kg)</td></tr>
            <?php $i = 1; foreach($data_hasilpanen->result_array() as $s){ ?>
            <tr>
              <td><?php
                    echo $i;
                    $i++;
                ?></td>
              <td><?php echo $s['nomor_petak']; ?></td>
              <td><?php echo $s['nama_kebun']; ?></td>
              <td><?php echo $s['luas']; ?></td>
              <td><?php echo $s['rata_rata']; ?></td>
            </tr>
            <?php } ?>
          </table>
          </div>
          </div>

          <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
        </div>
      </div>
    </div>
