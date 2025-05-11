<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use PDO;

class DEADS_TB extends Model
{
    use HasFactory;
    protected $table  = 'DEADS_TB';
    protected $guarded = [];

    public static function GET_DEAD_DATA_BY_ID($data)
    {

        $sql = "begin DEAD_INFO_PKG.GET_DEADS_DATA (:P_DEAD_CODE,:P_ID,:P_FIRST_NAME,:P_SECOND_NAME,:P_THIRD_NAME,:P_LAST_NAME,:P_DATE_FROM,:P_DATE_TO,:P_SEX_NO,:P_REGION_NO,:P_CITY_NO,:P_HOS_NO,:DIAG1_NAME,:DIAG4_NAME,:P_DEATH_PLACE,:P_ENTRY_POINT,:P_ENTER_FROM,:P_ENTER_TO,:P_ENTRY_EMPLOYEE,:P_START,:P_LIMIT,:RESULT_COUNT,:DEADS); end;";

        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_DEAD_CODE', $data['P_DEAD_CODE']);
            $stmt->bindParam(':P_ID', $data['P_ID']);
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
            $stmt->bindParam(':DIAG1_NAME', $data['DIAG1_NAME']);
            $stmt->bindParam(':DIAG4_NAME', $data['DIAG4_NAME']);
            $stmt->bindParam(':P_DEATH_PLACE', $data['P_DEATH_PLACE']);
            $stmt->bindParam(':P_ENTRY_POINT', $data['P_ENTRY_POINT']);
            $stmt->bindParam(':P_ENTER_FROM', $data['P_ENTER_FROM']);
            $stmt->bindParam(':P_ENTER_TO', $data['P_ENTER_TO']);
            $stmt->bindParam(':P_ENTRY_EMPLOYEE', $data['P_ENTRY_EMPLOYEE']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['length']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT, 11);

            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            $result['data'] = $array;
            $result['RESULT_COUNT'] = $RESULT_COUNT;
            return $result;
        });
    }

    public static function GET_DEAD_INFO($data)
    {
        //dd($data);
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_DATA (:P_DEAD_CODE,:P_ID,:P_FIRST_NAME,:P_SECOND_NAME,:P_THIRD_NAME,:P_LAST_NAME,:P_DATE_FROM,:P_DATE_TO,:P_SEX_NO,:P_REGION_NO,:P_CITY_NO,:P_HOS_NO,:DIAG1_NAME,:DIAG4_NAME,:P_DEATH_PLACE,:P_ENTRY_POINT,:P_START,:P_LIMIT,:RESULT_COUNT,:DEADS); end;";

        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_DEAD_CODE', $data['P_DEAD_CODE']);
            $stmt->bindParam(':P_ID', $data['P_ID']);
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
            $stmt->bindParam(':DIAG1_NAME', $data['DIAG1_NAME']);
            $stmt->bindParam(':DIAG4_NAME', $data['DIAG4_NAME']);
            $stmt->bindParam(':P_DEATH_PLACE', $data['P_DEATH_PLACE']);
            $stmt->bindParam(':P_ENTRY_POINT', $data['P_ENTRY_POINT']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['limit']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT, 11);

            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);

            return $array;
            //  dd($array);
        });
    }
    public static function ADD_DEAD_DATA($data)
    {
        //  dd($data['P_QR_CD']);

        $sql_dead = "begin DEAD_INFO_PKG.ADD_DEAD_TB(:P_ID_NO,:P_ID_TYPE,:P_FIRST_NAME ,:P_FATHER_NAME ,:P_GRAND_FATHER_NAME,:P_FAMILY_NAME,:P_DEAD_HOURS,:P_SEX_CD,
                           :P_REGION_CD,:P_CITY_CD,:P_DEATH_PLACE_CD,:P_HOS_CD,:P_DEAD_DETAILS_CD,:P_ICD_1,:P_ICD_2,:P_ICD_3,:P_ICD_4,:P_ICD_5,:P_ICD_6,:P_ICD_7,:P_ICD_8,:P_REPORT_SUBMITTED_ID,:P_REPORT_SUBMITTED_BY,:P_REPORT_DOC_BY,:P_DATE_OF_REPORT,
                           :P_REPORT_CREATED_BY_CD,:P_BIRTH_DATE,:P_DATE_DEATH,:P_NATIONALITY_CD,:P_MARTIAL_STATUS_CD,:P_DEATH_COUNTRY,:P_DEATH_REGION_PLACE,:P_DEATH_CITY_PLACE,
                           :P_BIRTH_PLACE,:P_RELEGION_CD,:P_JOB_CD,:P_BURIAL_PLACE,:P_BURIAL_CODE,:P_PREGNANCY_CD,:P_GESTATIONAL_WEEK,:P_AFTER_DELIVERY_CD,:P_PARTNER_ID,:P_PARTNER_NAME,
                           :P_DOC_SPECIALIST,:P_DOC_ADDRESS,:P_TREATMENT_DATE,:P_PREVIEW_DATE,:P_SEEING_CORPSE_DATE,:P_CORPSE_DISSECTION_CD,:P_CORPSE_DESSECTION_DATE,:P_REPORTER_SEX_CD,
                           :P_REPORTER_NATIONALITY_CD,:P_RELATIONSHIP,:P_REPORTER_ADDRESS,:P_REPORTER_MOBILE,:P_RECEIVE_DATE,:P_RECEIVER_NAME,:P_REGISTER_DATE,:P_REGISTER_NAME,:P_REGISTER_PLACE_CD,:P_SOURSE,:P_QR_CD,:P_DEAD_NUMBER,:P_RESULT); end;";
        return DB::transaction(function ($conn) use ($sql_dead, $data) {
            $P_RESULT = 0;
            $P_DEAD_NUMBER = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql_dead);
            $stmt->bindParam(':P_ID_NO', $data['P_ID_NO']);
            $stmt->bindParam(':P_ID_TYPE', $data['P_ID_TYPE']);
            $stmt->bindParam(':P_FIRST_NAME', $data['P_FIRST_NAME']);
            $stmt->bindParam(':P_FATHER_NAME', $data['P_FATHER_NAME']);
            $stmt->bindParam(':P_GRAND_FATHER_NAME', $data['P_GRAND_FATHER_NAME']);
            $stmt->bindParam(':P_FAMILY_NAME', $data['P_FAMILY_NAME']);
            $stmt->bindParam(':P_DEAD_HOURS', $data['P_DEAD_HOURS']);
            $stmt->bindParam(':P_SEX_CD', $data['P_SEX_CD']);
            $stmt->bindParam(':P_REGION_CD', $data['P_REGION_CD']);
            $stmt->bindParam(':P_CITY_CD', $data['P_CITY_CD']);
            $stmt->bindParam(':P_DEATH_PLACE_CD', $data['P_DEATH_PLACE_CD']);
            $stmt->bindParam(':P_HOS_CD', $data['P_HOS_CD']);
            $stmt->bindParam(':P_DEAD_DETAILS_CD', $data['P_DEAD_DETAILS_CD']);
            $stmt->bindParam(':P_ICD_1', $data['P_ICD_1']);
            $stmt->bindParam(':P_ICD_2', $data['P_ICD_2']);
            $stmt->bindParam(':P_ICD_3', $data['P_ICD_3']);
            $stmt->bindParam(':P_ICD_4', $data['P_ICD_4']);
            $stmt->bindParam(':P_ICD_5', $data['P_ICD_5']);
            $stmt->bindParam(':P_ICD_6', $data['P_ICD_6']);
            $stmt->bindParam(':P_ICD_7', $data['P_ICD_7']);
            $stmt->bindParam(':P_ICD_8', $data['P_ICD_8']);
            $stmt->bindParam(':P_REPORT_SUBMITTED_ID', $data['P_REPORT_SUBMITTED_ID']);
            $stmt->bindParam(':P_REPORT_SUBMITTED_BY', $data['P_REPORT_SUBMITTED_BY']);
            $stmt->bindParam(':P_REPORT_DOC_BY', $data['P_REPORT_DOC_BY']);
            $stmt->bindParam(':P_DATE_OF_REPORT', $data['P_DATE_OF_REPORT']);
            $stmt->bindParam(':P_REPORT_CREATED_BY_CD', $data['P_REPORT_CREATED_BY_CD']);
            $stmt->bindParam(':P_BIRTH_DATE', $data['P_BIRTH_DATE']);
            $stmt->bindParam(':P_DATE_DEATH', $data['P_DATE_DEATH']);
            $stmt->bindParam(':P_NATIONALITY_CD', $data['P_NATIONALITY_CD']);
            $stmt->bindParam(':P_MARTIAL_STATUS_CD', $data['P_MARTIAL_STATUS_CD']);
            $stmt->bindParam(':P_DEATH_COUNTRY', $data['P_DEATH_COUNTRY']);
            $stmt->bindParam(':P_DEATH_REGION_PLACE', $data['P_DEATH_REGION_PLACE']);
            $stmt->bindParam(':P_DEATH_CITY_PLACE', $data['P_DEATH_CITY_PLACE']);
            //dead details tb
            $stmt->bindParam(':P_BIRTH_PLACE', $data['P_BIRTH_PLACE']);
            $stmt->bindParam(':P_RELEGION_CD', $data['P_RELEGION_CD']);
            $stmt->bindParam(':P_JOB_CD', $data['P_JOB_CD']);
            $stmt->bindParam(':P_BURIAL_PLACE', $data['P_BURIAL_PLACE']);
            $stmt->bindParam(':P_BURIAL_CODE', $data['P_BURIAL_CODE']);
            $stmt->bindParam(':P_PREGNANCY_CD', $data['P_PREGNANCY_CD']);
            $stmt->bindParam(':P_GESTATIONAL_WEEK', $data['P_GESTATIONAL_WEEK']);
            $stmt->bindParam(':P_AFTER_DELIVERY_CD', $data['P_AFTER_DELIVERY_CD']);
            $stmt->bindParam(':P_PARTNER_ID', $data['P_PARTNER_ID']);
            $stmt->bindParam(':P_PARTNER_NAME', $data['P_PARTNER_NAME']);
            $stmt->bindParam(':P_DOC_SPECIALIST', $data['P_DOC_SPECIALIST']);
            $stmt->bindParam(':P_DOC_ADDRESS', $data['P_DOC_ADDRESS']);
            $stmt->bindParam(':P_TREATMENT_DATE', $data['P_TREATMENT_DATE']);
            $stmt->bindParam(':P_PREVIEW_DATE', $data['P_PREVIEW_DATE']);
            $stmt->bindParam(':P_SEEING_CORPSE_DATE', $data['P_SEEING_CORPSE_DATE']);
            $stmt->bindParam(':P_CORPSE_DISSECTION_CD', $data['P_CORPSE_DISSECTION_CD']);
            $stmt->bindParam(':P_CORPSE_DESSECTION_DATE', $data['P_CORPSE_DESSECTION_DATE']);
            $stmt->bindParam(':P_REPORTER_SEX_CD', $data['P_REPORTER_SEX_CD']);
            $stmt->bindParam(':P_REPORTER_NATIONALITY_CD', $data['P_REPORTER_NATIONALITY_CD']);
            $stmt->bindParam(':P_RELATIONSHIP', $data['P_RELATIONSHIP']);
            $stmt->bindParam(':P_REPORTER_ADDRESS', $data['P_REPORTER_ADDRESS']);
            $stmt->bindParam(':P_REPORTER_MOBILE', $data['P_REPORTER_MOBILE']);
            $stmt->bindParam(':P_RECEIVE_DATE', $data['P_RECEIVE_DATE']);
            $stmt->bindParam(':P_RECEIVER_NAME', $data['P_RECEIVER_NAME']);
            $stmt->bindParam(':P_REGISTER_DATE', $data['P_REGISTER_DATE']);
            $stmt->bindParam(':P_REGISTER_NAME', $data['P_REGISTER_NAME']);
            $stmt->bindParam(':P_REGISTER_PLACE_CD', $data['P_REGISTER_PLACE_CD']);
            $stmt->bindParam(':P_SOURSE', $data['P_SOURSE']);
            $stmt->bindParam(':P_QR_CD', $data['P_QR_CD']);
            $stmt->bindParam(':P_DEAD_NUMBER', $P_DEAD_NUMBER, PDO::PARAM_INT);
            $stmt->bindParam(':P_RESULT', $P_RESULT, PDO::PARAM_INT, 1);
            $stmt->execute();
            $data['P_DEAD_NUMBER'] = $P_DEAD_NUMBER;
            $data['P_RESULT'] = $P_RESULT;
            return $data;
        });
    }
    public static function GET_DEAD_ICD()
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEAD_ICD (:ICD_OUT_CUR); end;";

        return DB::transaction(function ($conn) use ($sql) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ICD_OUT_CUR', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_USER_PROFILE()
    {
        $sql = "begin DEAD_INFO_PKG.GET_USER_PROFILE (:USER_OUT_CUR); end;";

        return DB::transaction(function ($conn) use ($sql) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':USER_OUT_CUR', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }


    public static function GET_ICD_BY_ID($P_ICD_CODE)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEAD_ICD_BY_ICD (:P_ICD_CODE,:ICD_OUT_CUR); end;";

        return DB::transaction(function ($conn) use ($sql, $P_ICD_CODE) {
            $lista = [];
            //dd($P_ICD_CODE);
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_ICD_CODE', $P_ICD_CODE);
            $stmt->bindParam(':ICD_OUT_CUR', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_HOS_DREF($P_HOS_CODE)
    {
        $sql = "begin DEAD_INFO_PKG.GET_HOS_DREF (:P_HOS_CODE,:HOS_OUT_CUR); end;";

        return DB::transaction(function ($conn) use ($sql, $P_HOS_CODE) {
            $lista = [];
            //dd($P_ICD_CODE);
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_HOS_CODE', $P_HOS_CODE);
            $stmt->bindParam(':HOS_OUT_CUR', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_ICD_DATA_AUTO($P_TERM)
    {
        $sql = "begin DEAD_INFO_PKG.GET_ICD_DATA_AUTO (:P_TERM,:ICD_LIST); end;";

        return DB::transaction(function ($conn) use ($sql, $P_TERM) {
            $lista = [];
            //dd($P_ICD_CODE);
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_TERM', $P_TERM);
            $stmt->bindParam(':ICD_LIST', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    //update data

    public static function UPDATE_DEAD_DATA($data)
    {
        //dd($data);
        $sql_dead = "begin DEAD_INFO_PKG.UPDATE_DEAD_INFO(:P_DEAD_NUMBER,:P_ID_NO,:P_ID_TYPE,:P_FIRST_NAME ,:P_FATHER_NAME ,:P_GRAND_FATHER_NAME,:P_FAMILY_NAME,:P_DEAD_HOURS,:P_SEX_CD,
    :P_REGION_CD,:P_CITY_CD,:P_DEATH_PLACE_CD,:P_HOS_CD,:P_DEAD_DETAILS_CD,:P_ICD_1,:P_ICD_2,:P_ICD_3,:P_ICD_4,:P_ICD_5,:P_ICD_6,:P_ICD_7,:P_ICD_8,:P_REPORT_SUBMITTED_ID,:P_REPORT_SUBMITTED_BY,:P_REPORT_DOC_BY,:P_DATE_OF_REPORT,
    :P_UPDATED_BY,:P_BIRTH_DATE,:P_DATE_DEATH,:P_NATIONALITY_CD,:P_MARTIAL_STATUS_CD,:P_DEATH_COUNTRY,:P_DEATH_REGION_PLACE,:P_DEATH_CITY_PLACE,
    :P_BIRTH_PLACE,:P_RELEGION_CD,:P_JOB_CD,:P_BURIAL_PLACE,:P_BURIAL_CODE,:P_PREGNANCY_CD,:P_GESTATIONAL_WEEK,:P_AFTER_DELIVERY_CD,:P_PARTNER_ID,:P_PARTNER_NAME,
    :P_DOC_SPECIALIST,:P_DOC_ADDRESS,:P_TREATMENT_DATE,:P_PREVIEW_DATE,:P_SEEING_CORPSE_DATE,:P_CORPSE_DISSECTION_CD,:P_CORPSE_DESSECTION_DATE,:P_REPORTER_SEX_CD,
    :P_REPORTER_NATIONALITY_CD,:P_RELATIONSHIP,:P_REPORTER_ADDRESS,:P_REPORTER_MOBILE,:P_RECEIVE_DATE,:P_RECEIVER_NAME,:P_REGISTER_DATE,:P_REGISTER_NAME,:P_REGISTER_PLACE_CD,:P_RESULT); end;";
        return DB::transaction(function ($conn) use ($sql_dead, $data) {
            $lista = [];
            $P_RESULT = 0;
            $P_DEAD_NUMBER = 0;
            $pdo = $conn->getPdo();
            //dd($pdo);
            $stmt = $pdo->prepare($sql_dead);
            //dead tb
            $stmt->bindParam(':P_DEAD_NUMBER', $data['P_DEAD_NUMBER']);
            $stmt->bindParam(':P_ID_NO', $data['P_ID_NO']);
            $stmt->bindParam(':P_ID_TYPE', $data['P_ID_TYPE']);
            $stmt->bindParam(':P_FIRST_NAME', $data['P_FIRST_NAME']);
            $stmt->bindParam(':P_FATHER_NAME', $data['P_FATHER_NAME']);
            $stmt->bindParam(':P_GRAND_FATHER_NAME', $data['P_GRAND_FATHER_NAME']);
            $stmt->bindParam(':P_FAMILY_NAME', $data['P_FAMILY_NAME']);
            $stmt->bindParam(':P_DEAD_HOURS', $data['P_DEAD_HOURS']);
            $stmt->bindParam(':P_SEX_CD', $data['P_SEX_CD']);
            $stmt->bindParam(':P_REGION_CD', $data['P_REGION_CD']);
            $stmt->bindParam(':P_CITY_CD', $data['P_CITY_CD']);
            $stmt->bindParam(':P_DEATH_PLACE_CD', $data['P_DEATH_PLACE_CD']);
            $stmt->bindParam(':P_HOS_CD', $data['P_HOS_CD']);
            $stmt->bindParam(':P_DEAD_DETAILS_CD', $data['P_DEAD_DETAILS_CD']);
            $stmt->bindParam(':P_ICD_1', $data['P_ICD_1']);
            $stmt->bindParam(':P_ICD_2', $data['P_ICD_2']);
            $stmt->bindParam(':P_ICD_3', $data['P_ICD_3']);
            $stmt->bindParam(':P_ICD_4', $data['P_ICD_4']);
            $stmt->bindParam(':P_ICD_5', $data['P_ICD_5']);
            $stmt->bindParam(':P_ICD_6', $data['P_ICD_6']);
            $stmt->bindParam(':P_ICD_7', $data['P_ICD_7']);
            $stmt->bindParam(':P_ICD_8', $data['P_ICD_8']);
            $stmt->bindParam(':P_REPORT_SUBMITTED_ID', $data['P_REPORT_SUBMITTED_ID']);
            $stmt->bindParam(':P_REPORT_SUBMITTED_BY', $data['P_REPORT_SUBMITTED_BY']);
            $stmt->bindParam(':P_REPORT_DOC_BY', $data['P_REPORT_DOC_BY']);
            $stmt->bindParam(':P_DATE_OF_REPORT', $data['P_DATE_OF_REPORT']);
            $stmt->bindParam(':P_UPDATED_BY', $data['P_UPDATED_BY']);
            $stmt->bindParam(':P_BIRTH_DATE', $data['P_BIRTH_DATE']);
            $stmt->bindParam(':P_DATE_DEATH', $data['P_DATE_DEATH']);
            $stmt->bindParam(':P_NATIONALITY_CD', $data['P_NATIONALITY_CD']);
            $stmt->bindParam(':P_MARTIAL_STATUS_CD', $data['P_MARTIAL_STATUS_CD']);
            $stmt->bindParam(':P_DEATH_COUNTRY', $data['P_DEATH_COUNTRY']);
            $stmt->bindParam(':P_DEATH_REGION_PLACE', $data['P_DEATH_REGION_PLACE']);
            $stmt->bindParam(':P_DEATH_CITY_PLACE', $data['P_DEATH_CITY_PLACE']);
            //dead details tb
            $stmt->bindParam(':P_BIRTH_PLACE', $data['P_BIRTH_PLACE']);
            $stmt->bindParam(':P_RELEGION_CD', $data['P_RELEGION_CD']);
            $stmt->bindParam(':P_JOB_CD', $data['P_JOB_CD']);
            $stmt->bindParam(':P_BURIAL_PLACE', $data['P_BURIAL_PLACE']);
            $stmt->bindParam(':P_BURIAL_CODE', $data['P_BURIAL_CODE']);
            $stmt->bindParam(':P_PREGNANCY_CD', $data['P_PREGNANCY_CD']);
            $stmt->bindParam(':P_GESTATIONAL_WEEK', $data['P_GESTATIONAL_WEEK']);
            $stmt->bindParam(':P_AFTER_DELIVERY_CD', $data['P_AFTER_DELIVERY_CD']);
            $stmt->bindParam(':P_PARTNER_ID', $data['P_PARTNER_ID']);
            $stmt->bindParam(':P_PARTNER_NAME', $data['P_PARTNER_NAME']);
            $stmt->bindParam(':P_DOC_SPECIALIST', $data['P_DOC_SPECIALIST']);
            $stmt->bindParam(':P_DOC_ADDRESS', $data['P_DOC_ADDRESS']);
            $stmt->bindParam(':P_TREATMENT_DATE', $data['P_TREATMENT_DATE']);
            $stmt->bindParam(':P_PREVIEW_DATE', $data['P_PREVIEW_DATE']);
            $stmt->bindParam(':P_SEEING_CORPSE_DATE', $data['P_SEEING_CORPSE_DATE']);
            $stmt->bindParam(':P_CORPSE_DISSECTION_CD', $data['P_CORPSE_DISSECTION_CD']);
            $stmt->bindParam(':P_CORPSE_DESSECTION_DATE', $data['P_CORPSE_DESSECTION_DATE']);
            $stmt->bindParam(':P_REPORTER_SEX_CD', $data['P_REPORTER_SEX_CD']);
            $stmt->bindParam(':P_REPORTER_NATIONALITY_CD', $data['P_REPORTER_NATIONALITY_CD']);
            $stmt->bindParam(':P_RELATIONSHIP', $data['P_RELATIONSHIP']);
            $stmt->bindParam(':P_REPORTER_ADDRESS', $data['P_REPORTER_ADDRESS']);
            $stmt->bindParam(':P_REPORTER_MOBILE', $data['P_REPORTER_MOBILE']);
            $stmt->bindParam(':P_RECEIVE_DATE', $data['P_RECEIVE_DATE']);
            $stmt->bindParam(':P_RECEIVER_NAME', $data['P_RECEIVER_NAME']);
            $stmt->bindParam(':P_REGISTER_DATE', $data['P_REGISTER_DATE']);
            $stmt->bindParam(':P_REGISTER_NAME', $data['P_REGISTER_NAME']);
            $stmt->bindParam(':P_REGISTER_PLACE_CD', $data['P_REGISTER_PLACE_CD']);
            $stmt->bindParam(':P_RESULT', $P_RESULT, PDO::PARAM_INT, 1);
            $stmt->execute();
            $data['P_DEAD_NUMBER'] = $P_DEAD_NUMBER;
            $data['P_RESULT'] = $P_RESULT;
            return $data;
        });
    }

    public static function GET_DEAD_INFO_BY_CODE($P_DEAD_NUMBER)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEAD_INFO_BY_CODE (:P_DEAD_NUMBER,:DEAD_OUT_CUR); end;";

        return DB::transaction(function ($conn) use ($sql, $P_DEAD_NUMBER) {
            $lista = [];
            //dd($P_ICD_CODE);
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_DEAD_NUMBER', $P_DEAD_NUMBER);
            $stmt->bindParam(':DEAD_OUT_CUR', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }


    public static function GET_DEAD_INFO_BY_ID($P_DEAD_ID)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEAD_INFO_BY_ID (:P_DEAD_ID,:DEAD_OUT_CUR); end;";

        return DB::transaction(function ($conn) use ($sql, $P_DEAD_ID) {
            $lista = [];
            //dd($P_ICD_CODE);
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_DEAD_ID', $P_DEAD_ID);
            $stmt->bindParam(':DEAD_OUT_CUR', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_DEAD_DATA_BY_CODE($P_DEAD_NUMBER)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEAD_DATA_BY_CODE (:P_DEAD_NUMBER,:DEAD_OUT_CUR); end;";

        return DB::transaction(function ($conn) use ($sql, $P_DEAD_NUMBER) {
            $lista = [];
            //dd($P_ICD_CODE);
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_DEAD_NUMBER', $P_DEAD_NUMBER);
            $stmt->bindParam(':DEAD_OUT_CUR', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    // public static function get_person_query($data){

    //     $sql_person = "begin ALL_SOKAN.GET_ROWS_PERSONS(:ID,:DOB,:FIRST_NAME,:FATHER_NAME,:GRAND_NAME,:LAST_NAME,:PERSON_INFO_DATA); end;";
    //     return DB::transaction(function ($conn) use ( $sql_person,$data) {
    //         $lista = [];
    //         $pdo = $conn->getPdo();
    //         $stmt = $pdo->prepare($sql_person);
    //         $stmt->bindParam(':ID', $data['ID']);
    //         $stmt->bindParam(':DOB', $data['DOB']);
    //         $stmt->bindParam(':FIRST_NAME', $data['FIRST_NAME']);
    //         $stmt->bindParam(':FATHER_NAME', $data['FATHER_NAME']);
    //         $stmt->bindParam(':GRAND_NAME', $data['GRAND_NAME']);
    //         $stmt->bindParam(':LAST_NAME', $data['LAST_NAME']);
    //         $stmt->bindParam(':PERSON_INFO_DATA', $lista, PDO::PARAM_STMT);
    //         $stmt->execute();
    //         oci_execute($lista, OCI_DEFAULT);
    //         oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
    //         oci_free_cursor($lista);
    //         return $array;

    // });

    // }

    public static function DEAD_IS_FOUND($data)
    {
        //لفحص هذا رقم الهوية موجود أم لا
        $sql_check = "begin DEAD_INFO_PKG.DEAD_IS_FOUND(:P_ID_NO,:P_ID_TYPE,:DEADS); end;";

        return DB::transaction(function ($conn) use ($sql_check, $data) {

            $DEADS = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql_check);
            //  dd($data['P_ID_NO']);
            $stmt->bindParam(':P_ID_NO', $data['ID_NO']);
            $stmt->bindParam(':P_ID_TYPE', $data['P_ID_TYPE']);
            $stmt->bindParam(':DEADS', $DEADS, PDO::PARAM_INT, 1);

            //    $stmt->bindParam(':FOUND', $FOUND, PDO::PARAM_INT, 11);
            $stmt->execute();
            //dd($FOUND);
            $data['DEADS'] = $DEADS;
            return $data;
        });
    }
    public static function GET_DEAD_CITZN_BY_ID($P_ID_NO)
    {
        // لجلب بيانات الوالد من الداخلية
        $sql_citzn = "begin CITZN_INFO_PAC.GET_SHIFA_CITZN_INFO_PR(:P_ID_NO ,:DEAD_FIRST_NAME_AR , :DEAD_FATHER_NAME_AR ,:DEAD_GRANDFATHER_NAME_AR ,:DEAD_LAST_NAME_AR , :DEAD_SEX , :DEAD_REGION , :DEAD_CITY , :DEAD_STR ,:DEAD_DOB, :DEAD_MARTIAL_STATUS ,:DEATH_DT, :DEAD_REGION_CD, :DEAD_CITY_CD, :DEAD_PERSONALITY_CODE_CD , :DEAD_JOB ,:BIRTH_MCODE_CD,:BIRTH_CODE_CD,:BIRTH_MCODE,:DEAD_BIRTH_PLACE); end;";

        return DB::transaction(function ($conn) use ($sql_citzn, $P_ID_NO) {

            //بيانات الداخلية
            //   $P_ID_NO = 0;
            $DEAD_FIRST_NAME_AR = '';
            $DEAD_FATHER_NAME_AR = '';
            $DEAD_GRANDFATHER_NAME_AR = '';
            $DEAD_LAST_NAME_AR = '';
            $DEAD_SEX = '';
            $DEAD_REGION = '';
            $DEAD_CITY = '';
            $DEAD_STR = '';
            $DEAD_DOB = '';
            $DEAD_MARTIAL_STATUS = '';
            $DEATH_DT = '';
            $DEAD_REGION_CD = 0;
            $DEAD_CITY_CD = 0;
            $DEAD_PERSONALITY_CODE_CD = 0;
            $DEAD_JOB = '';
            $BIRTH_MCODE_CD = 0;
            $BIRTH_CODE_CD = 0;
            $BIRTH_MCODE = '';
            $DEAD_BIRTH_PLACE = '';
            $DEAD_SEX_CD = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql_citzn);
            $stmt->bindParam(':P_ID_NO', $P_ID_NO, PDO::PARAM_INT, 11);
            $stmt->bindParam(':DEAD_FIRST_NAME_AR', $DEAD_FIRST_NAME_AR, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEAD_FATHER_NAME_AR', $DEAD_FATHER_NAME_AR, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEAD_GRANDFATHER_NAME_AR', $DEAD_GRANDFATHER_NAME_AR, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEAD_LAST_NAME_AR', $DEAD_LAST_NAME_AR, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEAD_SEX', $DEAD_SEX, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEAD_REGION', $DEAD_REGION, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEAD_CITY', $DEAD_CITY, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEAD_STR', $DEAD_STR, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEAD_DOB', $DEAD_DOB, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEAD_MARTIAL_STATUS', $DEAD_MARTIAL_STATUS, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEATH_DT', $DEATH_DT, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEAD_REGION_CD', $DEAD_REGION_CD, PDO::PARAM_INT, 11);
            $stmt->bindParam(':DEAD_CITY_CD', $DEAD_CITY_CD, PDO::PARAM_INT, 11);
            $stmt->bindParam(':DEAD_PERSONALITY_CODE_CD', $DEAD_PERSONALITY_CODE_CD, PDO::PARAM_INT, 11);
            $stmt->bindParam(':DEAD_JOB', $DEAD_JOB, PDO::PARAM_STR, 200);
            $stmt->bindParam(':BIRTH_MCODE_CD', $BIRTH_MCODE_CD, PDO::PARAM_INT, 11);
            $stmt->bindParam(':BIRTH_CODE_CD', $BIRTH_CODE_CD, PDO::PARAM_INT, 11);
            $stmt->bindParam(':BIRTH_MCODE', $BIRTH_MCODE, PDO::PARAM_STR, 200);
            $stmt->bindParam(':DEAD_BIRTH_PLACE', $DEAD_BIRTH_PLACE, PDO::PARAM_STR, 200);
            $stmt->execute();
            if ($DEAD_SEX == 'ذكر')
                $DEAD_SEX_CD = 1;
            else
                $DEAD_SEX_CD = 2;

            $data['P_ID_NO'] = $P_ID_NO;
            $data['DEAD_FIRST_NAME_AR'] = $DEAD_FIRST_NAME_AR;
            $data['DEAD_FATHER_NAME_AR'] = $DEAD_FATHER_NAME_AR;
            $data['DEAD_GRANDFATHER_NAME_AR'] = $DEAD_GRANDFATHER_NAME_AR;
            $data['DEAD_LAST_NAME_AR'] = $DEAD_LAST_NAME_AR;
            $data['DEAD_DOB'] = $DEAD_DOB;
            $data['DEAD_CITY_CD'] = $DEAD_CITY_CD;
            $data['DEAD_MARTIAL_STATUS'] = $DEAD_MARTIAL_STATUS;
            $data['DEATH_DT'] = $DEATH_DT;
            $data['DEAD_REGION_CD'] = $DEAD_REGION_CD;
            $data['DEAD_SEX_CD'] = $DEAD_SEX_CD;
            $data['DEAD_PERSONALITY_CODE_CD'] = $DEAD_PERSONALITY_CODE_CD;
            $data['DEAD_JOB'] = $DEAD_JOB;
            $data['BIRTH_MCODE_CD'] = $BIRTH_MCODE_CD;
            $data['BIRTH_CODE_CD'] = $BIRTH_CODE_CD;
            $data['BIRTH_MCODE'] = $BIRTH_MCODE;
            $data['DEAD_BIRTH_PLACE'] = $DEAD_BIRTH_PLACE;

            return $data;
        });
    }

    public static function GET_COUNT_DEAD()
    {
        $sql = "begin DEAD_INFO_PKG.GET_COUNT_DEAD (:DEAD_COUNT); end;";

        return DB::transaction(function ($conn) use ($sql) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':DEAD_COUNT', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }


    public static function GET_DEADS_DEATH_PLACE($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_DEATH_PLACE (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_DEADS_REGION($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_REGION (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_DEADS_REGION_TOTAL($data)
    {
        //    dd($data);
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_REGION_TOTAL (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_Distribution_Death_Place_Kids($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_DEATH_PLACE (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_Distribution_Region_Kids($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_REGION_KIDS (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_DEADS_REGION_TOTAL_KIDS($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_REGION_TOTAL_KIDS (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_Distribution_Region_Ages1($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_REGION (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_Distribution_Region_Ages2($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_REGION (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_Distribution_Death_Hosp($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_DEATH_HOSP (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_Distribution_Region_Ages3($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_REGION (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_Distribution_Death_Hos_Kids($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_DEATH_HOSP (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_Distribution_sex_D($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_BY_SEX (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_DEADS_BY_SEX_TOTAL($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_BY_SEX_TOTAL (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    //من هنا يجب التعديل
    public static function GET_Daily_Dead_Rep_2($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEATHS_LIMIT_POINT (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:PLACE_CD,:HOS_CD,:USER_CD,:POINT_CD,:P_START,:P_LIMIT,:RESULT_COUNT,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':PLACE_CD', $data['DEAD_DEATH_PLACE_CD']);
            $stmt->bindParam(':HOS_CD', $data['DEAD_HOS_NAME_CD']);
            $stmt->bindParam(':USER_CD', $data['USER_FULL_NAME']);
            $stmt->bindParam(':POINT_CD', $data['BORN_DETAILS_HEALTH_CENTER_CD2']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['length']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT, 11);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            $result['data'] = $array;
            $result['RESULT_COUNT'] = $RESULT_COUNT;
            return $result;
        });
    }

    public static function GET_Daily_Report_D($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEATHS_LIMIT (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:PLACE_CD,:HOS_CD,:USER_CD,:POINT_CD,:P_START,:P_LIMIT,:RESULT_COUNT,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':PLACE_CD', $data['DEAD_DEATH_PLACE_CD']);
            $stmt->bindParam(':HOS_CD', $data['DEAD_HOS_NAME_CD']);
            $stmt->bindParam(':USER_CD', $data['USER_FULL_NAME']);
            $stmt->bindParam(':POINT_CD', $data['BORN_DETAILS_HEALTH_CENTER_CD2']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['length']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT, 11);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            $result['data'] = $array;
            $result['RESULT_COUNT'] = $RESULT_COUNT;
            return $result;
        });
    }

    public static function GET_Distribution_Diagnosis($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_BY_DIAGNOSIS (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_Deads_non_Diagnosable($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEATHS_NON_DIAGNOSED (:ID,:SEX,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            // $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            // $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_DEATHS_DIAGNOSED_LIMIT($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEATHS_DIAGNOSED_LIMIT (:ID,:SEX,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:P_START,:P_LIMIT,:RESULT_COUNT,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['length']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT, 11);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            $result['data'] = $array;
            $result['RESULT_COUNT'] = $RESULT_COUNT;
            return $result;
        });
    }

    public static function GET_Total_In_Diagnosis($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_TOTAL_BY_DIAGNOSIS (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_Unknown_Region_Deaths($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEATHS_UNKNOWN_REGION (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_DEATHS_UNKNOWN_REG_LIMIT($data)
    {
        //   dd($data);
        $sql = "begin DEAD_INFO_PKG.GET_DEATHS_UNKNOWN_REG_LIMIT (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:P_START,:P_LIMIT,:RESULT_COUNT,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['length']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT, 11);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            $result['data'] = $array;
            $result['RESULT_COUNT'] = $RESULT_COUNT;
            return $result;
        });
    }
    public static function GET_Distribution_ICD_Ages($data)
    {
        //dd($data);
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_ICD2 (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:ICD_OP,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':ICD_OP', $data['ICD_OPTN']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_Distribution_ICD_Ages_Total($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_ICD_TOTAL (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:ICD_OP,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':ICD_OP', $data['ICD_OPTN']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_Distribution_MS_D($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_BY_MS (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_DEADS_BY_MS_TOTAL($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_BY_MS_TOTAL (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_ICD_CODE($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_ICD_CODE (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:RESULT_C); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':RESULT_C', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_DEADS_ICD($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_ICD (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:V_ICD_CODE,:RESULT_C); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':V_ICD_CODE', $data['V_ICD_CODE']);
            $stmt->bindParam(':RESULT_C', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_DEADS_REGION_TOTAL2($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_DEADS_REGION_TOTAL2 (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:V_ICD_CODE,:RESULT_C); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':V_ICD_CODE', $data['V_ICD_CODE']);
            $stmt->bindParam(':RESULT_C', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_Scanned_files_rep($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_SCANNED_DEATHS_UP (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:USER_CD,:POINT_CD,:P_START,:P_LIMIT,:RESULT_COUNT,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':USER_CD', $data['USER_CD']);
            $stmt->bindParam(':POINT_CD', $data['POINT_CD']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['length']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT, 11);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            $result['data'] = $array;
            $result['RESULT_COUNT'] = $RESULT_COUNT;
            return $result;
        });
    }
    public static function GET_SCANNED_COUNT_UP($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_SCANNED_COUNT_UP (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:USER_CD,:POINT_CD,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':USER_CD', $data['USER_CD']);
            $stmt->bindParam(':POINT_CD', $data['POINT_CD']);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_GAZA_DREF($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_GAZA_DREF (:HOS_CD,:M_CURS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':HOS_CD', $data['HOS_CD']);
            $stmt->bindParam(':M_CURS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function GET_ALL_POINT()
    {
        $sql = "begin DEAD_INFO_PKG.GET_ALL_POINT (:E_POINT); end;";
        return DB::transaction(function ($conn) use ($sql) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':E_POINT', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }


    public static function GET_Death_updated_rep($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_UPDATED_DEATHS_LIMIT (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:USER_CD,:POINT_CD,:P_START,:P_LIMIT,:RESULT_COUNT,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $RESULT_COUNT = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':USER_CD', $data['USER_CD']);
            $stmt->bindParam(':POINT_CD', $data['POINT_CD']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['length']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT, 11);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            $result['data'] = $array;
            $result['RESULT_COUNT'] = $RESULT_COUNT;
            return $result;
        });
    }

    public static function GET_NotScanned_files_rep($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_NOTSCANNED_DEATHS_UP (:ID,:SEX,:DIAG_FROM,:DIAG_TO,:YEAR_FROM,:YEAR_TO,:DATE_FROM,:DATE_TO,:AGE_FROM,:AGE_TO,:USER_CD,:POINT_CD,:P_START,:P_LIMIT,:RESULT_COUNT,:DEADS); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $data['Dead_ID']);
            $stmt->bindParam(':SEX', $data['Sex']);
            $stmt->bindParam(':DIAG_FROM', $data['Diag_From']);
            $stmt->bindParam(':DIAG_TO', $data['Diag_To']);
            $stmt->bindParam(':YEAR_FROM', $data['Year_From']);
            $stmt->bindParam(':YEAR_TO', $data['Year_To']);
            $stmt->bindParam(':DATE_FROM', $data['Death_date_frm']);
            $stmt->bindParam(':DATE_TO', $data['Death_date_to']);
            $stmt->bindParam(':AGE_FROM', $data['Age_From']);
            $stmt->bindParam(':AGE_TO', $data['Age_To']);
            $stmt->bindParam(':USER_CD', $data['USER_CD']);
            $stmt->bindParam(':POINT_CD', $data['POINT_CD']);
            $stmt->bindParam(':P_START', $data['start']);
            $stmt->bindParam(':P_LIMIT', $data['length']);
            $stmt->bindParam(':RESULT_COUNT', $RESULT_COUNT, PDO::PARAM_INT, 11);
            $stmt->bindParam(':DEADS', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            $result['data'] = $array;
            $result['RESULT_COUNT'] = $RESULT_COUNT;
            return $result;
        });
    }
    public static function ALL_HOS_DREF()
    {
        $sql = "begin DEAD_INFO_PKG.ALL_HOS_DREF (:M_CURS); end;";

        return DB::transaction(function ($conn) use ($sql) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':M_CURS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function ALL_HOS()
    {
        $sql = "begin DEAD_INFO_PKG.ALL_HOS (:M_CURS); end;";

        return DB::transaction(function ($conn) use ($sql) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':M_CURS', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }
    public static function GET_CITY($data)
    {
        $sql = "begin DEAD_INFO_PKG.GET_CITY (:REGION_CD,:RESULT_CUR); end;";
        return DB::transaction(function ($conn) use ($sql, $data) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':REGION_CD', $data['region_cd']);
            $stmt->bindParam(':RESULT_CUR', $lista, PDO::PARAM_STMT);
            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            return $array;
        });
    }

    public static function Get_dead_name($ID_NUM)
    {
        $sql_name = "begin :VAR_D_NAME := DEAD_INFO_PKG.GET_DEAD_NAME(:ID_NUM); end;";

        return DB::transaction(function ($conn) use ($sql_name, $ID_NUM) {

            $VAR_D_NAME = '';
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql_name);
            $stmt->bindParam(':ID_NUM', $ID_NUM, PDO::PARAM_INT, 11);
            $stmt->bindParam(':VAR_D_NAME', $VAR_D_NAME, PDO::PARAM_STR, 200);

            $stmt->execute();
            $data['VAR_D_NAME'] = $VAR_D_NAME;

            return $data;
        });
    }

    public static function ADD_DEAD_SCAN($DEAD_ID, $USER_CD, $IS_SCANNED){
        $sql = "begin DEAD_INFO_PKG.ADD_SCAN_INFO (:P_ID,:P_SCAN_BY,:P_IS_SCANNED); end;";

        return DB::transaction(function ($conn) use ($sql, $DEAD_ID, $USER_CD, $IS_SCANNED) {
            $P_RESULT = 0;
            $P_DEAD_NUMBER = 0;
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':P_ID', $DEAD_ID);
            $stmt->bindParam(':P_SCAN_BY', $USER_CD);
            $stmt->bindParam(':P_IS_SCANNED', $IS_SCANNED);
            $stmt->execute();

        });

    }

}
