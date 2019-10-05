<!DOCTYPE html>
<html>
<head>
	<title>ceta ulang</title>
</head>
<body onload="window.print();window.close();">
<div id="hidden_div">
            <table width="100%">
                <tr>
                    <td width="49%">
                    	@foreach($data as $row)
                        <table width="100%" style="margin-bottom: 5px;">
                            <tr>
                                <td style="border: 1px solid black;" width="45%">
                                    <p style="font-size: 10;margin-left: 2%;margin-top: 2%;">No.Nota : {{$row->kode}}</p>
                                    <p style="font-size: 10;margin-left: 2%;margin-bottom: 2%;">Pembuat : {{$row->pembuat}}</p>
                                </td>
                                <td width="10%">
                                </td>
                                <td style="border: 1px solid black;" width="45%">
                                    <p style="font-size: 10;margin-left: 2%;margin-top: 2%;">Tgl :{{$row->tgl}}</p>
                                    <p style="font-size: 10;margin-left: 2%;margin-bottom: 2%;">Tuan/Toko : Grosir Murah Kediri</p>
                                </td>   
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <tr>
                               
                                
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <thead>
                                <td align="center" style="border: 1px solid black;">
                                    No
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Jml
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Barang
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Harga
                                </td>

                                <td align="center" style="border: 1px solid black;">
                                    Jml Dibayar
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Total
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Dibayar
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Kekurangan
                                </td>
                            </thead>
                            <tbody id="datacetak">
                            	<?php $i=1;?>
                                @foreach($datadetail as $row2)
									<tr>
										<td align="center" style="border: 1px solid black;">{{$i++}}</td>
										<td align="center" style="border: 1px solid black;">{{$row2->jumlah}}</td>
										<td align="center" style="border: 1px solid black;">{{$row2->barang}}</td>
										<td align="right" style="border: 1px solid black;">{{"Rp ". number_format($row2->harga,0,',','.')}}</td>
										<td align="center" style="border: 1px solid black;">{{$row2->jumlah_dibayar}}</td>
										<td align="right" style="border: 1px solid black;">{{"Rp ". number_format($row2->subtotal,0,',','.')}}</td>
										<td align="right" style="border: 1px solid black;">{{"Rp ". number_format($row2->dibayar,0,',','.')}}</td>
										<td align="right" style="border: 1px solid black;">{{"Rp ". number_format($row2->kekurangan,0,',','.')}}</td>
									</tr>									
                                @endforeach
                            </tbody>
                           <tfoot>
                                <tr>
                                    <td colspan="5" style="border: 1px solid black;" align="center">total</td>
                                    <td align="right" style="border: 1px solid black;"><span id="datatotal1">{{"Rp ". number_format($row->total,0,',','.')}}</span></td>
                                    <td align="right" style="border: 1px solid black;"><span id="datadibayar1">{{"Rp ". number_format($row->dibayar,0,',','.')}}</span></td>
                                    <td align="right" style="border: 1px solid black;"><span id="datakekurangan1">{{"Rp ". number_format($row->kekurangan,0,',','.')}}</span></td>
                                </tr>
                            </tfoot>
                        </table>
                        <table width="100%">
                            <tr>
                                <td width="50%" align="center">
                                    <p style="font-size: 10;">Penerima</p>
                                    <br>
                                    <p style="font-size: 10;">.....................</p>
                                </td>
                                <td width="50%" align="center">
                                     <p style="font-size: 10;">Hormat Kami</p>
                                    <br>
                                    <p style="font-size: 10;">.....................</p>
                                </td>
                                
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <tr>
                                <td align="center" bgcolor="#000000">
                                    <p style="color: white; font-size: 8;">GROSIR|ECER|DROPSHIP|PUSAT BAJU TERMURAH, TERBARU & BERKUALITAS DI KOTA KEDIRI</p>
                                    
                                </td>
                            </tr>
                        </table>
                        @endforeach
                    </td>
                    <td width="2%">
                    <hr width="1" size="100%">
                    </td>
                    <td width="49%" bgcolor="#ffff99">
                    	@foreach($data as $row)
                         <table width="100%" style="margin-bottom: 5px;">
                            <tr>
                                <td style="border: 1px solid black;" width="45%">
                                    <p style="font-size: 10;margin-left: 2%;margin-top: 2%;">No.Nota : {{$row->kode}}</p>
                                    <p style="font-size: 10;margin-left: 2%;margin-bottom: 2%;">Pembuat :{{$row->pembuat}}</p>
                                </td>
                                <td width="10%">
                                </td>
                                <td style="border: 1px solid black;" width="45%">
                                    <p style="font-size: 10;margin-left: 2%;margin-top: 2%;">Tgl :{{$row->tgl}}</p>
                                    <p style="font-size: 10;margin-left: 2%;margin-bottom: 2%;">Tuan/Toko : Grosir Murah Kediri</p>
                                </td>   
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <tr>
                                
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <thead>
                                <td align="center" style="border: 1px solid black;">
                                    No
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Jml
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Barang
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Harga
                                </td>

                                <td align="center" style="border: 1px solid black;">
                                    Jml Dibayar
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Total
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Dibayar
                                </td>
                                <td align="center" style="border: 1px solid black;">
                                    Kekurangan
                                </td>
                            </thead>
                            <tbody id="datacetak1">
                            <?php $i=1;?>
                               @foreach($datadetail as $row2)
									<tr>
										<td align="center" style="border: 1px solid black;">{{$i++}}</td>
										<td align="center" style="border: 1px solid black;">{{$row2->jumlah}}</td>
										<td align="center" style="border: 1px solid black;">{{$row2->barang}}</td>
										<td align="right" style="border: 1px solid black;">{{"Rp ". number_format($row2->harga,0,',','.')}}</td>
										<td align="center" style="border: 1px solid black;">{{$row2->jumlah_dibayar}}</td>
										<td align="right" style="border: 1px solid black;">{{"Rp ". number_format($row2->subtotal,0,',','.')}}</td>
										<td align="right" style="border: 1px solid black;">{{"Rp ". number_format($row2->dibayar,0,',','.')}}</td>
										<td align="right" style="border: 1px solid black;">{{"Rp ". number_format($row2->kekurangan,0,',','.')}}</td>
									</tr>									
                                @endforeach   
                            </tbody>
                           <tfoot>
                                <tr>
                                    <td colspan="5" style="border: 1px solid black;" align="center">total</td>
                                    <td align="right" style="border: 1px solid black;"><span id="datatotal1">{{"Rp ". number_format($row->total,0,',','.')}}</span></td>
                                    <td align="right" style="border: 1px solid black;"><span id="datadibayar1">{{"Rp ". number_format($row->dibayar,0,',','.')}}</span></td>
                                    <td align="right" style="border: 1px solid black;"><span id="datakekurangan1">{{"Rp ". number_format($row->kekurangan,0,',','.')}}</span></td>
                                </tr>
                            </tfoot>
                        </table>
                        <table width="100%">
                            <tr>
                                <td width="50%" align="center">
                                    <p style="font-size: 10;">Penerima</p>
                                    <br>
                                    <p style="font-size: 10;">.....................</p>
                                </td>
                                <td width="50%" align="center">
                                     <p style="font-size: 10;">Hormat Kami</p>
                                    <br>
                                    <p style="font-size: 10;">.....................</p>
                                </td>
                                
                            </tr>
                        </table>
                        <table width="100%" style="border-collapse:collapse;border: 1px solid black;margin-bottom: 5px;">
                            <tr>
                                <td align="center" bgcolor="#000000">
                                    <p style="color: white; font-size: 8;">GROSIR|ECER|DROPSHIP|PUSAT BAJU TERMURAH, TERBARU & BERKUALITAS DI KOTA KEDIRI</p>
                                    
                                </td>
                            </tr>
                        </table>
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>
</body>
</html>