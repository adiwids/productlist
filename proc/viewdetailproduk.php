<?php
	extract($_GET);
	require_once("../inc/class.koneksi.php");
	$k = new Koneksi();
	$filter = '';
	$sql = "select p.kode_kategori,kb.kategori,p.nama_produk,p.ukuran,p.harga";
	$sql .= " from PRODUK p inner join KATEGORI_BAHAN kb on kb.kode_kategori=p.kode_kategori";
	if(isset($_GET)){
		if($kategori != '' && $kategori != '999'){
			$filter .= " where p.kode_kategori=".$kategori;
		}
		if($nmproduk != ''){
			if($filter != ''){
				$filter .= " and p.nama_produk like '%".$nmproduk."%'";
			}else{
				$filter .= " where p.nama_produk like '%".$nmproduk."%'";
			}
		}
		if($szproduk != ''){
			if($filter != ''){
				$filter .= " and p.ukuran like '%".$szproduk."%'";
			}else{
				$filter .= " where p.ukuran like '%".$szproduk."%'";
			}
		}
	}
	$sql .= $filter;
	$sql .= " order by kb.kategori,p.nama_produk asc";
	$data = $k->execQuery($sql);
	$nrows = $k->recordCount($sql);

	$list = "<table border='1'>";
	$list .= "<tr><td>NO.</td><td>KATEGORI</td><td>PRODUK</td><td>UKURAN</td><td>HARGA</td></tr>";
	if($nrows > 0){
			if($nrows == 1){
				$list .= "<tr><td>1</td><td>".$data[kategori]."</td><td>".$data[nama_produk]."</td><td>".$data[ukuran]."</td><td>".$data[harga]."</td></tr>";
			}else{
				$i = 0;
				while($i<$nrows){
					$list .= "<tr><td>".($i+1)."</td><td>".$data[$i][kategori]."</td><td>".$data[$i][nama_produk]."</td><td>".$data[$i][ukuran]."</td><td>".$data[$i][harga]."</td></tr>";
					$i++;
				}
			}
		}else{
			$list .= "<tr><td colspan='6'>Tidak ada data.</td></tr>";
		}
	$list .= "</table>";

	echo $list;
?>
