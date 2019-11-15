<div class="container">
	<div class="entryform">
		<h3>Entry Kategori</h3>
		<form action="">
			<label for="kategori">Kategori :</label>
			<input type="text" name="kategori" id="kategori"/>
			<a href="#" onclick="return savedata_kategori()">Simpan</a>
		</form>
	</div>
	<div id="list">
	<?php
		require_once("inc/class.koneksi.php");
		$view = "select * from KATEGORI_BAHAN ORDER BY kategori";
		$l = new Koneksi();

		$data = $l->execQuery($view);
		$nrows = $l->recordCount($view);

		$list = "<table border='1'>";
		$list .= "<tr><td>NO.</td><td>KATEGORI</td><td></td></tr>";
		if($nrows > 0){
			if($nrows == 1){
				$list .= "<tr><td>1</td><td>".$data[kategori]."</td><td><a href='#' onclick='deletedata_kategori(".$data[kode_kategori].")'>Hapus</a></td></tr>";
			}else{
				$i = 0;
				while($i<$nrows){
					$list .= "<tr><td>".($i+1)."</td><td>".$data[$i][kategori]."</td><td><a href='#' onclick='deletedata_kategori(".$data[$i][kode_kategori].")'>Hapus</a></td></tr>";
					$i++;
				}
			}
		}else
		{
			$list .= "<tr><td colspan='3'>Tidak ada data.</td></tr>";
		}
		$list .= "</table>";

		echo $list;
	?>
	</div>
</div>
