<?php
	extract($_GET);
	require_once("../inc/class.koneksi.php");
	$k = new Koneksi();
	$sql = "select kode_kategori,kategori from KATEGORI_BAHAN";
	if($filt == 'true'){
		$sql .= " union select 999 as kode_kategori,'Semua' as kategori";
	}
	$sql .= " order by kategori asc";
	$data = $k->execQuery($sql);
	$nrows = $k->recordCount($sql);
	$option = "";

	if($nrows > 0){
		if($nrows == 1){
			$option .= "<option value='".$data[kode_kategori]."'>".$data[kategori]."</option>";
		}else{
			$i = 0;
			while($i<$nrows){
				$option .= "<option value='".$data[$i][kode_kategori]."'>".$data[$i][kategori]."</option>";
				$i++;
			}
		}
	}else{
		$option .= "<option value=''></option>";
	}
	echo $option;
?>
