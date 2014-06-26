// JScript source code
var xmlHttp;
var xmlHttp1;
var xmlHttp2;
var xmlHttp3;
function creatXMLHttpRequest3() {
    if (window.ActiveXObject) {
        xmlHttp3 = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if (window.XMLHttpRequest) {
        xmlHttp3 = new XMLHttpRequest();
    }
}
function CodeSend(obj) {
    creatXMLHttpRequest3();
    if (xmlHttp3 != null) {
        var code = obj.firstChild.firstChild.nodeValue;
        var toSend = "action=send" + "&good_id=" + code;
        xmlHttp3.open("post", "../../backplat/Jump.php", true);
        xmlHttp3.setRequestHeader("Content-Length", toSend.length);
        xmlHttp3.setRequestHeader("CONTENT-TYPE", "application/x-www-form-urlencoded");
        xmlHttp3.send(toSend);
    }
}

function creatXMLHttpRequest2(){
    if (window.ActiveXObject) {
        xmlHttp2 = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if (window.XMLHttpRequest) {
        xmlHttp2 = new XMLHttpRequest();
    }
}
function LogOutChange() {
    if (xmlHttp2.readyState == 2) {
    }
    if (xmlHttp2.readyState == 4) {
        if (xmlHttp2.status == 200 || xmlHttp2.status == 0) {
            var myXML = xmlHttp2.responseXML;
            var logOutStateNode = myXML.getElementsByTagName("logOut");
            var logOutState=logOutStateNode[0].firstChild.nodeValue;
            if (logOutState == 1) {
                document.getElementById("loged-part").style.display = "none";
                document.getElementById("top-Loged").style.display = "none";
            }
        }
    }
}
function LogOut() {
    creatXMLHttpRequest2();
    if (xmlHttp2 != null) {
        var toSend = "logOut=1";
        xmlHttp2.open("post", "../../backplat/logout.php", true);
        xmlHttp2.setRequestHeader("Content-Length", toSend.length);
        xmlHttp2.setRequestHeader("CONTENT-TYPE", "application/x-www-form-urlencoded");
        xmlHttp2.onreadystatechange = LogOutChange;
        xmlHttp2.send(toSend);
    }
}

function creatXMLHttpRequest() {
    if (window.ActiveXObject) {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if (window.XMLHttpRequest) {
        xmlHttp = new XMLHttpRequest();
    }
}
function creatXMLHttpRequest1() {
    if (window.ActiveXObject) {
        xmlHttp1 = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if (window.XMLHttpRequest) {
        xmlHttp1 = new XMLHttpRequest();
    }
}
function LogStateChange() {
    if (xmlHttp1.readyState == 2) {
    }
    if (xmlHttp1.readyState == 4) {
        if (xmlHttp1.status == 200 || xmlHttp1.status == 0) {
            var myXML = xmlHttp1.responseXML;
            var logNode = myXML.getElementsByTagName("logState");
            var logState = logNode[0].childNodes[0].nodeValue;
            if (logState == 1) {
                document.getElementById("loged-part").style.display = "block";
                document.getElementById("top-Loged").style.display = "block";
                var Node = myXML.getElementsByTagName("rname");
                var name = Node[0].childNodes[0].nodeValue;
                document.getElementById("uname").innerHTML = name;
                var sexNode = myXML.getElementsByTagName("sex");
                var sex = sexNode[0].childNodes[0].nodeValue;
                var good_count = myXML.getElementsByTagName("good_count");
                var the_count = good_count[0].childNodes[0].nodeValue;
                document.getElementById("item-numbers").innerHTML = the_count;
                var good_money = myXML.getElementsByTagName("good_money");
                var the_money = good_money[0].childNodes[0].nodeValue;
                document.getElementById("total-money").innerHTML = the_money;
                if (sex != "男") {
                    document.getElementById("sex-picture").src = "img/strangegirl.png";
                    document.getElementById("sex").innerHTML = "奇葩妹纸";
                }
            }
        }
        else {
            alert("异步调用出错\n返回的HTTP状态码为:" + xmlHttp1.status + "/n返回的HTTP状态信息为:" + xmlHttp1.statusText);
    }
  }
}
function CheckLog() {
    creatXMLHttpRequest1();
    if (xmlHttp1 != null) {
        var toSend = "checklog=0";
        xmlHttp1.open("post", "../../backplat/logState.php", true);
        xmlHttp1.setRequestHeader("Content-Length", toSend.length);
        xmlHttp1.setRequestHeader("CONTENT-TYPE", "application/x-www-form-urlencoded");
        xmlHttp1.onreadystatechange = LogStateChange;
        xmlHttp1.send(toSend);
    }
}

function Check() {
    if (document.mid_log_form.ID.value == "") {
        alert("请输入会员名");
        return false;
    }
    else if (document.mid_log_form.PASS.value == "") {
        alert("请输入密码");
        return false;
    } 
    else {
        return true;
    }
}
function topCheck(){
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
function httpStatteChange() {
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
            else {
                document.getElementById("loged-part").style.display = "block";
                document.getElementById("top-Loged").style.display = "block";
                var Node = myXML.getElementsByTagName("rname");
                var name = Node[0].childNodes[0].nodeValue;
                document.getElementById("uname").innerHTML = name;
                var sexNode = myXML.getElementsByTagName("sex");
                var sex = sexNode[0].childNodes[0].nodeValue;
                if (sex != "男") {
                    document.getElementById("sex-picture").src = "img/strangegirl.png";
                    document.getElementById("sex").innerHTML = "奇葩妹纸";
                }
            }
        }
        else {
            alert("异步调用出错\n返回的HTTP状态码为:" + xmlHttp.status + "/n返回的HTTP状态信息为:" + xmlHttp.statusText);
        }
    }
}
function Requst() {
    if (Check() == true) {
        creatXMLHttpRequest();
        if (xmlHttp != null) {
            var log_uname = document.mid_log_form.ID.value;
            var log_upwd = document.mid_log_form.PASS.value;
            var toSend = "log_uname=" + encodeURI(log_uname) + "&log_upwd=" + encodeURI(log_upwd);
            xmlHttp.open("post", "../../backplat/Log-in.php", true);
            xmlHttp.setRequestHeader("Content-Length", toSend.length);
            xmlHttp.setRequestHeader("CONTENT-TYPE", "application/x-www-form-urlencoded");
            xmlHttp.onreadystatechange = httpStatteChange;
            xmlHttp.send(toSend);
        }
    }
}
function topRequst() {
    if (topCheck() == true) {
        creatXMLHttpRequest();
        if (xmlHttp != null) {
            var log_uname = document.top_form.log_uname.value;
            var log_upwd = document.top_form.log_upwd.value;
            var toSend = "log_uname=" + encodeURI(log_uname) + "&log_upwd=" + encodeURI(log_upwd);
            xmlHttp.open("post", "../../backplat/Log-in.php", true);
            xmlHttp.setRequestHeader("Content-Length", toSend.length);
            xmlHttp.setRequestHeader("CONTENT-TYPE", "application/x-www-form-urlencoded");
            xmlHttp.onreadystatechange = httpStatteChange;
            xmlHttp.send(toSend);
        }
    }
}




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
function MidBannerOn(obj) {
    var mynode = obj;
    var n = mynode.firstChild.firstChild.nodeValue;
    var node3 = document.getElementById("banner-point3");
    node3.style.backgroundImage = "url(img/content/point1.png)";
    node3.style.width = "15px";
    node3.style.height = "15px";
    node3.style.top = "5px";
    node3.style.left = "115px";
    ChangeToSmall(n);
    ChangeToBig(obj, n);
    PictrueChange(obj);
}
function ChangeToSmall(n) {
    var othernode;
    var i = 1;
    for (i; i < 6; ++i) {
        othernode = document.getElementById("banner-point" + i);
        if (i == n)
            continue;
        else if (document.getElementById("banner-point" + i).style.top == "-1px")
            break;
    }
    var mystr1;
    switch (i) {
        case "1":
            mystr1 = "30px";
        case "2":
            mystr1 = "75px";
        case "3":
            mystr1 = "120px";
        case "4":
            mystr1 = "165px";
        case "5":
            mystr1 = "210px";
    }
    othernode.style.backgroundImage = "url(img/content/point1.png)";
    othernode.style.width = "15px";
    othernode.style.height = "15px";
    othernode.style.top = "5px";
    othernode.style.left = mystr1;
}
function ChangeToBig(obj, node, n) {
    var mystr;
    switch (n) {
        case "1":
            mystr = "25px";
        case "2":
            mystr = "70px";
        case "3":
            mystr = "115px";
        case "4":
            mystr = "160px";
        case "5":
            mystr = "205px";
    }
    obj.style.backgroundImage = "url(img/content/point2.png)";
    obj.style.width = "20px";
    obj.style.height = "20px";
    obj.style.top = "-1px";
    obj.style.left = mystr;
}

function PictrueChange(obj) {
    var node = obj;
    var n = node.firstChild.firstChild.nodeValue;
    var h = document.getElementById("banner-js");
    switch (n) {
        case "1":
            h.src = "img/bannner/1.jpg";
            break;
        case "2":
            h.src = "img/bannner/2.jpg";
            break;
        case "3":
            h.src = "img/bannner/3.jpg";
            break;
        case "4":
            h.src = "img/bannner/4.jpg";
            break;
        case "5":
            h.src = "img/bannner/5.jpg";
            break;
    }
}
