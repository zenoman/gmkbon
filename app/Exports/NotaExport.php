<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NotaExport implements FromCollection, WithHeadings, ShouldAutoSize
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
        return DB::table('nota')
        ->select(
            DB::raw('
                nota.kode,
                nota.tgl,
                users.username,
                nota.pembuat,
                nota.status,
                nota.total,
                nota.dibayar,
                nota.kekurangan'))
        ->leftjoin('users','users.id','=','nota.pembeli')
        ->whereBetween('tgl',[$tgl,$tgll])
        ->get();
    }

    public function headings(): array
    {
        return [
            'kode',
            'tanggal',
            'pembeli',
            'pembuat',
            'status',
            'total',
            'dibayar',
            'kekurangan',
        ];
    }
}
