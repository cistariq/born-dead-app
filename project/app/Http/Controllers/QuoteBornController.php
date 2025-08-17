<?php

namespace App\Http\Controllers;

use App\Rules\StartWith;

use App\Http\Controllers\Controller;
use App\Http\Traits\CitizenDataTrait;
use App\Http\Traits\BornDataTrait;
use App\Http\Traits\BirthApiTrait;
use App\Models\Constant;
use App\Models\Log;
use App\Models\C_DETAILS_REFERRAL_TB;
use App\Models\C_MARTIAL_STATUS_TB;
use App\Models\C_RELEGION_TB;
use App\Models\C_JOB_TB;
use App\Models\C_CITY_TB;
use App\Models\C_REGION_TB;
use App\Models\BORNS_INFO_TB;
use App\Exports\BornExport;
use App\Exports\BornsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Quota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class QuoteBornController extends Controller
{
    use CitizenDataTrait, BirthApiTrait;


    public function new_order_quote(Request $request)
    {

        $data['hospitals'] = C_DETAILS_REFERRAL_TB::get();

        // ==============================
        // 1) تجهيز القيم الافتراضية للمستخدم
        // ==============================
        $userId = Auth::id();
        $data['defaultHospital'] = User::where('id', $userId)->value('user_dref_cd');
        //   dd($defaultHospital);

        return view('born.new_order_quote', $data);
    }
    public function approve_quote_request()
    {

        $data['hospitals'] = C_DETAILS_REFERRAL_TB::get();

        // ==============================
        // 1) تجهيز القيم الافتراضية للمستخدم
        // ==============================
        $userId = Auth::id();
        $data['defaultHospital'] = User::where('id', $userId)->value('user_dref_cd');

        return view('born.approve_quote_request', $data);
    }
    public function release_requests()
    {
      $data['hospitals'] = C_DETAILS_REFERRAL_TB::get();

        // ==============================
        // 1) تجهيز القيم الافتراضية للمستخدم
        // ==============================
        $userId = Auth::id();
        $data['defaultHospital'] = User::where('id', $userId)->value('user_dref_cd');

        return view('born.release_requests', $data);
    }
    public function store(Request $request)
    {

        $request->validate([
            'hos_no'            => 'required|numeric',
            'current_number'    => 'required|numeric',
            'last_number'       => 'required|numeric',
            'remaining_numbers' => 'required|numeric',
        ]);

        $quota = new Quota();
        // $quota->ID              = Quota::nextId();
        $quota->CURRENT_NUMBER  = $request->current_number;
        $quota->LAST_NUMBER     = $request->last_number;
        $quota->REMAINING_DIGIT = $request->remaining_numbers;
        $quota->ORDER_STATUS    = 0; // حالة الطلب: جديد
        $quota->HOS_NO          = $request->hos_no;
        $quota->REQUEST_EMP     = Auth()->id() ?? 1;
        $quota->REQUEST_DATE    = now();
        $quota->save();

        // return response()->json(['status' => 'success', 'message' => 'تم حفظ الطلب بنجاح']);
        return Response::json(array('success' => true, 'results' =>  'تم حفظ الطلب بنجاح'));
    }
    public function search(Request $request)
    {
        $query = Quota::query()
            ->join('C_DETAILS_REFERRAL_TB as H', 'H.DREF_CODE', '=', 'BIRTH_QUOTA_TB.HOS_NO')
            ->select(
                'BIRTH_QUOTA_TB.*',
                'H.DREF_NAME_AR as HOS_NAME'
            );

        // فلترة بالمستشفى
        if ($request->filled('P_HOS_NO')) {
            $query->where('BIRTH_QUOTA_TB.HOS_NO', $request->P_HOS_NO);
        }

        // فلترة بتاريخ الطلب من
        if ($request->filled('P_DATE_FROM')) {
            $query->whereDate('BIRTH_QUOTA_TB.REQUEST_DATE', '>=', $request->P_DATE_FROM);
        }

        // فلترة بتاريخ الطلب إلى
        if ($request->filled('P_DATE_TO')) {
            $query->whereDate('BIRTH_QUOTA_TB.REQUEST_DATE', '<=', $request->P_DATE_TO);
        }

        $results = $query->orderBy('BIRTH_QUOTA_TB.REQUEST_DATE', 'desc')->get();
        //dd($results);

        return response()->json($results);
    }
public function approve(Request $request)
{
    try {
        $id = $request->id;
        if (!$id) {
            return response()->json(['success' => false, 'message' => 'لم يتم إرسال معرف الطلب']);
        }

        // تحديث مباشر في Oracle بصيغة TO_DATE
        $updated = DB::table('BIRTH_QUOTA_TB')
            ->where('ID', $id)
            ->update([
                'ORDER_STATUS' => 1,
                'REQUEST_APPROVE_EMP' => auth()->id() ?? 1,
                'APPROVE_DATE' => DB::raw("TO_DATE('" . now()->format('Y-m-d H:i:s') . "', 'YYYY-MM-DD HH24:MI:SS')")
            ]);

        if ($updated) {
            return response()->json(['success' => true, 'message' => 'تم اعتماد الطلب بنجاح']);
        } else {
            return response()->json(['success' => false, 'message' => 'لم يتم تعديل أي بيانات']);
        }

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}



public function cancel(Request $request)
{
    try {
        $updated = DB::table('BIRTH_QUOTA_TB')
            ->where('ID', $request->id)
            ->update(['ORDER_STATUS' => 3]);

        if ($updated) {
            return response()->json(['status' => 'success', 'message' => 'تم إلغاء الطلب']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'لم يتم تعديل أي بيانات']);
        }
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
    // دالة البحث - GET
    public function search_release(Request $request)
    {
        $hosNo = $request->input('P_HOS_NO');
        $dateFrom = $request->input('P_DATE_FROM');
        $dateTo = $request->input('P_DATE_TO');

        $query = Quota::query();

        if ($hosNo) {
            $query->where('HOS_NO', $hosNo);
        }

        if ($dateFrom) {
            $query->whereDate('REQUEST_DATE', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->whereDate('REQUEST_DATE', '<=', $dateTo);
        }

        // يمكنك تعديل شرط الحالة حسب منطقك (مثلاً فقط الطلبات التي يمكن صرفها)
        $query->where('ORDER_STATUS', 1); // مثلا: منتظر الصرف فقط

        // جلب البيانات مع أعمدة اضافية (تأكد من أسماء الحقول في الجدول)
        $results = $query->select(
            'ID as id',
            'HOS_NO',
            'CURRENT_NUMBER',
            'LAST_NUMBER',
            'REMAINING_DIGIT',
            'ORDER_STATUS',
            'REQUEST_DATE',
            'APPROVE_DATE',
            // الحقول الافتراضية لإظهار أسماء المستشفيات - قم بتعديل إذا تحتاج علاقة أو join
        )->get();

        // إذا تحتاج اسم المستشفى (hos_name) مثلاً:
        // يمكنك الانضمام للجدول الخاص بالمستشفيات أو تحميلها بطريقة مناسبة
        // هنا مثال سريع بدون join - استبدل بـ علاقة موديل أو join حقيقي
        foreach ($results as $item) {
            $item->hos_name = $this->getHospitalName($item->HOS_NO);
            // اضافة افتراضية لقيم release_from, release_to لو عندك
            $item->release_from = null;
            $item->release_to = null;
        }

        return response()->json($results);
    }

    // دالة صرف الطلب - POST
    public function release(Request $request)
    {
        $id = $request->input('id');
        if (!$id) {
            return response()->json(['status' => 'error', 'message' => 'لم يتم إرسال معرف الطلب']);
        }

        $quota = Quota::find($id);

        if (!$quota) {
            return response()->json(['status' => 'error', 'message' => 'الطلب غير موجود']);
        }

        try {
            // عدّل هذه القيم حسب منطق صرف الطلب عندك
            $quota->ORDER_STATUS = 2; // مثلا: تم الصرف
            // يمكنك تحديث حقول أخرى مثل أرقام الصرف من - إلى إذا متوفرة

            $saved = $quota->save();

            if ($saved) {
                return response()->json(['status' => 'success', 'message' => 'تم صرف الطلب بنجاح']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'فشل في صرف الطلب']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // مثال دالة مساعدة لإرجاع اسم المستشفى
    private function getHospitalName($hosNo)
    {
        // هذه الدالة يجب أن تربط بجدول المستشفيات الحقيقي
        // هنا فقط مثال ثابت - غيّرها حسب بياناتك
        $hospitals = [
            1 => 'مستشفى النصر',
            2 => 'مستشفى الهلال',
            3 => 'مستشفى الشفاء',
        ];

        return $hospitals[$hosNo] ?? 'غير معروف';
    }

}
