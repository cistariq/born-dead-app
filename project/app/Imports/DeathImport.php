<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;

class DeathImport implements ToCollection
{
    public $previewData = [];
    public $finalData = [];

    public function collection(Collection $rows)
    {
        $ids = [];

        // =========================
        // استخراج IDs من Excel
        // =========================
        foreach ($rows as $index => $row) {

            $id = trim((string)($row[0] ?? ''));

            $id = preg_replace('/\s+/', '', $id);

            if ($id == '') continue;

            // تجاهل الهيدر
            if ($index == 0 && !is_numeric($id)) continue;

            $ids[] = $id;
        }

        // إزالة التكرار
        $ids = array_values(array_unique($ids));

        if (empty($ids)) return;

        // =========================
        // جلب البيانات من Oracle (حل ORA-01795)
        // =========================
        $allData = [];

        foreach (array_chunk($ids, 900) as $chunk) {

            // حماية إضافية
            if (count($chunk) > 1000) {
                throw new \Exception('Chunk exceeded Oracle limit');
            }

            $placeholders = implode(',', array_fill(0, count($chunk), '?'));

            $data = DB::connection('oracle')->select("
                SELECT DEAD_ID, DEAD_DOD, SOURCE
                FROM DEADS_TB
                WHERE DEAD_ID IN ($placeholders)
            ", $chunk);

            foreach ($data as $row) {
                $allData[$row->DEAD_ID] = $row;
            }
        }

        // =========================
        // تجهيز النتائج
        // =========================
        foreach ($ids as $id) {

            if (isset($allData[$id])) {

                $status = 'متوفي';
                $type   = $this->mapType($allData[$id]->SOURCE);
                $date   = $allData[$id]->DEAD_DOD;

            } else {

                $status = 'على قيد الحياة';
                $type   = '-';
                $date   = '-';
            }

            // Preview
            $this->previewData[] = [
                'id'     => $id,
                'status' => $status,
                'type'   => $type,
                'date'   => $date,
            ];

            // Export
            $this->finalData[] = [
                $id,
                $status,
                $type,
                $date,
            ];
        }
    }

    // =========================
    // Mapping type
    // =========================
    private function mapType($type)
    {
        switch ((string)$type) {

            case '0':
                return 'وفاة طبيعية';

            case '1':
                return 'شهيد';

            case '2':
                return 'وفاة طبيعية - لجنة';

            case '3':
                return 'شهيد غير مباشر';

            default:
                return 'غير معروف';
        }
    }
}
