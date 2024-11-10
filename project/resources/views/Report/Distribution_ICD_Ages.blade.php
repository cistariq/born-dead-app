<style>
    h3,th {
        text-align: center;
    }
</style>
<div class="card mb-7" dir="ltr">
    <!--begin::Card body-->
    <div class="card-body">
        <div class="table-responsive">
            <h3>توزيع الوفيات حسب الفئات العمرية والمرض</h3>


            <table width="559" border="0" align="center" cellpadding="0" cellspacing="0">

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

            <form action="#" id="form1">
                <!--begin::Card-->
                <input type="hidden" id="d_from" name="d_from" value="{{ $old_record['Death_date_frm'] }}" />
                <input type="hidden" id="d_to" name="d_to" value=" {{ $old_record['Death_date_to'] }}" />

                <input type="hidden" id="dia_from" name="dia_from" value="{{ $old_record['Diag_From'] }}" />
                <input type="hidden" id="dia_to" name="dia_to" value="{{ $old_record['Diag_To'] }}" />

                <input type="hidden" id="age_From" name="age_From" value="{{ $old_record['Age_From'] }}" />
                <input type="hidden" id="age_To" name="age_To" value="{{ $old_record['Age_To'] }}" />

                <input type="hidden" id="y_from" name="y_from" value="{{ $old_record['Year_From'] }}" />
                <input type="hidden" id="y_to" name="y_to" value=" {{ $old_record['Year_To'] }}" />

                <input type="hidden" id="sex" name="sex" value="{{ $old_record['Sex'] }}" />
                <input type="hidden" id="id" name="id" value="{{ $old_record['Dead_ID'] }}" />

                <div class="card  mb-7">
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Compact form-->
                        <div class="d-flex align-items-center">
                            <!--begin::Input group-->
                            <label class="control-label col-md-1">بناءً على </label>
                            <div class="position-relative w-md-400px me-md-1">

                                <div class="row mb-4">
                                    <div class="col-lg-10">

                                        <select class="form-select" data-control="select2" id="ICD_OPTN"
                                            data-placeholder="اختر التشخيص ">
                                            <option value="1">التشخيص الأول</option>
                                            <option value="2">التشخيص الثاني</option>
                                            <option value="3">التشخيص الثالث</option>
                                        </select>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <!--end::Compact form-->

                        <!--begin::Compact form-->


                        <!--end::Compact form-->
                        <!--begin:Action-->

                        <!--begin::Input group-->

                        <div class="float-end">
                            @if (IsPermissionBtn(21))
                                <button type="button" class="btn btn-primary me-5"
                                    onclick="get_Distribution_ICD_Ages();">استعلام</button>
                            @endif

                        </div>
                    </div>

                </div>
            </form>

            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="194" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">&lt;1</span></th>
                    <th width="298" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid1" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="62" bgcolor="#91B641">ICD10</th>
                                <th width="230" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php
                            $age_F = 0;
                            $age_T = 1; ?>
                            @foreach ($data as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>

                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php $age_F = 0;
                            $age_T = 1;
                            ?>
                            @foreach ($data1 as $key => $entry_first)
                                <tr>

                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p>&nbsp;</p>
            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="194" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">4-1</span></th>
                    <th width="298" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid26" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="62" bgcolor="#91B641">ICD10</th>
                                <th width="230" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php
                            $age_F = 1;
                            $age_T = 5; ?>
                            @foreach ($data2 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php $age_F = 1;
                            $age_T = 5;
                            ?>
                            @foreach ($data3 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p>&nbsp;</p>
            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="194" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">9-5</span></th>
                    <th width="298" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid28" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="62" bgcolor="#91B641">ICD10</th>
                                <th width="230" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php
                            $age_F = 5;
                            $age_T = 10; ?>
                            @foreach ($data4 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php $age_F = 5;
                            $age_T = 10;

                            ?>
                            @foreach ($data5 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p>&nbsp;</p>
            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="194" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">14-10</span></th>
                    <th width="298" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid29" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="62" bgcolor="#91B641">ICD10</th>
                                <th width="230" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php
                            $age_F = 10;
                            $age_T = 15; ?>
                            @foreach ($data6 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php $age_F = 10;
                            $age_T = 15;
                            ?>
                            @foreach ($data7 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p>&nbsp;</p>
            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="194" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">19-15</span></th>
                    <th width="298" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid8" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="67" bgcolor="#91B641">ICD10</th>
                                <th width="225" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 15;
                            $age_T = 20; ?>
                            @foreach ($data8 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 15;
                            $age_T = 20; ?>
                            @foreach ($data9 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p></p>
            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="194" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">24-20</span></th>
                    <th width="298" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid21" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="67" bgcolor="#91B641">ICD10</th>
                                <th width="225" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 20;
                            $age_T = 25; ?>
                            @foreach ($data10 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 20;
                            $age_T = 25; ?>
                            @foreach ($data11 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p>&nbsp;</p>
            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="194" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">29-25</span></th>
                    <th width="298" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid6" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="67" bgcolor="#91B641">ICD10</th>
                                <th width="225" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 25;
                            $age_T = 30;
                            ?>
                            @foreach ($data12 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 25;
                            $age_T = 30; ?>
                            @foreach ($data13 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p>&nbsp;</p>
            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="194" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">34-30</span></th>
                    <th width="298" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid3" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="67" bgcolor="#91B641">ICD10</th>
                                <th width="225" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 30;
                            $age_T = 35; ?>
                            @foreach ($data14 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 30;
                            $age_T = 35; ?>
                            @foreach ($data15 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p>&nbsp;</p>
            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="196" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">39-35</span></th>
                    <th width="296" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid12" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="70" bgcolor="#91B641">ICD10</th>
                                <th width="222" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 35;
                            $age_T = 40; ?>
                            @foreach ($data16 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 35;
                            $age_T = 40; ?>
                            @foreach ($data17 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p></p>
            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="196" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">44-40</span></th>
                    <th width="296" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid7" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="70" bgcolor="#91B641">ICD10</th>
                                <th width="222" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 40;
                            $age_T = 45; ?>
                            @foreach ($data18 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 40;
                            $age_T = 45; ?>
                            @foreach ($data19 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p></p>
            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="196" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">49-45</span></th>
                    <th width="296" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid10" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="70" bgcolor="#91B641">ICD10</th>
                                <th width="222" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 45;
                            $age_T = 50; ?>
                            @foreach ($data20 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 45;
                            $age_T = 50; ?>
                            @foreach ($data21 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p></p>
            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="196" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">54-50</span></th>
                    <th width="296" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid4" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="70" bgcolor="#91B641">ICD10</th>
                                <th width="222" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 50;
                            $age_T = 55; ?>
                            @foreach ($data22 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 50;
                            $age_T = 55; ?>
                            @foreach ($data23 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p></p>
            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="196" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">59-55</span></th>
                    <th width="296" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" id="anyid16" width="492" height="87" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="73" bgcolor="#91B641">ICD10</th>
                                <th width="219" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 55;
                            $age_T = 60; ?>
                            @foreach ($data24 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 55;
                            $age_T = 60; ?>
                            @foreach ($data25 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p></p>
            <table width="492" height="97" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="196" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">64-60</span></th>
                    <th width="296" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" id="anyid11" width="492" height="87" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="73" bgcolor="#91B641">ICD10</th>
                                <th width="219" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 60;
                            $age_T = 65; ?>
                            @foreach ($data26 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 60;
                            $age_T = 65; ?>
                            @foreach ($data27 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p>&nbsp;</p>
            <table width="492" height="97" border="0" align="center" cellpadding="0"
                cellspacing="0">
                <tr>
                    <th width="196" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">69-65</span>
                    </th>
                    <th width="296" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" id="anyid14" width="492" height="87" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="73" bgcolor="#91B641">ICD10</th>
                                <th width="219" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 65;
                            $age_T = 70; ?>
                            @foreach ($data28 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 65;
                            $age_T = 70; ?>
                            @foreach ($data29 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p>&nbsp;</p>
            <table width="492" height="97" border="0" align="center" cellpadding="0"
                cellspacing="0">
                <tr>
                    <th width="196" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">74-70</span>
                    </th>
                    <th width="296" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" id="anyid5" width="492" height="87" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="73" bgcolor="#91B641">ICD10</th>
                                <th width="219" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 70;
                            $age_T = 75; ?>
                            @foreach ($data30 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 70;
                            $age_T = 75; ?>
                            @foreach ($data31 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p>&nbsp;</p>
            <table width="492" height="97" border="0" align="center" cellpadding="0"
                cellspacing="0">
                <tr>
                    <th width="195" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">79-75</span>
                    </th>
                    <th width="297" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table width="492" height="87" border="1" align="right" cellpadding="0"
                            cellspacing="0" bordercolor="#666666" class="sortable" id="anyid20">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="73" bgcolor="#91B641">ICD10</th>
                                <th width="219" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 75;
                            $age_T = 80; ?>
                            @foreach ($data32 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 75;
                            $age_T = 80; ?>
                            @foreach ($data33 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p></p>
            <table width="492" height="97" border="0" align="center" cellpadding="0"
                cellspacing="0">
                <tr>
                    <th width="195" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">84-80</span>
                    </th>
                    <th width="297" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table width="492" height="87" border="1" align="right" cellpadding="0"
                            cellspacing="0" bordercolor="#666666" class="sortable" id="anyid15">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="73" bgcolor="#91B641">ICD10</th>
                                <th width="219" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 80;
                            $age_T = 85; ?>
                            @foreach ($data34 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 80;
                            $age_T = 85; ?>
                            @foreach ($data35 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p></p>
            <table width="492" height="97" border="0" align="center" cellpadding="0"
                cellspacing="0">
                <tr>
                    <th width="195" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">89-85</span>
                    </th>
                    <th width="297" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table width="492" height="87" border="1" align="right" cellpadding="0"
                            cellspacing="0" bordercolor="#666666" class="sortable" id="anyid18">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="73" bgcolor="#91B641">ICD10</th>
                                <th width="219" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 85;
                            $age_T = 90; ?>
                            @foreach ($data36 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 85;
                            $age_T = 90; ?>
                            @foreach ($data37 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p></p>
            <table width="492" height="97" border="0" align="center" cellpadding="0"
                cellspacing="0">
                <tr>
                    <th width="195" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">94-90</span>
                    </th>
                    <th width="297" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table width="492" height="87" border="1" align="right" cellpadding="0"
                            cellspacing="0" bordercolor="#666666" class="sortable" id="anyid9">
                            <tr>
                                <th width="52" height="30" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="73" bgcolor="#91B641">ICD10</th>
                                <th width="219" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 90;
                            $age_T = 95; ?>
                            @foreach ($data38 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 90;
                            $age_T = 95; ?>
                            @foreach ($data39 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p></p>
            <table width="346" height="97" border="0" align="center" cellpadding="0"
                cellspacing="0">
                <tr>
                    <th width="141" height="31" bgcolor="#91B641" scope="col"><span
                            class="style24">&gt;95</span>
                    </th>
                    <th width="205" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid24" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="31" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="73" bgcolor="#91B641">ICD10</th>
                                <th width="219" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 95;
                            $age_T = 1500; ?>
                            @foreach ($data40 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 95;
                            $age_T = 1500; ?>
                            @foreach ($data41 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p></p>
            <table width="346" height="97" border="0" align="center" cellpadding="0"
                cellspacing="0">
                <tr>
                    <th width="141" height="31" bgcolor="#91B641" scope="col">المجموع</th>
                    <th width="205" bgcolor="#91B641" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <th height="46" colspan="2" scope="col">
                        <table class="sortable" height="87" id="anyid13" width="492" border="1"
                            align="right" cellpadding="0" cellspacing="0" bordercolor="#666666">
                            <tr>
                                <th width="52" height="31" bgcolor="#91B641">
                                    <div align="center">المجموع</div>
                                </th>
                                <th width="58" bgcolor="#91B641">
                                    <div align="center">غير ذلك</div>
                                </th>
                                <th width="35" bgcolor="#91B641">
                                    <div align="center">اناث</div>
                                </th>
                                <th width="41" bgcolor="#91B641">
                                    <div align="center">ذكور</div>
                                </th>
                                <th width="73" bgcolor="#91B641">ICD10</th>
                                <th width="219" bgcolor="#91B641">
                                    <div align="center"><strong>المرض</strong></div>
                                </th>
                            </tr>
                            <?php $age_F = 0;
                            $age_T = 1500; ?>
                            @foreach ($data42 as $key => $entry_first)
                                <tr>
                                    <td>
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_CD']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo $entry_first['ICD_NAME_EN']; ?></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
                <tr>
                    <th height="20" colspan="2" scope="col">
                        <table width="492" border="1" align="right" cellpadding="0" cellspacing="0"
                            bordercolor="#666666">
                            <?php
                            $age_F = 0;
                            $age_T = 1500; ?>
                            @foreach ($data43 as $key => $entry_first)
                                <tr>
                                    <td width="52">
                                        <div align="center"><?php echo $entry_first['TOTAL']; ?></div>
                                    </td>
                                    <td width="58">
                                        <div align="center"><?php echo $entry_first['UNKNOWN']; ?></div>
                                    </td>
                                    <td width="35">
                                        <div align="center"><?php echo $entry_first['FEMALE']; ?></div>
                                    </td>
                                    <td width="41">
                                        <div align="center"><?php echo $entry_first['MALE']; ?></div>
                                    </td>
                                    <td>
                                        <div align="center"><strong>المجموع</strong></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </th>
                </tr>
            </table>
            <p></p>
            <table width="926" border="0" align="center" cellpadding="0" cellspacing="0">

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

</div>
<script>
        function get_Distribution_ICD_Ages() {
            var query = {
                Sex: $('#sex').val(),
                Dead_ID: $('#id').val(),
                Age_From: $('#age_From').val(),
                Age_To: $('#age_To').val(),
                Diag_From: $('#dia_from').val(),
                Diag_To: $('#dia_to').val(),
                Year_From: $('#y_from').val(),
                Year_To: $('#y_to').val(),
                Death_date_frm: $('#d_from').val(),
                Death_date_to: $('#d_to').val(),
                ICD_OPTN: $('#ICD_OPTN').val(),


            }
            var base_url = "{{ URL::to('Report/GET_Distribution_ICD_Ages') }}?" + $.param(query);
            $('#MyModal .modal-body').load(base_url, function() {
                /* load finished, show dialog */
                $('#MyModal').modal('show')
            });
        }
    </script>
