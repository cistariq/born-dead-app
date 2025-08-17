<?php
namespace App\Http\Controllers;

use App\Models\ICDCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ICDCodeController extends Controller
{
    // public function index()
    // {
    //     // Fetch the root-level codes (no parent)
    //     $codes = ICDCode::whereNull('parent_id')->with('children')->get();
    //     return view('icd.index', compact('codes'));
    // }

    public function fetchChildren($id)
    {
        $children = ICDCode::where('parent_id', $id)->get();
        return response()->json($children);
    }
 public function index()
    {
        // جلب الأقسام الرئيسية فقط (ICD_TYPE = 0)
        $sections = DB::select("
            SELECT ICD_CD AS code, ICD_NAME_AR AS title
            FROM C_ICD_CODE_TB
            WHERE ICD_TYPE = 0 AND DELETE_CODE = 0
            ORDER BY ICD_CD
        ");
    return view('icd.index', compact('sections'));
    }

    public function show($code)
    {
        // جلب الفروع التابعة للقسم (ICD_TYPE != 0)
        $details = DB::select("
            SELECT ICD_CD AS code, ICD_NAME_AR AS title
            FROM C_ICD_CODE_TB
            WHERE ICD_TYPE != 0 AND DELETE_CODE = 0 AND ICD_CD LIKE :pattern
            ORDER BY ICD_CD
        ", ['pattern' => $code . '%']);

        return response()->json($details);
    }
}
?>
