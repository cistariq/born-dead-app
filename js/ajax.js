
function sack(file) {
	this.xmlhttp = null;

	this.resetData = function() {
		this.method = "POST";
  		this.queryStringSeparator = "?";
		this.argumentSeparator = "&";
		this.URLString = "";
		this.encodeURIString = true;
  		this.execute = false;
  		this.element = null;
		this.elementObj = null;
		this.requestFile = file;
		this.vars = new Object();
		this.responseStatus = new Array(2);
  	};

	this.resetFunctions = function() {
  		this.onLoading = function() { };
  		this.onLoaded = function() { };
  		this.onInteractive = function() { };
  		this.onCompletion = function() { };
  		this.onError = function() { };
		this.onFail = function() { };
	};

	this.reset = function() {
		this.resetFunctions();
		this.resetData();
	};

	this.createAJAX = function() {
		try {
			this.xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e1) {
			try {
				this.xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e2) {
				this.xmlhttp = null;
			}
		}

		if (! this.xmlhttp) {
			if (typeof XMLHttpRequest != "undefined") {
				this.xmlhttp = new XMLHttpRequest();
			} else {
				this.failed = true;
			}
		}
	};

	this.setVar = function(name, value){
		this.vars[name] = Array(value, false);
	};

	this.encVar = function(name, value, returnvars) {
		if (true == returnvars) {
			return Array(encodeURIComponent(name), encodeURIComponent(value));
		} else {
			this.vars[encodeURIComponent(name)] = Array(encodeURIComponent(value), true);
		}
	}

	this.processURLString = function(string, encode) {
		encoded = encodeURIComponent(this.argumentSeparator);
		regexp = new RegExp(this.argumentSeparator + "|" + encoded);
		varArray = string.split(regexp);
		for (i = 0; i < varArray.length; i++){
			urlVars = varArray[i].split("=");
			if (true == encode){
				this.encVar(urlVars[0], urlVars[1]);
			} else {
				this.setVar(urlVars[0], urlVars[1]);
			}
		}
	}

	this.createURLString = function(urlstring) {
		if (this.encodeURIString && this.URLString.length) {
			this.processURLString(this.URLString, true);
		}

		if (urlstring) {
			if (this.URLString.length) {
				this.URLString += this.argumentSeparator + urlstring;
			} else {
				this.URLString = urlstring;
			}
		}

		// prevents caching of URLString
		this.setVar("rndval", new Date().getTime());

		urlstringtemp = new Array();
		for (key in this.vars) {
			if (false == this.vars[key][1] && true == this.encodeURIString) {
				encoded = this.encVar(key, this.vars[key][0], true);
				delete this.vars[key];
				this.vars[encoded[0]] = Array(encoded[1], true);
				key = encoded[0];
			}

			urlstringtemp[urlstringtemp.length] = key + "=" + this.vars[key][0];
		}
		if (urlstring){
			this.URLString += this.argumentSeparator + urlstringtemp.join(this.argumentSeparator);
		} else {
			this.URLString += urlstringtemp.join(this.argumentSeparator);
		}
	}

	this.runResponse = function() {
		eval(this.response);
	}

	this.runAJAX = function(urlstring) {
		if (this.failed) {
			this.onFail();
		} else {
			this.createURLString(urlstring);
			if (this.element) {
				this.elementObj = document.getElementById(this.element);
			}
			if (this.xmlhttp) {
				var self = this;
				if (this.method == "GET") {
					totalurlstring = this.requestFile + this.queryStringSeparator + this.URLString;
					this.xmlhttp.open(this.method, totalurlstring, true);
				} else {
					this.xmlhttp.open(this.method, this.requestFile, true);
					try {
						this.xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
					} catch (e) { }
				}

				this.xmlhttp.onreadystatechange = function() {
					switch (self.xmlhttp.readyState) {
						case 1:
							self.onLoading();
							break;
						case 2:
							self.onLoaded();
							break;
						case 3:
							self.onInteractive();
							break;
						case 4:
							self.response = self.xmlhttp.responseText;
							self.responseXML = self.xmlhttp.responseXML;
							self.responseStatus[0] = self.xmlhttp.status;
							self.responseStatus[1] = self.xmlhttp.statusText;

							if (self.execute) {
								self.runResponse();
							}

							if (self.elementObj) {
								elemNodeName = self.elementObj.nodeName;
								elemNodeName.toLowerCase();
								if (elemNodeName == "input"
								|| elemNodeName == "select"
								|| elemNodeName == "option"
								|| elemNodeName == "textarea") {
									self.elementObj.value = self.response;
								} else {
									self.elementObj.innerHTML = self.response;
								}
							}
							if (self.responseStatus[0] == "200") {
								self.onCompletion();
							} else {
								self.onError();
							}

							self.URLString = "";
							break;
					}
				};

				this.xmlhttp.send(this.URLString);
			}
		}
	};

	this.reset();
	this.createAJAX();
}

var xmlhttp;
 // main function for xml object //mk 

function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;

}
/************************************************************************/
function show_data_icd(rcd,type)
{

xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
var url="../Get_Diag_Name.php";
url=url+"?id="+rcd+"&type="+type;

url=url+"&sid="+Math.random();
if (type==1)
xmlhttp.onreadystatechange=show_datastateChangedU1;
else if(type==2){
xmlhttp.onreadystatechange=show_datastateChangedU2;
}
else if(type==3){
xmlhttp.onreadystatechange=show_datastateChangedU3;
}
else if(type==4){
xmlhttp.onreadystatechange=show_datastateChangedU4;
}
else if(type==5){
xmlhttp.onreadystatechange=show_datastateChangedU5;
}
else if(type==6){
xmlhttp.onreadystatechange=show_datastateChangedU6;
}
else if(type==7){
xmlhttp.onreadystatechange=show_datastateChangedU7;
}
else if(type==8){
xmlhttp.onreadystatechange=show_datastateChangedU8;
}
xmlhttp.open("GET",url,true);
xmlhttp.send(null);

}
function show_datastateChangedU1()
{

if (xmlhttp.readyState==4)
  {	
     // alert(xmlhttp.responseText);
	   document.getElementById("dia1").innerHTML=xmlhttp.responseText;
	  
	  
  }

}
function show_datastateChangedU2()
{

if (xmlhttp.readyState==4)
  {	
     // alert(xmlhttp.responseText);
	   document.getElementById("dia2").innerHTML=xmlhttp.responseText;
	  
	  
  }

}
function show_datastateChangedU3()
{

if (xmlhttp.readyState==4)
  {	
     // alert(xmlhttp.responseText);
	   document.getElementById("dia3").innerHTML=xmlhttp.responseText;
	  
	  
  }

}
function show_datastateChangedU4()
{

if (xmlhttp.readyState==4)
  {	
     // alert(xmlhttp.responseText);
	   document.getElementById("dia4").innerHTML=xmlhttp.responseText;
	  
	  
  }

}
function show_datastateChangedU5()
{

if (xmlhttp.readyState==4)
  {	
     // alert(xmlhttp.responseText);
	   document.getElementById("dia5").innerHTML=xmlhttp.responseText;
	  
	  
  }

}
function show_datastateChangedU6()
{

if (xmlhttp.readyState==4)
  {	
     // alert(xmlhttp.responseText);
	   document.getElementById("dia6").innerHTML=xmlhttp.responseText;
	  
	  
  }

}
function show_datastateChangedU7()
{

if (xmlhttp.readyState==4)
  {	
     // alert(xmlhttp.responseText);
	   document.getElementById("dia7").innerHTML=xmlhttp.responseText;
	  
	  
  }

}
function show_datastateChangedU8()
{

if (xmlhttp.readyState==4)
  {	
     // alert(xmlhttp.responseText);
	   document.getElementById("dia8").innerHTML=xmlhttp.responseText;
	  
	  
  }

}
function show_data_job(rcd)
{

xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
var url="../get_job_name.php";
url=url+"?id="+rcd;

url=url+"&sid="+Math.random();

xmlhttp.onreadystatechange=show_datastateChangedU_job;

xmlhttp.open("GET",url,true);
xmlhttp.send(null);

}
function show_datastateChangedU_job()
{

if (xmlhttp.readyState==4)
  {	
     // alert(xmlhttp.responseText);
	   document.getElementById("job1").innerHTML=xmlhttp.responseText;
	  
	  
  }

}
/************************************************************************/

function confirm_dead_record(rcd)
{

xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
var url="../confirmed_dead.php";
url=url+"?cod="+rcd;

url=url+"&sid="+Math.random();

xmlhttp.onreadystatechange=show_datastateChangedConfirm_dead;

xmlhttp.open("GET",url,true);
xmlhttp.send(null);

}
function show_datastateChangedConfirm_dead()
{

if (xmlhttp.readyState==4)
  {	
     
	  alert(xmlhttp.responseText);
	   //document.getElementById("job1").innerHTML=xmlhttp.responseText;
	  
	  
  }

}

function update_dead_stat(rcd,s,ucod)
{

xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
var url="../update_dead_status.php";
url=url+"?cod="+rcd+"&st="+s+"&usr_cod="+ucod;

url=url+"&sid="+Math.random();

xmlhttp.onreadystatechange=show_datastateChangedUpd_dead;

xmlhttp.open("GET",url,true);
xmlhttp.send(null);

}
function show_datastateChangedUpd_dead()
{

if (xmlhttp.readyState==4)
  {	
     
	 // alert(xmlhttp.responseText);
	   //document.getElementById("job1").innerHTML=xmlhttp.responseText;
	  
	  return xmlhttp.responseText;
  }

}

/************************************************************************/
function check_id_F(cid,ctype)
{
         //alert('NAREEN');
	//var checked_dead = document.getElementById('dead_committee').value
	//alert(checked_dead);
	/*if (document.getElementById('MARTYRES').checked)
		var dead_type = document.getElementById('MARTYRES').value;

	if (document.getElementById('DEAD').checked)
		var dead_type = document.getElementById('DEAD').value;*/

	//alert(dead_type);

	xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
   
	var url="../Get_Check_Id_Found.php";
	url=url+"?id="+cid+"&type="+ctype;
	//url=url+"?id="+cid+"&type="+ctype+"&dead_type="+dead_type;


url=url+"&sid="+Math.random();

xmlhttp.onreadystatechange=show_datastateChangedIDF;


xmlhttp.open("GET",url,true);
xmlhttp.send(null);

}
function show_datastateChangedIDF()
{

if (xmlhttp.readyState==4)
  {	
//alert('NA');

	if (document.getElementById('dead_committee').checked)
		{
			var checked_dead = document.getElementById('dead_committee').value
		}
		
		//alert(checked_dead);
		var x=xmlhttp.responseText;
			const is_exist =x.substring(2);
		//alert(is_exist);
		
		
		document.getElementById("FOUND_YES").value=x.charAt(0); // By Nareen
		
		if(checked_dead == 2){
			document.getElementById("SOURCE").value = 2;
			//alert('nnn');
		}
		else{
	
			document.getElementById("SOURCE").value=0; // By Nareen  //وفاة عادية
		//alert(is_exist);
		
		if(is_exist == '2')
		{
			document.getElementById("SOURCE").value=1; // شهيد
			$("DEAD_MARTYRES").show();
			$("DEAD_MARTYRES1").hide();
			$("DEAD_MARTYRES2").hide();
			document.getElementById("submit").disabled = false;
			$("submit").show();
			 // document.getElementById("SOURCE_LABEl").value= 'شهيد معتمد' ;
		}
		else if(is_exist == '1')
			{
				document.getElementById("SOURCE").value=2; // غير معتمد تبليغ ذوي الشهداء
				$("DEAD_MARTYRES2").show();
				$("DEAD_MARTYRES1").hide();
				$("DEAD_MARTYRES").hide();
				  document.getElementById("submit").disabled = true;
				$("submit").hide();

				 // document.getElementById("SOURCE_LABEl").value= 'شهيد غير معتمد' ;
			}
		
		else{
			$("DEAD_MARTYRES1").show();
			$("DEAD_MARTYRES").hide();
			$("DEAD_MARTYRES2").hide();
			document.getElementById("SOURCE").value=0;
			document.getElementById("submit").disabled = false;
			$("submit").show();


		}
	
		}
		
					
			 
	  }
	
	}

/************************************************************************/
function check_id_D(cid)
{
	//alert('Nareen');


xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
   
var url="../Get_Check_Id.php";
url=url+"?id="+cid;

url=url+"&sid="+Math.random();

xmlhttp.onreadystatechange=show_datastateChangedIDD;


xmlhttp.open("GET",url,true);
xmlhttp.send(null);

}
function show_datastateChangedIDD()
{

if (xmlhttp.readyState==4)
  {	
	  
	  var x=xmlhttp.responseText;
	  
	 	 document.getElementById('CH').value=x.substring(0,1);
	 var y=x.substring(1);
	
	 if (y!=0){
		document.getElementById('DEAD_ID').value=y;
		
	 }
	// alert(y);
	//  alert(document.getElementById('CH').value);
	 if (document.getElementById('CH').value=="0"){ 
		alert('رقم هوية خاطئ'); 
		
		}else { getDeadData(document.getElementById('DEAD_ID').value);}
	  
  }

}
/***************************************/
function check_id_D_follw(cid,type)
{

xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
   
var url="../Get_Check_Id.php";
url=url+"?id="+cid;

url=url+"&sid="+Math.random();

if (type==1)
xmlhttp.onreadystatechange=show_datastateChangedIDPart;
else if (type==2)
xmlhttp.onreadystatechange=show_datastateChangedIDSub;


xmlhttp.open("GET",url,true);
xmlhttp.send(null);

}
function show_datastateChangedIDPart()
{

if (xmlhttp.readyState==4)
  {	
	  
	  var x=xmlhttp.responseText;
	  
	 	 document.getElementById('CH1').value=x.substring(0,1);
	 var y=x.substring(1);
		
	 if (y!=0){
		document.getElementById('DEAD_D_PARTNER_ID').value=y;
		
	 }
	// alert(y);
	//  alert(document.getElementById('CH').value);
	 if (document.getElementById('CH1').value=="0"){ 
		alert('رقم هوية خاطئ'); 
		document.getElementById('DEAD_D_PARTNER_ID').value='';
		}else { getpartnerData(document.getElementById('DEAD_D_PARTNER_ID').value);}
	  
  }

}
function show_datastateChangedIDSub()
{

if (xmlhttp.readyState==4)
  {	
	  
	  var x=xmlhttp.responseText;
	  
	 	 document.getElementById('CH2').value=x.substring(0,1);
	 var y=x.substring(1);
		
	 if (y!=0){
		document.getElementById('DEAD_REPORT_SUBMITTED_ID').value=y;
		
	 }
	// alert(y);
	//  alert(document.getElementById('CH').value);
	 if (document.getElementById('CH2').value=="0"){ 
		alert('رقم هوية خاطئ'); 
		document.getElementById('DEAD_REPORT_SUBMITTED_ID').value='';
		
		}else { getSubmittedData(document.getElementById('DEAD_REPORT_SUBMITTED_ID').value);}
	  
  }

}
/********************************************/
function check_id1(cid,type)
{

xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
 
var url="../Get_Check_Id.php";
url=url+"?id="+cid;

url=url+"&sid="+Math.random();
if (type==1)
xmlhttp.onreadystatechange=show_datastateChangedID_father;

else if(type==2)
xmlhttp.onreadystatechange=show_datastateChangedID_mother;
else if(type==3)
xmlhttp.onreadystatechange=show_datastateChangedID_born;
else if(type==4)
xmlhttp.onreadystatechange=show_datastateChangedID_born1;
else if(type==5)
xmlhttp.onreadystatechange=show_datastateChangedID_born2;
else if(type==6)
xmlhttp.onreadystatechange=show_datastateChangedID_born3;
else if(type==7)
xmlhttp.onreadystatechange=show_datastateChangedID_DEAD;
else if(type==8) 
xmlhttp.onreadystatechange=show_datastateChangedID_PARTNER
else if(type==9) 
xmlhttp.onreadystatechange=show_datastateChangedID_REPORTER

xmlhttp.open("GET",url,true);
xmlhttp.send(null);

}
function show_datastateChangedID_father()
{

if (xmlhttp.readyState==4)
  {	
	  //document.getElementById("id1").innerHTML=xmlhttp.responseText;
	    document.getElementById('FATHER_ID').readOnly=false;
		document.getElementById('FATHER_FIRST_NAME_AR').readOnly=false;
		document.getElementById('FATHER_FATHER_NAME_AR').readOnly=false;
		document.getElementById('FATHER_GRANDFATHER_NAME_AR').readOnly=false;
		document.getElementById('FATHER_LAST_NAME_AR').readOnly=false;
		document.getElementById('FATHER_BIRTH_PLACE').readOnly=false;
		document.getElementById('FATHER_DOB').readOnly=false;
	    document.getElementById('FATHER_ID').value='';
		document.getElementById('FATHER_FIRST_NAME_AR').value='';
		document.getElementById('FATHER_FATHER_NAME_AR').value='';
		document.getElementById('FATHER_GRANDFATHER_NAME_AR').value='';
		document.getElementById('FATHER_LAST_NAME_AR').value='';
		document.getElementById('FATHER_BIRTH_PLACE').value='';
		//document.getElementById('FATHER_FATHER_BIRTH_PLACE').value='';
	   // document.getElementById('FATHER_JOB').value='';
		document.getElementById('FATHER_DOB').value='';
		//document.getElementById('FATHER_YEAR_OF_EDUCATION').value='';
		//document.getElementById('FATHER_FATHER_BIRTH_PLACE').value='';
		
	
	  var x=xmlhttp.responseText;
	 	 document.getElementById('CH').value=x.substring(0,1);
	 var y=x.substring(1);
	
	 if (y!=0){
		document.getElementById('FATHER_ID').value=y;
	 }
	 //alert(y);
	 if (document.getElementById('CH').value=="0"){ 
		alert('رقم هوية خاطئ'); 
		
		}else { getFatherData(document.getElementById('FATHER_ID').value);}
	  
  }

}
function show_datastateChangedID_mother()
{

if (xmlhttp.readyState==4)
  {	
  
  document.getElementById('MOTHER_ID').readOnly=false;
		document.getElementById('MOTHER_FIRST_NAME_AR').readOnly=false;
		document.getElementById('MOTHER_FATHER_NAME_AR').readOnly=false;
		document.getElementById('MOTHER_GRANDMOTHER_NAME_AR').readOnly=false;
		document.getElementById('MOTHER_LAST_NAME_AR').readOnly=false;
		
		document.getElementById('MOTHER_BIRTH_PLACE').readOnly=false;
		document.getElementById('MOTHER_BIRTH_PLACE').disable=false;
		document.getElementById('MOTHER_DOB').readOnly=false;
  document.getElementById('MOTHER_ID').value='';
		document.getElementById('MOTHER_FIRST_NAME_AR').value='';
		document.getElementById('MOTHER_FATHER_NAME_AR').value='';
		document.getElementById('MOTHER_GRANDMOTHER_NAME_AR').value='';
		document.getElementById('MOTHER_LAST_NAME_AR').value='';
		document.getElementById('MOTHER_BIRTH_PLACE').value='';
		//document.getElementById('MOTHER_FATHER_BIRTH_PLACE').value='';
		//document.getElementById('MOTHER_JOB').value='';
		document.getElementById('MOTHER_DOB').value='';
		//document.getElementById('MOTHER_YEAR_OF_EDUCATION').value='';
		//document.getElementById('MOTHER_TEL').value='';
		//document.getElementById('MOTHER_FAMILY_NAME').value='';
	  //document.getElementById("id2").innerHTML=xmlhttp.responseText;
	   var x=xmlhttp.responseText;
	 document.getElementById('CH1').value=x.substring(0,1);
	 var y=x.substring(1);
	  if (y!=0){
		document.getElementById('MOTHER_ID').value=y;
	 }
	 if (document.getElementById('CH1').value=="0"){ 
		alert('رقم هوية خاطئ'); 
		
		}else getMotherData(document.getElementById('MOTHER_ID').value);
	  
  }

}
function show_datastateChangedID_born()
{

if (xmlhttp.readyState==4)
  {	
	  document.getElementById("id3").innerHTML=xmlhttp.responseText;
	  //alert(xmlhttp.responseText); 
	  var x=xmlhttp.responseText;
	  var y=x.substring(0,1);
	  var z=x.substring(1);
	   if (z!=0){
		document.getElementById('BI_ID').value=z;
		
	 }
	// document.getElementById('CH2').value=xmlhttp.responseText;
	//alert(document.getElementById('CH2').value); 
	 if (y=="0"){ 
		alert('رقم هوية خاطئ'); 
		document.getElementById('BI_ID').value='';
		
		}
	  
  }

}
function show_datastateChangedID_born1()
{

if (xmlhttp.readyState==4)
  {	
	  //document.getElementById("id4").innerHTML=xmlhttp.responseText;
	  //alert(xmlhttp.responseText); 
	  var x=xmlhttp.responseText;
	  var y=x.substring(0,1);
	  var z=x.substring(1);
	   if (z!=0){
		document.getElementById('born_Id').value=z;
		
	 }
	// document.getElementById('CH2').value=xmlhttp.responseText;
	//alert(document.getElementById('CH2').value); 
	 if (y=="0"){ 
		alert('رقم هوية خاطئ'); 
		document.getElementById('born_Id').value='';
		
		}
	  
  }

}
function show_datastateChangedID_born2()
{

if (xmlhttp.readyState==4)
  {	
	  //document.getElementById("id5").innerHTML=xmlhttp.responseText;
	  //alert(xmlhttp.responseText); 
	  var x=xmlhttp.responseText;
	  var y=x.substring(0,1);
	  var z=x.substring(1);
	   if (z!=0){
		document.getElementById('father_Id').value=z;
		
	 }
	// document.getElementById('CH2').value=xmlhttp.responseText;
	//alert(document.getElementById('CH2').value); 
	 if (y=="0"){ 
		alert('رقم هوية خاطئ'); 
		document.getElementById('father_Id').value='';
		
		}
	  
  }

}
function show_datastateChangedID_born3()
{

if (xmlhttp.readyState==4)
  {	
	  //document.getElementById("id5").innerHTML=xmlhttp.responseText;
	  //alert(xmlhttp.responseText); 
	  var x=xmlhttp.responseText;
	  var y=x.substring(0,1);
	  var z=x.substring(1);
	   if (z!=0){
		document.getElementById('mother_Id').value=z;
		
	 }
	// document.getElementById('CH2').value=xmlhttp.responseText;
	//alert(document.getElementById('CH2').value); 
	 if (y=="0"){ 
		alert('رقم هوية خاطئ'); 
		document.getElementById('mother_Id').value='';
		
		}
	  
  }

}
/*************************************************************/
function show_datastateChangedID_DEAD()
{

if (xmlhttp.readyState==4)
  {	
	   
	  var x=xmlhttp.responseText;
	  var y=x.substring(0,1);
	  var z=x.substring(1);
	
	   if (z!=0){
		document.getElementById('DEAD_ID').value=z;
		
	 }
	
	 if (y=="0"){ 
		alert('رقم هوية خاطئ'); 
		document.getElementById('DEAD_ID').value='';
		
		}
	  
  }

}
function show_datastateChangedID_PARTNER()
{

if (xmlhttp.readyState==4)
  {	
	   
	  var x=xmlhttp.responseText;
	  var y=x.substring(0,1);
	  var z=x.substring(1);
	   if (z!=0){
		document.getElementById('DEAD_D_PARTNER_ID').value=z;
		
	 }
	
	 if (y=="0"){ 
		alert('رقم هوية خاطئ'); 
		document.getElementById('DEAD_D_PARTNER_ID').value='';
		
		}
	  
  }

}

function show_datastateChangedID_REPORTER()
{

if (xmlhttp.readyState==4)
  {	
	   
	  var x=xmlhttp.responseText;
	  var y=x.substring(0,1);
	  var z=x.substring(1);
	   if (z!=0){
		document.getElementById('DEAD_REPORT_SUBMITTED_ID').value=z;
		
	 }
	
	 if (y=="0"){ 
		alert('رقم هوية خاطئ'); 
		document.getElementById('DEAD_REPORT_SUBMITTED_ID').value='';
		
		}
	  
  }

}

function check_dead_found(cid)
{
    //alert(cid);
    xmlhttp=GetXmlHttpObject();

    if (xmlhttp==null)
    {
        alert ("Browser does not support HTTP Request");

        return;
    }

    var url="../DEAD_FOUND_IN_DB.php";
    url=url+"?id="+cid;

    url=url+"&sid="+Math.random();

        xmlhttp.onreadystatechange=show_if_dead_is_found;
    xmlhttp.open("GET",url,true);
    xmlhttp.send(null);

}
function show_if_dead_is_found()
{

    if (xmlhttp.readyState==4)
    {

        var x=xmlhttp.responseText;
       // alert(x);
        if (x!=0){
            document.getElementById('is_found').value=x;

        }




    }

}

function show_dead_name()
{

    if (xmlhttp.readyState==4)
    {

        var xx=xmlhttp.responseText;
      //  alert(x);
        if (xx!=''){
            document.getElementById('d_name').value=xx;

        }




    }

}
/*************************************************************/
function show_data_user(rcd)
{

var i=0,x=0,y=0;
xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
var url="../Get_User_Name.php";
url=url+"?id="+rcd;

url=url+"&sid="+Math.random();

xmlhttp.onreadystatechange=show_datastateChangedU;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);

}
function show_datastateChangedU()
{

if (xmlhttp.readyState==4)
  {	
   //alert(xmlhttp.responseText);
	  document.getElementById("user1").innerHTML=xmlhttp.responseText;
	 
	  
  }

}
/************************************************************************/

function show_data(rcd,pic)
{
var i=0,x=0,y=0;
xmlhttp=GetXmlHttpObject();

$(pic).show();
//alert('dfsfsdf');
if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
var url="../Get_City_Name.php";
url=url+"?id="+rcd+" &pic="+pic;

url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=show_datastateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
$(pic).hide();
}
function show_datastateChanged()
{

if (xmlhttp.readyState==4)
  {	  
	  //alert(xmlhttp.responseText);
	  document.getElementById("ahmed").innerHTML=xmlhttp.responseText;
	  
	  
  }

}
function show_dataD(rcd,type)
{

xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
var url="../Get_City_Name_D.php";
url=url+"?id="+rcd+"&type="+type;

url=url+"&sid="+Math.random();
 if (type==1)
xmlhttp.onreadystatechange=show_datastateChangedD;
 else if (type==2)
 xmlhttp.onreadystatechange=show_datastateChangedD3;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);

}
function show_datastateChangedD()
{

if (xmlhttp.readyState==4)
  {	  
	  //alert(xmlhttp.responseText);
	 
	  document.getElementById("city").innerHTML=xmlhttp.responseText;
	
	  
	  
  }

}
function show_datastateChangedD3()
{

if (xmlhttp.readyState==4)
  {	  
	  //alert(xmlhttp.responseText);
	
		document.getElementById("city_death").innerHTML=xmlhttp.responseText;  
	  
	  
  }

}

////////////////////////////////////////////////////


function show_dataD2(rcd)
{

xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
var url="../Get_Hos_NameD.php";
url=url+"?id="+rcd;

url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=show_datastateChangedD2;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);

}
function show_datastateChangedD2()
{

if (xmlhttp.readyState==4)
  {	  
	  //alert(xmlhttp.responseText);
	  document.getElementById("cityD").innerHTML=xmlhttp.responseText;
	  
	  
  }

}
function show_dataD_visibility(rcd)
{
	
		 
xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
var url="../Get_Death_Details.php";
url=url+"?id="+rcd;

url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=show_datastateChangedD_visibility;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
	
}
function show_datastateChangedD_visibility()
{

if (xmlhttp.readyState==4)
  {	  
	  //alert(xmlhttp.responseText);
	  document.getElementById("d_details").innerHTML=xmlhttp.responseText;
	  
	  
  }

}
/////////////////////////////////////////////////
function show_dataF(rcd)
{
var i=0,x=0,y=0;
xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
var url="../Get_City_NameF.php";
url=url+"?id="+rcd;

url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=show_datastateChangedF;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);

}
function show_datastateChangedF()
{

if (xmlhttp.readyState==4)
  {	  
	  document.getElementById("city1").innerHTML=xmlhttp.responseText;
	  //alert(xmlhttp.responseText);
	  
  }

}
function show_dataM(rcd)
{
var i=0,x=0,y=0;
xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  
  return;
  }
var url="../Get_City_NameM.php";
url=url+"?id="+rcd;

url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=show_datastateChangedM;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);

}
function show_datastateChangedM()
{

if (xmlhttp.readyState==4)
  {	  
	  document.getElementById("city2").innerHTML=xmlhttp.responseText;
	  //alert(xmlhttp.responseText);
	  
  }

}
/************************************************************************/
function show_city(rcd)
{
var i=0,x=0,y=0;
xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return;
  }
var url="../Data_Entry/Get_City_Name.php";
url=url+"?id="+rcd;

url=url+"&sid="+Math.random();
//alert(url);
xmlhttp.onreadystatechange=show_citystateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}
function show_citystateChanged()
{

if (xmlhttp.readyState==4)
  {
	  
	  document.getElementById("city").innerHTML=xmlhttp.responseText;
	  //alert(xmlhttp.responseText);
	
  }

}
/*****************************************************************************/
function show_m_city(rcd)
{
var i=0,x=0,y=0;
xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return;
  }
var url="../Data_Entry/Get_m_City_Name.php";
url=url+"?id="+rcd;

url=url+"&sid="+Math.random();
//alert(url);
xmlhttp.onreadystatechange=show_m_citystateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}
function show_m_citystateChanged()
{

if (xmlhttp.readyState==4)
  {
	  
	  document.getElementById("m_city").innerHTML=xmlhttp.responseText;
	 // alert(xmlhttp.responseText);
	
  }

}
/*****************************************************************************/

function show_city_admin(rcd)
{
var i=0,x=0,y=0;
xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return;
  }
var url="../Admin/Get_City_Name.php";
url=url+"?id="+rcd;

url=url+"&sid="+Math.random();
//alert(url);
xmlhttp.onreadystatechange=show_citystateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}
function show_citystateChanged()
{

if (xmlhttp.readyState==4)
  {
	  
	  document.getElementById("city").innerHTML=xmlhttp.responseText;
	  //alert(xmlhttp.responseText);
	
  }

}
/************************************************************************/

function show_m_city_admin(rcd)
{
var i=0,x=0,y=0;
xmlhttp=GetXmlHttpObject();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return;
  }
var url="../Admin/Get_m_City_Name.php";
url=url+"?id="+rcd;

url=url+"&sid="+Math.random();
//alert(url);
xmlhttp.onreadystatechange=show_m_citystateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}
function show_m_citystateChanged()
{

if (xmlhttp.readyState==4)
  {
	  
	  document.getElementById("m_city").innerHTML=xmlhttp.responseText;
	 // alert(xmlhttp.responseText);
	
  }

}
/********************/


// by Nareen 23/06/2023

	function show_data_icd_name(rcd,type)
	{
		//alert('Nareen');
		xmlhttp=GetXmlHttpObject();

		if (xmlhttp==null)
		{
		alert ("Browser does not support HTTP Request");
		
		return;
		}
		var url="../Get_Diag_ICD.php";
		url=url+"?id="+rcd+"&type="+type;

		url=url+"&sid="+Math.random();
		if (type==1)
		xmlhttp.onreadystatechange=show_datastateChangedU11;
		else if(type==2){
		xmlhttp.onreadystatechange=show_datastateChangedU22;
		}
		else if(type==3){
		xmlhttp.onreadystatechange=show_datastateChangedU33;
		}
		else if(type==4){
		xmlhttp.onreadystatechange=show_datastateChangedU44;
		}
		else if(type==5){
		xmlhttp.onreadystatechange=show_datastateChangedU55;
		}
		else if(type==6){
		xmlhttp.onreadystatechange=show_datastateChangedU66;
		}
		else if(type==7){
		xmlhttp.onreadystatechange=show_datastateChangedU77;
		}
		else if(type==8){
		xmlhttp.onreadystatechange=show_datastateChangedU88;
		}
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);

	}
	function show_datastateChangedU11()
	{

	if (xmlhttp.readyState==4)
	{	
		//alert(xmlhttp.responseText);
		document.getElementById("dia1").innerHTML=xmlhttp.responseText;
		
		
	}

	}
	function show_datastateChangedU22()
	{

	if (xmlhttp.readyState==4)
	{	
		// alert(xmlhttp.responseText);
		document.getElementById("dia2").innerHTML=xmlhttp.responseText;
		
		
	}

	}
	function show_datastateChangedU33()
	{

	if (xmlhttp.readyState==4)
	{	
		// alert(xmlhttp.responseText);
		document.getElementById("dia3").innerHTML=xmlhttp.responseText;
		
		
	}

	}
	function show_datastateChangedU44()
	{

	if (xmlhttp.readyState==4)
	{	
		// alert(xmlhttp.responseText);
		document.getElementById("dia4").innerHTML=xmlhttp.responseText;
		
		
	}

	}
	function show_datastateChangedU55()
	{

	if (xmlhttp.readyState==4)
	{	
		// alert(xmlhttp.responseText);
		document.getElementById("dia5").innerHTML=xmlhttp.responseText;
		
		
	}

	}
	function show_datastateChangedU66()
	{

	if (xmlhttp.readyState==4)
	{	
		// alert(xmlhttp.responseText);
		document.getElementById("dia6").innerHTML=xmlhttp.responseText;
		
		
	}

	}
	function show_datastateChangedU77()
	{

	if (xmlhttp.readyState==4)
	{	
		// alert(xmlhttp.responseText);
		document.getElementById("dia7").innerHTML=xmlhttp.responseText;
		
		
	}

	}
	function show_datastateChangedU88()
	{

	if (xmlhttp.readyState==4)
	{	
		// alert(xmlhttp.responseText);
		document.getElementById("dia8").innerHTML=xmlhttp.responseText;
		
		
	}

	}
