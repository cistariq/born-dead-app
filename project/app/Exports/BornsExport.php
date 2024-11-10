<?php

namespace App\Exports;

use App\Models\BORNS_INFO_TB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;

//use Illuminate\Http\Request;

class BornsExport implements FromCollection, WithHeadings, WithMapping
{

    protected $data;
    use Exportable;
    public function __construct($data)
    {
        $this->data = $data;
       // dd(55);
    }
    public function collection()
    {
        return collect($this->data);

    }
    public function map($data): array
    {
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
