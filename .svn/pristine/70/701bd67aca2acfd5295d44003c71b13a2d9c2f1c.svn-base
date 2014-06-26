function GetSearchResult(str){
	var xmlhttp;
	xmlhttp=GetXmlHttpObject();
	if(xmlhttp==null){
	alert("您的浏览器不支持AJAX！");
        return;
	}
	var url="Search.php";
	url = url + "?keyword=" + str + "&sid=" + Math.random();
	
	xmlhttp.onreadystatechange = function () {
		
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			
            xmlDoc = xmlhttp.responseXML;
			
			alert(xmlDoc);
            document.getElementById("good1").span.innerHTML = xmlDoc.getElementsByTagName("good1").childNodes[0].childNodes[0].nodeValue;
			
        }
    }
	
    xmlhttp.open("GET", url, true);
	
    xmlhttp.send(null);  
}
function GetXmlHttpObject() {
    var xmlHttp = null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    }
    catch (e) {
        // Internet Explorer
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}