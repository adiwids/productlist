<?php
	extract($_GET);
	require_once("../inc/class.koneksi.php");
	$sql = "insert into KATEGORI_BAHAN(kategori) VALUES('$kategori')";
	$k = new Koneksi();
	$k->execQuery($sql);
?>
