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
function creatXMLHttpRequest1() {
    if (window.ActiveXObject) {
        xmlHttp1 = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if (window.XMLHttpRequest) {
        xmlHttp1 = new XMLHttpRequest();
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
function GetItemChange() {
    if (xmlHttp3.readyState == 2) {}
    if (xmlHttp3.readyState == 4) {

        if (xmlHttp3.status == 200 || xmlHttp3.status == 0) {
            var myXML = xmlHttp3.responseXML;
            var state = myXML.getElementsByTagName("state")[0].firstChild.nodeValue;
            if (state == 1) {
                var codeNode = myXML.getElementsByTagName("good_id");
                var code=codeNode[0].childNodes[0].nodeValue;
                var name = myXML.getElementsByTagName("good_name")[0].firstChild.nodeValue;
                var price = myXML.getElementsByTagName("good_price")[0].firstChild.nodeValue;
                var img = myXML.getElementsByTagName("good_imgsrc")[0].firstChild.nodeValue;
                var item_code = document.getElementById("item-code");
                var item_name = document.getElementById("item-name");
                var item_price = document.getElementById("price");
                item_code.firstChild.nodeValue = code;
                item_name.firstChild.nodeValue = name;
                item_price.firstChild.nodeValue = price;
                document.getElementById("item-pic").src = img;
            }
            else if (state == 0)
                alert("商品加载失败！");
        }
        else {
            alert("异步调用出错\n返回的HTTP状态码为:" + xmlHttp3.status + "/n返回的HTTP状态信息为:" + xmlHttp3.statusText);
        }
    }
}
function GetItem() {
    creatXMLHttpRequest3();
    if (xmlHttp3 != null) {
        var toSend = "action=get";
        xmlHttp3.open("post", "../../backplat/Jump.php", true);
        xmlHttp3.setRequestHeader("Content-Length", toSend.length);
        xmlHttp3.setRequestHeader("CONTENT-TYPE", "application/x-www-form-urlencoded");
        xmlHttp3.onreadystatechange = GetItemChange;
        xmlHttp3.send(toSend);
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
function LogStateChange() {
    if (xmlHttp.readyState == 2) {
    }
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200 || xmlHttp.status == 0) {
            var myXML = xmlHttp.responseXML;
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

function Check() {
    if (document.mid_log_form.ID.value == "") {
        alert("请输入用户名");
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
function itemCheck() {
    if (document.item_form.number.value == "") {
        alert("请输入需购买商品的数量");
        return false;
    }
    else
        return true;
}
function itemAddStateChange() {
    if (xmlHttp.readyState == 2) {
    }
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200 || xmlHttp.status == 0) {
            var testResponse = xmlHttp.responseText;
            alert(testResponse);
        }
    }
}
function itemAdd() {
    if (itemCheck() == true) {
        creatXMLHttpRequest();
        if (xmlHttp != null) {
            var id = document.getElementById("item-code").firstChild.nodeValue;
 //      	var id = 3;
            var count = document.item_form.number.value;
            var toSend = "good_id=" + encodeURI(id) + "&good_count=" + encodeURI(count) + "&action=0";
            xmlHttp.open("post", "../../backplat/shopCart.php", true);
            xmlHttp.setRequestHeader("Content-Length", toSend.length);
            xmlHttp.setRequestHeader("CONTENT-TYPE", "application/x-www-form-urlencoded");
            xmlHttp.onreadystatechange = itemAddStateChange;
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
function ColorButton(obj) {
    for (var i = 1; i < 4; ++i) {
        var myColor = "color" + i;
        var colorButton = document.getElementById(myColor);
        colorButton.style.borderColor = "#676767";
        colorButton.style.borderWidth = "1px";
    }
    obj.style.borderColor = "#FF7900";
    obj.style.borderWidth = "2px";
}