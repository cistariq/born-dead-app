<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\DeadSourceTrait;

class DeadApiController extends Controller
{
    use DeadSourceTrait;

    /**
     * ==============================================
     * API: Update Dead Source By ID Number
     * ==============================================
     * Method: POST
     * URL: /api/updateDeadSource
     * Body:
     * {
     *   "P_ID_NO": "408123456",
     *   "P_SOURCE": 1,
     *   "UPDATE_REASON": "سبب التعديل"
     * }
     * ==============================================
     */

    public function updateDeadSource(Request $request)
    {
    //print_r('test');exit;
    return $this->updateDeadSourceByIdNo($request);
    }
}
