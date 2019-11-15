<?php
	extract($_GET);
	require_once("../inc/class.koneksi.php");
	$sql = "insert into PRODUK(kode_kategori,nama_produk,ukuran,harga) VALUES($kategori,'$nmproduk','$szproduk',$harga)";
	$k = new Koneksi();
	$k->execQuery($sql);
?>
