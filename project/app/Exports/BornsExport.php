<?php

namespace App\Exports;

use App\Models\BORNS_INFO_TB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\WithChunkReading;
//use Illuminate\Http\Request;

class BornsExport implements FromCollection, WithHeadings, WithMapping, WithChunkReading
{


    protected $data;
    use Exportable;
    use RemembersChunkOffset;

    public function __construct($data)
    {
        $this->data = $data;
        // dd(55);
    }
    public function collection()
    {
        return collect($this->data);
    }
    private $headers = [
        'Content-Type' => 'text/csv',
        'Content-Encoding'=> 'SHIFT-JIS' // somthing like this ?
    ];
    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }

    public function map($data): array
    {
    //   dd($[data0]);
     return [
        $data['BI_CODE'],
        $data['BI_ID'],
        $data['BI_FULL_NAME'],
        $data['MOTHER_FULL_NAME'],
        $data['BORN_DATE'],
        $data['DREF_NAME_AR']
    ];
    }
    public function headings(): array
    {
        return  [
            'رقم السجل',
            'هوية المولود',
            'اسم المولود بالكامل',
            'اسم الأم',
            'تاريخ الميلاد',
            'المركز الصحي'

        ];
    }
}
