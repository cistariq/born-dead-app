<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class BORNS_INFO_TB extends Model
{
    use HasFactory;
    protected $table  = 'BORNS_INFO_TB';
    protected $guarded = [];

    public static function GET_BORN_DATA_BY_ID($data)
    {

        $sql = "begin BORN_INFO_PKG.GET_BORNS_DATA (:P_BORN_CODE,:P_FATHER_ID,:P_MOTHER_ID, :P_FIRST_NAME, :P_SECOND_NAME,:P_THIRD_NAME,:P_LAST_NAME,:P_DATE_FROM,:P_DATE_TO,:P_SEX_NO, :P_REGION_NO, :P_CITY_NO,:P_HOS_NO,:P_START,:P_LIMIT,:RESULT_COUNT,:BORNS); end;";

        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT=0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_BORN_CODE', $data['P_BORN_CODE']);
            $stmt->bindParam(':P_FATHER_ID', $data['P_FATHER_ID']);
            $stmt->bindParam(':P_MOTHER_ID', $data['P_MOTHER_ID']);
            $stmt->bindParam(':P_FIRST_NAME', $data['P_FIRST_NAME']);
            $stmt->bindParam(':P_SECOND_NAME', $data['P_SECOND_NAME']);
            $stmt->bindParam(':P_THIRD_NAME', $data['P_THIRD_NAME']);
            $stmt->bindParam(':P_LAST_NAME', $data['P_LAST_NAME']);
            $stmt->bindParam(':P_DATE_FROM', $data['P_DATE_FROM']);
            $stmt->bindParam(':P_DATE_TO', $data['P_DATE_TO']);
            $stmt->bindParam(':P_SEX_NO', $data['P_SEX_NO']);
            $stmt->bindParam(':P_REGION_NO', $data['P_REGION_NO']);
            $stmt->bindParam(':P_CITY_NO', $data['P_CITY_NO']);
            $stmt->bindParam(':P_HOS_NO', $data['P_HOS_NO']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['length']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT,11);

            $stmt->bindParam(':BORNS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            $result['data'] = $array;
            $result['RESULT_COUNT'] = $RESULT_COUNT;
            return $result;
        });
    }
    public static function GET_BORN_DATA2($data)
    {

        $sql = "begin BORN_INFO_PKG.GET_BORNS_INFO_PR (:P_BORN_CODE,:P_FATHER_ID,:P_MOTHER_ID, :P_FIRST_NAME, :P_SECOND_NAME,:P_THIRD_NAME,:P_LAST_NAME,:P_DATE_FROM,:P_DATE_TO,:P_SEX_NO, :P_REGION_NO, :P_CITY_NO,:P_HOS_NO,:P_START,:P_LIMIT,:RESULT_COUNT,:BORNS); end;";

        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT=0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_BORN_CODE', $data['P_BORN_CODE']);
            $stmt->bindParam(':P_FATHER_ID', $data['P_FATHER_ID']);
            $stmt->bindParam(':P_MOTHER_ID', $data['P_MOTHER_ID']);
            $stmt->bindParam(':P_FIRST_NAME', $data['P_FIRST_NAME']);
            $stmt->bindParam(':P_SECOND_NAME', $data['P_SECOND_NAME']);
            $stmt->bindParam(':P_THIRD_NAME', $data['P_THIRD_NAME']);
            $stmt->bindParam(':P_LAST_NAME', $data['P_LAST_NAME']);
            $stmt->bindParam(':P_DATE_FROM', $data['P_DATE_FROM']);
            $stmt->bindParam(':P_DATE_TO', $data['P_DATE_TO']);
            $stmt->bindParam(':P_SEX_NO', $data['P_SEX_NO']);
            $stmt->bindParam(':P_REGION_NO', $data['P_REGION_NO']);
            $stmt->bindParam(':P_CITY_NO', $data['P_CITY_NO']);
            $stmt->bindParam(':P_HOS_NO', $data['P_HOS_NO']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['length']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT,11);

            $stmt->bindParam(':BORNS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);

            $result['data'] = $array;
            $result['RESULT_COUNT'] = $RESULT_COUNT;
            return $result;
        });
    }
    public static function GET_BORN_DATA($data)
    {

        $sql = "begin BORN_INFO_PKG.GET_BORNS_INFO_PR (:P_BORN_CODE,:P_FATHER_ID,:P_MOTHER_ID, :P_FIRST_NAME, :P_SECOND_NAME,:P_THIRD_NAME,:P_LAST_NAME,:P_DATE_FROM,:P_DATE_TO,:P_SEX_NO, :P_REGION_NO, :P_CITY_NO,:P_HOS_NO,:P_START,:P_LIMIT,:RESULT_COUNT,:BORNS); end;";

        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT=0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_BORN_CODE', $data['P_BORN_CODE']);
            $stmt->bindParam(':P_FATHER_ID', $data['P_FATHER_ID']);
            $stmt->bindParam(':P_MOTHER_ID', $data['P_MOTHER_ID']);
            $stmt->bindParam(':P_FIRST_NAME', $data['P_FIRST_NAME']);
            $stmt->bindParam(':P_SECOND_NAME', $data['P_SECOND_NAME']);
            $stmt->bindParam(':P_THIRD_NAME', $data['P_THIRD_NAME']);
            $stmt->bindParam(':P_LAST_NAME', $data['P_LAST_NAME']);
            $stmt->bindParam(':P_DATE_FROM', $data['P_DATE_FROM']);
            $stmt->bindParam(':P_DATE_TO', $data['P_DATE_TO']);
            $stmt->bindParam(':P_SEX_NO', $data['P_SEX_NO']);
            $stmt->bindParam(':P_REGION_NO', $data['P_REGION_NO']);
            $stmt->bindParam(':P_CITY_NO', $data['P_CITY_NO']);
            $stmt->bindParam(':P_HOS_NO', $data['P_HOS_NO']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['length']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT,11);

            $stmt->bindParam(':BORNS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;

            // $result['data'] = $array;
            // $result['RESULT_COUNT'] = $RESULT_COUNT;
            // return $result;
        });
    }
    //add born data

    public static function ADD_BORN_DATA($data)
    {

        $sql_born = "begin BORN_INFO_PKG.ADD_BORNS_INFO_TB(:P_BI_ID, :P_BI_ORDER, :P_BI_FIRST_NAME , :P_BI_WEIGHT_GM, :P_BI_RELEGION_CD,:P_BI_SEX_CD, :P_BI_OUT_COME_CD ,
        :P_BI_PRESENTATION_CD , :P_BI_PARTOGRAM_CD ,:P_BI_ADMITTED_NICU_CD , :P_BI_EXAM_BEFORE_CD , :P_BI_EXAM_OUT_COME_CD , :P_BI_CONGENITAL_ANOMALIES_CD,
        :P_BI_ADMISSION_CD , :P_BI_NOTIFICATION_CREATED_ON , :P_BI_NOTIFICATION_CREATED_BY,:P_BI_APAGAR_1, :P_BI_APAGAR_5,:CHK_CODE); end;";


        return DB::transaction(function ($conn) use ($sql_born, $data) {
            $CHK_CODE = 0;
            $pdo = $conn->getPdo();
            //dd($pdo);
            $stmt = $pdo->prepare($sql_born);
            //dead tb
            $stmt->bindParam(':P_BI_ID', $data['P_BI_ID'], PDO::PARAM_INT, 11);
            $stmt->bindParam(':P_BI_ORDER', $data['P_BI_ORDER'], PDO::PARAM_INT, 11);
            $stmt->bindParam(':P_BI_FIRST_NAME', $data['P_BI_FIRST_NAME'], PDO::PARAM_STR, 200);
            $stmt->bindParam(':P_BI_WEIGHT_GM', $data['P_BI_WEIGHT_GM'], PDO::PARAM_INT, 11);
            $stmt->bindParam(':P_BI_RELEGION_CD', $data['P_BI_RELEGION_CD'], PDO::PARAM_INT, 11);
            $stmt->bindParam(':P_BI_SEX_CD', $data['P_BI_SEX_CD'], PDO::PARAM_INT, 11);
            $stmt->bindParam(':P_BI_OUT_COME_CD', $data['P_BI_OUT_COME_CD']);
            $stmt->bindParam(':P_BI_PRESENTATION_CD', $data['P_BI_PRESENTATION_CD']);
            $stmt->bindParam(':P_BI_PARTOGRAM_CD', $data['P_BI_PARTOGRAM_CD']);
            $stmt->bindParam(':P_BI_ADMITTED_NICU_CD', $data['P_BI_ADMITTED_NICU_CD']);
            $stmt->bindParam(':P_BI_EXAM_BEFORE_CD', $data['P_BI_EXAM_BEFORE_CD']);
            $stmt->bindParam(':P_BI_EXAM_OUT_COME_CD', $data['P_BI_EXAM_OUT_COME_CD']);
            $stmt->bindParam(':P_BI_CONGENITAL_ANOMALIES_CD', $data['P_BI_CONGENITAL_ANOMALIES_CD']);
            $stmt->bindParam(':P_BI_ADMISSION_CD', $data['P_BI_ADMISSION_CD'], PDO::PARAM_INT, 11);
            $stmt->bindParam(':P_BI_NOTIFICATION_CREATED_ON', $data['P_BI_NOTIFICATION_CREATED_ON'], PDO::PARAM_STR, 200);
            $stmt->bindParam(':P_BI_NOTIFICATION_CREATED_BY', $data['P_BI_NOTIFICATION_CREATED_BY'], PDO::PARAM_INT, 11);
            $stmt->bindParam(':P_BI_APAGAR_1', $data['P_BI_APAGAR_1']);
            $stmt->bindParam(':P_BI_APAGAR_5', $data['P_BI_APAGAR_5']);
            $stmt->bindParam(':CHK_CODE', $CHK_CODE, PDO::PARAM_INT, 11);
            $stmt->execute();
            $data['CHK_CODE'] = $CHK_CODE;
            return $data;
        });
    }
    public static function IS_FATHER_FOUND($P_FATHER_NO)
{
    //لفحص هذا رقم الهوية موجود أم لا
    $sql_check ="begin BORN_INFO_PKG.IS_FATHER_FOUND(:P_FATHER_NO,:FOUND); end;";

    return DB::transaction(function ($conn) use ($sql_check,$P_FATHER_NO) {
        $FOUND = 0;
        $pdo = $conn->getPdo();
        $stmt = $pdo->prepare($sql_check);
        $stmt->bindParam(':P_FATHER_NO', $P_FATHER_NO);

        $stmt->bindParam(':FOUND', $FOUND, PDO::PARAM_INT, 1);
        $stmt->execute();
        $data['FOUND'] = $FOUND;
        return $data;
    });

}
public static function IS_MOTHER_FOUND($P_MOTHER_ID)
{
    //لفحص هذا رقم الهوية موجود أم لا
    $sql_check ="begin BORN_INFO_PKG.IS_MOTHER_FOUND(:P_MOTHER_ID,:FOUND); end;";

    return DB::transaction(function ($conn) use ($sql_check,$P_MOTHER_ID) {
        $FOUND = 0;
        $pdo = $conn->getPdo();
        $stmt = $pdo->prepare($sql_check);
        $stmt->bindParam(':P_MOTHER_ID', $P_MOTHER_ID);

        $stmt->bindParam(':FOUND', $FOUND, PDO::PARAM_INT, 1);
        $stmt->execute();
        $data['FOUND'] = $FOUND;
        return $data;
    });

}
public static function GET_FATHER_CITZN_BY_ID($P_FATHER_NO)
{
// لجلب بيانات الوالد من الداخلية
        $sql_citzn = "begin CITZN_INFO_PAC.GET_SHIFA_CITZN_INFO_PR(:P_FATHER_NO ,:FATHER_FIRST_NAME_AR , :FATHER_FATHER_NAME_AR ,:FATHER_GRANDFATHER_NAME_AR ,:FATHER_LAST_NAME_AR , :SEX , :REGION , :CITY , :STR ,:FATHER_DOB, :FATHER_MARTIAL_STATUS ,:DEATH_DT, :FATHER_REGION_CD, :FATHER_CITY_CD, :FATHER_PERSONALITY_CODE_CD , :FATHER_JOB_CD ,:BIRTH_MCODE_CD,:BIRTH_CODE_CD,:BIRTH_MCODE,:BIRTH_CODE); end;";

        return DB::transaction(function ($conn) use ($sql_citzn, $P_FATHER_NO) {

//بيانات الداخلية
$FATHER_FIRST_NAME_AR = '';
$FATHER_FATHER_NAME_AR = '';
$FATHER_GRANDFATHER_NAME_AR = '';
$FATHER_LAST_NAME_AR = '';
$SEX = '';
$REGION = '';
$CITY = '';
$STR = '';
$FATHER_DOB = '';
$FATHER_MARTIAL_STATUS = '';
$DEATH_DT = '';
$FATHER_REGION_CD = 0;
$FATHER_CITY_CD = 0;
$FATHER_PERSONALITY_CODE_CD = 0;
$FATHER_JOB_CD = '';
$BIRTH_MCODE_CD = 0;
$BIRTH_CODE_CD = 0;
$BIRTH_MCODE = '';
$BIRTH_CODE = '';
$FATHER_SEX_CD = 0;
$pdo = $conn->getPdo();
$stmt = $pdo->prepare($sql_citzn);
            $stmt->bindParam(':P_FATHER_NO', $P_FATHER_NO, PDO::PARAM_INT,11);
            $stmt->bindParam(':FATHER_FIRST_NAME_AR', $FATHER_FIRST_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':FATHER_FATHER_NAME_AR', $FATHER_FATHER_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':FATHER_GRANDFATHER_NAME_AR', $FATHER_GRANDFATHER_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':FATHER_LAST_NAME_AR', $FATHER_LAST_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':SEX', $SEX, PDO::PARAM_STR,200);
            $stmt->bindParam(':REGION', $REGION, PDO::PARAM_STR,200);
            $stmt->bindParam(':CITY', $CITY, PDO::PARAM_STR,200);
            $stmt->bindParam(':STR', $STR, PDO::PARAM_STR,200);
            $stmt->bindParam(':FATHER_DOB', $FATHER_DOB, PDO::PARAM_STR,200);
            $stmt->bindParam(':FATHER_MARTIAL_STATUS', $FATHER_MARTIAL_STATUS, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEATH_DT', $DEATH_DT, PDO::PARAM_STR,200);
            $stmt->bindParam(':FATHER_REGION_CD', $FATHER_REGION_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':FATHER_CITY_CD', $FATHER_CITY_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':FATHER_PERSONALITY_CODE_CD', $FATHER_PERSONALITY_CODE_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':FATHER_JOB_CD', $FATHER_JOB_CD, PDO::PARAM_STR,200);
            $stmt->bindParam(':BIRTH_MCODE_CD', $BIRTH_MCODE_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':BIRTH_CODE_CD', $BIRTH_CODE_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':BIRTH_MCODE', $BIRTH_MCODE, PDO::PARAM_STR,200);
            $stmt->bindParam(':BIRTH_CODE', $BIRTH_CODE, PDO::PARAM_STR,200);
            $stmt->execute();
            if ($SEX == 'أنثى')
            $FATHER_SEX_CD = 2;
        else
            $FATHER_SEX_CD = 1;
            $data['P_FATHER_NO'] = $P_FATHER_NO;
            $data['FIRST_NAME_AR'] = $FATHER_FIRST_NAME_AR;
            $data['FATHER_NAME_AR'] = $FATHER_FATHER_NAME_AR;
            $data['GRANDFATHER_NAME_AR'] = $FATHER_GRANDFATHER_NAME_AR;
            $data['LAST_NAME_AR'] = $FATHER_LAST_NAME_AR;
            $data['DOB'] = $FATHER_DOB;
            $data['MS_NAME'] = $FATHER_MARTIAL_STATUS;
            $data['DEATH_DT'] = $DEATH_DT;
            $data['FATHER_REGION_CD'] = $FATHER_REGION_CD;
            $data['FATHER_CITY_CD'] = $FATHER_CITY_CD;
            $data['MARTIAL_STATUS_CD'] = $FATHER_PERSONALITY_CODE_CD;
            $data['FATHER_JOB_CD'] = $FATHER_JOB_CD;
            $data['BIRTH_MCODE_CD'] = $BIRTH_MCODE_CD;
            $data['BIRTH_CODE_CD'] = $BIRTH_CODE_CD;
            $data['BIRTH_PLACE'] = $BIRTH_CODE;
            $data['FATHER_BIRTH_PLACE'] = $BIRTH_MCODE;
            $data['FATHER_SEX_CD'] = $FATHER_SEX_CD;

            return $data;
        });

}


    public static function GET_FATHER_DATA_BY_ID($P_FATHER_NO)
    {
//لجلب البيانات من جدول الوالد في قاعدة البيانات
        $sql = "begin BORN_INFO_PKG.GET_FATHER_DATA (:P_FATHER_NO,:P_FATHER_ID,:FATHER_NUMBER,:FIRST_NAME_AR,:FATHER_NAME_AR,:GRANDFATHER_NAME_AR,:LAST_NAME_AR,:DOB,:FATHER_BIRTH_PLACE
        ,:FATHER_FATHER_BIRTH_PLACE,:JOB_CD,:JOB_NAME,:MARTIAL_STATUS_CD,:MS_NAME,:YEAR_OF_EDUCATION,:REGION_CD,:CITY_CD,:DATA_FRM_MOI); end;";

        return DB::transaction(function ($conn) use ($sql, $P_FATHER_NO) {
            $P_FATHER_ID=0;
            $FATHER_NUMBER = 0;
            $FIRST_NAME_AR='';
            $FATHER_NAME_AR='';
            $GRANDFATHER_NAME_AR='';
            $LAST_NAME_AR='';
            $DOB='';
            $FATHER_BIRTH_PLACE='';
            $FATHER_FATHER_BIRTH_PLACE='';
            $JOB_CD=0;
            $JOB_NAME='';
            $MARTIAL_STATUS_CD=0;
            $MS_NAME='';
            $YEAR_OF_EDUCATION=0;
            $REGION_CD=0;
            $CITY_CD=0;
            $DATA_FRM_MOI=0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_FATHER_NO', $P_FATHER_NO);
            $stmt->bindParam(':P_FATHER_ID', $P_FATHER_ID, PDO::PARAM_INT,11);
            $stmt->bindParam(':FATHER_NUMBER', $FATHER_NUMBER, PDO::PARAM_INT,11);
            $stmt->bindParam(':FIRST_NAME_AR', $FIRST_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':FATHER_NAME_AR', $FATHER_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':GRANDFATHER_NAME_AR', $GRANDFATHER_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':LAST_NAME_AR', $LAST_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':DOB', $DOB, PDO::PARAM_STR,200);
            $stmt->bindParam(':FATHER_BIRTH_PLACE', $FATHER_BIRTH_PLACE, PDO::PARAM_STR,200);
            $stmt->bindParam(':FATHER_FATHER_BIRTH_PLACE', $FATHER_FATHER_BIRTH_PLACE, PDO::PARAM_STR,200);
            $stmt->bindParam(':JOB_CD', $JOB_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':JOB_NAME', $JOB_NAME, PDO::PARAM_STR,200);
            $stmt->bindParam(':MARTIAL_STATUS_CD', $MARTIAL_STATUS_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':MS_NAME', $MS_NAME, PDO::PARAM_STR,200);
            $stmt->bindParam(':YEAR_OF_EDUCATION', $YEAR_OF_EDUCATION, PDO::PARAM_INT,11);
            $stmt->bindParam(':REGION_CD', $REGION_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':CITY_CD', $CITY_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':DATA_FRM_MOI', $DATA_FRM_MOI, PDO::PARAM_INT,11);

            $stmt->execute();
            $data['P_FATHER_ID'] = $P_FATHER_ID;
            $data['FATHER_NUMBER'] = $FATHER_NUMBER;
            $data['FIRST_NAME_AR'] = $FIRST_NAME_AR;
            $data['FATHER_NAME_AR'] = $FATHER_NAME_AR;
            $data['GRANDFATHER_NAME_AR'] = $GRANDFATHER_NAME_AR;
            $data['LAST_NAME_AR'] = $LAST_NAME_AR;
            $data['DOB'] = $DOB;
            $data['BIRTH_PLACE'] = $FATHER_BIRTH_PLACE;
            $data['FATHER_BIRTH_PLACE'] = $FATHER_FATHER_BIRTH_PLACE;
            $data['JOB_CD'] = $JOB_CD;
            $data['JOB_NAME'] = $JOB_NAME;
            $data['MARTIAL_STATUS_CD'] = $MARTIAL_STATUS_CD;
            $data['MS_NAME'] = $MS_NAME;
            $data['YEAR_OF_EDUCATION'] = $YEAR_OF_EDUCATION;
            $data['REGION_CD'] = $REGION_CD;
            $data['CITY_CD'] = $CITY_CD;
            $data['DATA_FRM_MOI'] = $DATA_FRM_MOI;
            $data['FATHER_SEX_CD'] = 1;

            return $data;
        });
    }


public static function GET_MOTHER_CITZN_BY_ID($P_MOTHER_ID)
{
// لجلب بيانات الوالد من الداخلية
        $sql_citzn = "begin CITZN_INFO_PAC.GET_SHIFA_CITZN_INFO_PR(:P_MOTHER_ID ,:MOTHER_FIRST_NAME_AR , :MOTHER_FATHER_NAME_AR ,:MOTHER_GRANDFATHER_NAME_AR ,:MOTHER_LAST_NAME_AR , :SEX , :REGION , :CITY , :STR ,:MOTHER_DOB, :MOTHER_MARTIAL_STATUS ,:DEATH_DT, :MOTHER_REGION_CD, :MOTHER_CITY_CD, :MOTHER_PERSONALITY_CODE_CD , :MOTHER_JOB_CD ,:BIRTH_MCODE_CD,:BIRTH_CODE_CD,:BIRTH_MCODE,:BIRTH_CODE); end;";

        return DB::transaction(function ($conn) use ($sql_citzn, $P_MOTHER_ID) {

//بيانات الداخلية
$MOTHER_FIRST_NAME_AR = '';
$MOTHER_FATHER_NAME_AR = '';
$MOTHER_GRANDFATHER_NAME_AR = '';
$MOTHER_LAST_NAME_AR = '';
$SEX = '';
$REGION = '';
$CITY = '';
$STR = '';
$MOTHER_DOB = '';
$MOTHER_MARTIAL_STATUS = '';
$DEATH_DT = '';
$MOTHER_REGION_CD = 0;
$MOTHER_CITY_CD = 0;
$MOTHER_PERSONALITY_CODE_CD = 0;
$MOTHER_JOB_CD = '';
$BIRTH_MCODE_CD = 0;
$BIRTH_CODE_CD = 0;
$BIRTH_MCODE = '';
$BIRTH_CODE = '';
$MOTHER_SEX_CD = 0;
$pdo = $conn->getPdo();
$stmt = $pdo->prepare($sql_citzn);
            $stmt->bindParam(':P_MOTHER_ID', $P_MOTHER_ID, PDO::PARAM_INT,11);
            $stmt->bindParam(':MOTHER_FIRST_NAME_AR', $MOTHER_FIRST_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':MOTHER_FATHER_NAME_AR', $MOTHER_FATHER_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':MOTHER_GRANDFATHER_NAME_AR', $MOTHER_GRANDFATHER_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':MOTHER_LAST_NAME_AR', $MOTHER_LAST_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':SEX', $SEX, PDO::PARAM_STR,200);
            $stmt->bindParam(':REGION', $REGION, PDO::PARAM_STR,200);
            $stmt->bindParam(':CITY', $CITY, PDO::PARAM_STR,200);
            $stmt->bindParam(':STR', $STR, PDO::PARAM_STR,200);
            $stmt->bindParam(':MOTHER_DOB', $MOTHER_DOB, PDO::PARAM_STR,200);
            $stmt->bindParam(':MOTHER_MARTIAL_STATUS', $MOTHER_MARTIAL_STATUS, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEATH_DT', $DEATH_DT, PDO::PARAM_STR,200);
            $stmt->bindParam(':MOTHER_REGION_CD', $MOTHER_REGION_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':MOTHER_CITY_CD', $MOTHER_CITY_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':MOTHER_PERSONALITY_CODE_CD', $MOTHER_PERSONALITY_CODE_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':MOTHER_JOB_CD', $MOTHER_JOB_CD, PDO::PARAM_STR,200);
            $stmt->bindParam(':BIRTH_MCODE_CD', $BIRTH_MCODE_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':BIRTH_CODE_CD', $BIRTH_CODE_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':BIRTH_MCODE', $BIRTH_MCODE, PDO::PARAM_STR,200);
            $stmt->bindParam(':BIRTH_CODE', $BIRTH_CODE, PDO::PARAM_STR,200);
            $stmt->execute();
            if ($SEX == 'ذكر')
            $MOTHER_SEX_CD = 1;
        else
            $MOTHER_SEX_CD = 2;
            $data['P_MOTHER_ID'] = $P_MOTHER_ID;
            $data['FIRST_NAME_AR'] = $MOTHER_FIRST_NAME_AR;
            $data['FATHER_NAME_AR'] = $MOTHER_FATHER_NAME_AR;
            $data['GRANDFATHER_NAME_AR'] = $MOTHER_GRANDFATHER_NAME_AR;
            $data['LAST_NAME_AR'] = $MOTHER_LAST_NAME_AR;
            $data['DOB'] = $MOTHER_DOB;
            $data['MS_NAME'] = $MOTHER_MARTIAL_STATUS;
            $data['DEATH_DT'] = $DEATH_DT;
            $data['REGION_CD'] = $MOTHER_REGION_CD;
            $data['CITY_CD'] = $MOTHER_CITY_CD;
            $data['MARTIAL_STATUS_CD'] = $MOTHER_PERSONALITY_CODE_CD;
            $data['MOTHER_JOB_CD'] = $MOTHER_JOB_CD;
            $data['BIRTH_MCODE_CD'] = $BIRTH_MCODE_CD;
            $data['BIRTH_CODE_CD'] = $BIRTH_CODE_CD;
            $data['BIRTH_PLACE'] = $BIRTH_CODE;
            $data['FATHER_BIRTH_PLACE'] = $BIRTH_MCODE;
            $data['MOTHER_SEX_CD'] = $MOTHER_SEX_CD;

            return $data;
        });

}
    public static function GET_MOTHER_DATA_BY_ID($P_MOTHER_ID)
    {

        $sql = "begin BORN_INFO_PKG.GET_MOTHER_DATA (:P_MOTHER_ID,:MOTHER_NUMBER,:FIRST_NAME_AR,:FATHER_NAME_AR,:GRANDFATHER_NAME_AR,:LAST_NAME_AR
                                                    ,:DOB,:BIRTH_PLACE,:FATHER_BIRTH_PLACE1,:JOB_CD,:JOB_NAME,:MARTIAL_STATUS_CD,:MS_NAME,:YEAR_OF_EDUCATION
                                                    ,:REGION_CD,:CITY_CD,:TEL,:FAMILY_NAME,:DATA_FRM_MOI); end;";
        return DB::transaction(function ($conn) use ($sql, $P_MOTHER_ID) {
            $MOTHER_NUMBER = 0;
            $FIRST_NAME_AR='';
            $FATHER_NAME_AR='';
            $GRANDFATHER_NAME_AR='';
            $LAST_NAME_AR='';
            $DOB='';
            $BIRTH_PLACE='';
            $FATHER_BIRTH_PLACE1='';
            $JOB_CD=0;
            $JOB_NAME='';
            $MARTIAL_STATUS_CD=0;
            $MS_NAME='';
            $YEAR_OF_EDUCATION=0;
            $REGION_CD=0;
            $CITY_CD=0;
            $TEL=0;
            $FAMILY_NAME='';
            $DATA_FRM_MOI=0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_MOTHER_ID', $P_MOTHER_ID);
            $stmt->bindParam(':MOTHER_NUMBER', $MOTHER_NUMBER, PDO::PARAM_INT,11);
            $stmt->bindParam(':FIRST_NAME_AR', $FIRST_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':FATHER_NAME_AR', $FATHER_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':GRANDFATHER_NAME_AR', $GRANDFATHER_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':LAST_NAME_AR', $LAST_NAME_AR, PDO::PARAM_STR,200);
            $stmt->bindParam(':DOB', $DOB, PDO::PARAM_STR,200);
            $stmt->bindParam(':BIRTH_PLACE', $BIRTH_PLACE, PDO::PARAM_STR,200);
            $stmt->bindParam(':FATHER_BIRTH_PLACE1', $FATHER_BIRTH_PLACE1, PDO::PARAM_STR,200);
            $stmt->bindParam(':JOB_CD', $JOB_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':JOB_NAME', $JOB_NAME, PDO::PARAM_STR,200);
            $stmt->bindParam(':MARTIAL_STATUS_CD', $MARTIAL_STATUS_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':MS_NAME', $MS_NAME, PDO::PARAM_STR,200);
            $stmt->bindParam(':YEAR_OF_EDUCATION', $YEAR_OF_EDUCATION, PDO::PARAM_INT,11);
            $stmt->bindParam(':REGION_CD', $REGION_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':CITY_CD', $CITY_CD, PDO::PARAM_INT,11);
            $stmt->bindParam(':TEL', $TEL, PDO::PARAM_INT,11);
            $stmt->bindParam(':FAMILY_NAME', $FAMILY_NAME, PDO::PARAM_STR,200);
            $stmt->bindParam(':DATA_FRM_MOI', $DATA_FRM_MOI, PDO::PARAM_INT,11);

            $stmt->execute();
            $data['P_MOTHER_ID'] = $P_MOTHER_ID;
            $data['MOTHER_NUMBER'] = $MOTHER_NUMBER;
            $data['FIRST_NAME_AR'] = $FIRST_NAME_AR;
            $data['FATHER_NAME_AR'] = $FATHER_NAME_AR;
            $data['GRANDFATHER_NAME_AR'] = $GRANDFATHER_NAME_AR;
            $data['LAST_NAME_AR'] = $LAST_NAME_AR;
            $data['DOB'] = $DOB;
            $data['BIRTH_PLACE'] = $BIRTH_PLACE;
            $data['FATHER_BIRTH_PLACE1'] = $FATHER_BIRTH_PLACE1;
            $data['JOB_CD'] = $JOB_CD;
            $data['JOB_NAME'] = $JOB_NAME;
            $data['MARTIAL_STATUS_CD'] = $MARTIAL_STATUS_CD;
            $data['MS_NAME'] = $MS_NAME;
            $data['YEAR_OF_EDUCATION'] = $YEAR_OF_EDUCATION;
            $data['REGION_CD'] = $REGION_CD;
            $data['CITY_CD'] = $CITY_CD;
            $data['TEL'] = $TEL;
            $data['FAMILY_NAME'] = $FAMILY_NAME;
            $data['DATA_FRM_MOI'] = $DATA_FRM_MOI;
            $data['MOTHER_SEX_CD'] = 2;

            return $data;
        });
    }

    public static function UPDATE_FATHER_DATA($data)
    {

        $sql_dead = "begin BORN_INFO_PKG.UPDATE_FATHER_INFO(:F_NUMBER,:F_ID , :F_FIRST_NAME_AR, :F_FATHER_NAME_AR,
                             :F_GRANDFATHER_NAME_AR, :F_LAST_NAME_AR, :F_DOB, :F_BIRTH_PLACE,:F_FATHER_BIRTH_PLACE, :F_JOB_CD , :F_MARTIAL_STATUS_CD,
                             :F_YEAR_OF_EDUCATION, :F_REGION_CD,:F_CITY_CD,:F_DATA_FRM_MOI, :F_ID_TYPE,:B_CODE,:P_FATHER_MODIFIED_BY,:P_RESULT); end;";




        return DB::transaction(function ($conn) use ($sql_dead, $data) {
            $P_RESULT = 0;
            $pdo = $conn->getPdo();
            //dd($pdo);
            $stmt = $pdo->prepare($sql_dead);
            //dead tb
            $stmt->bindParam(':F_NUMBER', $data['F_NUMBER']);
            $stmt->bindParam(':F_ID', $data['F_ID']);
            $stmt->bindParam(':F_FIRST_NAME_AR', $data['F_FIRST_NAME_AR']);
            $stmt->bindParam(':F_FATHER_NAME_AR', $data['F_FATHER_NAME_AR']);
            $stmt->bindParam(':F_GRANDFATHER_NAME_AR', $data['F_GRANDFATHER_NAME_AR']);
            $stmt->bindParam(':F_LAST_NAME_AR', $data['F_LAST_NAME_AR']);
            $stmt->bindParam(':F_DOB', $data['F_DOB']);
            $stmt->bindParam(':F_BIRTH_PLACE', $data['F_BIRTH_PLACE']);
            $stmt->bindParam(':F_FATHER_BIRTH_PLACE', $data['F_FATHER_BIRTH_PLACE']);
            $stmt->bindParam(':F_JOB_CD', $data['F_JOB_CD']);
            $stmt->bindParam(':F_MARTIAL_STATUS_CD', $data['F_MARTIAL_STATUS_CD']);
            $stmt->bindParam(':F_YEAR_OF_EDUCATION', $data['F_YEAR_OF_EDUCATION']);
            $stmt->bindParam(':F_REGION_CD', $data['F_REGION_CD']);
            $stmt->bindParam(':F_CITY_CD', $data['F_CITY_CD']);
            $stmt->bindParam(':F_DATA_FRM_MOI', $data['F_DATA_FRM_MOI']);
            $stmt->bindParam(':F_ID_TYPE', $data['F_ID_TYPE']);
            $stmt->bindParam(':B_CODE', $data['B_CODE']);
            $stmt->bindParam(':P_FATHER_MODIFIED_BY', $data['P_FATHER_MODIFIED_BY']);

            $stmt->bindParam(':P_RESULT', $P_RESULT, PDO::PARAM_INT, 1);
            $stmt->execute();
            $data['P_RESULT'] = $P_RESULT;
            return $data;
        });
    }

    public static function UPDATE_MOTHER_DATA($data)
    {

        $sql_dead = "begin BORN_INFO_PKG.UPDATE_MOTHER_INFO(:M_NUMBER , :M_ID , :M_FIRST_NAME_AR , :M_FATHER_NAME_AR ,:M_GRANDFATHER_NAME_AR , :M_LAST_NAME_AR ,
                             :M_DOB , :M_BIRTH_PLACE  ,:M_FATHER_BIRTH_PLACE , :M_JOB_CD , :M_MARTIAL_STATUS_CD , :M_YEAR_OF_EDUCATION ,
                             :M_REGION_CD  , :M_CITY_CD  , :M_TEL  , :M_FAMILY_NAME ,:M_ID_TYPE,:M_DATA_FRM_MOI,:B_CODE,:P_MOTHER_MODIFIED_BY,:P_RESULT); end;";


        return DB::transaction(function ($conn) use ($sql_dead, $data) {
            $P_RESULT = 0;
            $pdo = $conn->getPdo();
            //dd($pdo);
            $stmt = $pdo->prepare($sql_dead);
            //dead tb
            $stmt->bindParam(':M_NUMBER', $data['MOTHER_NUMBER']);
            $stmt->bindParam(':M_ID', $data['MOTHER_ID']);
            $stmt->bindParam(':M_FIRST_NAME_AR', $data['MOTHER_FIRST_NAME_AR']);
            $stmt->bindParam(':M_FATHER_NAME_AR', $data['MOTHER_FATHER_NAME_AR']);
            $stmt->bindParam(':M_GRANDFATHER_NAME_AR', $data['MOTHER_GRANDFATHER_NAME_AR']);
            $stmt->bindParam(':M_LAST_NAME_AR', $data['MOTHER_LAST_NAME_AR']);
            $stmt->bindParam(':M_DOB', $data['MOTHER_DOB']);
            $stmt->bindParam(':M_BIRTH_PLACE', $data['MOTHER_BIRTH_PLACE']);
            $stmt->bindParam(':M_FATHER_BIRTH_PLACE', $data['MOTHER_FATHER_BIRTH_PLACE']);
            $stmt->bindParam(':M_JOB_CD', $data['MOTHER_JOB']);
            $stmt->bindParam(':M_MARTIAL_STATUS_CD', $data['MOTHER_MARTIAL_STATUS_CD']);
            $stmt->bindParam(':M_YEAR_OF_EDUCATION', $data['MOTHER_YEAR_OF_EDUCATION']);
            $stmt->bindParam(':M_REGION_CD', $data['MOTHER_REGION_CD']);
            $stmt->bindParam(':M_CITY_CD', $data['MOTHER_CITY_CD']);
            $stmt->bindParam(':M_TEL', $data['MOTHER_TEL']);
            $stmt->bindParam(':M_FAMILY_NAME', $data['MOTHER_FAMILY_NAME']);
            $stmt->bindParam(':M_DATA_FRM_MOI', $data['MOTHER_DATA_FRM_MOI']);
            $stmt->bindParam(':M_ID_TYPE', $data['MOTHER_ID_TYPE']);
            $stmt->bindParam(':B_CODE', $data['B_CODE']);
            $stmt->bindParam(':P_MOTHER_MODIFIED_BY', $data['P_MOTHER_MODIFIED_BY']);

            $stmt->bindParam(':P_RESULT', $P_RESULT, PDO::PARAM_INT, 1);
            $stmt->execute();
            $data['P_RESULT'] = $P_RESULT;
            return $data;
        });
    }

    public static function ADD_BORN_FATHER_DATA($data)
    {

        $sql_dead = "begin BORN_INFO_PKG.ADD_BORN_FATHER_TB (:FATHER_NUMBER,:FATHER_ID, :FATHER_FIRST_NAME_AR, :FATHER_FATHER_NAME_AR,
        :FATHER_GRANDFATHER_NAME_AR, :FATHER_LAST_NAME_AR,:FATHER_DOB, :FATHER_BIRTH_PLACE,:FATHER_FATHER_BIRTH_PLACE, :FATHER_JOB,
        :FATHER_MARTIAL_STATUS_CD,:FATHER_YEAR_OF_EDUCATION, :FATHER_REGION_CD,:FATHER_CITY_CD,:FATHER_DATA_FRM_MOI,:FATHER_ID_TYPE); end;";

        return DB::transaction(function ($conn) use ($sql_dead, $data) {
            $FATHER_NUMBER = 0;
            $pdo = $conn->getPdo();

            $stmt = $pdo->prepare($sql_dead);

            $stmt->bindParam(':FATHER_NUMBER', $FATHER_NUMBER, PDO::PARAM_INT, 11);
            $stmt->bindParam(':FATHER_ID', $data['FATHER_ID']);
            $stmt->bindParam(':FATHER_FIRST_NAME_AR', $data['FATHER_FIRST_NAME_AR']);
            $stmt->bindParam(':FATHER_FATHER_NAME_AR', $data['FATHER_FATHER_NAME_AR']);
            $stmt->bindParam(':FATHER_GRANDFATHER_NAME_AR', $data['FATHER_GRANDFATHER_NAME_AR']);
            $stmt->bindParam(':FATHER_LAST_NAME_AR', $data['FATHER_LAST_NAME_AR']);
            $stmt->bindParam(':FATHER_DOB', $data['FATHER_DOB']);
            $stmt->bindParam(':FATHER_BIRTH_PLACE', $data['FATHER_BIRTH_PLACE']);
            $stmt->bindParam(':FATHER_FATHER_BIRTH_PLACE', $data['FATHER_FATHER_BIRTH_PLACE']);
            $stmt->bindParam(':FATHER_JOB', $data['FATHER_JOB']);
            $stmt->bindParam(':FATHER_MARTIAL_STATUS_CD', $data['FATHER_MARTIAL_STATUS_CD']);
            $stmt->bindParam(':FATHER_YEAR_OF_EDUCATION', $data['FATHER_YEAR_OF_EDUCATION']);
            $stmt->bindParam(':FATHER_REGION_CD', $data['FATHER_REGION_CD']);
            $stmt->bindParam(':FATHER_CITY_CD', $data['FATHER_CITY_CD']);
            $stmt->bindParam(':FATHER_DATA_FRM_MOI', $data['FATHER_DATA_FRM_MOI']);
            $stmt->bindParam(':FATHER_ID_TYPE', $data['FATHER_ID_TYPE']);

            $stmt->execute();
            $data['FATHER_NUMBER'] = $FATHER_NUMBER;
            return $data;
        });
    }

    public static function ADD_BORN_MOTHER_DATA($data)
    {

        $sql_dead = "begin BORN_INFO_PKG.ADD_BORN_MOTHER_TB (:MOTHER_NUMBER,:MOTHER_ID, :MOTHER_FIRST_NAME_AR, :MOTHER_FATHER_NAME_AR,:MOTHER_GRANDFATHER_NAME_AR,
                                                             :MOTHER_LAST_NAME_AR, :MOTHER_DOB, :MOTHER_BIRTH_PLACE,:MOTHER_FATHER_BIRTH_PLACE, :MOTHER_JOB,
                                                             :MOTHER_MARTIAL_STATUS_CD,:MOTHER_YEAR_OF_EDUCATION, :MOTHER_REGION_CD,:MOTHER_CITY_CD, :MOTHER_TEL,
                                                             :MOTHER_FAMILY_NAME,:MOTHER_DATA_FRM_MOI,:MOTHER_ID_TYPE); end;";

        return DB::transaction(function ($conn) use ($sql_dead, $data) {
            $MOTHER_NUMBER = 0;
            $pdo = $conn->getPdo();

            $stmt = $pdo->prepare($sql_dead);

            $stmt->bindParam(':MOTHER_NUMBER', $MOTHER_NUMBER, PDO::PARAM_INT, 11);
            $stmt->bindParam(':MOTHER_ID', $data['MOTHER_ID']);
            $stmt->bindParam(':MOTHER_FIRST_NAME_AR', $data['MOTHER_FIRST_NAME_AR']);
            $stmt->bindParam(':MOTHER_FATHER_NAME_AR', $data['MOTHER_FATHER_NAME_AR']);
            $stmt->bindParam(':MOTHER_GRANDFATHER_NAME_AR', $data['MOTHER_GRANDFATHER_NAME_AR']);
            $stmt->bindParam(':MOTHER_LAST_NAME_AR', $data['MOTHER_LAST_NAME_AR']);
            $stmt->bindParam(':MOTHER_DOB', $data['MOTHER_DOB']);
            $stmt->bindParam(':MOTHER_BIRTH_PLACE', $data['MOTHER_BIRTH_PLACE']);
            $stmt->bindParam(':MOTHER_FATHER_BIRTH_PLACE', $data['MOTHER_FATHER_BIRTH_PLACE']);
            $stmt->bindParam(':MOTHER_JOB', $data['MOTHER_JOB']);
            $stmt->bindParam(':MOTHER_MARTIAL_STATUS_CD', $data['MOTHER_MARTIAL_STATUS_CD']);
            $stmt->bindParam(':MOTHER_YEAR_OF_EDUCATION', $data['MOTHER_YEAR_OF_EDUCATION']);
            $stmt->bindParam(':MOTHER_REGION_CD', $data['MOTHER_REGION_CD']);
            $stmt->bindParam(':MOTHER_CITY_CD', $data['MOTHER_CITY_CD']);
            $stmt->bindParam(':MOTHER_TEL', $data['MOTHER_TEL']);
            $stmt->bindParam(':MOTHER_FAMILY_NAME', $data['MOTHER_FAMILY_NAME']);
            $stmt->bindParam(':MOTHER_DATA_FRM_MOI', $data['MOTHER_DATA_FRM_MOI']);
            $stmt->bindParam(':MOTHER_ID_TYPE', $data['MOTHER_ID_TYPE']);

            $stmt->execute();
            $data['MOTHER_NUMBER'] = $MOTHER_NUMBER;
            return $data;
        });
    }


    public static function ADD_BORN_DETAILS_DATA($data)
    {

        $sql_dead = "begin BORN_INFO_PKG.ADD_BORN_DETAILS_TB (:BI_NUMBER,:BORN_DETAILS_REASON_CD,:BORN_DETAILS_GRAVID, :BORN_DETAILS_PARITY, :BORN_DETAILS_ABORTION,
                                                              :BORN_DETAILS_GESTATIONAL_WEEKS, :BORN_DETAILS_DELIVERY_DATE, :BORN_DETAILS_DELIVERY_CD,:BORN_DETAILS_PLURALITY,
                                                              :BORN_DETAILS_DELIVERY_COMPLI_C, :BORN_DETAILS_CATALYST_CD,:BORN_DETAILS_MOTHER_EXAM_CD, :BORN_DETAILS_MOTHER_RESULT_CD,
                                                              :BORN_DETAILS_PAIN_RELIEF_CD, :BORN_DETAILS_BLOOD_TRANS_CD, :BORN_DETAILS_PLACENTA_COND_CD,:BORN_DETAILS_MARRIAGE_DATE,
                                                              :BORN_DETAILS_MARRIAGE_NUMBER, :BORN_DETAILS_CUR_MARRIAGE_LIVE,:BORN_DETAILS_CUR_MARRIAGE_DEAD, :BORN_DETAILS_PRE_MARRIAGE_LIVE,
                                                              :BORN_DETAILS_PRE_MARRIAGE_DEAD, :BORN_DETAILS_GENERATOR_CD, :BORN_DETAILS_TWINS,:BORN_DETAILS_FATH_CD, :BORN_DETAILS_MOTHER_CD,
                                                              :BORN_DETAILS_CITY_CD,:BORN_DETAILS_REGION_CD, :BORN_DETAILS_HOME_NO, :BORN_DETAILS_PARENTS_TEL_NO,:BORN_DETAILS_HEALTH_CENTER_CD ,
                                                              :BORN_DETAILS_BIRTH_PLACE_CD); end;";

        return DB::transaction(function ($conn) use ($sql_dead, $data) {
            $BI_NUMBER = 0;
            $pdo = $conn->getPdo();

            $stmt = $pdo->prepare($sql_dead);

            $stmt->bindParam(':BI_NUMBER', $BI_NUMBER, PDO::PARAM_INT, 11);
            $stmt->bindParam(':BORN_DETAILS_REASON_CD', $data['BORN_DETAILS_REASON_CD']);
            $stmt->bindParam(':BORN_DETAILS_GRAVID', $data['BORN_DETAILS_GRAVID']);
            $stmt->bindParam(':BORN_DETAILS_PARITY', $data['BORN_DETAILS_PARITY']);
            $stmt->bindParam(':BORN_DETAILS_ABORTION', $data['BORN_DETAILS_ABORTION']);
            $stmt->bindParam(':BORN_DETAILS_GESTATIONAL_WEEKS', $data['BORN_DETAILS_GESTATIONAL_WEEKS']);
            $stmt->bindParam(':BORN_DETAILS_DELIVERY_DATE', $data['BORN_DETAILS_DELIVERY_DATE']);
            $stmt->bindParam(':BORN_DETAILS_DELIVERY_CD', $data['BORN_DETAILS_DELIVERY_CD']);
            $stmt->bindParam(':BORN_DETAILS_PLURALITY', $data['BORN_DETAILS_PLURALITY']);
            $stmt->bindParam(':BORN_DETAILS_DELIVERY_COMPLI_C', $data['BORN_DETAILS_DELIVERY_COMPLI_C']);
            $stmt->bindParam(':BORN_DETAILS_CATALYST_CD', $data['BORN_DETAILS_CATALYST_CD']);
            $stmt->bindParam(':BORN_DETAILS_MOTHER_EXAM_CD', $data['BORN_DETAILS_MOTHER_EXAM_CD']);
            $stmt->bindParam(':BORN_DETAILS_MOTHER_RESULT_CD', $data['BORN_DETAILS_MOTHER_RESULT_CD']);
            $stmt->bindParam(':BORN_DETAILS_PAIN_RELIEF_CD', $data['BORN_DETAILS_PAIN_RELIEF_CD']);
            $stmt->bindParam(':BORN_DETAILS_BLOOD_TRANS_CD', $data['BORN_DETAILS_BLOOD_TRANS_CD']);
            $stmt->bindParam(':BORN_DETAILS_PLACENTA_COND_CD', $data['BORN_DETAILS_PLACENTA_COND_CD']);
            $stmt->bindParam(':BORN_DETAILS_MARRIAGE_DATE', $data['BORN_DETAILS_MARRIAGE_DATE']);
            $stmt->bindParam(':BORN_DETAILS_MARRIAGE_NUMBER', $data['BORN_DETAILS_MARRIAGE_NUMBER']);
            $stmt->bindParam(':BORN_DETAILS_CUR_MARRIAGE_LIVE', $data['BORN_DETAILS_CUR_MARRIAGE_LIVE']);
            $stmt->bindParam(':BORN_DETAILS_CUR_MARRIAGE_DEAD', $data['BORN_DETAILS_CUR_MARRIAGE_DEAD']);
            $stmt->bindParam(':BORN_DETAILS_PRE_MARRIAGE_LIVE', $data['BORN_DETAILS_PRE_MARRIAGE_LIVE']);
            $stmt->bindParam(':BORN_DETAILS_PRE_MARRIAGE_DEAD', $data['BORN_DETAILS_PRE_MARRIAGE_DEAD']);
            $stmt->bindParam(':BORN_DETAILS_GENERATOR_CD', $data['BORN_DETAILS_GENERATOR_CD']);
            $stmt->bindParam(':BORN_DETAILS_TWINS', $data['BORN_DETAILS_TWINS']);
            $stmt->bindParam(':BORN_DETAILS_FATH_CD', $data['BORN_DETAILS_FATH_CD']);
            $stmt->bindParam(':BORN_DETAILS_MOTHER_CD', $data['BORN_DETAILS_MOTHER_CD']);
            $stmt->bindParam(':BORN_DETAILS_CITY_CD', $data['BORN_DETAILS_CITY_CD']);
            $stmt->bindParam(':BORN_DETAILS_REGION_CD', $data['BORN_DETAILS_REGION_CD']);
            $stmt->bindParam(':BORN_DETAILS_HOME_NO', $data['BORN_DETAILS_HOME_NO']);
            $stmt->bindParam(':BORN_DETAILS_PARENTS_TEL_NO', $data['BORN_DETAILS_PARENTS_TEL_NO']);
            $stmt->bindParam(':BORN_DETAILS_HEALTH_CENTER_CD', $data['BORN_DETAILS_HEALTH_CENTER_CD']);
            $stmt->bindParam(':BORN_DETAILS_BIRTH_PLACE_CD', $data['BORN_DETAILS_BIRTH_PLACE_CD']);

            $stmt->execute();
            $data['BI_NUMBER'] = $BI_NUMBER;
            return $data;
        });
    }

    public static function GET_BORN_DATE_BY_ID($data)
    {
        $sql = "begin BORN_INFO_PKG.GET_BORNS_DATE (:F_ID,:M_ID,:BORNS); end;";

        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
          //  dd($data);
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':F_ID', $data['F_ID']);
            $stmt->bindParam(':M_ID', $data['M_ID']);
            $stmt->bindParam(':BORNS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_BORNS_NUMBER($data)
    {
        $sql = "begin BORN_INFO_PKG.GET_BORNS_NUMBER (:F_ID,:M_ID,:BORN_NUMBER); end;";

        return DB::transaction(function ($conn) use ($sql, $data) {
            $BORN_NUMBER = 0;
          //  dd($data);
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':F_ID', $data['F_ID']);
            $stmt->bindParam(':M_ID', $data['M_ID']);
            $stmt->bindParam(':BORN_NUMBER', $BORN_NUMBER, PDO::PARAM_INT, 1);
            $stmt->execute();
            $data['BORN_NUMBER'] = $BORN_NUMBER;
            return $data;
        });
    }
    public static function IS_BORN_FOUND($P_BI_ADMISSION_CD)
{
    $sql_check ="begin BORN_INFO_PKG.IS_BORN_FOUND(:P_BI_ADMISSION_CD,:FOUND); end;";

    return DB::transaction(function ($conn) use ($sql_check,$P_BI_ADMISSION_CD) {
        $FOUND = 0;
        $pdo = $conn->getPdo();
        $stmt = $pdo->prepare($sql_check);
        $stmt->bindParam(':P_BI_ADMISSION_CD', $P_BI_ADMISSION_CD);

        $stmt->bindParam(':FOUND', $FOUND, PDO::PARAM_INT, 1);
        $stmt->execute();
        $data['FOUND'] = $FOUND;
        return $data;
    });

}

public static function GET_BORN_DATA_BY_CODE($P_BI_ADMISSION_CD)
{
//لجلب البيانات من جدول الوالد في قاعدة البيانات
    $sql = "begin BORN_INFO_PKG.GET_BORN_INFO (:P_BI_ADMISSION_CD,:V_BI_CODE,:V_BI_ID,:V_BI_ORDER,:V_BI_FIRST_NAME,:V_BI_WEIGHT_GM,
                                               :V_BI_RELEGION_CD,:V_BI_SEX_CD,:V_BI_OUT_COME_CD,:V_BI_PRESENTATION_CD,
                                               :V_BI_PARTOGRAM_CD,:V_BI_ADMITTED_NICU_CD,:V_BI_EXAM_BEFORE_CD,:V_BI_EXAM_OUT_COME_CD,:V_BI_CONGENITAL_ANOMALIES_CD,
                                               :V_BI_ADMISSION_CD,:V_BI_APAGAR_1,:V_BI_APAGAR_5); end;";

    return DB::transaction(function ($conn) use ($sql, $P_BI_ADMISSION_CD) {
        $V_BI_CODE = 0;
        $V_BI_ID=0;
        $V_BI_ORDER=0;
        $V_BI_FIRST_NAME='';
        $V_BI_WEIGHT_GM=0;
        $V_BI_RELEGION_CD=0;
        $V_BI_SEX_CD=0;
        $V_BI_OUT_COME_CD=0;
        $V_BI_PRESENTATION_CD=0;
        $V_BI_PARTOGRAM_CD=0;
        $V_BI_ADMITTED_NICU_CD=0;
        $V_BI_EXAM_BEFORE_CD=0;
        $V_BI_EXAM_OUT_COME_CD=0;
        $V_BI_CONGENITAL_ANOMALIES_CD=0;
        $V_BI_ADMISSION_CD=0;
        $V_BI_APAGAR_1=0;
        $V_BI_APAGAR_5=0;

       $pdo = $conn->getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':P_BI_ADMISSION_CD', $P_BI_ADMISSION_CD);
      $stmt->execute();
        $data['V_BI_CODE'] = $V_BI_CODE;
        $data['V_BI_ID'] = $V_BI_ID;
        $data['V_BI_ORDER'] = $V_BI_ORDER;
        $data['V_BI_FIRST_NAME'] = $V_BI_FIRST_NAME;
        $data['V_BI_WEIGHT_GM'] = $V_BI_WEIGHT_GM;
        $data['V_BI_RELEGION_CD'] = $V_BI_RELEGION_CD;
        $data['V_BI_SEX_CD'] = $V_BI_SEX_CD;
        $data['V_BI_OUT_COME_CD'] = $V_BI_OUT_COME_CD;
        $data['V_BI_PRESENTATION_CD'] = $V_BI_PRESENTATION_CD;
        $data['V_BI_PARTOGRAM_CD'] = $V_BI_PARTOGRAM_CD;
        $data['V_BI_ADMITTED_NICU_CD'] = $V_BI_ADMITTED_NICU_CD;
        $data['V_BI_EXAM_BEFORE_CD'] = $V_BI_EXAM_BEFORE_CD;
        $data['V_BI_EXAM_OUT_COME_CD'] = $V_BI_EXAM_OUT_COME_CD;
        $data['V_BI_CONGENITAL_ANOMALIES_CD'] = $V_BI_CONGENITAL_ANOMALIES_CD;
        $data['V_BI_ADMISSION_CD'] = $V_BI_ADMISSION_CD;
        $data['V_BI_APAGAR_1'] = $V_BI_APAGAR_1;
        $data['V_BI_APAGAR_5'] = $V_BI_APAGAR_5;
     return $data;
    });
}

public static function GET_BORN_INFO_BY_CODE($P_BI_CODE)
{
    $sql = "begin BORN_INFO_PKG.GET_BORN_INFO_BY_CODE (:P_BI_CODE,:BORN_OUT_CUR); end;";

    return DB::transaction(function ($conn) use ($sql, $P_BI_CODE) {
        $lista = [];
        //dd($P_ICD_CODE);
        $pdo = $conn->getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':P_BI_CODE', $P_BI_CODE);
        $stmt->bindParam(':BORN_OUT_CUR', $lista, PDO::PARAM_STMT);
        $stmt->execute();
        oci_execute($lista, OCI_DEFAULT);
        oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
        oci_free_cursor($lista);
        return $array;
    });
}

public static function UPDATE_BORN_DATA($data)
    {

        $sql_born = "begin BORN_INFO_PKG.UPDATE_BORN_INFO(:P_BI_CODE,:F_NUMBER,:M_NUMBER,:BORN_D_DELIVERY_DATE ,
                                   :BORN_D_MARRIAGE_DATE,:BORN_D_MARRIAGE_NUMBER,:BORN_D_CUR_MARRIAGE_LIVE ,:BORN_D_CUR_MARRIAGE_DEAD ,
                                   :BORN_D_PRE_MARRIAGE_LIVE,:BORN_D_PRE_MARRIAGE_DEAD,:BORN_D_PLURALITY,:BORN_D_CITY_CD  ,
                                   :BORN_D_REGION_CD,:BORN_D_HOME_NO,:BORN_D_PARENTS_TEL_NO,:BORN_D_HEALTH_CENTER_CD  ,
                                   :BORN_D_BIRTH_PLACE_CD,:P_BI_ID,:P_BI_ORDER,:P_BI_FIRST_NAME,:P_BI_WEIGHT_GM,:P_BI_RELEGION_CD ,
                                   :P_BI_SEX_CD,:P_BI_OUT_COME_CD,:P_BI_PRESENTATION_CD,:P_BI_PARTOGRAM_CD,
                                   :P_BI_ADMITTED_NICU_CD,:P_BI_EXAM_BEFORE_CD,:P_BI_EXAM_OUT_COME_CD,:P_BI_CONGENITAL_ANOMALIES_CD,
                                   :P_BI_ADMISSION_CD,:P_BI_NOTIFICATION_CREATED_ON,:P_BI_NOTIFICATION_CREATED_BY,
                                   :P_BI_APAGAR_1,:P_BI_APAGAR_5,:P_RESULT); end;";
        return DB::transaction(function ($conn) use ($sql_born, $data) {
            $P_RESULT = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql_born);
            $stmt->bindParam(':P_BI_CODE', $data['P_BI_CODE']);
            $stmt->bindParam(':F_NUMBER', $data['BORN_DETAILS_FATH_CD']);
            $stmt->bindParam(':M_NUMBER', $data['BORN_DETAILS_MOTHER_CD']);
            $stmt->bindParam(':BORN_D_DELIVERY_DATE', $data['BORN_DETAILS_DELIVERY_DATE']);
            $stmt->bindParam(':BORN_D_MARRIAGE_DATE', $data['BORN_DETAILS_DELIVERY_CD']);
            $stmt->bindParam(':BORN_D_MARRIAGE_NUMBER', $data['BORN_DETAILS_MARRIAGE_NUMBER']);
            $stmt->bindParam(':BORN_D_CUR_MARRIAGE_LIVE', $data['BORN_DETAILS_CUR_MARRIAGE_LIVE']);
            $stmt->bindParam(':BORN_D_CUR_MARRIAGE_DEAD', $data['BORN_DETAILS_CUR_MARRIAGE_DEAD']);
            $stmt->bindParam(':BORN_D_PRE_MARRIAGE_LIVE', $data['BORN_DETAILS_PRE_MARRIAGE_LIVE']);
            $stmt->bindParam(':BORN_D_PRE_MARRIAGE_DEAD', $data['BORN_DETAILS_PRE_MARRIAGE_DEAD']);
            $stmt->bindParam(':BORN_D_PLURALITY', $data['BORN_DETAILS_PLURALITY']);
            $stmt->bindParam(':BORN_D_CITY_CD', $data['BORN_DETAILS_CITY_CD']);
            $stmt->bindParam(':BORN_D_REGION_CD', $data['BORN_DETAILS_REGION_CD']);
            $stmt->bindParam(':BORN_D_HOME_NO', $data['BORN_DETAILS_HOME_NO']);
            $stmt->bindParam(':BORN_D_PARENTS_TEL_NO', $data['BORN_DETAILS_PARENTS_TEL_NO']);
            $stmt->bindParam(':BORN_D_HEALTH_CENTER_CD', $data['BORN_DETAILS_HEALTH_CENTER_CD']);
            $stmt->bindParam(':BORN_D_BIRTH_PLACE_CD', $data['BORN_DETAILS_BIRTH_PLACE_CD']);
            $stmt->bindParam(':P_BI_ID', $data['P_BI_ID']);
            $stmt->bindParam(':P_BI_ORDER', $data['P_BI_ORDER']);
            $stmt->bindParam(':P_BI_FIRST_NAME', $data['P_BI_FIRST_NAME']);
            $stmt->bindParam(':P_BI_WEIGHT_GM', $data['P_BI_WEIGHT_GM']);
            $stmt->bindParam(':P_BI_RELEGION_CD', $data['P_BI_RELEGION_CD']);
            $stmt->bindParam(':P_BI_SEX_CD', $data['P_BI_SEX_CD']);
            $stmt->bindParam(':P_BI_OUT_COME_CD', $data['P_BI_OUT_COME_CD']);
            $stmt->bindParam(':P_BI_PRESENTATION_CD', $data['P_BI_PRESENTATION_CD']);
            $stmt->bindParam(':P_BI_PARTOGRAM_CD', $data['P_BI_PARTOGRAM_CD']);
            $stmt->bindParam(':P_BI_ADMITTED_NICU_CD', $data['P_BI_ADMITTED_NICU_CD']);
            $stmt->bindParam(':P_BI_EXAM_BEFORE_CD', $data['P_BI_EXAM_BEFORE_CD']);
            $stmt->bindParam(':P_BI_EXAM_OUT_COME_CD', $data['P_BI_EXAM_OUT_COME_CD']);
            $stmt->bindParam(':P_BI_CONGENITAL_ANOMALIES_CD', $data['P_BI_CONGENITAL_ANOMALIES_CD']);
            $stmt->bindParam(':P_BI_ADMISSION_CD', $data['P_BI_ADMISSION_CD']);
            $stmt->bindParam(':P_BI_NOTIFICATION_CREATED_ON', $data['P_BI_NOTIFICATION_CREATED_ON']);
            $stmt->bindParam(':P_BI_NOTIFICATION_CREATED_BY', $data['P_BI_NOTIFICATION_CREATED_BY']);
            $stmt->bindParam(':P_BI_APAGAR_1', $data['P_BI_APAGAR_1']);
            $stmt->bindParam(':P_BI_APAGAR_5', $data['P_BI_APAGAR_5']);
            $stmt->bindParam(':P_RESULT', $P_RESULT, PDO::PARAM_INT, 1);
            $stmt->execute();
            $data['P_RESULT'] = $P_RESULT;
            return $data;
        });
    }

    public static function GET_COUNT_BORN()
    {
        $sql = "begin BORN_INFO_PKG.GET_COUNT_BORN (:BORN_COUNT); end;";

        return DB::transaction(function ($conn) use ($sql) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':BORN_COUNT', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_USER_PROFILE($user_name)
    {
        $sql = "begin BORN_INFO_PKG.GET_USER_PROFILE (:USERNAME,:USER_PROFILE); end;";
        return DB::transaction(function ($conn) use ($sql, $user_name) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':USERNAME', $user_name);
            $stmt->bindParam(':USER_PROFILE', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_BORN_REGION($P_REGION_CODE)
    {
        $sql = "begin BORN_INFO_PKG.GET_BORN_REGION (:P_REGION_CODE,:REGION_OUT_CUR); end;";

        return DB::transaction(function ($conn) use ($sql, $P_REGION_CODE) {
            $lista = [];

            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_REGION_CODE', $P_REGION_CODE);
            $stmt->bindParam(':REGION_OUT_CUR', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_BORN_CITY($P_CITY_CODE)
    {
        $sql = "begin BORN_INFO_PKG.GET_BORN_CITY (:P_CITY_CODE,:CITY_OUT_CUR); end;";

        return DB::transaction(function ($conn) use ($sql, $P_CITY_CODE) {
            $lista = [];

            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_CITY_CODE', $P_CITY_CODE);
            $stmt->bindParam(':CITY_OUT_CUR', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_BORNS_LIMIT($data)
    {
     //   dd($data);
        $sql = "begin BORN_INFO_PKG.GET_BORNS_LIMIT (:DATE_FROM,:DATE_TO,:U_CODE,:BORNS,:S,:E); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':DATE_FROM', $data['date_F']);
            $stmt->bindParam(':DATE_TO', $data['date_T']);
            $stmt->bindParam(':U_CODE', $data['U_CODE']);
            $stmt->bindParam(':S', $data['S']);
            $stmt->bindParam(':E', $data['E']);
            $stmt->bindParam(':BORNS', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_BORNS($data)
    {
     //   dd($data);
        $sql = "begin BORN_INFO_PKG.GET_BORNS (:DATE_FROM,:DATE_TO,:U_CODE,:BORNS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':DATE_FROM', $data['date_F']);
            $stmt->bindParam(':DATE_TO', $data['date_T']);
            $stmt->bindParam(':U_CODE', $data['U_CODE']);
            $stmt->bindParam(':BORNS', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_BORNS_ALL($data)
    {
     //   dd($data);
        $sql = "begin BORN_INFO_PKG.GET_BORNS_ALL (:DATE_FROM,:DATE_TO,:U_CODE,:P_START,:P_LIMIT,:RESULT_COUNT,:BORNS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT=0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':DATE_FROM', $data['date_F']);
            $stmt->bindParam(':DATE_TO', $data['date_T']);
            $stmt->bindParam(':U_CODE', $data['U_CODE']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['length']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT,11);
            $stmt->bindParam(':BORNS', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            $result['data'] = $array;
            $result['RESULT_COUNT'] = $RESULT_COUNT;
            return $result;
        });
    }
    public static function GET_PLACE_BORNS($data)
    {
     //   dd($data);
        $sql = "begin BORN_INFO_PKG.GET_PLACE_BORNS (:DATE_FROM,:DATE_TO,:U_CODE,:BORN_INFO); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':DATE_FROM', $data['date_F']);
            $stmt->bindParam(':DATE_TO', $data['date_T']);
            $stmt->bindParam(':U_CODE', $data['U_CODE']);
            $stmt->bindParam(':BORN_INFO', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_BORNS_ALL_DELIVERY($data)
    {
     //   dd($data);
        $sql = "begin BORN_INFO_PKG.GET_BORNS_ALL_DELIVERY (:DATE_FROM,:DATE_TO,:U_CODE,:P_START,:P_LIMIT,:RESULT_COUNT,:BORNS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT=0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':DATE_FROM', $data['date_F']);
            $stmt->bindParam(':DATE_TO', $data['date_T']);
            $stmt->bindParam(':U_CODE', $data['U_CODE']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['length']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT,11);
            $stmt->bindParam(':BORNS', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            $result['data'] = $array;
            $result['RESULT_COUNT'] = $RESULT_COUNT;
            return $result;
        });
    }
    public static function CHECK_BORN_ID($data)
    {
        //لفحص هذا رقم الهوية موجود أم لا
        $sql_check = "begin BORN_INFO_PKG.CHECK_BORN_ID(:P_BI_ID,:BORN); end;";

        return DB::transaction(function ($conn) use ($sql_check, $data) {

            $BORN = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql_check);
            $stmt->bindParam(':P_BI_ID', $data['P_BI_ID']);
            $stmt->bindParam(':BORN', $BORN, PDO::PARAM_INT, 1);

            $stmt->execute();
            $data['BORN'] = $BORN;
            return $data;
        });
    }

    public static function CHECK_BIRTH_DATE($data)
    {

        $sql_check = "begin BORN_INFO_PKG.CHECK_BIRTH_DATE (:F_ID,:M_ID,:BIRTH_DATE, :USER_ID,:CHECK_CODE); end;";

        return DB::transaction(function ($conn) use ($sql_check, $data) {
            $CHECK_CODE = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql_check);
            $stmt->bindParam(':F_ID', $data['F_ID']);
            $stmt->bindParam(':M_ID', $data['M_ID']);
            $stmt->bindParam(':BIRTH_DATE', $data['BIRTH_DATE']);
            $stmt->bindParam(':USER_ID', $data['USER_ID']);

            $stmt->bindParam(':CHECK_CODE', $CHECK_CODE, PDO::PARAM_INT, 1);

            $stmt->execute();
            $data['CHECK_CODE'] = $CHECK_CODE;
            return $data;
        });
    }
    public static function CHECK_BORN_COUNT($data)
    {
        //لفحص هذا رقم الهوية موجود أم لا
        $sql_check = "begin BORN_INFO_PKG.CHECK_BORN_COUNT(:P_BI_ADMISSION_CD,:BORN); end;";

        return DB::transaction(function ($conn) use ($sql_check, $data) {

            $BORN = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql_check);
            $stmt->bindParam(':P_BI_ADMISSION_CD', $data['P_BI_ADMISSION_CD']);
            $stmt->bindParam(':BORN', $BORN, PDO::PARAM_INT, 1);

            $stmt->execute();
            $data['BORN'] = $BORN;
            return $data;
        });
    }
}
