<?php

namespace App\Http\Controllers;

use App\Rules\StartWith;

use App\Http\Controllers\Controller;
use App\Http\Controllers\dead\DeadController;

use App\Models\Log;
use App\Models\User;


use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        $data['users'] = User::where('status', 1)->get();
        return view('logs_info.index', $data);
    }
    public function search(Request $request)
    {
        $query = Log::GET_LOGS_DATA($request->all());

        $totalData = $query['RESULT_COUNT'] ?? 0;
        $totalFiltered = $totalData;
        $data = [];

        if (!empty($query) && is_array($query)) {
            foreach ($query as $value) {
                $data[] = [
                    'USER_ID' => $value['USER_ID'] ?? null,
                    'USER_FULL_NAME' => $value['USER_FULL_NAME'] ?? null,
                    'CREATED_AT' => $value['CREATED_AT'] ?? null,
                    'TYPE_ACTION' => $value['TYPE_ACTION'] ?? null,
                    'TABLE_NAME' => $value['TABLE_NAME'] ?? null,
                    'COLUMN_NAME' => $value['COLUMN_NAME'] ?? null,
                    'OLD_VALUE' => isset($value['OLD_VALUE'])
                        ? json_decode($value['OLD_VALUE'], true)
                        : null,
                    'NEW_VALUE' => isset($value['NEW_VALUE'])
                        ? json_decode($value['NEW_VALUE'], true)
                        : null,
                    'UPDATE_REASON' => $value['UPDATE_REASON'] ?? null,
                ];
            }
        }


        $deadController = new DeadController();
        $deadController->logSearch('LOGS', $request->P_ID ?: null, 'ID', json_encode($request->all()), json_encode($data), 'S');

        //dd($data);
        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ]);
    }
}
