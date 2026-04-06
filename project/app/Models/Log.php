<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use PDO;

class Log extends Model
{
    use HasFactory;
    protected $table = 'LOGS';
    protected $guarded = [];
    protected $primaryKey = 'ID';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false; // لأن Oracle ما يعتمد Laravel timestamps تلقائياً

    protected $fillable = [
        'USER_ID',
        'ID_NO',
        'IP',
        'TABLE_NAME',
        'COLUMN_NAME',
        'OLD_VALUE',
        'NEW_VALUE',
        'TYPE_ACTION',
        'CREATED_AT',
        'UPDATED_AT',
        'ROW_ID'
    ];

    // =========================
    // علاقة مع المستخدم
    // =========================
    public function user()
    {
        return $this->belongsTo(User::class, 'USER_ID', 'ID');
    }

    public static function GET_LOGS_DATA($data)
    {
        //dd($data);
        $sql = "begin LOGS_INFO_PKG.GET_LOGS_DATA (:P_ID,:P_USER_NO,:P_DATE_FROM,:P_DATE_TO,:P_START,:P_LIMIT,:RESULT_COUNT,:LOGS); end;";

        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_ID', $data['P_ID']);
            $stmt->bindParam(':P_USER_NO', $data['P_USER_NO']);
            $stmt->bindParam(':P_DATE_FROM', $data['P_DATE_FROM']);
            $stmt->bindParam(':P_DATE_TO', $data['P_DATE_TO']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['limit']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT, 11);

            $stmt->bindParam(':LOGS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);

            return $array;
            //  dd($array);
        });
    }
}
