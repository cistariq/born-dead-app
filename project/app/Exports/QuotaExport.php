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

class QuotaExport implements FromCollection, WithHeadings, WithMapping, WithChunkReading
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
        'Content-Encoding' => 'SHIFT-JIS' // somthing like this ?
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
        $status = (int)$data['order_status']; // 🔹 التحويل إلى رقم

        $statusText = match ($status) {
            0 => 'قيد الاعتماد',
            1 => 'معتمد',
            2 => 'تم الصرف',
            3 => 'ملغي',
            default => 'غير معروف',
        };

        return [
            $data['id'],
            $data['hos_name'],
            $data['current_number'],
            $data['last_number'],
            $data['remaining_digit'],
            $statusText,
            $data['release_from'],
            $data['release_to'],
        ];
    }
    public function headings(): array
    {
        return  [
            'رقم السجل',
            'المستشفى',
            'الرقم الحالي',
            'آخر رقم في الكوتة',
            'عدد الأرقام المتبقية',
            'حالة الطلب',
            'الرقم المصروف من',
            'الرقم المصروف إلى'

        ];
    }
}
