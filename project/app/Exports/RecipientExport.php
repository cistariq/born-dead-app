<?php

namespace App\Exports;

use  App\Models\Recipient;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


use Illuminate\Http\Request;

class RecipientExport implements FromCollection, WithHeadings
{
    public function collection()
    {

        return Recipient::select('id_no', 'name', 'city_id', 'recipient_id_no', 'recipient_name', 'mobile')->get();
    }
    public function headings(): array
    {
        return  [
            '#',
            'هوية الشهيد',
            'اسم الشهيد',
            'المنطقة',
            'هوية المستلم',
            'اسم المستلم',
            'جوال المستلم'

        ];
    }
}
