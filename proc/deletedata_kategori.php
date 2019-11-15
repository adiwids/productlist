<?php
	extract($_GET);
	require_once("../inc/class.koneksi.php");
	$sql = "delete from KATEGORI_BAHAN where kode_kategori='$kdkategori'";
	$k = new Koneksi();
	$k->execQuery($sql);
?>
