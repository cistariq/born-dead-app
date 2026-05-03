<?php

namespace App\Exports;

use App\Models\DEADS_TB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\WithChunkReading;

//use Illuminate\Http\Request;

class MccdDeadExport implements FromCollection, WithHeadings, WithMapping, WithChunkReading
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
       // dd($this->data);
        return collect($this->data['data']);
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
        return [
            $data['DEAD_CODE'],
            $data['DEAD_ID'],
            $data['FULL_NAME'],
            $data['BIRTH_DATE'],
            $data['DEAD_DATE'],
            $data['SEX_NAME_AR'],
            $data['UNDERLYING_CAUSE_DEATH'],
            $data['TITLE'],
            $data['DREF_NAME_AR']
        ];
    }
    public function headings(): array
    {
        return  [
            'رقم السجل',
            'هوية المتوفي',
            'اسم المتوفي',
            'تاريخ الميلاد',
            'تاريخ الوفاة',
            'الجنس',
            'كود سبب الوفاة',
            'سبب الوفاة',
            'المستشفى',
        ];
    }
}
