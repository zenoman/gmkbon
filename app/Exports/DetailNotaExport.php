<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DetailNotaExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function __construct(string $tglmulai,string $tglselesai)
    {
        $this->tglmulai = $tglmulai;
        $this->tglselesai = $tglselesai;
    }
    public function collection()
    {
        $tgl = $this->tglmulai;
    	$tgll = $this->tglselesai;
        return DB::table('detail_nota')
        ->select(
            DB::raw('
                detail_nota.kode_nota,
                detail_nota.barang,
                detail_nota.jumlah,
                detail_nota.harga,
                detail_nota.subtotal,
                detail_nota.jumlah_dibayar,
                detail_nota.dibayar,
                detail_nota.kekurangan'))
        ->leftjoin('nota','nota.kode','=','detail_nota.kode_nota')
        ->whereBetween('nota.tgl',[$tgl,$tgll])
        ->get();
    }

    public function headings(): array
    {
        return [
            'kode nota',
            'barang',
            'jumlah',
            'harga',
            'subtotal',
            'jumlah dibayar',
            'dibayar',
            'kekurangan',
        ];
    }

}
