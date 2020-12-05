<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Laporan </title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; padding:5px}
.style9 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; padding: 5px; font-weight: bold; }
-->
</style>
</head>

<body>
<table width="889" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td><span class="style1">REKAP TRANSAKSI AREA PARKIR BULANAN </span></td>
  </tr>
  <tr>
    <td><span class="style2">PERIODE <?php echo $_GET['bulan'] ?></span></td>
  </tr>
  <tr>
    <td><hr /></td>
  </tr>
  <tr>
    <td height="113" valign="top"><table width="894" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td width="61" align="center" class="style2">NO</td>
        <td width="109" height="27" align="center" class="style2">TANGGAL</td>
        <td width="318" align="center" class="style2">AREA PARKIR </td>
        <td width="170" align="center" class="style2">WILAYAH</td>
        <td width="224" align="center"><span class="style2">NILAI TRANSAKSI  </span></td>
      </tr>
	  <?php
	  $i=0; 
	  $total = 0;
	  foreach($modelData as $value): 
	  $i++;
	  $total = $total+$value->fee;
	  ?>
      <tr>
        <td align="center" class="style7"><?php echo $i ?></td>
        <td height="30"><span class="style7"><?php echo $value->dates ?></span></td>
        <td><span class="style7"><?php echo $value->parking_lot_name ?></span></td>
        <td><span class="style7"><?php echo $value->territory_name ?></span></td>
        <td align="right"><span class="style7"><?php echo number_format($value->fee) ?></span></td>
      </tr>
	  <?php endforeach ?>
      <tr>
        <td height="30" colspan="4" align="right" class="style7"><strong>TOTAL</strong></td>
        <td align="right"><span class="style9"><?php echo number_format($total) ?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
