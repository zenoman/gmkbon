//fungsi remove html
	//====================================================
	Element.prototype.remove = function() {
	    this.parentElement.removeChild(this);
	}
	NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
	    for(var i = this.length - 1; i >= 0; i--) {
	        if(this[i] && this[i].parentElement) {
	            this[i].parentElement.removeChild(this[i]);
	        }
	    }
	}

	//====================================================
	var counter = 1; //variabel nomor inputan
	var realnomor = 0; 
	var nomornya = [];
	var limit = 16; //fungsi tambah input
	function addInput(divName){
		if(counter == limit){
    		alert("Limit hanya 15 inputan");
 		}else{
 			nomornya.push(counter);
		    var newdiv = document.createElement('div');
		    newdiv.innerHTML ='<div class="row" id="input'+ counter +'">'+
		                          '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">'+
		                              '<label>Nama Barang Ke-'+counter+'</label>'+
		                                    '<div class="nk-int-st">'+
		                                        '<input type="text" class="form-control" name="barang[]" id="barang'+counter+'">'+
		                                        '<br>'+
		                                    '</div>'+
		                          '</div>'+
		                          '<div class="row">'+
		                          '<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">'+
		                              '<label>Jumlah</label>'+
		                                    '<div class="nk-int-st">'+
		                                        '<input type="number" onchange="hitungtotal('+counter+')" class="form-control" value="0" id="jumlah'+counter+'" name="jumlah[]">'+
		                                        '<br>'+
		                                    '</div>'+
		                          '</div>'+
		                          '<div class="row">'+
		                          '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">'+
		                              '<label>Harga</label>'+
		                                    '<div class="nk-int-st">'+
		                                        '<input type="number" class="form-control" id="harga'+counter+'" value="0" onchange="hitungtotal('+counter+')" name="harga[]">'+
		                                        '<br>'+
		                                    '</div>'+
		                          '</div>'+
		                          '<div class="row">'+
		                          '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">'+
		                              '<label>Jumlah Dibayar</label>'+
		                                    '<div class="nk-int-st">'+
		                                        '<input type="number" class="form-control" value="0" onchange="hitungtotal('+counter+')" name="jumlahbayar[]" id="jumlahbayar'+counter+'">'+
		                                        '<br>'+
		                                    '</div>'+
		                          '</div>'+
		                          '<div class="row">'+
		                          '<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">'+
		                              '<label>Total</label>'+
		                                    '<div class="nk-int-st">'+
		                                        '<input type="number" class="form-control" id="total'+counter+'" value="0"  name="total[]" readonly>'+
		                                        '<br>'+
		                                    '</div>'+
		                          '</div>'+
		                          '<div class="row">'+
		                          '<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">'+
		                              '<label>Dibayar</label>'+
		                                    '<div class="nk-int-st">'+
		                                        '<input type="number" class="form-control" value="0" name="dibayar[]" id="dibayar'+counter+'" readonly>'+
		                                        '<br>'+
		                                    '</div>'+
		                          '</div>'+
		                          '<div class="row">'+
		                          '<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">'+
		                              '<label>Kekurangan</label>'+
		                                    '<div class="nk-int-st">'+
		                                        '<input type="number" class="form-control" id="kekurangan'+counter+'" value="0"  name="kekurangan[]" readonly>'+
		                                        '<br>'+
		                                    '</div>'+
		                          '</div>'+
		                          '<div class="row">'+
		                          '<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">'+
		                          '<br>'+
		                          '<button onclick="del('+counter+')" type="button" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>'+
		                          '</div>'+
		                          '</div>'+
		                        '</div>';
		    document.getElementById(divName).appendChild(newdiv);
		    counter++;
		    realnomor++;
 		}}

		//=================================================================
		//fungsi hapus input
		function del(no) {
		  	var totalharga = $('#total_harganya').val();
		  	var harga = $('#total'+no).val();
		  	var totalharganya = parseInt(totalharga) - parseInt(harga);
		  	$('#total_harganya').val(totalharganya);
			realnomor = realnomor - 1;
			nomornya = jQuery.grep(nomornya,function(value){
		    	return value != no;
		    });

		  	document.getElementById('input'+no).remove();
		  	hitungtotalharga();
				hitungbayar();
		}

		//=================================================================
		function hitungtotal(nomor){

			var dibayar = $('#jumlahbayar'+nomor).val();
			var jumlah = $('#jumlah'+nomor).val();
			var harga = $('#harga'+nomor).val();
			if(dibayar > jumlah){
				alert('Oops, Tolong cek lagi dong yang di input');
				$('#jumlah'+nomor).val(0);
				$('#jumlahbayar'+nomor).val(0);

				var totalbayar = 0*parseInt(harga);
				var total = 0*parseInt(harga);
				var kekurangan = parseInt(total)-parseInt(totalbayar);

				$('#kekurangan'+nomor).val(kekurangan);
				$('#dibayar'+nomor).val(totalbayar);
				$('#total'+nomor).val(total);
				hitungtotalharga();
				hitungbayar();
			}else{
				var totalbayar = parseInt(dibayar)*parseInt(harga);
				var total = parseInt(jumlah)*parseInt(harga);
				var kekurangan = parseInt(total)-parseInt(totalbayar);

				$('#kekurangan'+nomor).val(kekurangan);
				$('#dibayar'+nomor).val(totalbayar);
				$('#total'+nomor).val(total);
				hitungtotalharga();
				hitungbayar();
			}
			
		}

		//=================================================================
		function hitungtotalharga(){
			var totalharganya = 0;
			for (var i = 0; i < realnomor; i++){
				var total = $('#total'+nomornya[i]).val();
				totalharganya += parseInt(total);
			}
			$('#total_harganya').val(totalharganya);
		}

		//=================================================================
		function hitungbayar(){
			var totaldibayar = 0;
			var totalbayar = $('#total_harganya').val();
			for (var i = 0; i < realnomor; i++){
				var dibayar = $('#dibayar'+nomornya[i]).val();
				totaldibayar += parseInt(dibayar);
			}
			if(parseInt(totalbayar) > parseInt(totaldibayar)){
				var kekurangan = parseInt(totalbayar)-parseInt(totaldibayar);
			}else{
				var kekurangan = parseInt(totaldibayar)-parseInt(totalbayar);
			}
			$('#total_bayar').val(totaldibayar);
			$('#kembalianya').val(kekurangan);
			if(parseInt(totaldibayar)!=0 && parseInt(totaldibayar)!=0){
				if(parseInt(totalbayar)==parseInt(totaldibayar)){
					$('#status').val('lunas');
				}else{
					$('#status').val('belum lunas');
				}	
			}else{
				$('#status').val('belum lunas');
			}
			
			$('#kembalian').html('Rp. '+rupiah(kekurangan));
		}

		//=================================================================
		function rupiah(bilangan){
			var	number_string = bilangan.toString(),
			sisa 	= number_string.length % 3,
			rupiah 	= number_string.substr(0, sisa),
			ribuan 	= number_string.substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

			return rupiah;
		}

		function cetaknota(){
			if(realnomor == 0){
				alert('Oops Di isi dulu dong notanya !');
				return false;
			}else{
				var no=0;
				var rows2='';
				for (var i = 0; i < realnomor; i++){
				no +=1;
                rows2 = rows2 + '<tr>';
                rows2 = rows2 + '<td align="center" style="border: 1px solid black;">' +no+'</td>';
                rows2 = rows2 + '<td align="center" style="border: 1px solid black;">' +$('#jumlah'+nomornya[i]).val();+' Pcs </td>';
                rows2 = rows2 + '<td align="center" style="border: 1px solid black;">' + $('#barang'+nomornya[i]).val();+'</td>';
                rows2 = rows2 + '<td align="right" style="border: 1px solid black;"> Rp. ' +rupiah($('#harga'+nomornya[i]).val())+'</td>';
                rows2 = rows2 + '<td align="center" style="border: 1px solid black;">'+$('#jumlahbayar'+nomornya[i]).val();+'</td>';
                rows2 = rows2 + '<td align="right" style="border: 1px solid black;"> Rp. ' +rupiah($('#total'+nomornya[i]).val())+'</td>';
                rows2 = rows2 + '<td align="right" style="border: 1px solid black;"> Rp. ' +rupiah($('#dibayar'+nomornya[i]).val())+'</td>';
                rows2 = rows2 + '<td align="right" style="border: 1px solid black;"> Rp. ' +rupiah($('#kekurangan'+nomornya[i]).val())+'</td>';
                rows2 = rows2 + '</tr>';
				}
				$('#datacetak').html(rows2);
				$('#datacetak1').html(rows2);
				$('#datatotal').html('Rp. '+rupiah($('#total_harganya').val()));
				$('#datatotal1').html('Rp. '+rupiah($('#total_harganya').val()));
				$('#datadibayar').html('Rp. '+rupiah($('#total_bayar').val()));
				$('#datadibayar1').html('Rp. '+rupiah($('#total_bayar').val()));
				$('#datakekurangan').html('Rp. '+rupiah($('#kembalianya').val()));
				$('#datakekurangan1').html('Rp. '+rupiah($('#kembalianya').val()));
				var divToPrint=document.getElementById('hidden_div');
				var newWin=window.open('','Print-Window');
				newWin.document.open();
				newWin.document.write('<html><body onload="window.print();window.close()">'+divToPrint.innerHTML+'</body></html>');
				newWin.document.close();
				return true;
			}
		}
		window.cetaknota = cetaknota;