<html>
<style>
    body,
    td {
        font-family: "Times New Roman", Times, sans-serif;

        padding-top: 3px;
        padding-bottom: 3px;
    }
</style>
<div dir="rtl">

    <body>
        <!-- ............................ترويسة التبليغ ................... -->

        <div style="width:750px;height:80px; margin:0 auto">
            <table
                style="width: 700px;height:75px !important; text-align:right ;background-color:white; margin:0 auto;border: 1px solid black;border-collapse: collapse;">
                <tr>
                    <td
                        style="width:300px;text-align:center;font-weight: bold;font-size:18px;border: 1px solid black;border-collapse: collapse;">
                        دولـة فلـسـطين <br><br>
                        وزارة الداخلية
                    </td>

                    <td rowspan="3"
                        style="width:300px;text-align:center;font-weight: bold;font-size:18px; border: 1px solid black;border-collapse: collapse;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/ee/Coat_of_arms_of_State_of_Palestine_%28Official%29.png"
                            width="70" height="70">
                    </td>
                    <td
                        style="width:300px;text-align:center;font-weight: bold;font-size:18px;border: 1px solid black;border-collapse: collapse;">
                        تبليغ عن وفاة <br><br>
                        (نسخة وزارة الداخلية)
                    </td>

                </tr>

            </table>
        </div>
        <!-- .................بيانات المتوفي  ............... -->
        <div style="width:750px; margin:0 auto;border: 1px solid black;">
            <table style="width: 750;border-collapse: collapse;">
                <tr style="height: 8px;">
                    <td
                        style="width: 750;height:2px !important; border: 1px solid black;border-left: none;  text-align:center ;background-color:cornflowerblue;font-weight: bold;font-size:14px">

                        <span>
                            @if ($data[0]['SOURCE'] == 1)
                                بيانات المتوفي (شهيد)
                            @else
                                بيانات المتوفي
                            @endif

                        </span>

                    </td>
                    <td
                        style="width: 10;height:2px !important; border: 1px solid black;border-right: none;  text-align:center ;background-color:cornflowerblue;font-weight: bold;font-size:12px">
                        {{ $data[0]['QR_CODE'] }}</td>

                </tr>
                <tr>
                    <table style="width: 750; border: 1px solid black;border-collapse: collapse;">
                        <tr>
                            <table style="width: 750; border: 1px solid black;border-collapse: collapse; ">
                                <tr>
                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        1.
                                    </td>
                                    <td>
                                        الاسم الرباعي للمتوفي/ة:
                                    </td>
                                    <td>{{ $data[0]['DEAD_FIRST_NAME_AR'] . ' ' . $data[0]['DEAD_FATHER_NAME_AR'] . ' ' . $data[0]['DEAD_GRANDFATHER_NAME_AR'] . ' ' . $data[0]['DEAD_LAST_NAME_AR'] }}
                                    </td>


                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        2.
                                    </td>
                                    <td>
                                        رقم هوية المتوفي/ة :
                                    </td>
                                    <td>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_ID'])[8] }}" readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_ID'])[7] }}" readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_ID'])[6] }}" readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_ID'])[5] }}" readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_ID'])[4] }}" readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_ID'])[3] }}" readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_ID'])[2] }}" readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_ID'])[1] }}" readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_ID'])[0] }}" readonly disabled>
                                    </td>
                                </tr>
                            </table>
                        </tr>

                        <tr>
                            <table style="width: 750; border: 1px solid black;border-collapse: collapse;">
                                <tr>
                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        3.
                                    </td>
                                    <td>
                                        تاريخ الميلاد:
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_DOB'])[9] }}" readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_DOB'])[8] }}" readonly disabled>
                                        /
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_DOB'])[6] }}" readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_DOB'])[5] }}" readonly disabled>
                                        /
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_DOB'])[3] }}" readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_DOB'])[2] }}" readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_DOB'])[1] }}" readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_DOB'])[0] }}" readonly disabled>
                                    </td>

                                    <td>
                                        اذا كان المتوفي طفلاً عاش اقل من 24 ساعة اذكر عدد ساعات الحياة <input
                                            type="text" style="width: 15px;"
                                            value="{{ $data[0]['DEAD_HOURS'] ?? '' }}"readonly disabled>

                                    </td>

                                </tr>
                            </table>
                        </tr>
                        <tr>
                            <table style="width: 750; border: 1px solid black;border-collapse: collapse; ">
                                <tr>
                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        4.
                                    </td>
                                    <td colspan="3"
                                        style="border: 1px solid black;border-collapse: collapse;width:300px">
                                        الجنس: 1.ذكر 2. انثى <input type="text" style="width: 15px;"
                                            value={{ $data[0]['DEAD_SEX_CD'] }} readonly disabled>
                                    </td>

                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        5.
                                    </td>
                                    <td>
                                        الحالة الزوجية : 1.اعزب 2.متزوج 3.مطلق 4.ارمل 5.منفصل <input type="text"
                                            style="width: 20px;" value={{ $data[0]['DEAD_MARTIAL_STATUS_CD'] }}
                                            readonly disabled>
                                    </td>
                                </tr>
                            </table>
                        </tr>
                        <tr>
                            <table style="width: 750; border: 1px solid black;border-collapse: collapse; ">

                                <tr>
                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        6.
                                    </td>
                                    <td>
                                        مكان الولادة: التجمع السكاني / المحافظة : {{ $data[0]['DEAD_D_BIRTH_PLACE'] }}
                                    </td>

                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        7.
                                    </td>
                                    <td>
                                        الديانة: {{ $data[0]['RE_NAME_AR'] }}
                                    </td>
                                </tr>
                            </table>
                        </tr>
                        <tr>
                            <table style="width: 750; border: 1px solid black;border-collapse: collapse; ">
                                <tr>
                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        8.
                                    </td>
                                    <td>
                                        المهنة :{{ $data[0]['JOB_NAME_AR'] }}
                                    </td>

                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        9.
                                    </td>
                                    <td>
                                        الجنسية:{{ $data[0]['DEATH_NATIONALITY'] }}
                                    </td>

                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        10.
                                    </td>
                                    <td>
                                        مكان الاقامة التجمع السكني :{{ $data[0]['CITY'] }}
                                    </td>

                                    <td>
                                        المحافظة :{{ $data[0]['REGION'] }}
                                    </td>

                                    <td>
                                        الدولة:.................
                                    </td>
                                </tr>
                            </table>
                        </tr>
                        <tr>
                            <table style="width: 750; border: 1px solid black;border-collapse: collapse; ">
                                <tr>
                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        11.
                                    </td>
                                    <td>
                                        تاريخ الوفاة: اليوم: <input type="text" style="width: 15px;"
                                            value="{{ str_split(date('m/d/Y', strtotime($data[0]['DEAD_DOD'])))[9] }}"
                                            readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split(date('m/d/Y', strtotime($data[0]['DEAD_DOD'])))[8] }}"
                                            readonly disabled>
                                    </td>

                                    <td>
                                        الشهر: <input type="text" style="width: 15px;"
                                            value="{{ str_split(date('Y/m/d', strtotime($data[0]['DEAD_DOD'])))[6] }}"
                                            readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split(date('Y/m/d', strtotime($data[0]['DEAD_DOD'])))[5] }}"
                                            readonly disabled>
                                    </td>
                                    <td>
                                        السنة: <input type="text" style="width: 15px;"
                                            value="{{ str_split(date('Y/m/d', strtotime($data[0]['DEAD_DOD'])))[3] }}"
                                            readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split(date('Y/m/d', strtotime($data[0]['DEAD_DOD'])))[2] }}"
                                            readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split(date('Y/m/d', strtotime($data[0]['DEAD_DOD'])))[1] }}"
                                            readonly disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split(date('Y/m/d', strtotime($data[0]['DEAD_DOD'])))[0] }}"
                                            readonly disabled>
                                    </td>

                                    <td>
                                        وقت الوفاة : الدقيقة:<input type="text" style="width: 15px;"
                                            value="{{ str_split(date('H:i', strtotime($data[0]['DEAD_DOD'])))[4] }}"
                                            readonly disabled> <input type="text" style="width: 15px;"
                                            value="{{ str_split(date('H:i', strtotime($data[0]['DEAD_DOD'])))[3] }}"
                                            readonly disabled>
                                    </td>


                                    <td>
                                        الساعة: <input type="text" style="width: 15px;"
                                            value="{{ str_split(date('H:i', strtotime($data[0]['DEAD_DOD'])))[1] }}"
                                            readonly disabled> <input type="text" style="width: 15px;"
                                            value="{{ str_split(date('H:i', strtotime($data[0]['DEAD_DOD'])))[0] }}"
                                            readonly disabled>
                                    </td>
                                </tr>
                            </table>

                        </tr>
                        <tr>
                            <table style="width: 750; border: 1px solid black;border-collapse: collapse; ">
                                <tr>
                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        12.
                                    </td>
                                    <td>
                                        مكان الوفاة 1.مستشفى 2.بيت 3.غير ذلك <input type="text"
                                            style="width: 20px;" value="{{ $data[0]['HOS_CD'] }}" readonly disabled>
                                    </td>

                                    <td>
                                        المستشفى : {{ $data[0]['DEATH_PLACE'] }}
                                    </td>

                                    <td>
                                        التجمع السكني:{{ $data[0]['DEATH_CITY'] }}
                                    </td>

                                    <td>
                                        المحافظة:{{ $data[0]['DEATH_REGION'] }}
                                    </td>

                                    <td>
                                        الدولة:{{ $data[0]['DEAD_DEATH_COUNTRY'] }}
                                    </td>
                                </tr>
                            </table>
                        </tr>
                        <tr>
                            <table style="width: 750; border: 1px solid black;border-collapse: collapse; ">
                                <tr>
                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        13.
                                    </td>
                                    <td>
                                        مكان الدفن:{{ $data[0]['DEAD_D_BURIAL_PLACE'] }}
                                    </td>

                                    <td
                                        style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                        14.
                                    </td>
                                    <td>
                                        رقم تصريح الدفن:
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_D_BURIAL_CODE'])[7] ?? '' }}" readonly
                                            disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_D_BURIAL_CODE'])[6] ?? '' }}" readonly
                                            disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_D_BURIAL_CODE'])[5] ?? '' }}" readonly
                                            disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_D_BURIAL_CODE'])[4] ?? '' }}" readonly
                                            disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_D_BURIAL_CODE'])[3] ?? '' }}" readonly
                                            disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_D_BURIAL_CODE'])[2] ?? '' }}" readonly
                                            disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_D_BURIAL_CODE'])[1] ?? '' }}" readonly
                                            disabled>
                                        <input type="text" style="width: 15px;"
                                            value="{{ str_split($data[0]['DEAD_D_BURIAL_CODE'])[0] ?? '' }}" readonly
                                            disabled>
                                    </td>
                                </tr>
                            </table>
                        </tr>
                    </table>
                </tr>

            </table>
            <!-- ................. تفاصيل الزوج / الزوجة ................. -->
            <div style="width:750px; margin:0 auto;">
                <table style="width: 750;border-collapse: collapse;">
                    <tr>
                        <td
                            style="width: 750;height:1; border: 1px solid black;  text-align:center ;background-color:cornflowerblue;;font-weight: bold;font-size:14px">
                            <span>تفاصيل الزوج / الزوجة </span>
                        </td>
                    </tr>
                    <tr>
                        <table style="width: 750; border: 1px solid black;border-collapse: collapse; ">
                            <tr>
                                <td
                                    style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                    15.
                                </td>
                                <td>
                                    اسم الزوج / الزوجة رباعي : {{ $data[0]['DEAD_D_PARTNER_NAME'] }}
                                </td>

                                <td
                                    style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                    16.
                                </td>
                                <td>
                                    رقم الهوية:
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PARTNER_ID'])[8] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PARTNER_ID'])[7] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PARTNER_ID'])[6] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PARTNER_ID'])[5] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PARTNER_ID'])[4] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PARTNER_ID'])[3] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PARTNER_ID'])[2] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PARTNER_ID'])[1] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PARTNER_ID'])[0] ?? '' }}" readonly
                                        disabled>
                                </td>

                            </tr>
                        </table>
                    </tr>
                </table>
            </div>
            <!-- ............................ اسباب الوفاة ................ -->
            <div style="width:750px; margin:0 auto;">
                <table style="width: 750;border-collapse: collapse;">
                    <tr>
                        <td
                            style="width: 750;height:1; border: 1px solid black;  text-align:center ;background-color:cornflowerblue;font-weight: bold;font-size:14px">
                            <span> أسباب الوفاة ( تستوفى من الطبيب المشرف عن الوفاة ) </span>
                        </td>
                    </tr>
                    <tr>
                        <table style="width: 750px; border: 1px solid black;border-collapse: collapse; ">
                            <tr>
                                <td style="width:5px;text-align:center ; border: 1px solid black;"> 17.</td>
                                <td colspan="2"
                                    style="width: 200px;height:5; border: 1px solid black;text-align:right ;font-weight: bold;font-size:18px;">
                                    سبب الوفاة</td>
                                <td
                                    style="width: 285px;height:5; border: 1px solid black;text-align:center ;font-weight: bold;font-size:18px;">
                                    التشخيص</td>
                                <td
                                    style="width: 100px;height:5; border: 1px solid black;text-align:center ;font-weight: bold;font-size:18px;">
                                    فترة المرض</td>
                                <td
                                    style="width: 80px;height:5; border: 1px solid black;text-align:center ;font-weight: bold;font-size:18px;">
                                    ICD 10</td>
                            </tr>
                            <tr>
                                <td rowspan="4" style="width:0px;text-align:center ; border: 1px solid black;">I.
                                </td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:right ;">السبب المباشر
                                    للوفاة</td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:center ;"> أ </td>
                                <td
                                    style="width: 5;height:5; border: 1px solid black;text-align:center ;font-weight: bold;font-size:16px;">
                                    {{ $data[0]['DEAD_ICD1_NAME'] ?? '' }}</td>
                                <td style="width: 5;height:5; border: 1px solid black;"> </td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:center ;">
                                    {{ $data[0]['DEAD_ICD1_CODE'] ?? '' }} </td>
                            </tr>
                            <tr>

                                <td style="width: 5;height:5; border: 1px solid black;text-align:right ;"> نتيجة من
                                </td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:center ;"> ب </td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:center ;">
                                    {{ $data[0]['DEAD_ICD2_NAME'] ?? '' }} </td>
                                <td style="width: 5;height:5; border: 1px solid black;"> </td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:center ;">
                                    {{ $data[0]['DEAD_ICD2_CODE'] ?? '' }} </td>
                            </tr>
                            <tr>

                                <td style="width: 5;height:5; border: 1px solid black;text-align:right ;"> نتيجة من
                                </td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:center ;"> ج </td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:center ;">
                                    {{ $data[0]['DEAD_ICD3_NAME'] ?? '' }} </td>
                                <td style="width: 5;height:5; border: 1px solid black;"> </td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:center ;">
                                    {{ $data[0]['DEAD_ICD3_CODE'] ?? '' }} </td>
                            </tr>
                            <tr>

                                <td style="width: 5;height:5; border: 1px solid black;text-align:right ;"> نتيجة من
                                    المرض الأصلي </td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:center ;"> د </td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:center ;">
                                    {{ $data[0]['DEAD_ICD4_NAME'] ?? '' }}</td>
                                <td style="width: 5;height:5; border: 1px solid black;"> </td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:center ;">
                                    {{ $data[0]['DEAD_ICD4_CODE'] ?? '' }} </td>
                            </tr>
                            <tr>
                                <td style="width:0px;text-align:center ; border: 1px solid black;">II.

                                </td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:right ;">أمراض أخرى
                                </td>
                                <td colspan="2"
                                    style="width: 5;height:5; border: 1px solid black;text-align:center ;">
                                    {{ $data[0]['DEAD_ICD5_NAME'] ? $data[0]['DEAD_ICD5_NAME'] .'-' : '' }}  {{ $data[0]['DEAD_ICD6_NAME'] ? $data[0]['DEAD_ICD6_NAME'] .'-' : '' }}
                                    {{ $data[0]['DEAD_ICD7_NAME'] ? $data[0]['DEAD_ICD7_NAME'] .'-' : '' }} {{ $data[0]['DEAD_ICD8_NAME'] ? $data[0]['DEAD_ICD8_NAME'] : '' }}
                                </td>
                                <td style="width: 5;height:5; border: 1px solid black;"> </td>
                                <td style="width: 5;height:5; border: 1px solid black;text-align:center ;">
                                    {{ $data[0]['DEAD_ICD5_CODE'] ? $data[0]['DEAD_ICD5_CODE'] .'-' : '' }}  {{ $data[0]['DEAD_ICD6_CODE'] ? $data[0]['DEAD_ICD6_CODE'] .'-' : '' }}
                                    {{ $data[0]['DEAD_ICD7_CODE'] ? $data[0]['DEAD_ICD7_CODE'] .'-' : '' }} {{ $data[0]['DEAD_ICD8_CODE'] ? $data[0]['DEAD_ICD8_CODE'] : '' }}
                                </td>
                            </tr>
                        </table>
                    </tr>
                    <tr>


                        <table style="width: 750; border: 1px solid black;border-collapse: collapse; ">
                            <tr>
                                <td rowspan="3"
                                    style="border: 1px solid black;border-collapse: collapse;width:23px;text-align:center ;">
                                    18.</td>
                                <td>
                                    اذا كان المتوفي إمرأة في سن الانجاب (15-49) سنة ، هل كانت حاملاً او اجهضت او اوضعت
                                    قبل وفاتها 1.نعم 2.لا <input type="text"
                                        value=" {{ $data[0]['DEAD_D_PREGNANCY_CD'] ?? '' }}"
                                        style="border: 1px solid black;width:20px" readonly disabled>

                                </td>
                                <td rowspan="4"
                                    style="width: 112px;height:5; border: 1px solid black;text-align:center;">ختم
                                    المستشفى</td>
                            </tr>
                            <tr>
                                <td>
                                    اذا نعم ، الرجاء ذكر عدد اسابيع الحمل ، عدد الأسابيع <input type="text"
                                        style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_GESTATIONAL_WEEK'])[1] ?? '0' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_GESTATIONAL_WEEK'])[0] ?? '0' }}" readonly
                                        disabled> هل توفيت خلال 42
                                    يوماً بعد الولادة 1.نعم 2.لا <input type="text" style="width: 15px;" readonly
                                        value={{ $data[0]['DEAD_D_AFTER_DELIVERY_CD'] ?? '' }} disabled>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="width: 750;height:1; border: 1px solid black;  text-align:center ;background-color:cornflowerblue;;font-weight: bold;font-size:14px">
                                    <span> بيانات الطبيب </span>
                                </td>
                            </tr>
                        </table>

                    <tr>
                        <table style="width: 750; border: 1px solid black; border-collapse: collapse;font-size:12px">
                            <tr>
                                <td
                                    style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                    19.</td>

                                <td colspan="3"
                                    style="border: 1px solid black;border-collapse: collapse;width:650px">
                                    أشهد بأني عالجت المتوفي المذكور أعلاه منذ <input type="text"
                                        style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_TREATMENT_DATE'])[9] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_TREATMENT_DATE'])[8] ?? '' }}" readonly
                                        disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_TREATMENT_DATE'])[6] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_TREATMENT_DATE'])[5] ?? '' }}" readonly
                                        disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_TREATMENT_DATE'])[3] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_TREATMENT_DATE'])[2] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_TREATMENT_DATE'])[1] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_TREATMENT_DATE'])[0] ?? '' }}" readonly
                                        disabled>
                                    وإني قد رأيت المتوفي
                                    على قيد الحياة لآخر مرة
                                    <br>
                                    بتاريخ
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PREVIEW_DATE'])[9] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PREVIEW_DATE'])[8] ?? '' }}" readonly
                                        disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PREVIEW_DATE'])[6] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PREVIEW_DATE'])[5] ?? '' }}" readonly
                                        disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PREVIEW_DATE'])[3] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PREVIEW_DATE'])[2] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PREVIEW_DATE'])[1] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_PREVIEW_DATE'])[0] ?? '' }}" readonly
                                        disabled>
                                    وأن الوفاة وقعت بتاريخ
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DOD'])[9] ?? '' }}" readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DOD'])[8] ?? '' }}" readonly disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DOD'])[6] ?? '' }}" readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DOD'])[5] ?? '' }}" readonly disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DOD'])[3] ?? '' }}" readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DOD'])[2] ?? '' }}" readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DOD'])[1] ?? '' }}" readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DOD'])[0] ?? '' }}" readonly disabled>
                                    وإنني رأيت الجثة
                                    <br>
                                    بتاريخ

                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_SEEING_CORPSE_DATE'])[9] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_SEEING_CORPSE_DATE'])[8] ?? '' }}"
                                        readonly disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_SEEING_CORPSE_DATE'])[6] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_SEEING_CORPSE_DATE'])[5] ?? '' }}"
                                        readonly disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_SEEING_CORPSE_DATE'])[3] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_SEEING_CORPSE_DATE'])[2] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_SEEING_CORPSE_DATE'])[1] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_SEEING_CORPSE_DATE'])[0] ?? '' }}"
                                        readonly disabled>

                                    جرى تشريح الجثة 1.نعم 2.لا

                                    <input type="text" style="width: 15px;"
                                        value="{{ $data[0]['DEAD_D_CORPSE_DISSECTION_CD'] ?? '' }}" readonly disabled>
                                    اذا نعم تاريخ تشريح الجثة
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_CORPSE_DESSECTION_DATE'])[9] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_CORPSE_DESSECTION_DATE'])[8] ?? '' }}"
                                        readonly disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_CORPSE_DESSECTION_DATE'])[6] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_CORPSE_DESSECTION_DATE'])[5] ?? '' }}"
                                        readonly disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_CORPSE_DESSECTION_DATE'])[3] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_CORPSE_DESSECTION_DATE'])[2] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_CORPSE_DESSECTION_DATE'])[1] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_CORPSE_DESSECTION_DATE'])[0] ?? '' }}"
                                        readonly disabled>

                                    <br>
                                    أشهد حسب معرفتي الشخصية بأن كافة التفاصيل المبينة أعلاه مضبوطة وصحيحة
                                </td>
                                <td rowspan="3"
                                    style="width: 100px;height:5; border: 1px solid black;text-align:center;border-collapse: collapse;">
                                    ختم الطبيب</td>
                            </tr>
                            <tr>
                                <td
                                    style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                </td>
                                <td style="border: 1px solid black;border-collapse: collapse;">اسم الطبيب :
                                    {{ $data[0]['DEAD_REPORT_DOC_BY'] ?? '' }}</td>
                                <td style="border: 1px solid black;border-collapse: collapse;">التخصص :
                                    {{ $data[0]['DEAD_D_DOC_SPECIALIST'] ?? '' }}</td>
                                <td style="border: 1px solid black;border-collapse: collapse;">العنوان
                                    :{{ $data[0]['DEAD_D_DOC_ADDRESS'] ?? '' }}</td>

                            </tr>
                            <tr>
                                <td
                                    style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                </td>


                                <td style="border: 1px solid black;border-collapse: collapse;">توقيع الطبيب :</td>

                                <td colspan="2" style="border: 1px solid black;border-collapse: collapse;">التاريخ
                                    : ...../....../.......</td>

                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table style="width: 750; border: 1px solid black; border-collapse: collapse;">
                            <tr>
                                <td colspan="6"
                                    style="width: 700px;height:1; border: 1px solid black;border-collapse: collapse;  text-align:center ;background-color:cornflowerblue;;font-weight: bold;font-size:14px">
                                    <span> لإستخدام مديرية الصحة </span>
                                </td>
                                <td rowspan="5" style="width: 100px;height:5; border: 1px solid black;">ختم مديرية
                                    الصحة</td>
                            </tr>

                            <tr>
                                <td
                                    style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                    20.</td>
                                <td colspan="5"
                                    style="font-size: 14px;border: 1px solid black;border-collapse: collapse;width:22px;text-align:right ;">
                                    تشهد مديرية الصحة بأن الطبيب الذي استوفى البيانات اعلاه هو طبيب مسجل في وزارة الصحة
                                    ومؤهل لإصدار هذا التبليغ</td>

                            </tr>
                            <tr>

                                <td colspan="6"
                                    style="width: 700px;height:1; border: 1px solid black;  text-align:center ;background-color:cornflowerblue;;font-weight: bold;font-size:14px">
                                    <span> بيانات المبلغ </span>
                                </td>

                            </tr>
                            <tr>

                                <td
                                    style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                    21.</td>
                                <td colspan="2"
                                    style="border: 1px solid black;border-collapse: collapse;text-align:right ;">اسم
                                    مقدم التبليغ رباعي:{{ $data[0]['DEAD_REPORT_SUBMITTED_BY'] }}</td>

                                <td
                                    style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                    22.</td>
                                <td colspan="2"
                                    style="border: 1px solid black;border-collapse: collapse;text-align:right ;">رقم
                                    الهوية :
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_REPORT_SUBMITTED_ID'])[8] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_REPORT_SUBMITTED_ID'])[7] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_REPORT_SUBMITTED_ID'])[6] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_REPORT_SUBMITTED_ID'])[5] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_REPORT_SUBMITTED_ID'])[4] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_REPORT_SUBMITTED_ID'])[3] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_REPORT_SUBMITTED_ID'])[2] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_REPORT_SUBMITTED_ID'])[1] ?? '' }}"
                                        readonly disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_REPORT_SUBMITTED_ID'])[0] ?? '' }}"
                                        readonly disabled>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                    23.</td>
                                <td colspan="2"
                                    style="border: 1px solid black;border-collapse: collapse;text-align:right ;">الجنس
                                    : 1.ذكر 2. أنثى <input type="text" style="width: 20px;" readonly disabled
                                        value=" {{ $data[0]['DEAD_D_REPORTER_SEX_CD'] ?? '' }}">

                                </td>
                                <td colspan="2"
                                    style="border: 1px solid black;border-collapse: collapse;text-align:right;">
                                    الجنسية : {{ $data[0]['REPORTED_NATIONALITY'] ?? '' }}
                                </td>

                                <td style="border: 1px solid black;border-collapse: collapse;text-align:right ;">
                                    صلة القرابة:{{ $data[0]['DEAD_D_RELATIONSHIP'] ?? '' }}
                                </td>


                            </tr>
                            <tr>

                                <td
                                    style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                    26.</td>
                                <td colspan="2">العنوان :{{ $data[0]['DEAD_D_REPORTER_ADDRESS'] ?? '' }} التجمع :
                                    {{ $data[0]['REGION'] ?? '' }}</td>

                                <td colspan="2"
                                    style="border: 1px solid black;border-collapse: collapse;text-align:right ;">
                                    الشارع:{{ $data[0]['DEAD_D_REPORTER_ADDRESS'] ?? '' }}</td>
                                <td style="border: 1px solid black;border-collapse: collapse;text-align:right ;">رقم
                                    التليفون: {{ $data[0]['DEAD_D_REPORTER_MOBILE'] }} </td>
                                <td
                                    style="border: 1px solid black;border-collapse: collapse;text-align:right ;font-size:14px">
                                    صندوق بريد:..........</td>


                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table style="width: 750; border: 1px solid black; border-collapse: collapse;font-size:16px">
                            <tr>

                                <td
                                    style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                    27</td>
                                <td colspan="5"
                                    style="border: 1px solid black;border-collapse: collapse;text-align:right ;">تاريخ
                                    تقديم التبليغ:
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DATE_OF_REPORT'])[9] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DATE_OF_REPORT'])[8] ?? '' }}" readonly
                                        disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DATE_OF_REPORT'])[6] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DATE_OF_REPORT'])[5] ?? '' }}" readonly
                                        disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DATE_OF_REPORT'])[3] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DATE_OF_REPORT'])[2] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DATE_OF_REPORT'])[1] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_DATE_OF_REPORT'])[0] ?? '' }}" readonly
                                        disabled>


                                </td>


                                <td rowspan="5" style=" border: 1px solid black;">ختم مديرية الداخلية</td>
                            </tr>
                            <tr>

                                <td colspan="5"
                                    style="width: 625px;height:1; border: 1px solid black;  text-align:center ;background-color:cornflowerblue;font-weight: bold;font-size:14px">
                                    <span> خاص باستخدام مديرية الداخلية </span>
                                </td>
                            </tr>

                            <tr>

                                <td
                                    style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                    28.</td>
                                <td colspan="2"
                                    style="width:120px;border: 1px solid black;border-collapse: collapse;text-align:right ;">
                                    تاريخ استلام التبليغ:
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_RECEIVE_DATE'])[9] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_RECEIVE_DATE'])[8] ?? '' }}" readonly
                                        disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_RECEIVE_DATE'])[6] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_RECEIVE_DATE'])[5] ?? '' }}" readonly
                                        disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_RECEIVE_DATE'])[3] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_RECEIVE_DATE'])[2] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_RECEIVE_DATE'])[1] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_RECEIVE_DATE'])[0] ?? '' }}" readonly
                                        disabled>



                                </td>

                                <td
                                    style="width:120px;border: 1px solid black;border-collapse: collapse;text-align:right ;">
                                    اسم الموظف: {{ $data[0]['DEAD_D_RECEIVER_NAME'] ?? '' }}</td>

                                <td colspan="2"
                                    style="border: 1px solid black;border-collapse: collapse;text-align:right ;">توقيع
                                    الموظف: </td>


                            </tr>
                            <tr>

                                <td
                                    style="border: 1px solid black;border-collapse: collapse;width:22px;text-align:center ;">
                                    29.</td>
                                <td colspan="2"
                                    style="width:120px; border: 1px solid black;border-collapse: collapse;text-align:right ;font-size:12px">
                                    تاريخ تسجيل الواقعة بسجل السكان:

                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_REGISTER_DATE'])[9] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_REGISTER_DATE'])[8] ?? '' }}" readonly
                                        disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_REGISTER_DATE'])[6] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_REGISTER_DATE'])[5] ?? '' }}" readonly
                                        disabled>
                                    /
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_REGISTER_DATE'])[3] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_REGISTER_DATE'])[2] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_REGISTER_DATE'])[1] ?? '' }}" readonly
                                        disabled>
                                    <input type="text" style="width: 15px;"
                                        value="{{ str_split($data[0]['DEAD_D_REGISTER_DATE'])[0] ?? '' }}" readonly
                                        disabled>


                                </td>
                                <td
                                    style="width:120px;border: 1px solid black;border-collapse: collapse;text-align:right ;">
                                    اسم الموظف:{{ $data[0]['DEAD_D_REGISTER_NAME'] ?? '' }}</td>
                                <td colspan="2"
                                    style="border: 1px solid black;border-collapse: collapse;text-align:right ;">توقيع
                                    الموظف:</td>

                            </tr>
                        </table>
                    </tr>

                </table>

            </div>
        </div>
        <div style="width:750px; margin:0 auto;">
            <table style="width: 750;border-collapse: collapse;">
                <tr>
                    <table style="width: 750; ">
                        <tr>
                            <td>
                                {!! $image !!}
                            </td>
                            <td colspan="3" style="font-weight: bold;font-size:14px; text-align:center ;">
                                تم طباعة استمارة الوفاة إلكترونياً حسب البيانات المسجلة في نظام المستشفيات - وزارة
                                الصحة.
                            </td>
                            <td colspan="1" style="font-size:10px; text-align:left ;">
                                {{ date('m/d/Y H:I') }}
                            </td>
                        </tr>
                    </table>
                </tr>
            </table>
        </div>
    </body>
</div>
</html>

<script>
    window.print();

    function generateBarCode() {

        //   var nric = $('#qr_code').val();
        var url = 'https://sehatty.ps/public/check_dead_data';
        $('#barcode').attr('src', url);
    }
</script>
