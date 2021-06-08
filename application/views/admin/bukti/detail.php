<center><h3>Detail Data Payway <font color='red'><?php echo str_replace('coba','',$dt->customer->nama)?></font></h3></center>
<table class="table table-responsive table-hover" style="width:100%">
<tr>
	<td>Nama Customer</td>
	<td>:</td>
	<td><?php echo str_replace('coba','',$dt->customer->nama)?></td>
</tr>
<tr>
	<td>Email Customer</td>
	<td>:</td>
	<td><?php echo $dt->customer->email?></td>
</tr>
<tr>
	<td>No Telp Customer</td>
	<td>:</td>
	<td><?php echo $dt->customer->no_telp?></td>
</tr>
<tr>
	<td>Nomor Virtual Account</td>
	<td>:</td>
	<td><?php echo $dt->virtual_account?> (Bank Mandiri)</td>
</tr>
<tr>
	<td>Jumlah Tagihan</td>
	<td>:</td>
	<td><?php echo $dt->mata_uang.". ".number_format($dt->tagihan,2,',','.')?></td>
</tr>
<tr>
	<td>Tanggal Dibuat</td>
	<td>:</td>
	<td><?php echo $dt->tanggal_dibuat?></td>
</tr>
<tr>
	<td>Status Pembayaran</td>
	<td>:</td>
	<td><?php echo ($dt->status_bayar==1) ? '<b><font color="blue">Sudah Dibayar</font></b>' : '<b><font color="red">Belum Dibayar</font></b>'?></td>
</tr>
<tr>
	<td>Tanggal Pembayaran</td>
	<td>:</td>
	<td><?php echo $dt->tanggal_bayar?></td>
</tr>
</table>