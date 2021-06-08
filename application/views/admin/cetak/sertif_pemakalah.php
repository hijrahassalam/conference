<?php
foreach ($this->db->where('kategori','1')->get('registrasi',30)->result_array() as $row)
{
  ?>
<page>
<br>
<br><br><br>
<table style="width: 96%; text-align:right; font-size: 14pt; text-decoration:bold;  " >
  <tr>
    <td style="width: 99%">NO.12345</td>
  </tr>
  </table>
<style>
     .big{
         height:100px;
     }

     .small{
        height:10px;
     }
 </style>


<br>
<br>
<br>
<br>
<br>
<table style="width: 96%; text-align:center; font-size: 15pt;  font-family: Times" >
  <tr>
    <td style="width: 99%; ">Diberikan Kepada:</td>
  </tr>
  
  <tr>
    <td><span style="font-size:10pt"> </span></td>
  </tr>
  <tr>
  <td style="font-size:20pt;  "><?=strtoupper($this->account_model->nama_peserta_gelar($row['no']))?></td>
    
  </tr>
  <tr>
    <td style="font-size:10pt;"><span style="font-size:10pt"> </span></td>
  </tr>
 
  <tr>
    <td style="font-size:16pt;">Sebagai</td>
  </tr>

  <tr>
    <td><span style="font-size:10pt"> </span></td>
  </tr>
  <tr>
    <td><span style="font-size:20pt;">
      <u>PEMAKALAH</u>
    </span></td>
  </tr>
  <tr>
    <td><span style="font-size:14pt;"><?php echo "&quot;".$row['judul']."&quot;"?></span></td>
  </tr>
  <tr>
    <td  style="height:5px"><span style="font-size:12pt"></span></td>
  </tr>
  <tr>
    <td><span style="font-size:16pt;">Dalam Seminar Nasional XIII</span></td>
  </tr>
  <tr>
    <td><span style="font-size:21pt;">&quot;Biologi, Sains, Lingkungan dan Pembelajarannya&quot;</span></td>
  </tr>
  <tr>
    <td><span style="font-size:14pt;">Diselenggarakan oleh Program Studi Pendidikan Biologi FKIP Universitas Sebelas Maret
    </span></td>
  </tr>
  <tr>
    <td><span style="font-size:14pt;">Surakarta, 6 Agustus 2016
    </span></td>
  </tr>
  
</table>


<table cellspacing="0" style="width: 140%; font-size: 15pt;  font-family: Times">
        <tr>
          <td style="width: 45%">&nbsp;</td>
            <td style="width: 55%">&nbsp;</td>
  </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Dekan FKIP UNS,</td>
        </tr>
        <tr>
          <td height="65">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td tyle="font-size:18pt;">&nbsp;</td>
          <td>Prof. Dr. Joko Nurkamto, M.Pd.</td>
        </tr>
        <tr>
          <td tyle="font-size:18pt;">&nbsp;</td>
          <td>NIP 1961012 4198702 1 001</td>
        </tr>
            <tr>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><barcode type="C39" label="none" value="<?='aaaaa'?>"  style="width:40mm;  height:10mm;"></barcode></td>
            <td>&nbsp;</td>
            </tr>
    </table>
</page>
<?php
}
?>