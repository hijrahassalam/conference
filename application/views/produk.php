<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Products</title>
</head>
<body>
<div align="center">
	<h1 align="center">Products</h1>
	<table border="0" cellpadding="2px" width="600px">
		<?php
			foreach ($products->result_array() as $product){
				$id = $product['produk_kode'];
				$name = $product['produk_nama'];
				$description = $product['produk_deskripsi'];
				$price = $product['produk_harga'];
		?>
    	<tr>
        	<td><img src="<?php echo base_url('uploads/produk/'.$product['produk_gambar'].'')?>" height="75px" width="75px" /></td>
            <td><b><?php echo $name; ?></b><br />
            		<?php echo $description; ?><br />
                    Price:<big style="color:green">
                    $<?php echo $price; ?></big><br /><br />
                    <a href="<?php echo base_url('cart/tambah?id='.$id.'')?>"><button>Add to Cart</button></a>
			</td>
		</tr>
        <tr><td colspan="2"><hr size="1" /></td>
        <?php } ?>
    </table>
</div>
</body>
</html>
