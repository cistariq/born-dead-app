<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Log;
use App\Models\PrintLog;
use Illuminate\Validation\Rule;
use App\Models\DEADS_TB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ScanfileController extends Controller
{
    public function index()
    {
        return view('scan.index');
    }
    public function multiUpload()
    {
        return view('scan.multi_upload');
    }
    public function scan_death_file()
    {
        $result['USER_CODE'] = Auth()->id();

        return view('scan.scan_death_file',$result);
    }

    public function downloadFile()
    {

        if (Storage::disk('public')->exists('attachment/400008371_old_1719738270.jpg')) {
            //Storage::disk('public')->delete('attachment/400008371.jpg');
            $new_path ='attachment/400008371_old_'.time().'.jpg';
            Storage::disk('public')->move('attachment/400008371_old_1719738270.jpg',$new_path);
            dd($new_path);
        }
        dd(1);
    }


    public function storefile(Request $request)
    {
        $role = [
            'ID_NO' => 'required|numeric|digits:9|exists:print_logs,id_no|unique:attachments,id_no,'.$request->ID_NO,
            'image' => 'required|mimes:pdf|max:7168',
        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            )); // 400 being the HTTP code for an invalid request.
        }
        if ($request->hasFile('image')){
            $file=$request->file('image');
            $file_name = $request->ID_NO.'.'.$file->getClientOriginalExtension();

            $path=$file->storeAs('attachment',$file_name,[
                               'disk'=>'public'
            ]);
            $data['path']=$path;
            $data['id_no']=$request->ID_NO;
            $data['type']=$file->getClientOriginalExtension();
            $data['name']=$file->getClientOriginalName();
            $data['user_id']= Auth()->id();
            $attachment = Attachment::create($data);
            return Response::json(array('success' => true,'results'=>['message' => 'تمت عملية الإدخال بنجاح']));
        }

    }
    public function getscanResult(Request $request)
    {
        $role = [
            'P_ID' => 'numeric|digits:9|nullable',
            'P_FROM_DATE' => 'nullable:date',
            'P_TO_DATE' => 'nullable:date',

        ];
        $data = $request->validate($role);
        $query = Attachment::has('citizen');
        $check = false;

        if($data['P_ID'] != null){
            $query->where('id_no',$data['P_ID']);
            $check = true;
        }
        if($data['P_FROM_DATE'] != null && $data['P_TO_DATE'] != null){
            $query->wheredate('attachments.created_at','>=',$data['P_FROM_DATE']);
            $query->wheredate('attachments.created_at','<=',$data['P_TO_DATE']);
            $check = true;
        }
        if($check){
            $data_res = $query->get();

        }else{
            $data_res = [];
        }
        $result['data'] = [];
        if($data_res){
            foreach ($data_res as $key =>$value) {

                $action='';
                if(IsPermissionBtn(14)){
                    $action.='<button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-3"
                        onclick="delete_file('.$value->id_no.')">
                        <i class="fonticon-trash-bin fs-3"></i>
                    </button>' ;
                }
                if(IsPermissionBtn(12)){
                    $action.='<a class="accordion-toggle accordion-toggle-styled" href= '."project/storage/app/public/".$value->path.' target="_blank" > فتح المرفق </a>' ;
                }

                $result['data'][] = array(
                    $key+1,
                    $value->id_no,
                    $value->citizen->FIRST_NAME.' '.$value->citizen->FASTHER_NAME.' '.$value->citizen->GRAND_FATHER_NAME.' '.$value->citizen->FAMILY_NAME,
                    $value->created_at->toDateTimeString(),
                    $action
            );
            }
        }
        echo json_encode($result);
    }
    public function storeMultiFile(Request $request)
    {
        $role = [
            'file' => 'required|mimes:pdf|max:7168',
        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => implode('-',$validator->errors()->all())

            )); // 400 being the HTTP code for an invalid request.
        }
        try {
            if ($request->hasFile('file')){
                $file=$request->file('file');
                if(strlen($file->getClientOriginalName()) > 8){
                    $name = substr($file->getClientOriginalName(),0,9);
                    if(is_numeric($name)){
                        $attachment = Attachment::where('id_no',$name)->first();
                        if($attachment){
                            return Response::json(array('success' => false,'errors'=>'المرفق مدخل مسبقاً'));
                        }
                        $print_log = PrintLog::where('id_no',$name)->first();
                        if(!$print_log){
                            return Response::json(array('success' => false,'errors'=>'الهوية غير موجودة في جدول الشهداء'));
                        }
                        $file_name = $name.'.'.$file->getClientOriginalExtension();

                        $path=$file->storeAs('attachment',$file_name,[
                            'disk'=>'public'
                         ]);
                        $data['path']= $path;
                        $data['id_no']= $name;
                        $data['type']= $file->getClientOriginalExtension();
                        $data['name']= $file->getClientOriginalName();
                        $data['user_id']= Auth()->id();
                        Attachment::create($data);
                        return Response::json(array('success' => true,'results'=>'تمت عملية الحفظ بنجاح'));
                    }else{
                        return Response::json(array('success' => false,'errors'=>'غير اسم الملف لرقم هوية صحيح'));
                    }

                }else{
                    return Response::json(array('success' => false,'errors'=>'غير اسم الملف لرقم هوية صحيح'));
                }
            }

        }catch (\Exception $exception){
            return Response::json(array('success' => false,'errors'=> $exception.'يوجد خطأ في عملية الإدخال'));
        }
    }
    public function deleteFile(Request $request)
    {
        $role = [
            'id_no' => 'required|numeric|digits:9|exists:attachments,id_no',
        ];

        $validator = Validator::make($request->all(), $role);
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => implode('-',$validator->errors()->all())

            )); // 400 being the HTTP code for an invalid request.
        }
        try {
            DB::beginTransaction();
            $attachment = Attachment::where('id_no',$request->id_no)->first();
            $new_path = '';
            if (Storage::disk('public')->exists($attachment->path)) {
                $new_path = 'attachment/'.$request->id_no.'_old_'.time().strstr($attachment->path,'.', false);
                Storage::disk('public')->move($attachment->path,$new_path);
            }
            $data['user_id'] = Auth()->id();
            $data['ip'] = request()->ip();
            $data['id_no'] = $attachment->id_no;
            $data['table_name'] = 'attachments';
            $data['column_name'] = 'id_no';
            $data['old_value'] = $attachment->path;
            $data['new_value'] = $new_path;
            $data['old_record'] = $attachment;
            $data['type_action'] = 'D';
            Log::create($data);
            $attachment->delete();

        }catch (\Exception $exception){
            DB::rollBack();
            return Response::json(array('success' => false,'errors'=> $exception.'يوجد خطأ في عملية الحذف'));
        }
        DB::commit();
        return Response::json(array('success' => true,'results'=>'تمت عملية الحذف بنجاح '));
    }

    public function upload(Request $request){

        $image = $request->file('image');
        $filename= date('YmdHi').$image->getClientOriginalName();


        //$image_Path = Storage::disk('public')->putFile('images', $image);
        //$fullUrl = "http://localhost:8000/storage/$image_Path";

        $fullUrl = "http://localhost/images/$filename";


        $image-> move(public_path('images'), $filename);

        $ocr = new TesseractOCR(public_path("images/$filename"));
        //$ocr->lang('fr','ara');
        $ocr->lang('fra' , 'eng' , 'ara');
        $text = $ocr->run();

        return redirect()->back()->with([
           "fullUrl"=>$fullUrl,
           "text"=>$text
           ]);




       }


       public function savetofile()
       {
        $fileTempName = $_FILES['RemoteFile']['tmp_name'];
  $fileSize = $_FILES['RemoteFile']['size'];
//  $fileName = "uploadedimages\\".$_FILES['RemoteFile']['name'];//WINDOWS
//$fileName = "uploadedimages/".$_FILES['RemoteFile']['name'];// LINUX TO SERVER
$name=array();
$name=explode("_",$_FILES['RemoteFile']['name']);
//dd($_FILES['RemoteFile']);

$fileName =Storage::path('uploaded_files/'.$name[1]);
//$fileName = public_path("uploaded_files/").$name[1];// LINUX TO SERVER
$DEAD_ID=substr($name[1],0,strlen($name[1])-4);
$user_cd=$name[0];
//dd($user_cd);

   if (!file_exists($fileName)) {



        $fWriteHandle = fopen($fileName, 'w');
        $fReadHandle = fopen($fileTempName, 'rb');
        $fileContent = fread($fReadHandle, $fileSize);
        fwrite($fWriteHandle, $fileContent);
        fclose($fWriteHandle);

        DEADS_TB::ADD_DEAD_SCAN($DEAD_ID, $user_cd, 1);
  }

       }

}
