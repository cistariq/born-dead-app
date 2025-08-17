<?php

namespace App\Http\Controllers\dead;

use App\Http\Controllers\Controller;
use App\Models\DEADS_TB;
use App\Models\BORNS_INFO_TB;
use App\Models\C_DETAILS_REFERRAL_TB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;


class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $data['hospitals'] = C_DETAILS_REFERRAL_TB::get();

        // ==============================
        // 1) تجهيز القيم الافتراضية للمستخدم
        // ==============================
        $userId = Auth::id();
        $defaultHospital = User::where('id', $userId)->value('user_dref_cd');

        // ==============================
        // 2) قراءة مُدخلات التصفية (GET)
        // ==============================
        $dateFrom = $request->input('P_ENTER_FROM', date('d/m/Y 00:00'));
        $dateTo   = $request->input('P_ENTER_TO', date('d/m/Y H:i'));
        $hosNo    = $request->input('hos_no', $defaultHospital);

        $data['date_from'] = $dateFrom;
        $data['date_to']   = $dateTo;
        $data['hos_no']    = $hosNo;

        // ==============================
        // 3) جلب قائمة المستشفيات
        // ==============================


        // ==============================
        // 4) بناء الاستعلامات الأساسية
        // ==============================
        $deadQuery = DEADS_TB::query()
            ->select('DEADS_TB.*')
            ->join('DEAD_DETAIL_TB', 'DEADS_TB.DEAD_CODE', '=', 'DEAD_DETAIL_TB.DEAD_D_CODE');
        $bornBase = BORNS_INFO_TB::query()
            ->leftJoin(
                'BORN_DETAILS_TB',
                'BORN_DETAILS_TB.BORN_DETAILS_CODE',
                '=',
                'BORNS_INFO_TB.BI_ADMISSION_CD'
            );

        // تطبيق تصفية المستشفى
        if (!empty($hosNo)) {
            $deadQuery->where('DEAD_REGISTER_PLACE_CD', $hosNo);
            $bornBase->where('BORN_DETAILS_TB.BORN_DETAILS_BIRTH_PLACE_CD', $hosNo);
        }

        // تطبيق تصفية التاريخ
        try {

            $deadQuery->whereRaw("DEAD_REPORT_CREATED_ON BETWEEN TO_DATE(?, 'DD/MM/YYYY HH24:MI') AND TO_DATE(?, 'DD/MM/YYYY HH24:MI')", [$dateFrom, $dateTo]);
            // $deadQuery->whereBetween('DEAD_DOD', [$fromDateCarbon, $toDateCarbon]);
            //  $bornBase->whereBetween('BORN_DETAILS_TB.BORN_DETAILS_DELIVERY_DATE', [$fromDateCarbon, $toDateCarbon]);
            $bornBase->whereRaw("BORNS_INFO_TB.BI_NOTIFICATION_CREATED_ON BETWEEN TO_DATE(?, 'DD/MM/YYYY HH24:MI') AND TO_DATE(?, 'DD/MM/YYYY HH24:MI')", [$dateFrom, $dateTo]);
        } catch (\Exception $e) {
            // تجاهل خطأ التاريخ
        }

        // ==============================
        // 5) الإحصائيات العامة
        // ==============================
        $data['DeadCount']    = $deadQuery->count();
        $data['DeadCount_M']  = (clone $deadQuery)->where('DEAD_SEX_CD', 1)->count();
        $data['DeadCount_F']  = (clone $deadQuery)->where('DEAD_SEX_CD', 2)->count();

        $data['BornCount']    = (clone $bornBase)->distinct('BORNS_INFO_TB.BI_ADMISSION_CD')->count('BORNS_INFO_TB.BI_ADMISSION_CD');
        $data['BornCount_M']  = (clone $bornBase)->where('BORNS_INFO_TB.BI_SEX_CD', 1)->distinct('BORNS_INFO_TB.BI_ADMISSION_CD')->count('BORNS_INFO_TB.BI_ADMISSION_CD');
        $data['BornCount_F']  = (clone $bornBase)->where('BORNS_INFO_TB.BI_SEX_CD', 2)->distinct('BORNS_INFO_TB.BI_ADMISSION_CD')->count('BORNS_INFO_TB.BI_ADMISSION_CD');


        $request->merge(["Death_date_frm" =>  date('d/m/Y')]);
        $request->merge(["Death_date_to" =>  date('d/m/Y')]);
        $Deads = DEADS_TB::GET_COUNT_DEAD($request->all());
       // dd($Deads);
        $chart_data = [];
        $region_data = [];
        foreach ($Deads as $Dead) {
            $chart_data[] = [
                'name' => $Dead['NAME'],
                'total' => $Dead['TOTAL'],
            ];
        }
        // 6) الإحصائيات حسب المناطق (وفيات)
        // ==============================

        $region_data = [];
        $RegionsQuery = DB::table('DEADS_TB')
            ->join('C_REGION_TB', 'C_REGION_TB.R_CODE', '=', 'DEADS_TB.DEAD_REGION_CD')
            ->join('DEAD_DETAIL_TB', 'DEAD_DETAIL_TB.DEAD_D_CODE', '=', 'DEADS_TB.DEAD_CODE')
            ->select('C_REGION_TB.R_NAME_AR as name', DB::raw('COUNT(*) AS total'))
            ->groupBy('C_REGION_TB.R_NAME_AR');

        if (!empty($hosNo)) {
            $RegionsQuery->where('DEAD_DETAIL_TB.DEAD_REGISTER_PLACE_CD', $hosNo);
        }

        if (!empty($dateFrom) && !empty($dateTo)) {
            $RegionsQuery->whereRaw(
                "DEADS_TB.DEAD_REPORT_CREATED_ON BETWEEN TO_DATE(?, 'DD/MM/YYYY HH24:MI') AND TO_DATE(?, 'DD/MM/YYYY HH24:MI')",
                [$dateFrom, $dateTo]
            );
        }

        $Regions = $RegionsQuery->get();
        foreach ($Regions as $Region) {
            $region_data[] = [
                'name_city'  => $Region->NAME ?? ($Region->name ?? ''),
                'total_city' => $Region->TOTAL ?? ($Region->total ?? 0),

            ];
        }

        // ==============================
        // 7) بيانات المدن (المواليد) - استعلام جديد
        // ==============================
        $Born_City = BORNS_INFO_TB::query()
            ->leftJoin(
                'BORN_DETAILS_TB',
                'BORN_DETAILS_TB.BORN_DETAILS_CODE',
                '=',
                'BORNS_INFO_TB.BI_ADMISSION_CD'
            )
            ->join(
                'C_REGION_TB',
                'C_REGION_TB.R_CODE',
                '=',
                'BORN_DETAILS_TB.BORN_DETAILS_REGION_CD'
            )
            ->select(
                'C_REGION_TB.R_NAME_AR as NAME',
                DB::raw('COUNT(DISTINCT BORNS_INFO_TB.BI_ADMISSION_CD) AS TOTAL')
            )
            ->when($hosNo, function ($q) use ($hosNo) {
                return $q->where('BORN_DETAILS_TB.BORN_DETAILS_BIRTH_PLACE_CD', $hosNo);
            })
            ->when(
                !empty($dateFrom) && !empty($dateTo),
                function ($q) use ($dateFrom, $dateTo) {
                    return $q->whereRaw(
                        "BORNS_INFO_TB.BI_NOTIFICATION_CREATED_ON BETWEEN TO_DATE(?, 'DD/MM/YYYY HH24:MI') AND TO_DATE(?, 'DD/MM/YYYY HH24:MI')",
                        [$dateFrom, $dateTo]
                    );
                }
            )
            ->groupBy('C_REGION_TB.R_NAME_AR')
            ->get()
            ->toArray();

        $city_data = [];
        foreach ($Born_City as $city) {
            $city_data[] = [
                'name_city2'  => $city['name'] ?? ($city['name'] ?? ''),
                'total_city2' => $city['TOTAL'] ?? ($city['total'] ?? 0),
            ];
        }

        $data['chart_data'] = $chart_data;
        $data['region_data'] = $region_data;
        $data['city_data'] = $city_data;
        //dd($data);
        return view('dashboard', $data);
    }
    public function getStatistics(Request $request)
    {
        // التحقق من صحة البيانات
        $rules = [
            'dateFrom' => 'required|date_format:d/m/Y',
            'dateTo'   => 'required|date_format:d/m/Y',
            'hosNo'    => 'nullable|exists:C_DETAILS_REFERRAL_TB,DREF_CODE', // تحديد العمود
        ];
        $data = $request->validate($rules);
       // dd( $request->all());

        // تعريف المتغيرات المطلوبة
        $dateFrom = $request->input('dateFrom') . ' 00:00';
        $dateTo = $request->input('dateTo') . ' ' . now()->format('H:i');
        $hosNo = $request->input('hosNo', null);

        // استعلام الوفيات
        $deadQuery = DEADS_TB::query()
            ->select('DEADS_TB.*')
            ->join('DEAD_DETAIL_TB', 'DEADS_TB.DEAD_CODE', '=', 'DEAD_DETAIL_TB.DEAD_D_CODE');

        // استعلام المواليد
        $bornBase = BORNS_INFO_TB::query()
            ->leftJoin('BORN_DETAILS_TB', 'BORN_DETAILS_TB.BORN_DETAILS_CODE', '=', 'BORNS_INFO_TB.BI_ADMISSION_CD');

        // فلترة المستشفى
        if ($hosNo) {
            $deadQuery->where('DEAD_DETAIL_TB.DEAD_REGISTER_PLACE_CD', $hosNo);
            $bornBase->where('BORN_DETAILS_TB.BORN_DETAILS_BIRTH_PLACE_CD', $hosNo);
        }

        // فلترة بالتاريخ
        $deadQuery->whereRaw("DEAD_REPORT_CREATED_ON BETWEEN TO_DATE(?, 'DD/MM/YYYY HH24:MI') AND TO_DATE(?, 'DD/MM/YYYY HH24:MI')", [$dateFrom, $dateTo]);
        $bornBase->whereRaw("BORNS_INFO_TB.BI_NOTIFICATION_CREATED_ON BETWEEN TO_DATE(?, 'DD/MM/YYYY HH24:MI') AND TO_DATE(?, 'DD/MM/YYYY HH24:MI')", [$dateFrom, $dateTo]);

        // الإحصائيات العامة
        $data['DeadCount']   = $deadQuery->count();
        $data['DeadCount_M'] = (clone $deadQuery)->where('DEAD_SEX_CD', 1)->count();
        $data['DeadCount_F'] = (clone $deadQuery)->where('DEAD_SEX_CD', 2)->count();

        $data['BornCount']   = (clone $bornBase)->distinct('BORNS_INFO_TB.BI_ADMISSION_CD')->count('BORNS_INFO_TB.BI_ADMISSION_CD');
        $data['BornCount_M'] = (clone $bornBase)->where('BORNS_INFO_TB.BI_SEX_CD', 1)->distinct('BORNS_INFO_TB.BI_ADMISSION_CD')->count('BORNS_INFO_TB.BI_ADMISSION_CD');
        $data['BornCount_F'] = (clone $bornBase)->where('BORNS_INFO_TB.BI_SEX_CD', 2)->distinct('BORNS_INFO_TB.BI_ADMISSION_CD')->count('BORNS_INFO_TB.BI_ADMISSION_CD');

        // استدعاء بيانات الوفيات حسب السبب
        $request->merge([
            'Death_date_frm' => $data['dateFrom'], // بدون وقت
            'Death_date_to'  => $data['dateTo'],   // بدون وقت
        ]);
        //dd($request->all());
        $Deads = DEADS_TB::GET_COUNT_DEAD($request->all());

        $chart_data = collect($Deads)->map(function ($Dead) {
            return [
                'name'  => $Dead['NAME'],
                'total' => $Dead['TOTAL'],
            ];
        })->toArray();

        // إحصائيات الوفيات حسب المناطق
        $regionQuery = DB::table('DEADS_TB')
            ->join('C_REGION_TB', 'C_REGION_TB.R_CODE', '=', 'DEADS_TB.DEAD_REGION_CD')
            ->join('DEAD_DETAIL_TB', 'DEAD_DETAIL_TB.DEAD_D_CODE', '=', 'DEADS_TB.DEAD_CODE')
            ->select('C_REGION_TB.R_NAME_AR as name', DB::raw('COUNT(*) AS total'))
            ->groupBy('C_REGION_TB.R_NAME_AR');

        if ($hosNo) {
            $regionQuery->where('DEAD_DETAIL_TB.DEAD_REGISTER_PLACE_CD', $hosNo);
        }

        $regionQuery->whereRaw("DEADS_TB.DEAD_REPORT_CREATED_ON BETWEEN TO_DATE(?, 'DD/MM/YYYY HH24:MI') AND TO_DATE(?, 'DD/MM/YYYY HH24:MI')", [$dateFrom, $dateTo]);
        $region_data = $regionQuery->get()->map(function ($region) {
            return [
                'name_city'  => $region->name,
                'total_city' => $region->total,
            ];
        })->toArray();

        // إحصائيات المواليد حسب المناطق
        $born_city = BORNS_INFO_TB::query()
            ->leftJoin('BORN_DETAILS_TB', 'BORN_DETAILS_TB.BORN_DETAILS_CODE', '=', 'BORNS_INFO_TB.BI_ADMISSION_CD')
            ->join('C_REGION_TB', 'C_REGION_TB.R_CODE', '=', 'BORN_DETAILS_TB.BORN_DETAILS_REGION_CD')
            ->select('C_REGION_TB.R_NAME_AR as name', DB::raw('COUNT(DISTINCT BORNS_INFO_TB.BI_ADMISSION_CD) AS total'))
            ->when($hosNo, fn($q) => $q->where('BORN_DETAILS_TB.BORN_DETAILS_BIRTH_PLACE_CD', $hosNo))
            ->whereRaw("BORNS_INFO_TB.BI_NOTIFICATION_CREATED_ON BETWEEN TO_DATE(?, 'DD/MM/YYYY HH24:MI') AND TO_DATE(?, 'DD/MM/YYYY HH24:MI')", [$dateFrom, $dateTo])
            ->groupBy('C_REGION_TB.R_NAME_AR')
            ->get()
            ->map(function ($city) {
                return [
                    'name_city2'  => $city->name,
                    'total_city2' => $city->total,
                ];
            })->toArray();

        // إضافة النتائج إلى مصفوفة البيانات
        $data['chart_data']  = $chart_data;
        $data['region_data'] = $region_data;
        $data['city_data']   = $born_city;

        // إرجاع النتيجة كـ JSON
        return response()->json($data);
    }


    public function welcome()
    {

        //dd(session()->all());
        return view('dead.welcome');
    }
}
