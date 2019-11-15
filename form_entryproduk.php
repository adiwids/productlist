<div class="container">
	<div class="entryform">
		<h3>Entry Produk</h3>
		<form action="">
			<label for="kategori">Kategori :</label>
			<select name="kategori" id="kategori">
			<script type="text/javascript">
			<!--
			getComboKategori(false);
			-->
			</script>
			</select>
			<label for="nmproduk">Nama Produk :</label>
			<input type="text" name="nmproduk" id="nmproduk"/>
			<label for="szproduk">Ukuran :</label>
			<input type="text" name="szproduk" id="szproduk" />
			<label for="harga">Harga :</label>
			<input type="text" name="harga" id="harga" />
			<a href="#" onclick="return savedata_produk()">Simpan</a>
		</form>
	</div>
	<div id="list">
	<?php
		require_once("inc/class.koneksi.php");
		$view = "select kb.kategori,p.kode_produk,p.nama_produk,p.ukuran,p.harga";
		$view .= " from PRODUK p inner join KATEGORI_BAHAN kb on kb.kode_kategori=p.kode_kategori";
		$view .= " order by kb.kategori,p.nama_produk asc";
		$l = new Koneksi();

		$data = $l->execQuery($view);
		$nrows = $l->recordCount($view);

		$list = "<table border='1'>";
		$list .= "<tr><td>NO.</td><td>KATEGORI</td><td>PRODUK</td><td>UKURAN</td><td>HARGA</td><td></td></tr>";
		if($nrows > 0){
			if($nrows == 1){
				$list .= "<tr><td>1</td><td>".$data[kategori]."</td><td>".$data[nama_produk]."</td><td>".$data[ukuran]."</td><td>".$data[harga]."</td><td><a haref='#' onclick='deletedata_produk(".$data[kode_produk].")'>Hapus</a></td></tr>";
			}else{
				$i = 0;
				while($i<$nrows){
					$list .= "<tr><td>".($i+1)."</td><td>".$data[$i][kategori]."</td><td>".$data[$i][nama_produk]."</td><td>".$data[$i][ukuran]."</td><td>".$data[$i][harga]."</td><td><a href='#' onclick='deletedata_produk(".$data[$i][kode_produk].")'>Hapus</a></td></tr>";
					$i++;
				}
			}
		}else{
			$list .= "<tr><td colspan='6'>Tidak ada data.</td></tr>";
		}
		$list .= "</table>";

		echo $list;
	?>
	</div>
</div>
