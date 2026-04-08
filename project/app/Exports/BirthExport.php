<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BirthExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // =========================
    // البيانات
    // =========================
    public function array(): array
    {
        return $this->data;
    }

    // =========================
    // العناوين (Header)
    // =========================
    public function headings(): array
    {
        return [
            'رقم الهوية',
            'اسم المولود',
            'حالة الولادة',
            'مكان الولادة',
            'تاريخ الولادة'
        ];
    }
}
