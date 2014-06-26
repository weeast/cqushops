// JScript source code
function ButtonMouse() {
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
function MidButtonOn1(obj) {
    obj.style.backgroundImage = "url(img/button/1.gif)"
}
function MidButtonOut1(obj) {
    obj.style.backgroundImage = "url(img/button/1-1.gif)";
}
function MidButtonOn2(obj) {
    obj.style.backgroundImage = "url(img/button/2.gif)"
}
function MidButtonOut2(obj) {
    obj.style.backgroundImage = "url(img/button/2-1.gif)";
}
function MidButtonOn3(obj) {
    obj.style.backgroundImage = "url(img/button/3.gif)"
}
function MidButtonOut3(obj) {
    obj.style.backgroundImage = "url(img/button/3-1.gif)";
}
function MidButtonOn4(obj) {
    obj.style.backgroundImage = "url(img/button/4.gif)"
}
function MidButtonOut4(obj) {
    obj.style.backgroundImage = "url(img/button/4-1.gif)";
}
function MidButtonOn5(obj) {
    obj.style.backgroundImage = "url(img/button/5.gif)"
}
function MidButtonOut5(obj) {
    obj.style.backgroundImage = "url(img/button/5-1.gif)";
}
function MidButtonOn6(obj) {
    obj.style.backgroundImage = "url(img/button/6.gif)"
}
function MidButtonOut6(obj) {
    obj.style.backgroundImage = "url(img/button/6-1.gif)";
}
function MidButtonOn7(obj) {
    obj.style.backgroundImage = "url(img/button/7.gif)"
}
function MidButtonOut7(obj) {
    obj.style.backgroundImage = "url(img/button/7-1.gif)";
}
function MidButtonOn8(obj) {
    obj.style.backgroundImage = "url(img/button/8.gif)"
}
function MidButtonOut8(obj) {
    obj.style.backgroundImage = "url(img/button/8-1.gif)";
}
function goodsDivideButtonOn(obj) {
    obj.style.backgroundColor = "#F7EEDC";
    obj.style.color = "#FB682F";
}
function goodsDivideButtonOut(obj) {
    obj.style.backgroundColor = "white";
    obj.style.color = "#999";
}
function ImgChangeOn(obj) {
    obj.src = "img/leftpart/welcome-cartoon--2.png";
}
function ImgChangeOut(obj) {
    obj.src = "img/leftpart/welcome-cartoon.png";
}
function PageChangeOn(obj) {
    obj.style.color = "#FAA20A";
}
function PageChangeOut(obj) {
    obj.style.color = "#666";
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
function topCheck() {
    if (document.top_form.log_uname.value == "") {
        alert("请输入会员名");
        return false;
    }
    else if (document.top_form.log_upwd.value == "") {
        alert("请输入密码");
        return false;
    }
    else {
        return true;
    }
}
function topHttpStatteChange() {
    if (xmlHttp.readyState == 2) {
    }
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200 || xmlHttp.status == 0) {
            var myXML = xmlHttp.responseXML;
            var test = xmlHttp.responseText;
            if (test == "密码不正确")
                alert("用户名或密码不正确");
            else if (test == "用户不存在")
                alert("该用户名不存在，请重新输入");
            else
                document.getElementById("top-Loged").style.display = "block";
        }
        else {
            alert("异步调用出错\n返回的HTTP状态码为:" + xmlHttp.status + "/n返回的HTTP状态信息为:" + xmlHttp.statusText);
        }
    }
}
function topRequst() {
    topCheck();
    if (topCheck() == true) {
        creatXMLHttpRequest();
        if (xmlHttp != null) {
            var log_uname = document.top_form.log_uname.value;
            var log_upwd = document.top_form.log_upwd.value;
            var toSend = "log_uname=" + encodeURI(log_uname) + "&log_upwd=" + encodeURI(log_upwd);
            xmlHttp.open("post", "../../backplat/Log-in.php", true);
            xmlHttp.setRequestHeader("Content-Length", toSend.length);
            xmlHttp.setRequestHeader("CONTENT-TYPE", "application/x-www-form-urlencoded");
            xmlHttp.onreadystatechange = topHttpStatteChange;
            xmlHttp.send(toSend);
        }
    }
}

function LogStateChange() {
    if (xmlHttp.readyState == 2) {
    }
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200 || xmlHttp.status == 0) {
            var myXML = xmlHttp.responseXML;
            var logNode = myXML.getElementsByTagName("logState");
            var logState = logNode[0].childNodes[0].nodeValue;  
            if (logState == 1) {
                document.getElementById("top-Loged").style.display = "block";
            }
        }
        else {
            alert("异步调用出错\n返回的HTTP状态码为:" + xmlHttp.status + "/n返回的HTTP状态信息为:" + xmlHttp.statusText);
        }
    }
}
function CheckLog() {
    creatXMLHttpRequest();
    if (xmlHttp != null) {
        var toSend = "checklog=0";
        xmlHttp.open("post", "../../backplat/logState.php", true);
        xmlHttp.setRequestHeader("Content-Length", toSend.length);
        xmlHttp.setRequestHeader("CONTENT-TYPE", "application/x-www-form-urlencoded");
        xmlHttp.onreadystatechange = LogStateChange;
        xmlHttp.send(toSend);
    }
}