<?php
namespace App\Http\Controllers;

use App\Models\ICDCode;
use Illuminate\Http\Request;

class ICDCodeController extends Controller
{
    public function index()
    {
        // Fetch the root-level codes (no parent)
        $codes = ICDCode::whereNull('parent_id')->with('children')->get();
        return view('icd.index', compact('codes'));
    }

    public function fetchChildren($id)
    {
        $children = ICDCode::where('parent_id', $id)->get();
        return response()->json($children);
    }
}
?>
