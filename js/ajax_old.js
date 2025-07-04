
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
function show_data(rcd,pic)
{
var i=0,x=0,y=0;
xmlhttp=GetXmlHttpObject();
$(pic).show();

if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return;
  }
var url="../Get_City_Name.php";
url=url+"?id="+rcd+"&pic="+pic;

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
	  document.getElementById("ahmed").innerHTML=xmlhttp.responseText;
	 // alert(xmlhttp.responseText);	
  }

}
/****************************************/
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
/******************************************/
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

