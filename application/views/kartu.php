<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SMP NEGERI 19 BANDUNG</title>
</head>

<body><?php                                                        
                                            foreach ($datapersonal->result() as $rows) {
                                            ?>
<table border="1">
  <tr>
    <td><table width="537" border="0">
      <tr>
        <td height="60" colspan="4" align="center"><table width="100%" border="1">
          <tr>
            <td height="50" align="center">KARTU PENDAFTARAN</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="29" colspan="4" align="center" bordercolor="#000000">SMP NEGERI 19 BANDUNG</td>
      </tr>
      <tr>
        <td align="center" colspan="4">Jalan Sadang Luhur XI,Kelurahan Sekeloa,Kecamatan Coblong</td>
      </tr>
      <tr>
        <td align="center" width="122" rowspan="5"><table width="100%" border="1">
          <tr>
            <td nowrap="nowrap" align="center" ><img  alt="Foto" width="150" height="200" src="<?=base_url();?>uploads/F<?= $rows->nisn?>.jpg"></td>
          </tr>
        </table></td>
        <td width="112">NISN</td>
        <td width="10">:</td>
        <td width="241"><?= $rows->nisn?></td>
      </tr>
      <tr>
        <td>Nama</td>
        <td>:</td>
        <td><?= $rows->name?></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><?= $rows->alamat?></td>
      </tr>
      <tr>
        <td>Asal Sekolah</td>
        <td>:</td>
        <td><?= $rows->asal_sekolah?></td>
      </tr>
      <tr>
        <td valign="top">nun</td>
        <td valign="top">:</td>
        <td valign="top"><?= $rows->nun?></td>
      </tr>
      <tr>
        <td align="center">Tanda Tangan</td>
        <td colspan="3" rowspan="3" valign="top">NB: Kartu tanda bukti bahwa telah lulus di SMPN 19 Bandung dan harap dibawa saat melakukan daftar ulang</td>
      </tr>
      <tr>
        <td height="100">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" nowrap="nowrap"><?= $rows->name?></td>
      </tr>
    </table></td>
  </tr>
</table><?php }?>
</body>
</html>