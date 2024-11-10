@extends('layouts.main')
@section('title', 'المسح الضوئي لاشعار الوفاة')

@section('content')


    <style>
        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                right: 0;
                top: 0;
            }
        }

        td {

            padding-top: 1px;
            padding-bottom: 1px;
            border: solid black;
            border-width: thin;
        }

        th {

            padding-top: 1px;
            padding-bottom: 1px;
            text-align: center;

        }

        .style9 {
            font-family: "Times New Roman", Times, serif;
            font-size: 18px;
        }

        .style10 {
            font-size: 16px;
            font-weight: bold;
        }

        .style11 {
            color: #FF0000;
            font-weight: bold;
            font-size: 18px;
        }

        #jsEnabled table tr td table tr td table tr .body_txt p strong {
            color: #F00;
        }
    </style>

<script type="text/javascript" src="{{ asset('assets/js/ajax.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/ajax-dynamic-list_D.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('assets/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118') }} "></script>
<script type="text/javascript" src="{{ asset('assets/js/Resources2/dynamsoft.webtwain.initiate.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/Resources2/dynamsoft.webtwain.config.js') }}"></script>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
<meta name="description" content="Health care website">
<meta name="keywords" content="health, care, healthcare">
<link type="text/css" rel="stylesheet"
    href="{{ asset('assets/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112') }}" media="screen">
    <div id="jsEnabled">
        <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td height="1" valign="top">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="1">&nbsp;</td>
                            <td width="100%" align="center" background="{{ asset('assets/media/images/menu-bg.gif') }}">
                                &nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="100%" valign="top">
                    <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="1" valign="top">&nbsp;</td>
                            <td height="100%" valign="top">
                                <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td bgcolor="#ddd1b6">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="1"><img
                                                            src="{{ asset('assets/media/images/logo.gif') }}" width="83"
                                                            height="79"></td>
                                                    <td width="1" valign="top">
                                                        <table width="100%" border="0" cellspacing="0"
                                                            cellpadding="0">
                                                            <tr>
                                                                <td><img src="{{ asset('assets/media/images/spacer.gif') }}"
                                                                        alt="" width="1" height="9"></td>
                                                            </tr>
                                                            <tr>
                                                                <td
                                                                    background="{{ asset('assets/media/images/cname-bg.gif') }}">
                                                                    <table width="100%" border="0" cellspacing="0"
                                                                        cellpadding="0">
                                                                        <tr>
                                                                            <td width="1"><img
                                                                                    src="{{ asset('assets/media/images/spacer.gif') }}"
                                                                                    width="10" height="41"></td>
                                                                            <td class="c_name">وزارة الصحة الفلسطينية
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="{{ asset('assets/media/images/spacer.gif') }}"
                                                                        width="249" height="1"></td>
                                                            </tr>
                                                            <tr>
                                                                <td background="{{ asset('assets/media/images/cname-bg.gif') }}"
                                                                    class="bgy">
                                                                    <img src="{{ asset('assets/media/images/spacer.gif') }}"
                                                                        width="1" height="19">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><img src="{{ asset('assets/media/images/spacer.gif') }}"
                                                                        width="1" height="9"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td background="{{ asset('assets/media/images/logo_rbg.gif') }}"
                                                        class="bgx">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td background="{{ asset('assets/media/images/welcome-bg.gif') }}">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="1"><img
                                                            src="{{ asset('assets/media/images/welcome-bg.gif') }}"
                                                            width="1" height="31"></td>
                                                    <td width="745" class="welcome"><a href="">تسجيل
                                                            الخروج</a></td>
                                                    <td width="225" class="welcome">
                                                        <div align="right"><strong>الوفيات</strong></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="body_txt">
                                            <table width="200" border="0" align="center" cellpadding="0"
                                                cellspacing="0">
                                                <tr>
                                                    <td>
                                                        <div align="center"><a href=""><strong>لوحة
                                                                    التحكم</strong></a></div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <p></p>


                                            <table width="721" border="0" align="center" cellpadding="0"
                                                cellspacing="0">

                                                <tr>
                                                    <td>
                                                        <div align="right">
                                                        </div>
                                                    </td>
                                                    <td width="91">
                                                        <div align="right"><strong> :أهلا وسهلا بك</strong></div>
                                                    </td>
                                                </tr>
                                                <input id="ucode" type="hidden" value="" />


                                            </table>
                                            <p></p>
                                            <table width="1066" border="0" align="center" cellpadding="0"
                                                cellspacing="0">
                                                <tr>
                                                    <td width="137" align="right"><a href=""
                                                            onclick=""><strong>مسح البيانات</strong></a>
                                                        <input name="clear" type="button" id="clear"
                                                            onclick="" value="جديد" />
                                                    </td>

                                                    <td width="80">
                                                        <div align="left">
                                                            <label></label>

                                                            <input id="is_found" type="hidden" value="0" />
                                                            <input name="scan" type="button" id="scan"
                                                                tabindex="69" onclick=" " value="مسح ضوئي" /><input
                                                                type="hidden" name="scan_yes" id="scan_yes"
                                                                value="0" />
                                                        </div>
                                                    </td>
                                                    <td width="148"><select name="source" size="1"
                                                            id="source" style="position:relative;width:146px"
                                                            onChange="source_onchange()">

                                                        </select></td>
                                                    <td width="145"><label for = 'ShowUI'><input type='checkbox'
                                                                id='ShowUI' checked />ShowUI&nbsp;</label>


                                                        <label for = 'ADF'><input type='checkbox' id='ADF'
                                                                checked ?>/>ADF&nbsp;</label>
                                                    </td>
                                                    <td width="148">
                                                        <label for = 'Duplex'><input type='checkbox' id='Duplex'
                                                                checked />Duplex&nbsp;</label>
                                                        <label for = 'Color'><input type='checkbox' id='Color'
                                                           checked />Color&nbsp;</label>
                                                    </td>
                                                    <td width="188"><input align="center" id="d_name"
                                                            style="width: 175px" disabled /></td>
                                                    <td width="144"><input type="text" name="DEAD_ID"
                                                            id="DEAD_ID" onChange="get_dead_name(this.value);" />
                                                    </td>
                                                    <td width="76">
                                                        <div align="right"><strong>:رقم الوثيقة</strong></div>
                                                    </td>
                                                </tr>
                                            </table>


                                            <p align="center">


                                            <table width="778" height="1048" border="0" align="center"
                                                cellpadding="0" cellspacing="0">




                                                <table width="1040" border="0" align="center" cellpadding="0"
                                                    cellspacing="0">
                                                    <tr>
                                                        <td>
                                                            <div align="center">

                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </table>
                                            </p>

                                        </td>
                                    </tr>

                                </table>
                            </td>
                            <td height="100%" valign="top">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="1" valign="top" background="{{ asset('assets/media/images/bot-bg.gif') }}"
                    class="bgx">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="address">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
@endsection
{{-- @push('scripts')

<script>
//     function get_dead_name(cid)
// {
//     //alert(cid);
//     xmlhttp=GetXmlHttpObject();

//     if (xmlhttp==null)
//     {
//         alert ("Browser does not support HTTP Request");

//         return;
//     }

//     var url="../Get_dead_name.php";
//     url=url+"?id="+cid;

//     url=url+"&sid="+Math.random();

//         xmlhttp.onreadystatechange=show_dead_name;
//     xmlhttp.open("GET",url,true);
//     xmlhttp.send(null);

// }

</script> --}}
