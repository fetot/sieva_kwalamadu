    <div class="container margin-b70">
      <div class="row">
        <div class="col-md-12">
        <?php error_reporting(0); ?>
          <h1>Data Awal</h1>

            <div id="body">
            <a class="btn btn-primary" href="<?php echo base_url(); ?>supplier/iterasi_kmeans_lanjut">Proses Iterasi Selanjutnya</a><br><br>
            <div class="table-responsive">
            <table  id="table_data" class="table table-bordered table-admin">
              <tr align="center"><td rowspan="2">Nomor Petak</td><td rowspan="2">Kebun</td><td rowspan="2">Luas (Hektar)</td><td rowspan="2">Rata-rata Netto (Kg)</td><td rowspan="2">Jumlah Panen per Kebun</td>
              <td colspan="3">Centroid 1</td><td colspan="3">Centroid 2</td><td colspan="3">Centroid 3</td><td rowspan="2">C1</td><td rowspan="2">C2</td><td rowspan="2">C3</td>
              </tr>
              <tr align="center">
              <td>0.1</td><td>5800</td><td>4</td>
              <td>0.05</td><td>5200</td><td>2.5</td>
              <td>0.01</td><td>4600</td><td>1</td>
              </tr>
              <?php 
              $c1a = 0.1; //Batas atas Centroid untuk Luas
              $c1b = 5800; //Batas atas Centroid untuk Rata rata Netto
              $c1c = 4; //Batas atas Centroid untuk Jumlah Panen per Kebun
              
              $c2a = 0.05; //Batas tengah Centroid untuk Luas
              $c2b = 5200; //Batas tengah Centroid untuk Rata rata netto
              $c2c = 2.5; //Batas tengah Centroid untuk Jumlah Panen per Kebun
              
              $c3a = 0.01; //Batas bawah Centroid untuk Luas
              $c3b = 4600; //Batas bawah Centroid untuk Rata rata netto
              $c3c = 1; //Batas bawah Centroid untuk Jumlah Panen per Kebun
              
              $c1a_b = "";
              $c1b_b = "";
              $c1c_b = "";
              
              $c2a_b = "";
              $c2b_b = "";
              $c2c_b = "";
              
              $c3a_b = "";
              $c3b_b = "";
              $c3c_b = "";
              
              $hc1=0;
              $hc2=0;
              $hc3=0;
              
              $no=0;
              $arr_c1 = array();
              $arr_c2 = array();
              $arr_c3 = array();
              
              $arr_c1_temp = array();
              $arr_c2_temp = array();
              $arr_c3_temp = array();
              
              $this->db->query('truncate table centroid_temp');
              $this->db->query('truncate table hasil_centroid');
              foreach($data_hasilpanen->result_array() as $s){ ?>
              <tr><td><?php echo $s['nomor_petak']; ?></td><td><?php echo $s['nama_kebun']; ?></td><td><?php echo $s['luas']; ?></td><td><?php echo round($s['avgnetto'], 0); ?></td><td><?php echo round($s['jumlahpanen'], 0); ?></td>
              
              <td colspan="3"><?php 
                $hc1 = sqrt(pow(($s['luas']-$c1a),2)+pow(($s['avgnetto']-$c1b),2)+pow(($s['jumlahpanen']-$c1c),2));
                echo $hc1;
              ?></td>
              <td colspan="3"><?php 
                $hc2 = sqrt(pow(($s['luas']-$c2a),2)+pow(($s['avgnetto']-$c2b),2)+pow(($s['jumlahpanen']-$c2c),2));
                echo $hc2;
              ?></td>
              <td colspan="3"><?php 
                $hc3 = sqrt(pow(($s['luas']-$c3a),2)+pow(($s['avgnetto']-$c3b),2)+pow(($s['jumlahpanen']-$c3c),2));
                echo $hc3;
              ?></td>
              <?php 
              
              if($hc1<=$hc2)
              {
                if($hc1<=$hc3)
                {
                  $arr_c1[$no] = 1;
                }
                else
                {
                  $arr_c1[$no] = '0';
                }
              }
              else
              {
                $arr_c1[$no] = '0';
              }
              
              if($hc2<=$hc1)
              {
                if($hc2<=$hc3)
                {
                  $arr_c2[$no] = 1;
                }
                else
                {
                  $arr_c2[$no] = '0';
                }
              }
              else
              {
                $arr_c2[$no] = '0';
              }
              
              if($hc3<=$hc1)
              {
                if($hc3<=$hc2)
                {
                  $arr_c3[$no] = 1;
                }
                else
                {
                  $arr_c3[$no] = '0';
                }
              }
              else
              {
                $arr_c3[$no] = '0';
              }
              
              $arr_c1_temp[$no] = $s['luas'];
              $arr_c2_temp[$no] = $s['avgnetto'];
              $arr_c3_temp[$no] = $s['jumlahpanen'];
              
              $warna1="";
              $warna2="";
              $warna3="";
              ?>
              <?php if($arr_c1[$no]==1){$warna1='#FFFF00';} else{$warna1='#ccc';} ?><td bgcolor="<?php echo $warna1; ?>"><?php echo $arr_c1[$no] ;?></td>
              <?php if($arr_c2[$no]==1){$warna2='#FFFF00';} else{$warna2='#ccc';} ?><td bgcolor="<?php echo $warna2; ?>"><?php echo $arr_c2[$no] ;?></td>
              <?php if($arr_c3[$no]==1){$warna3='#FFFF00';} else{$warna3='#ccc';} ?><td bgcolor="<?php echo $warna3; ?>"><?php echo $arr_c3[$no] ;?></td>
              </tr>
              <?php
              
              $q = "insert into centroid_temp(iterasi,c1,c2,c3) values(1,'".$arr_c1[$no]."','".$arr_c2[$no]."','".$arr_c3[$no]."')";
              $this->db->query($q);
              
              $no++; } 
              
              //centroid baru 1.a
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c1);$i++)
              {
                $arr[$i] = $arr_c1_temp[$i]*$arr_c1[$i];
                if($arr_c1[$i]==1)
                {
                  $jum++;
                }
              }
              $c1a_b = array_sum($arr)/$jum;
              
              //centroid baru 1.b
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c2);$i++)
              {
                $arr[$i] = $arr_c2_temp[$i]*$arr_c1[$i];
                if($arr_c1[$i]==1)
                {
                  $jum++;
                }
              }
              $c1b_b = array_sum($arr)/$jum;

              
              
              //centroid baru 1.c
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c3);$i++)
              {
                $arr[$i] = $arr_c3_temp[$i]*$arr_c1[$i];
                if($arr_c1[$i]==1)
                {
                  $jum++;
                }
              }
              $c1c_b = array_sum($arr)/$jum;
              
              
              
              
              //centroid baru 2.a
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c1);$i++)
              {
                $arr[$i] = $arr_c1_temp[$i]*$arr_c2[$i];
                if($arr_c2[$i]==1)
                {
                  $jum++;
                }
              }
              $c2a_b = array_sum($arr)/$jum;


              
              
              //centroid baru 2.b
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c2);$i++)
              {
                $arr[$i] = $arr_c2_temp[$i]*$arr_c2[$i];
                if($arr_c2[$i]==1)
                {
                  $jum++;
                }
              }
              $c2b_b = array_sum($arr)/$jum;
              
              //centroid baru 2.c
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c3);$i++)
              {
                $arr[$i] = $arr_c3_temp[$i]*$arr_c2[$i];
                if($arr_c2[$i]==1)
                {
                  $jum++;
                }
              }
              $c2c_b = array_sum($arr)/$jum;
              
              
              
              
              //centroid baru 3.a
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c1);$i++)
              {
                $arr[$i] = $arr_c1_temp[$i]*$arr_c3[$i];
                if($arr_c3[$i]==1)
                {
                  $jum++;
                }
              }
              $c3a_b = array_sum($arr)/$jum;
              
              //centroid baru 3.b
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c2);$i++)
              {
                $arr[$i] = $arr_c2_temp[$i]*$arr_c3[$i];
                if($arr_c3[$i]==1)
                {
                  $jum++;
                }
              }
              $c3b_b = array_sum($arr)/$jum;
              
              //centroid baru 3.c
              $jum = 0;
              $arr = array();
              for($i=0;$i<count($arr_c3);$i++)
              {
                $arr[$i] = $arr_c3_temp[$i]*$arr_c3[$i];
                if($arr_c3[$i]==1)
                {
                  $jum++;
                }
              }
              $c3c_b = array_sum($arr)/$jum;
              
              
              $q = "insert into hasil_centroid(c1a,c1b,c1c,c2a,c2b,c2c,c3a,c3b,c3c) values('".$c1a_b."','".$c1b_b."','".$c1c_b."','".$c2a_b."','".$c2b_b."','".$c2c_b."','".$c3a_b."','".
              $c3b_b."','".$c3c_b."')";
              $this->db->query($q);
              
              
              
              ?>
            </table>
            </div>
            </div>

            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
        </div>
      </div>
    </div>
