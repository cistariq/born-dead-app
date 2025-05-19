<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\dead\ApplicationController;
use App\Http\Controllers\dead\DashboardController;
use App\Http\Controllers\ConstantController;
use App\Http\Controllers\dead\DeadController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BornController;
use App\Http\Controllers\dead\ImportExcelDeadController;
use App\Http\Controllers\dead\RecipientController;
use App\Http\Controllers\PersonalInfoController;
use App\Http\Controllers\Role\RoleBtnController;
use App\Http\Controllers\Role\RolePageController;
use App\Http\Controllers\ScanfileController;
use App\Http\Controllers\Print_logController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\user\UserController;
use App\Http\Middleware\Authenticate;
use App\Models\CitizenData;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\ICDCodeController;

Route::get('/test',function(){
    $UNIX_DATE = (45293 - 25569) * 86400;
    echo date("d-m-Y", $UNIX_DATE);

//
});

// Route::get('/test-db', function () {
//     try {
//         DB::connection()->getPdo();
//         return "تم الاتصال بقاعدة البيانات بنجاح!";
//     } catch (\Exception $e) {
//         return "خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage();
//     }
// });

Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'login'])->name('login.check');
Route::group(['middleware' => [Authenticate::class]],function(){
    Route::get('/profile',[ProfileController::class, 'index'])->name('profile.index');
    Route::post('/update-password',[ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('/getPersonalInfo', [PersonalInfoController::class, 'getPersonalInfo'])->name('getPersonalInfo');

    Route::post('/check_records', [DeadController::class, 'check_records'])->name('check_records');
    Route::post('/check_record_born', [BornController::class, 'check_record_born'])->name('check_record_born');


    Route::get('/welcome', [DashboardController::class, 'welcome'])->name('welcome');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'dead','as'=>'dead.'], function () {
        //Route::get('/', [DeadController::class, 'index'])->name('index');
        Route::post('/getDataResult', [DeadController::class,'getDataResult'])->name('getDataResult');
        Route::get('/insert_dead', [DeadController::class, 'insert_dead'])->name('insert_dead');
        Route::get('/update_dead/{ID_NO}', [DeadController::class, 'update_dead'])->name('update_dead');
        Route::get('/print_dead_notic/{ID_NO}', [DeadController::class, 'print_dead_notic'])->name('print_dead_notic');
        Route::get('/dead_search', [DeadController::class, 'dead_search'])->name('dead_search');
        Route::post('/getDeadResult', [DeadController::class,'getDeadResult'])->name('getDeadResult');
        Route::get('/export_excel', [DeadController::class, 'export_excel'])->name('export_excel');
        Route::post('/save_dead_info', [DeadController::class, 'save_dead_info'])->name('save_dead_info');
        Route::post('/update_dead_info', [DeadController::class, 'update_dead_info'])->name('update_dead_info');
        Route::post('/getDeadIcd_name', [DeadController::class, 'getDeadIcd_name'])->name('getDeadIcd_name');
        Route::post('/getDeadIcd_id', [DeadController::class, 'getDeadIcd_id'])->name('getDeadIcd_id');
        Route::post('/getDeadIcd_bycode', [DeadController::class, 'getDeadIcd_bycode'])->name('getDeadIcd_bycode');
        Route::post('/getDeadInfoByIdNo', [DeadController::class, 'getDeadInfoByIdNo'])->name('getDeadInfoByIdNo');
        Route::post('/getDeadInfoById', [DeadController::class, 'getDeadInfoById'])->name('getDeadInfoById');
        Route::get('/print_dead_book/{DEAD_NUMBER}', [DeadController::class, 'print_dead_book'])->name('print_dead_book');
        Route::get('/open_dead_book/{DEAD_ID}', [DeadController::class, 'open_dead_book'])->name('open_dead_book');
        Route::post('/update_crt_dead', [DeadController::class, 'update_crt_dead'])->name('update_crt_dead');
        Route::post('/getDeadInfoByCodeNo', [DeadController::class, 'getDeadInfoByCodeNo'])->name('getDeadInfoByCodeNo');
        Route::post('/check_is_found', [DeadController::class, 'check_is_found'])->name('check_is_found');
        Route::post('/get_city', [DeadController::class, 'get_city'])->name('get_city');
        Route::post('/print_crt_dead', [DeadController::class, 'print_crt_dead'])->name('print_crt_dead');
        Route::post('/print_missing_form', [DeadController::class, 'print_missing_form'])->name('print_missing_form');
        Route::post('/check_records', [DeadController::class, 'check_records'])->name('check_records');
        Route::post('/print_dead', [DeadController::class, 'print_dead'])->name('print_dead');
        Route::post('/update', [DeadController::class, 'update'])->name('update');
        Route::post('/get_person_query', [DeadController::class, 'get_person_query'])->name('get_person_query');
        Route::post('/Get_dead_name', [DeadController::class, 'Get_dead_name'])->name('Get_dead_name');
        Route::post('/open_crt_dead', [DeadController::class, 'open_crt_dead'])->name('open_crt_dead');
        Route::get('/file_pdf', [DeadController::class, 'file_pdf'])->name('file_pdf');
        Route::post('/get_helth_center', [DeadController::class, 'get_helth_center'])->name('get_helth_center');
        Route::post('/get_hos_by_place', [DeadController::class, 'get_hos_by_place'])->name('get_hos_by_place');


    });


    Route::group(['prefix' => 'Report','as'=>'Report.'], function () {
            Route::get('/',[ReportController::class,'index'])->name('index');
            Route::get('/Distribution_Death_Place',[ReportController::class,'Distribution_Death_Place'])->name('Distribution_Death_Place');
            Route::get('/Distribution_Region_Ages',[ReportController::class,'Distribution_Region_Ages'])->name('Distribution_Region_Ages');
            Route::get('/GET_Distribution_Death_Place_Kids',[ReportController::class,'GET_Distribution_Death_Place_Kids'])->name('GET_Distribution_Death_Place_Kids');
            Route::get('/GET_Distribution_Region_Kids',[ReportController::class,'GET_Distribution_Region_Kids'])->name('GET_Distribution_Region_Kids');
            Route::get('/GET_Distribution_Region_Ages1',[ReportController::class,'GET_Distribution_Region_Ages1'])->name('GET_Distribution_Region_Ages1');
            Route::get('/GET_Distribution_Region_Ages2',[ReportController::class,'GET_Distribution_Region_Ages2'])->name('GET_Distribution_Region_Ages2');
            Route::get('/GET_Distribution_Death_Hosp',[ReportController::class,'GET_Distribution_Death_Hosp'])->name('GET_Distribution_Death_Hosp');
            Route::get('/GET_Distribution_Region_Ages3',[ReportController::class,'GET_Distribution_Region_Ages3'])->name('GET_Distribution_Region_Ages3');
            Route::get('/GET_Distribution_Death_Hos_Kids',[ReportController::class,'GET_Distribution_Death_Hos_Kids'])->name('GET_Distribution_Death_Hos_Kids');
            Route::get('/GET_Distribution_sex_D',[ReportController::class,'GET_Distribution_sex_D'])->name('GET_Distribution_sex_D');
            Route::get('/GET_Daily_Dead_Rep_2',[ReportController::class,'GET_Daily_Dead_Rep_2'])->name('GET_Daily_Dead_Rep_2');
            Route::get('/GET_Daily_Report_D',[ReportController::class,'GET_Daily_Report_D'])->name('GET_Daily_Report_D');
            Route::post('/Get_Daily_Dead_Rep_D',[ReportController::class,'Get_Daily_Dead_Rep_D'])->name('Get_Daily_Dead_Rep_D');

            Route::get('/GET_Distribution_Diagnosis',[ReportController::class,'GET_Distribution_Diagnosis'])->name('GET_Distribution_Diagnosis');
            Route::get('/GET_Deads_non_Diagnosable',[ReportController::class,'GET_Deads_non_Diagnosable'])->name('GET_Deads_non_Diagnosable');
            Route::post('/GET_Deads_non_Diagnosable_all',[ReportController::class,'GET_Deads_non_Diagnosable_all'])->name('GET_Deads_non_Diagnosable_all');
            Route::get('/GET_Total_In_Diagnosis',[ReportController::class,'GET_Total_In_Diagnosis'])->name('GET_Total_In_Diagnosis');
            Route::get('/GET_Unknown_Region_Deaths',[ReportController::class,'GET_Unknown_Region_Deaths'])->name('GET_Unknown_Region_Deaths');
            Route::post('/GET_Unknown_Region_Deaths_ALL',[ReportController::class,'GET_Unknown_Region_Deaths_ALL'])->name('GET_Unknown_Region_Deaths_ALL');
            Route::get('/GET_Distribution_ICD_Ages',[ReportController::class,'GET_Distribution_ICD_Ages'])->name('GET_Distribution_ICD_Ages');
            Route::get('/GET_Distribution_MS_D',[ReportController::class,'GET_Distribution_MS_D'])->name('GET_Distribution_MS_D');
            Route::get('/GET_Distribution_ICD_Ages_sample2',[ReportController::class,'GET_Distribution_ICD_Ages_sample2'])->name('GET_Distribution_ICD_Ages_sample2');
            Route::get('/GET_Scanned_files_rep',[ReportController::class,'GET_Scanned_files_rep'])->name('GET_Scanned_files_rep');
            Route::post('/get_scanned_file_rep',[ReportController::class,'get_scanned_file_rep'])->name('get_scanned_file_rep');
            Route::post('/get_updated_file_rep',[ReportController::class,'get_updated_file_rep'])->name('get_updated_file_rep');
            Route::get('/GET_Death_updated_rep',[ReportController::class,'GET_Death_updated_rep'])->name('GET_Death_updated_rep');
            Route::get('/GET_NotScanned_files_rep',[ReportController::class,'GET_NotScanned_files_rep'])->name('GET_NotScanned_files_rep');
            Route::get('/Icd_Search',[ReportController::class,'Icd_Search'])->name('Icd_Search');
            Route::post('/get_unscanned_file_rep',[ReportController::class,'get_unscanned_file_rep'])->name('get_unscanned_file_rep');

            Route::get('/Daily_Born',[ReportController::class,'Daily_Born'])->name('Daily_Born');
            Route::get('/Daily_Report_Birth_Place',[ReportController::class,'Daily_Report_Birth_Place'])->name('Daily_Report_Birth_Place');
            Route::get('/Daily_Born_Delivery',[ReportController::class,'Daily_Born_Delivery'])->name('Daily_Born_Delivery');
            Route::get('/Daily_Born_Print',[ReportController::class,'Daily_Born_Print'])->name('Daily_Born_Print');
            Route::post('/get_Daily_Born',[ReportController::class,'get_Daily_Born'])->name('get_Daily_Born');
            Route::post('/Daily_Born_Delivery_Print',[ReportController::class,'Daily_Born_Delivery_Print'])->name('Daily_Born_Delivery_Print');
            Route::post('/Get_Daily_Dead_Result',[ReportController::class,'Get_Daily_Dead_Result'])->name('Get_Daily_Dead_Result');


    });


        Route::group(['prefix' => 'constant','as'=>'constant.'], function () {
            Route::get('/', [ConstantController::class, 'index'])->name('index');
            Route::post('/getPersonalInfoByIdNo', [ConstantController::class, 'getPersonalInfoByIdNo'])->name('getPersonalInfoByIdNo');
            Route::post('/getPersonalInfoByName', [ConstantController::class, 'getPersonalInfoByName'])->name('getPersonalInfoByName');
            Route::post('/getPersonalNameByIdNo', [ConstantController::class, 'getPersonalNameByIdNo'])->name('getPersonalNameByIdNo');
            Route::post('/getConstantDtl',[ConstantController::class,'getConstantDtl'])->name('get_constant_dtl');
        });

        Route::group(['prefix' => 'users','as'=>'user.'], function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/insert_user', [UserController::class, 'insert_user'])->name('insert_user');
            Route::post('/update', [UserController::class, 'update'])->name('update');
            Route::post('/update_password', [UserController::class, 'update_password'])->name('update_password');
        });
        Route::group(['prefix' => 'personl-info','as'=>'personl_info.'], function () {
            Route::get('/', [PersonalInfoController::class, 'index'])->name('index');
        });

        Route::group(['prefix' => 'roles','as'=>'roles.'], function () {
            Route::get('/', [RolePageController::class, 'index'])->name('index');
            Route::post('/store', [RolePageController::class, 'store'])->name('store');
            Route::get('/page-user', [RolePageController::class, 'page_user'])->name('page_user');
            Route::post('/getUserPageByUserId', [RolePageController::class, 'getUserPageByUserId'])->name('getUserPageByUserId');
            Route::post('/changeRolePageToUser', [RolePageController::class, 'changeRolePageToUser'])->name('changeRolePageToUser');
        });
        Route::group(['prefix' => 'roles-btn','as'=>'roles_btn.'], function () {
            Route::get('/', [RoleBtnController::class, 'index'])->name('index');
            Route::post('/store', [RoleBtnController::class, 'store'])->name('store');
            Route::post('/getUserBtnByUserId', [RoleBtnController::class, 'getUserBtnByUserId'])->name('getUserBtnByUserId');
            Route::post('/changeRoleBtnToUser', [RoleBtnController::class, 'changeRoleBtnToUser'])->name('changeRoleBtnToUser');
        });
        Route::get('/getConstantByParent', [ConstantController::class, 'getConstantByParent'])->name('getConstantByParent');

        Route::group(['prefix' => 'scan-file','as'=>'scan_file.'], function () {
            Route::get('/', [ScanfileController::class, 'index'])->name('index');
            Route::get('/multi-upload', [ScanfileController::class, 'multiUpload'])->name('multi_upload');

            Route::post('/getscanResult', [ScanfileController::class,'getscanResult'])->name('getscanResult');
            Route::post('/storefile', [ScanfileController::class, 'storefile'])->name('storefile');
            Route::post('/store-multi-file', [ScanfileController::class, 'storeMultiFile'])->name('store_multi_file');
            Route::get('/downloadFile', [ScanfileController::class, 'downloadFile'])->name('downloadFile');
            Route::post('/delete-file', [ScanfileController::class, 'deleteFile'])->name('deleteFile');




        });

        Route::group(['prefix' => 'scan','as'=>'scan.'], function () {

            Route::get('/scan_death_file', [ScanfileController::class, 'scan_death_file'])->name('scan_death_file');
            Route::post('/upload', [ScanfileController::class, 'upload'])->name('upload');
            Route::post('/savetofile', [ScanfileController::class, 'savetofile'])->name('savetofile');




        });
        Route::group(['prefix' => 'born','as'=>'born.'], function () {
            Route::get('/', [BornController::class, 'add_born'])->name('add_born');
            Route::get('/new_born_search', [BornController::class, 'new_born_search'])->name('new_born_search');
            Route::get('/born_search', [BornController::class, 'born_search'])->name('born_search');
            Route::post('/getBornResult', [BornController::class,'getBornResult'])->name('getBornResult');
            Route::post('/getBornInfo', [BornController::class,'getBornInfo'])->name('getBornInfo');
            Route::post('/is_born_found', [BornController::class,'is_born_found'])->name('is_born_found');
            Route::post('/getBornInfoByNo', [BornController::class,'getBornInfoByNo'])->name('getBornInfoByNo');
            Route::post('/getBornInfoByCode', [BornController::class,'getBornInfoByCode'])->name('getBornInfoByCode');
            Route::post('/getBornInfoByCodeNo', [BornController::class,'getBornInfoByCodeNo'])->name('getBornInfoByCodeNo');
            Route::post('/update_born_info', [BornController::class, 'update_born_info'])->name('update_born_info');

            Route::get('/export_excel', [BornController::class, 'export_excel'])->name('export_excel');
            Route::get('/born_export_excel', [BornController::class, 'born_export_excel'])->name('born_export_excel');
            Route::post('/save_born_info', [BornController::class, 'save_born_info'])->name('save_born_info');
            Route::post('/getFatherInfoByIdNo', [BornController::class, 'getFatherInfoByIdNo'])->name('getFatherInfoByIdNo');
            Route::post('/getMotherInfoByIdNo', [BornController::class, 'getMotherInfoByIdNo'])->name('getMotherInfoByIdNo');
            Route::post('/ADD_BORN_FATHER_DATA', [BornController::class, 'ADD_BORN_FATHER_DATA'])->name('ADD_BORN_FATHER_DATA');
            Route::post('/update_father_info', [BornController::class, 'update_father_info'])->name('update_father_info');
            Route::post('/update_mother_info', [BornController::class, 'update_mother_info'])->name('update_mother_info');
            Route::post('/ADD_BORN_MOTHER_DATA', [BornController::class, 'ADD_BORN_MOTHER_DATA'])->name('ADD_BORN_MOTHER_DATA');
            Route::post('/save_born_details_info', [BornController::class, 'save_born_details_info'])->name('save_born_details_info');
            Route::get('/insert_new_born', [BornController::class, 'insert_new_born'])->name('insert_new_born');
            Route::get('/GET_BORNS_DATE', [BornController::class, 'GET_BORNS_DATE'])->name('GET_BORNS_DATE');
            Route::get('/getBorn_Code', [BornController::class, 'getBorn_Code'])->name('getBorn_Code');
            Route::get('/update_born/{ID_NO}', [BornController::class, 'update_born'])->name('update_born');
            Route::get('/Daily_Form', [BornController::class, 'Daily_Form'])->name('Daily_Form');
            Route::post('/check_born_id', [BornController::class,'check_born_id'])->name('check_born_id');
            Route::post('/check_born_date', [BornController::class,'check_born_date'])->name('check_born_date');
            Route::post('/check_born_count', [BornController::class,'check_born_count'])->name('check_born_count');
            Route::get('/add_new_born', [BornController::class,'add_new_born'])->name('add_new_born');
            Route::post('/check_record_born', [BornController::class, 'check_record_born'])->name('check_record_born');

            Route::post('/save_all_born_info', [BornController::class, 'save_all_born_info'])->name('save_all_born_info');




        });

        Route::group(['prefix' => 'print-logs','as'=>'print_logs.'], function () {
            Route::get('/', [Print_logController::class, 'index'])->name('index');
            Route::post('/getprintResult', [Print_logController::class,'getprintResult'])->name('getprintResult');

        });

});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/icd-codes', [ICDCodeController::class, 'index'])->name('icd.index');
Route::get('/icd-codes/children/{id}', [ICDCodeController::class, 'fetchChildren'])->name('icd.fetchChildren');






