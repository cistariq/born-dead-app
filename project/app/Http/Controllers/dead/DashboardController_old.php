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

class DashboardController extends Controller
{

 public function index(Request $request)
{
    // ==============================
    // 1) تجهيز القيم الافتراضية للمستخدم
    // ==============================
    $userId = Auth::id();
    $defaultHospital = User::where('id', $userId)->value('user_dref_cd');

    // ==============================
    // 2) قراءة مُدخلات التصفية (GET)
    // ==============================
    $dateFrom = $request->input('P_ENTER_FROM', '01/05/2025');
    $dateTo   = $request->input('P_ENTER_TO', date('d/m/Y'));
    $hosNo    = $request->input('hos_no', $defaultHospital);

    $data['date_from'] = $dateFrom;
    $data['date_to']   = $dateTo;
    $data['hos_no']    = $hosNo;

    // ==============================
    // 3) جلب قائمة المستشفيات
    // ==============================
    $data['hospitals'] = C_DETAILS_REFERRAL_TB::get();

    // ==============================
    // 4) بناء الاستعلامات الأساسية
    // ==============================
    $deadQuery = DEADS_TB::query();
    $bornBase = BORNS_INFO_TB::query()
        ->leftJoin(
            'BORN_DETAILS_TB',
            'BORN_DETAILS_TB.BORN_DETAILS_CODE',
            '=',
            'BORNS_INFO_TB.BI_ADMISSION_CD'
        );

    // تطبيق تصفية المستشفى
    if (!empty($hosNo)) {
        $deadQuery->where('DEAD_HOS_NAME_CD', $hosNo);
        $bornBase->where('BORN_DETAILS_TB.BORN_DETAILS_BIRTH_PLACE_CD', $hosNo);
    }

    // تطبيق تصفية التاريخ
    try {
        $fromDateCarbon = Carbon::createFromFormat('d/m/Y', $dateFrom)->startOfDay();
        $toDateCarbon   = Carbon::createFromFormat('d/m/Y', $dateTo)->endOfDay();

        $deadQuery->whereBetween('DEAD_DOD', [$fromDateCarbon, $toDateCarbon]);
        $bornBase->whereBetween('BORN_DETAILS_TB.BORN_DETAILS_DELIVERY_DATE', [$fromDateCarbon, $toDateCarbon]);
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

    // ==============================
    // 5) إحصائيات الوفيات
    // ==============================
        $Deads = DEADS_TB::GET_COUNT_DEAD();


        $chart_data = [];
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
        ->select('C_REGION_TB.R_NAME_AR as name', DB::raw('COUNT(*) AS total'))
        ->groupBy('C_REGION_TB.R_NAME_AR');

    if (!empty($hosNo)) {
        $RegionsQuery->where('DEADS_TB.DEAD_HOS_NAME_CD', $hosNo);
    }
    if (isset($fromDateCarbon, $toDateCarbon)) {
        $RegionsQuery->whereBetween('DEADS_TB.DEAD_DOD', [$fromDateCarbon, $toDateCarbon]);
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
        ->select('BORN_DETAILS_TB.BORN_DETAILS_REGION_CD as NAME', DB::raw('COUNT(DISTINCT BORNS_INFO_TB.BI_ADMISSION_CD) AS TOTAL'))
        ->when($hosNo, fn($q) => $q->where('BORN_DETAILS_TB.BORN_DETAILS_BIRTH_PLACE_CD', $hosNo))
        ->when(isset($fromDateCarbon, $toDateCarbon), fn($q) => $q->whereBetween('BORN_DETAILS_TB.BORN_DETAILS_DELIVERY_DATE', [$fromDateCarbon, $toDateCarbon]))
        ->groupBy('BORN_DETAILS_TB.BORN_DETAILS_REGION_CD')
        ->get()
        ->toArray();

    $city_data = [];
    foreach ($Born_City as $city) {
        $city_data[] = [
            'name_city2'  => $city['NAME'] ?? ($city['name'] ?? ''),
            'total_city2' => $city['TOTAL'] ?? ($city['total'] ?? 0),
        ];
    }

    // ==============================
    // 8) الإحصائيات العامة في العرض
    // ==============================
    $data['chart_data'] = $chart_data;
    $data['region_data'] = $region_data;
    $data['city_data']   = $city_data;

    return view('dashboard', $data);
}

    public function welcome()
    {
        // dd($_SESSION);
        return view('dead.welcome');
    }
}
