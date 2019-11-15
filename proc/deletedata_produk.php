<?php
	extract($_GET);
	require_once("../inc/class.koneksi.php");
	$sql = "delete from PRODUK where kode_produk='$kdproduk'";
	$k = new Koneksi();
	$k->execQuery($sql);
?>
