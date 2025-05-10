<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اشعار وفاة</title>



    <style>
        /* @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500&display=swap'); */


        body,
    td {
        font-family: Tajawal, Poppins, Helvetica, sans-serif;
    }

        @media print {
            @page {
                margin-top: 10px;
                margin-bottom: 10px;
            }
        }

        .text-center {
            text-align: center;
        }

        .datatable {
            border: 1px solid;
            border-collapse: collapse;
            padding: 3px;
            border-color: #C0C0C0;
            font: normal small sans-serif;
        }

        .datatableheder {
            background-color: #eee;
            text-align: center;
            font-weight: bold;
            height: 30px;
            color: #000;
            font-size: 14px;
        }

        tr {
            padding: 10px 0;
            line-height: 19px;
        }
    </style>
</head>

<body>

    <tr style="margin-bottom: 5px;">
        <td width="18%">
            <table width="100%" border="0" dir="rtl">
                <tr>
                    <td width="35%" align="center" valign="middle" style="font-weight:bold">دولة فلسطين</td>

                    <td width="30%" rowspan="4" align="center" valign="middle">
                        <div id="rlogo">
                            <p> <img src="{{ asset('assets/media/logos/logo_new.png') }}"
                                width="70" height="70"></p>


                        </div>
                    </td>
                    <td width="35%" align="center" valign="middle" style="font-weight:bold">تبليغ عن وفاة
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="font-weight:bold">وزارة الداخلية</td>
                    <td align="center" valign="middle" style="font-weight:bold">(نسخة وزارة الداخلية)</td>

                </tr>

                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </td>
    </tr>



    <div>
        <table style="font-family: 'Tajawal'" class="datatable" width="100%" border="1" dir="rtl"
            cellpadding="0">
            <tr style="background-color:#eee ">
                <td style="text-align: center; font-weight:bold" colspan="5">
                    @if(isset($data[0]['SOURCE'])  && $data[0]['SOURCE'] == 1)
                    بيانات المتوفي (شهيد)
                @else
                    بيانات المتوفي
                @endif

                </td>
            </tr>
            <tr>
                <td colspan="3">الاسم رباعي للمتوفي/ة:
                    {{ $data[0]['DEAD_FIRST_NAME_AR'] . ' ' . $data[0]['DEAD_FATHER_NAME_AR'] . ' ' . $data[0]['DEAD_GRANDFATHER_NAME_AR'] . ' ' . $data[0]['DEAD_LAST_NAME_AR'] }}
                </td>
                <td colspan="2">رقم هوية المتوفي/ة : <?php echo $data[0]['DEAD_ID']; ?></td>
            </tr>
            <tr>
                <td colspan="5">تاريخ الميلاد: {{ date('d/m/Y', strtotime($data[0]['DEAD_DOB'])) }}  (اذا كان المتوفى طفلاً عاش أقل من 24 ساعة اذكر عدد
                    ساعات الحياة) </td>
            </tr>
            <tr>
                <td colspan="2">الجنس:  {{ $data[0]['SEX_NAME_AR'] }}</td>
                <td colspan="3">الحالة الاجتماعية: {{ $data[0]['MS_NAME_AR'] }}</td>

            </tr>
            <tr>
                <td colspan="2">مكان الولادة: المحافظة:  {{ $data[0]['DEAD_D_BIRTH_PLACE'] }}</td>

                <td colspan="3">الديانة: {{ $data[0]['RE_NAME_AR'] }}</td>

            </tr>

            <tr>
                <td width="20%">المهنة : {{ $data[0]['JOB_NAME_AR'] }} </td>
                <td width="20%">الجنسية:  {{ $data[0]['DEATH_NATIONALITY'] }}</td>
                <td width="20%">مكان الاقامة : {{ $data[0]['CITY'] }}</td>

                <td width="20%">المحافظة: {{ $data[0]['REGION'] }}</td>
                <td width="20%">الدولة : </td>
            </tr>

            <tr>
                <td colspan="2">تاريخ الوفاة* : {{ date('d/m/Y', strtotime($data[0]['DEAD_DOD'])) }}</td>
                <td colspan="3">وقت الوفاة: {{ date('H:i', strtotime($data[0]['DEAD_DOD'])) }}</td>

            </tr>

            <tr>
                <td width="20%">مكان الوفاة : {{ $data[0]['PLACE_NAME_AR'] }}</td>
                <td width="20%">المستشفى: {{ $data[0]['DEATH_PLACE'] }}</td>
                <td width="20%">مكان الاقامة، التجمع السكاني: {{ $data[0]['DEATH_CITY'] }}</td>
                <td width="20%">المحافظة: {{ $data[0]['DEATH_REGION'] }}</td>
                <td width="20%">الدولة: {{ $data[0]['DEAD_DEATH_COUNTRY'] }}</td>

            </tr>

            <tr>
                <td colspan="2">مكان الدفن : {{ $data[0]['DEAD_D_BURIAL_PLACE'] }} </td>
                <td colspan="3">رقم تصريح الدفن : {{ $data[0]['DEAD_D_BURIAL_CODE'] ? $data[0]['DEAD_D_BURIAL_CODE'] : '' }} </td>
            </tr>





        </table>
    </div>
    <div>
        <table style="font-family: 'Tajawal'" class="datatable" width="100%" border="1" dir="rtl"
            cellpadding="0">

            <tr style="background-color:#eee ">
                <td style="text-align: center; font-weight:bold" colspan="2">تفاصيل الزوج/ الزوجة</td>
            </tr>

            <tr>
                <td width="50%" colspan="1">اسم الزوج/الزوجة رباعي: {{ $data[0]['DEAD_D_PARTNER_NAME'] }}</td>
                <td width="50%" colspan="1">رقم الهوية : <?php echo $data[0]['DEAD_D_PARTNER_ID']; ?> {{ $data[0]['DEAD_D_PARTNER_ID'] ? $data[0]['DEAD_D_PARTNER_ID'] : '' }}</td>
            </tr>

        </table>
    </div>
    <div>
        <table style="font-family: 'Tajawal'" class="datatable" width="100%" border="1" dir="rtl"
            cellpadding="0">
            <tr style="background-color:#eee ">
                <td style="text-align: center; font-weight:bold" colspan="4">أسباب الوفاة (تستوفي من الطبيب المعالج
                    للوفاة)</td>
            </tr>
            <tr>
                <td width="25%" colspan="1">سبب الوفاة</td>
                <td width="50%" colspan="1">التشخيض</td>
                <td width="12%" colspan="1">فترة المرض</td>
                <td width="13%" colspan="1">ICD 10</td>
            </tr>
            <tr>
                <td>السبب المباشر للوفاة</td>
                <td colspan="1">{{ $data[0]['DEAD_ICD1_NAME'] }}</td>
                <td colspan="1"></td>
                <td colspan="1">{{ $data[0]['DEAD_ICD1_CODE'] }}</td>

            </tr>
            <tr>
                <td>نتيجة من</td>
                <td colspan="1">{{ $data[0]['DEAD_ICD2_NAME'] }}</td>
                <td colspan="1"></td>
                <td colspan="1">{{ $data[0]['DEAD_ICD2_CODE'] }}</td>
            </tr>
            <tr>
                <td>نتيجة من</td>
                <td colspan="1">{{ $data[0]['DEAD_ICD3_NAME'] }}</td>
                <td colspan="1"></td>
                <td colspan="1">{{ $data[0]['DEAD_ICD3_CODE'] }}</td>
            </tr>
            <tr>
                <td>نتيجة من المرض الأصلي</td>
                <td colspan="1">{{ $data[0]['DEAD_ICD4_NAME'] }}</td>
                <td colspan="1"></td>
                <td colspan="1">{{ $data[0]['DEAD_ICD4_CODE'] }}</td>
            </tr>

            <tr>
                <td>أمراض أخرى: </td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>

            </tr>

            <tr>
                <td width="90%" colspan="4">إذا كان المتوفى امراة في سن الانجاب (15-49) سنة هل كانت حاملاً أو
                    اجهضت أو وضعت قبل وفاتها؟ {{ $data[0]['DEAD_D_PREGNANCY_CD'] ?? '' }}
                    <br /> إذا نعم، الرجاء ذكر عدد الأسابيع {{ $data[0]['DEAD_D_GESTATIONAL_WEEK'] ?? '0' }} هل توفيت
                    خلال 42 يوماً ما بعد الولادة {{ $data[0]['DEAD_D_AFTER_DELIVERY_CD'] ?? '' }}
                </td>

            </tr>

        </table>
    </div>

    <div>
        <table style="font-family: 'Tajawal'" class="datatable" width="100%" border="1" dir="rtl"
            cellpadding="0">
            @if(($data[0]['SOURCE']==2) || ($data[0]['SOURCE']==1))
            <tr style="background-color:#eee ">
                <td style="text-align: center; font-weight:bold" colspan="4">افادة اللجنة</td>
            </tr>

            <tr>
                <td colspan="3" width="90%">
                تشهد لجنة الوفيات ب {{ $data[0]['HOS_NAME'] ? $data[0]['HOS_NAME'] : '' }} ان الوفاة وقعت بتاريخ {{ $data[0]['DEAD_DOD'] ? date('d/m/Y', strtotime($data[0]['DEAD_DOD'])) : '' }} حسب الوثائق والاوراق التي عاينتها اللجنة
            </td>
                <td align="center" rowspan="5" width="10%">ختم المستشفى
                    <br />

                    <br />
                    طبيب اللجنة

                </td>
            </tr>
            <tr>

                <td colspan="3" width="90%">
                {{ $data[0]['COMMITTE_OPINION'] ? " سبب التعديل :" . $data[0]['COMMITTE_OPINION'] : '' }}
            </td>

            </tr>
            @else
            <tr style="background-color:#eee ">
                <td style="text-align: center; font-weight:bold" colspan="4">افادة الطبيب</td>
            </tr>

            <tr>
                <td colspan="3" width="90%">
                    أشهد بأني عالجت المتوفي المذكور أعلاه منذ
                    <span>{{ $data[0]['DEAD_D_TREATMENT_DATE'] ? date('d/m/Y', strtotime($data[0]['DEAD_D_TREATMENT_DATE'])) : '' }}   </span> وأني
                    قد رأيت المتوفي على قيد الحياة لاخر مرة بتاريخ
                    <span>{{ $data[0]['DEAD_D_PREVIEW_DATE'] ?  date('d/m/Y', strtotime($data[0]['DEAD_D_PREVIEW_DATE'])) : '' }} </span> وان
                    الوفاة وقعت بتاريخ <span>{{ $data[0]['DEAD_DOD'] ? date('d/m/Y', strtotime($data[0]['DEAD_DOD'])) : '' }}</span>
                    وانني رأيت الجثة بتاريخ
                    <span>{{ $data[0]['DEAD_D_SEEING_CORPSE_DATE'] ? date('d/m/Y', strtotime($data[0]['DEAD_D_SEEING_CORPSE_DATE'])) : '' }}</span>

                </td>
                <td align="center" rowspan="5" width="10%">ختم المستشفى
                    <br />
                    {{-- {!! $image !!} --}}
                    <br />
                    ختم الطبيب

                </td>
            </tr>
            @endif
            <tr>
                <td colspan="3">جرى تشريح الجثة:
                    {{ $data[0]['DEAD_D_CORPSE_DISSECTION_NAME'] ? $data[0]['DEAD_D_CORPSE_DISSECTION_NAME'] : '' }}</td>


            </tr>

            <tr>
                <td colspan="3">
                    أشهد حسب معرفتي الشخصية بأن كافة التفاصيل المبنية أعلاه مضبوطة وصحيحة
                </td>
            </tr>

            <tr>
                <td colspan="1">اسم الطبيب :
                    {{ $data[0]['DEAD_REPORT_DOC_BY'] ? $data[0]['DEAD_REPORT_DOC_BY'] : '' }} </td>
                <td colspan="1">التخصص:
                    {{ $data[0]['DEAD_D_DOC_SPECIALIST'] ? $data[0]['DEAD_D_DOC_SPECIALIST'] : '' }}</td>
                <td colspan="1">العنوان: {{ $data[0]['DEAD_D_DOC_ADDRESS'] ? $data[0]['DEAD_D_DOC_ADDRESS'] : '' }}
                </td>
            </tr>
            <tr>
                <td colspan="1">توقيع الطبيب :</td>
                <td colspan="2">التاريخ: {{ date('d/m/Y') }} </td>
            </tr>
        </table>
    </div>


    <div>
        <table style="font-family: 'Tajawal'" class="datatable" width="100%" border="1" dir="rtl"
            cellpadding="0">
            <tr style="background-color:#eee ">
                <td colspan="2" style="text-align: center; font-weight:bold">لاستخدام مديرية الصحة</td>
            </tr>

            <tr>
                <td width="90%">
                    تشهد مديرية الصحة بان الطبيب استوفى البيانات اعلاه هو طبيب مسجل في وزارة الصحة وموهل لاصدار هذا
                    التبليغ
                </td>
                <td align="center" width="10%">ختم مديرية الصحة</td>
            </tr>
            </tr>
        </table>
    </div>

    <div>
        <table style="font-family: 'Tajawal'" class="datatable" width="100%" border="1" dir="rtl"
            cellpadding="0">
            <tr style="background-color:#eee ">
                <td style="text-align: center; font-weight:bold" colspan="5">بينانات المبلغ</td>
            </tr>

            <tr>
                <td colspan="2">اسم مقدم التبليغ رباعي : {{ $data[0]['DEAD_REPORT_SUBMITTED_BY'] }}</td>
                <td colspan="3">رقم الهوية :
                    {{ $data[0]['DEAD_REPORT_SUBMITTED_ID'] ? $data[0]['DEAD_REPORT_SUBMITTED_ID'] : '' }}</td>
            </tr>

            <tr>
                <td colspan="1">الجنس :{{ $data[0]['REPORTER_SEX_NAME_AR'] ?? '' }}</td>
                <td colspan="1">الجنسية: {{ $data[0]['REPORTED_NATIONALITY'] ? $data[0]['REPORTED_NATIONALITY'] : '' }}</td>

                <td colspan="3">صلة القرابة: {{ $data[0]['DEAD_D_RELATIONSHIP'] ? $data[0]['DEAD_D_RELATIONSHIP'] : '' }}</td>

            </tr>

            <tr>
                <td>العنوان: {{ $data[0]['DEAD_D_REPORTER_ADDRESS'] ? $data[0]['DEAD_D_REPORTER_ADDRESS'] :'' }}</td>
                <td>التجمع : {{ $data[0]['REGION'] ? $data[0]['REGION'] : '' }} </td>
                <td>الشارع :</td>
                <td>رقم التلفون : {{ $data[0]['DEAD_D_REPORTER_MOBILE'] ? $data[0]['DEAD_D_REPORTER_MOBILE'] : '' }}</td>
                <td>صندوق بريد :</td>
            </tr>
            <tr>
                <td colspan="5">تاريخ تقديم الطلب : {{ $data[0]['DEAD_DATE_OF_REPORT'] ? $data[0]['DEAD_DATE_OF_REPORT'] : '' }}</td>
            </tr>
        </table>
    </div>
    <div>
        <table style="font-family: 'Tajawal'" class="datatable" width="100%" border="1" dir="rtl"
            cellpadding="0">
            <tr style="background-color:#eee ">
                <td style="text-align: center; font-weight:bold" colspan="5">خاص باستخدام مديرية الداخلية</td>
            </tr>

            <tr>
                <td>تاريخ استلام التبليغ : {{ $data[0]['DEAD_D_RECEIVE_DATE'] ? $data[0]['DEAD_D_RECEIVE_DATE'] : '' }} </td>
                <td>اسم الموظف: {{ $data[0]['DEAD_D_RECEIVER_NAME'] ? $data[0]['DEAD_D_RECEIVER_NAME'] : '' }} </td>
                <td>توقيع الموظف</td>
                <td align="center" width="10%" rowspan="2">ختم مديرية الداخلية</td>
            </tr>

            <tr>
                <td>تاريخ تسجيل الواقعة: {{ $data[0]['DEAD_D_REGISTER_DATE'] ?  date('d/m/Y', strtotime($data[0]['DEAD_D_REGISTER_DATE'])) : '' }}</td>
                <td>اسم الموظف: {{ $data[0]['DEAD_D_REGISTER_NAME'] ? $data[0]['DEAD_D_REGISTER_NAME'] : '' }} </td>
                <td>توقيع الموظف</td>

            </tr>

        </table>

    </div>

    <div>
        <table style="font-family: 'Tajawal'" class="datatable" width="100%" border="0" dir="rtl"
            cellpadding="0">
            <tr>
                <td>
                    <p style="font-size:12px;" align="right">التاريخ المسجل هو تاريخ تسجيل الوفاة وهو تاريخ قابل
                        للمراجعة والنقض (*)</p>
                </td>
                <td></td>
                <td>
                    <p style="font-size:12px;" align="left"> مسجل اشعار الوفاة </p>
                </td>
            </tr>
            <tr>
                {{-- <td>كود الاستعلام: {{ $data[0]['QR_CODE'] ? $data[0]['QR_CODE'] : '' }} </td> --}}
                <td>كود الاستعلام: {!! $data[0]['QR_CODE'] !!}</td>
                <td rowspan="2">{!! $image !!}</td>

                <td>
                    <p style="font-size:12px;" align="left"> {{ $data[0]['USER_FULL_NAME'] ? $data[0]['USER_FULL_NAME'] : '' }}</p>
                </td>
            </tr>

        </table>
    </div>

</body>

</html>
<script>
    window.print();
</script>




