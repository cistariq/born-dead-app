<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DeathExport implements FromArray, WithHeadings
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
            'حالة المواطن',
            'نوع الوفاة',
            'تاريخ الوفاة'
        ];
    }
}
