function savedata_kategori(){
	if($('#kategori').val() != ''){
		$.ajax(
			{
				url: 'proc/savedata_kategori.php',
				type: 'get',
				data: 'kategori=' + $('#kategori').val(),
				success: function(html){
					$('#kategori').text('');
					alert('Data tersimpan.');
					loadform(1);
				},
				error: function(){
					alert('Maaf proses simpan gagal, coba ulangi lagi.');
					$('#kategori').text('');
				}
			}
		);
	}else{ alert('Kategori masih kosong. Harap diisi dahulu.'); }
	return false;
}

function deletedata_kategori(catid){
	$.ajax(
		{
			url: 'proc/deletedata_kategori.php',
			type: 'get',
			data: 'kdkategori=' + catid,
			success: function(){
				alert('Data dihapus.');
				loadform(1);
			},
			error: function(){
				alert('Maaf proses hapus gagal, coba ulangi lagi.');
			}
		}
	);
	return false;
}

function savedata_produk(){
	var msg = '';
	msg = validateEntryProduk();
	if(msg != ''){
		alert(msg);
	}else{
		$.ajax(
			{
				url: 'proc/savedata_produk.php',
				type: 'get',
				data: getParamProduk(true),
				success: function(html){
					$('#kategori').text('');
					alert('Data tersimpan.');
					loadform(2);
				},
				error: function(){
					alert('Maaf proses simpan gagal, coba ulangi lagi.');
					$('#kategori').text('');
				}
			}
		);
	}
	return false;
}

function getParamProduk(isSaving){
	var param = '';
	if(isSaving){
		param += 'kategori=' + $('#kategori').val();
		param += '&nmproduk=' + $('#nmproduk').val();
		param += '&szproduk=' + $('#szproduk').val();
		param += '&harga=' + $('#harga').val();
	}else{
		param += 'kategori=' + $('#kategori').val();
		param += '&nmproduk=' + $('#nmproduk').val();
		param += '&szproduk=' + $('#szproduk').val();
	}
	return param;
}

function validateEntryProduk(){
	var errormsg = '';
	if($('#kategori').val() == ''){
		errormsg += 'Kategori';
	}
	if($('#nmproduk').val() == ''){
		if(errormsg != ''){ errormsg += ', ';}
		errormsg += 'Nama Produk';
	}
	if($('#szproduk').val() == ''){
		if(errormsg != ''){ errormsg += ', ';}
		errormsg += 'Ukuran';
	}
	if($('#harga').val() == ''){
		if(errormsg != ''){ errormsg += ', ';}
		errormsg += 'Harga';
	}
	if(errormsg != ''){
		errormsg += ' masih kosong. Harap diisi dahulu.'
	}

	return errormsg;
}

function deletedata_produk(prodid){
	$.ajax(
		{
			url: 'proc/deletedata_produk.php',
			type: 'get',
			data: 'kdproduk=' + prodid,
			success: function(){
				alert('Data dihapus.');
				loadform(2);
			},
			error: function(){
				alert('Maaf proses hapus gagal, coba ulangi lagi.');
			}
		}
	);
	return false;
}


function getComboKategori(isFilter){
	var strFilter = 'false';
	if(isFilter){
		strFilter = 'true';
	}
	$.ajax(
		{
			url: 'proc/viewkategori.php',
			type: 'get',
			data: 'filt=' + strFilter,
			dataType: 'html',
			success: function(html){
				$('#kategori').append(html);
			},
			error: function(){

			}
		}
	);
}

$('#kategori').change(function(){
	loadDetailProduk();
});

$('#nmproduk').keyup(function(){
	loadDetailProduk();
	alert('asda');
});

$('#szproduk').keyup(function(){
	loadDetailProduk();
});

function loadDetailProduk(){
	$.ajax({
		url: 'proc/viewdetailproduk.php',
		type: 'get',
		dataType: 'html',
		data: getParamProduk(false),
		success: function(html){
			$('#list').html(html);
		},
		error: function(){

		}
	});
}

function loadform(id){
	var form = '';
	switch(id){
		case 1:
			form = 'form_entrykategori.php';break;
		case 2:
			form = 'form_entryproduk.php';break;
		case 3:
			form = 'list_detailproduk.php';break;
		default:
			form = '404.html';
	}
	$('#form').load(form);
}
