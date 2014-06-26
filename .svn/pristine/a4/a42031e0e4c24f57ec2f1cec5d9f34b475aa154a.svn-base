// JScript source code
function ButtonMouse(){
    var node = document.getElementById("button");
    node.style.color = "#FFAC50";
    node.style.fontWeight = "bold";
    node.style.borderColor = "#FFAC50";
    node.style.borderWidth = "2px";
}
function ButtonMouseOut() {
    var node = document.getElementById("button");
    node.style.color = "#C7C7C7";
    node.style.fontWeight = "normal";
    node.style.borderColor = "#EBEBEB";
    node.style.borderWidth = "1px";
}
function FontStyle(obj) {
    obj.style.color = "#FFAC50";
}
function SpanMouseOut(obj) {
    obj.style.color = "#898989";
}
var xmlHttp;
function creatXMLHttpRequest() {
    if (window.ActiveXObject) {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if (window.XMLHttpRequest) {
        xmlHttp = new XMLHttpRequest();
    }
}
function Check() {
    var str = document.log_form.log_uname.value;
    if (str == null) {
        alert("plase type in the user name");
        return false;
    }
    else if (document.forms[0].elements[1].value == null) {
        alert("请输入密码");
        return false;
    }
    else {
        return true;
    }
}
function httpStatteChange() {
    if (xmlHttp.readyState == 2) {
        window.location.href = "";
    }
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200 || xmlHttp.status == 0) {
            var myXML = xmlHttp.responseXML;
            var IDNode = myXML.getElementsByTagName("uname");
            var ID = document.getElementsById("id");
            ID.firstChild.nodeValue = IDNode.firstChild.nodeValue;
            var sexNode = myXML.getElementsByTagName("sex");
            var Sex = document.getElementsById("sex");
            Sex.fisrtChild.nodeValue = sexNode.firstChild.nodeValue;
            var ChangeNode = document.getElementById("loged-in");
            ChangeNode.style.display = "block";
        }
        else {
            alert("异步调用出错\n返回的HTTP状态码为:" + xmlHttp.status + "/n返回的HTTP状态信息为:" + xmlHttp.statusText);
        }
    }
}
function submit() {
    Check();
    creatXMLHttpRequest();
    if (xmlHttp != null) {
        xmlHttp.open("get", "../网站后台/Log-in.php", true);
        xmlHttp.onreadystatechange = httpStatteChange;
        xmlHttp.send(null);
    }
}