<style>
    h3,th {
        text-align: center;
    }
</style>
<div class="card mb-7" dir="ltr">
    <!--begin::Card body-->
    <div class="card-body">
        <div class="table-responsive">
            <h3>تقرير الوفيات بتشخيص غير مدخل</h3>


            <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                style="width:472px">
                @if ($old_record['Death_date_frm'] != '' || $old_record['Death_date_frm'] != '')
                    <tr>
                        <th width="50px" scope="col">إلى:</th>
                        <th width="50px" height="34" scope="col">
                            {{ $old_record['Death_date_to'] }}
                        </th>
                        <th width="50px" scope="col">من تاريخ:</th>
                        <th width="50px" scope="col">
                            {{ $old_record['Death_date_frm'] }}
                        </th>

                    </tr>
                @endif
                @if ($old_record['Age_From'] != '' || $old_record['Age_To'] != '')
                    <tr>
                        <th scope="col">إلى:</th>
                        <th scope="col">
                            {{ $old_record['Age_To'] }}
                        </th>
                        <th scope="col">من عمر:</th>
                        <th scope="col">
                            {{ $old_record['Age_From'] }}
                        </th>

                    </tr>
                @endif
                @if ($old_record['Year_From'] != '' || $old_record['Year_To'] != '')
                    <tr>
                        <th scope="col">إلى:</th>
                        <th scope="col">
                            {{ $old_record['Year_To'] }}
                        </th>
                        <th scope="col">من السنة:</th>
                        <th scope="col">
                            {{ $old_record['Year_From'] }}
                        </th>

                    </tr>
                @endif
                @php
                    if ($old_record['Sex'] == 0) {
                        $sex1 = 'غير معروف';
                    } elseif ($old_record['Sex'] == 1) {
                        $sex1 = 'ذكر';
                    } elseif ($old_record['Sex'] == 2) {
                        $sex1 = 'أنثى';
                    }
                @endphp
                @if ($old_record['Sex'] != '')
                    <tr>
                        <th scope="col">الجنس:</th>
                        <th scope="col">
                            {{ $sex1 }}
                        </th>

                    </tr>
                @endif

            </table>
            <P></P>

            <div class="d-flex align-items-center">


                <label class="control-label col-md-1">عدد السجلات</label>
                <div class="position-relative w-md-300px me-md-1">

                    <div class="row mb-4">
                        <div class="col-lg-5">
                            <input type="text" id="out_records_num" class="form-control text-center"
                                name="out_records_num" readonly="readonly" />
                        </div>
                    </div>
                </div>

            </div>
            <!--begin::datatable-->
            <table id="result_tbs" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
            style="width:100%">
                <thead>

                    <tr>

                        <th width="144" height="37" bgcolor="#91B641"><div align="center" class="style7">العملية</div></th>
                        <th width="250" height="37" bgcolor="#91B641"><div align="center" class="style7">اسم المتوفى رباعي</div></th>
                        <th width="112" bgcolor="#91B641"><div align="center">تاريخ الوفاة</div></th>
                        <th width="218" height="37" bgcolor="#91B641"><div align="center" class="style7">تاريخ الميلاد</div></th>
                        <th width="93" bgcolor="#91B641">هوية المتوفى</th>
                        <th height="37" bgcolor="#91B641">
                            <div align="center" class="style7">.م</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>

            </table>

        </div>
        <!--end::datatable-->
    </div>
    <!--end::Compact form-->
</div>

<script>
    GET_Deads_non_Diagnosable_all();

    function GET_Deads_non_Diagnosable_all() {

        var url = "{{ route('Report.GET_Deads_non_Diagnosable_all') }}";
        console.log(11);
        $("#result_tbs").DataTable({
            dom: 'Bfrtip',
            buttons: [  {
                        extend: 'excelHtml5',
                        title: 'Excel',
                        text:'Excel'

                    },{
                        extend: 'pdfHtml5',
                        title: 'Daily_Born',
                        text: 'PDF',
                    } ],
            serverSide: true,
            paging: true,
            ordering: false,
            destroy: true,
            ajax: {
                url: url,
                method: 'POST',
                data: {
                Sex: $('#Sex').val(),
                Dead_ID: $('#Dead_ID').val(),
                Age_From: $('#Age_From').val(),
                Age_To: $('#Age_To').val(),
                Diag_From: $('#Diag_From').val(),
                Diag_To: $('#Diag_To').val(),
                Year_From: $('#Year_From').val(),
                Year_To: $('#Year_To').val(),
                Death_date_frm: $('#Death_date_frm').val(),
                Death_date_to: $('#Death_date_to').val(),


                },
            },
            initComplete: function(data) {
                console.log(data);
            },
            columnDefs: [
            { targets: '_all', className: 'dt-center' }
            ],

            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "لايوجد بيانات في الجدول للعرض",
                "info": "عرض _START_ الى  _END_ من _TOTAL_ سجلات",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "عرض _MENU_",
                "search": "بحث:",
                "zeroRecords": "No matching records found",

            },
            lengthMenu: [
                [10, 25, 50, -1],
                ['10', '25', '50', 'All']
            ],

            "searching": true,
            'paging': true,

            "infoCallback": function(settings, start, end, max, total, pre) {
                $('#out_records_num').val(total);

                return "عرض _" + start + "_ الى  _" + end + "_ من _" + total + "_ سجلات";
            }


        });
    }


    function update_crt_dead(P_DEAD_ID) {
    var url = "{{ route('dead.getDeadInfoById') }}";

    $.ajax({
        url: url,
        method: 'post',
        data: {
            P_DEAD_ID: P_DEAD_ID
        },
    }).done(function(response) {
        console.log(response);
        if (response.success != true) {
            Swal.fire({
                title: 'يوجد خطأ في عملية الإدخال !',
                text: $message,
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            Swal.fire({
                title: "هل تريد بالفعل تعديل إشعار الوفاة",
                showDenyButton: true,
                confirmButtonText: "موافق",
                denyButtonText: `إلغاء`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var red_url = '{{ route('dead.update_dead', ':P_DEAD_NUMBER') }}';
                    red_url = red_url.replace(':P_DEAD_NUMBER', response.results[0]['DEAD_CODE']);
                    window.open(red_url, true);
                }
            });
        }
    });

}
</script>


{{-- <html>
<style>
    body {
        font-family: "Times New Roman", Times, sans-serif;

        padding-top: 1px;
        padding-bottom: 1px;
        border: solid blue;
        border-width: thin;
    }

    td {
        font-family: "Times New Roman", Times, sans-serif;

        padding-top: 1px;
        padding-bottom: 1px;
        border: solid black;
        border-width: thin;
        text-align: center;
    }

    th {
        font-family: "Times New Roman", Times, sans-serif;

        padding-top: 1px;
        padding-bottom: 1px;
        text-align: center;

    }

    h3 {
        text-align: center;
    }

    table {
        margin-left: auto;
        margin-right: auto;
    }
</style>
<div dir="ltr">

    <body>
        <div style="width:1000px; margin:0 auto;" class="text-center">

            <h3>توزيع الوفيات حسب الفئة العمرية والمحافظة</h3>

        </div>
        <div style="width:1000px; margin: auto;" class="text-center">

            <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                style="width:472px">
                @if ($old_record['Death_date_frm'] != '' || $old_record['Death_date_frm'] != '')
                    <tr>
                        <th width="50px" scope="col">إلى:</th>
                        <th width="50px" height="34" scope="col">
                            {{ $old_record['Death_date_to'] }}
                        </th>
                        <th width="50px" scope="col">من تاريخ:</th>
                        <th width="50px" scope="col">
                            {{ $old_record['Death_date_frm'] }}
                        </th>

                    </tr>
                @endif

                @if ($old_record['Diag_From'] != '' || $old_record['Diag_To'] != '')
                    <tr>
                        <th width="50px" scope="col">إلى:</th>
                        <th width="50px" scope="col">{{ $old_record['Diag_To'] }}</th>
                        <th width="50px" scope="col"> من تشخيص:</th>
                        <th width="50px" scope="col">{{ $old_record['Diag_From'] }}</th>

                    </tr>
                @endif
                @if ($old_record['Age_From'] != '' || $old_record['Age_To'] != '')
                    <tr>
                        <th scope="col">إلى:</th>
                        <th scope="col">
                            {{ $old_record['Age_To'] }}
                        </th>
                        <th scope="col">من عمر:</th>
                        <th scope="col">
                            {{ $old_record['Age_From'] }}
                        </th>

                    </tr>
                @endif
                @if ($old_record['Year_From'] != '' || $old_record['Year_To'] != '')
                    <tr>
                        <th scope="col">إلى:</th>
                        <th scope="col">
                            {{ $old_record['Year_To'] }}
                        </th>
                        <th scope="col">من السنة:</th>
                        <th scope="col">
                            {{ $old_record['Year_From'] }}
                        </th>

                    </tr>
                @endif
                @php
                    if ($old_record['Sex'] == 0) {
                        $sex1 = 'غير معروف';
                    } elseif ($old_record['Sex'] == 1) {
                        $sex1 = 'ذكر';
                    } elseif ($old_record['Sex'] == 2) {
                        $sex1 = 'أنثى';
                    }
                @endphp
                @if ($old_record['Sex'] != '')
                    <tr>
                        <th scope="col">الجنس:</th>
                        <th scope="col">
                            {{ $sex1 }}
                        </th>

                    </tr>
                @endif

            </table>
            <P></P>

            <table width="520" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="554" scope="col">
                        <table width="546" height="93" cellpadding="0" cellspacing="0" bordercolor="#666666"
                            class="sortable" id="anyid">
                            <tr>
                                <th width="33">العملية</th>
                                <th width="238" height="37">
                                    <div class="style7">اسم المتوفى رباعي</div>
                                </th>
                                <th width="90" height="37">
                                    <div class="style7">تاريخ الوفاة</div>
                                </th>
                                <th width="89" height="37">
                                    <div class="style7  style11">تاريخ الميلاد</div>
                                </th>
                                <th width="84" height="37">هوية المتوفى</th>
                            </tr>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td width="33">
                                        <div><a href=""
                                                onclick="">تعديل</a>
                                        </div>
                                    </td>
                                    <td width="238" height="54">
                                        <div
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            {{ $value['DEAD_NAME']}}</div>
                                    </td>
                                    <td height="54">
                                        <div
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            {{ $value['DEAD_DOD']}}</div>
                                    </td>
                                    <td height="54">
                                        <div
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            {{$value['DEAD_DOB']}}</div>
                                    </td>
                                    <td height="54">
                                        <div
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            {{ $value['DEAD_ID']}}</div>
                                    </td>
                                </tr>
                                @php
                                    $number = $number + 1;
                                @endphp
                            @endforeach


                        </table>
                        <div></div>
                    </th>
                    <th width="335" scope="col">
                        <table width="30" height="93" cellpadding="0" cellspacing="0">
                            <tr>
                                <th height="37" scope="col">.م</th>
                            </tr>
                            @foreach ($data1 as $key => $value)
                                <tr>
                                    <td height="54">
                                        <div
                                            style=" font-weight:500; font-family:'Times New Roman', Times, serif;font-size:17px">
                                            <?php echo '.' . $j;
                                            echo $born[0]; ?></div>
                                    </td>
                                </tr>
                                @php

                                    $j = $j + 1;
                                @endphp
                            @endforeach

                        </table>
                    </th>
                </tr>
            </table>
            <p>
                @php
                    $p_limit = 168; // This should be more than $limit and set to a value for whick links to be breaked

                    $p_f = $_GET['p_f']; // To take care global variable if OFF
                    if (!($p_f > 0)) {
                        // This variable is set to zero for the first page
                        $p_f = 0;
                    }

                    $p_fwd = $p_f + $p_limit;
                    $p_back = $p_f - $p_limit;
                    //////////// End of variables for advance paging ///////////////
                    /////////////// Start the buttom links with Prev and next link with page numbers /////////////////

                    echo "<table align = 'center' width='50%'><tr><td  align='left' width='20%'>";
                    if ($p_f != 0) {
                        print "<a href='$page_name?start=$p_back&p_f=$p_back&d_from=$date_F&d_to=$date_T&id=$id1&sex=$sex&y_from=$year_F&y_to=$year_T&age_From=$age_F&age_To=$age_T'><font face='Verdana' size='2'><<<<<</font></a>";
                    }
                    echo "</td><td  align='left' width='10%'>";
                    //// if our variable $back is equal to 0 or more then only we will display the link to move back ////////
                    if ($back >= 0 and $back >= $p_f) {
                        print "<a href='$page_name?start=$back&p_f=$p_f&d_from=$date_F&d_to=$date_T&id=$id1&sex=$sex&y_from=$year_F&y_to=$year_T&age_From=$age_F&age_To=$age_T'><font face='Verdana' size='2'>السابق</font></a>";
                    }
                    //////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
                    echo "</td><td align=center width='30%'>";

                    for ($i = $p_f; $i < $ROW1['COUNTER'] and $i < $p_f + $p_limit; $i = $i + $limit) {
                        if ($i != $eu) {
                            $i2 = $i + $p_f;
                            echo " <a href='$page_name?start=$i&p_f=$p_f&d_from=$date_F&d_to=$date_T&id=$id1&sex=$sex&y_from=$year_F&y_to=$year_T&age_From=$age_F&age_To=$age_T'><font face='Verdana' size='2'>$K</font></a> ";
                        } else {
                            echo "<font face='Verdana' size='4' color=red>$K</font>";
                        } /// Current page is not displayed as link and given font color red
                        $K = $K + 1;
                    }
                    echo "</td><td  align='right' width='10%'>";
                    ///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
                    if ($this1 < $ROW1['COUNTER'] and $this1 < $p_f + $p_limit) {
                        print "<a href='$page_name?start=$next&p_f=$p_f&d_from=$date_F&d_to=$date_T&id=$id1&sex=$sex&y_from=$year_F&y_to=$year_T&age_From=$age_F&age_To=$age_T'><font face='Verdana' size='2'>التالي</font></a>";
                    }
                    echo "</td><td  align='right' width='20%'>";
                    if ($p_fwd < $ROW1['COUNTER']) {
                        print "<a href='$page_name?start=$p_fwd&p_f=$p_fwd&d_from=$date_F&d_to=$date_T&id=$id1&sex=$sex&y_from=$year_F&y_to=$year_T&age_From=$age_F&age_To=$age_T'><font face='Verdana' size='2'>>>>>></font></a>";
                    }
                    echo '</td></tr></table>';
                @endphp

            </p>
            <p></p>
            <table id="result_tb" class="table table-striped dt-responsive table-row-bordered gy-5 gs-7"
                style="width:686px">
                <tr>
                    <th width="177" height="27" scope="col">
                        <div><strong>
                                {{ $user_name }}
                        </div></strong>
                    </th>
                    <th width="150" class="style22" scope="col">
                        <div><strong>
                                منشئ التقرير:
                            </strong>
                        </div>
                    </th>
                    <th width="280" scope="col">
                        <div><strong>
                                {{ date('d/m/Y H:i', time()) }}

                        </div></strong>
                    </th>
                    <th width="280" scope="col">
                        <div><strong>
                                تاريخ ووقت الطباعة:
                            </strong>
                    </th>


                </tr>

            </table>
            <p></p>
            <p></p>
        </div>
    </body>
</div>

</html> --}}
