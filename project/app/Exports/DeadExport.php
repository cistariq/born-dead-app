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

class DeadExport implements FromCollection, WithHeadings, WithMapping, WithChunkReading
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

        return [
            $data['DEAD_CODE'],
            $data['DEAD_ID'],
            $data['DEAD_FIRST_NAME_AR'] . ' ' . $data['DEAD_FATHER_NAME_AR'] . ' ' . $data['DEAD_GRANDFATHER_NAME_AR'] . ' ' . $data['DEAD_LAST_NAME_AR'],
            $data['DEAD_DOB'],
            $data['DEAD_DOD'],
            $data['SEX_NAME_AR'],
            $data['R_NAME_AR'],
            $data['ICD1_NAME'],
            $data['DEAD_ICD1'],
            $data['ICD4_NAME'],
            $data['DEAD_ICD4'],
            $data['DREF_NAME_AR'],
            $data['DEATH_TYPE']

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
            'منطقة السكن',
            'سبب الوفاة',
            'كود سبب الوفاة',
            'المرض الأصلي',
            'كود المرض الأصلي',
            'المستشفى',
            'نوع الوفاة '

        ];
    }
}
