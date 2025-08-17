
<?php

use Illuminate\Support\Facades\DB;

if(!function_exists('HeaderMenu'))
{
    function HeaderMenu()
    {
        if(session('permission')){
            return session('permission');
        }
        return [];
    }
}
if(!function_exists('PermissionBtn'))
{
    function IsPermissionBtn($btn_id)
    {
        if(session('permission_btn')){
            if(in_array($btn_id,session('permission_btn'))){
                return true;
            }
        }
        return false;
    }
}

function GET_BORNS_WEIGHT($CODE, $date_F, $date_T)
    {
         //  dd($data);
        $sql = "begin DISTRIBUTION_SEX.GET_BORNS_WEIGHT(:CODE,:DATE_FROM,:DATE_TO,:BORNS); end;";

        return DB::transaction(function ($conn) use ($sql, $CODE, $date_F,$date_T) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':CODE', $CODE);
            $stmt->bindParam(':DATE_FROM', $date_F);
            $stmt->bindParam(':DATE_TO', $date_T);
            $stmt->bindParam(':BORNS', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            //   dd($array);
            return $array;
        });
    }
function GET_BORNS_CLINIC_D($CODE, $date_F, $date_T)
    {
         //  dd($data);
        $sql = "begin DISTRIBUTION_SEX.GET_BORNS_CLINIC_D(:CODE,:DATE_FROM,:DATE_TO,:BORNS); end;";

        return DB::transaction(function ($conn) use ($sql, $CODE, $date_F,$date_T) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':CODE', $CODE);
            $stmt->bindParam(':DATE_FROM', $date_F);
            $stmt->bindParam(':DATE_TO', $date_T);
            $stmt->bindParam(':BORNS', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            //   dd($array);
            return $array;
        });
    }
function GET_BORNS_CLINIC_WITHOUT_D($CODE, $date_F, $date_T)
    {
         //  dd($data);
        $sql = "begin DISTRIBUTION_SEX.GET_BORNS_CLINIC_WITHOUT_D(:CODE,:DATE_FROM,:DATE_TO,:BORNS); end;";

        return DB::transaction(function ($conn) use ($sql, $CODE, $date_F,$date_T) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':CODE', $CODE);
            $stmt->bindParam(':DATE_FROM', $date_F);
            $stmt->bindParam(':DATE_TO', $date_T);
            $stmt->bindParam(':BORNS', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            //   dd($array);
            return $array;
        });
    }
function GET_BORNS_CLINIC_CD($CODE, $date_F, $date_T)
    {
         //  dd($data);
        $sql = "begin DISTRIBUTION_SEX.GET_BORNS_CLINIC_CD(:CODE,:DATE_FROM,:DATE_TO,:BORNS); end;";

        return DB::transaction(function ($conn) use ($sql, $CODE, $date_F,$date_T) {
            $lista = [];
            $pdo = $conn->getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':CODE', $CODE);
            $stmt->bindParam(':DATE_FROM', $date_F);
            $stmt->bindParam(':DATE_TO', $date_T);
            $stmt->bindParam(':BORNS', $lista, PDO::PARAM_STMT);

            $stmt->execute();
            oci_execute($lista, OCI_DEFAULT);
            oci_fetch_all($lista, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
            oci_free_cursor($lista);
            //   dd($array);
            return $array;
        });
    }
