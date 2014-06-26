function onRegisterInputBoxclick(obj) {
    obj.style.backgroundImage = "url(img/frame2.png)";
}
function onRegisterInputBoxblur(obj) {
    obj.style.backgroundImage = "url(img/frame1.png)";
}

function Isempty(str, id) {
    if (str.length == 0) {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "不能为空";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叉.png)";
    }
}

function request() {
    for (var i = 1; i < 13; ++i) {
        var inputboxid = "textHint" + i;
        if (inputboxid == "textHint1" || inputboxid == "textHint2" || inputboxid == "textHint3" || inputboxid == "textHint7" || inputboxid == "textHint8" || inputboxid == "textHint12") {
            if (document.getElementById(inputboxid).parentNode.getElementsByTagName("span")[0].style.backgroundImage == "url(http://localhost/cqushop/1/front/register/img/%E5%8F%89.png)") {
                alert("输入有误！");
                return false;
            }
            else if (document.getElementById(inputboxid).value == "") {
                alert("必要选项不能为空！");
                return false;
            }
        }
    }
    var xmlhttp;
    xmlhttp = GetXmlHttpObject();
    if (xmlhttp == null) {
        alert("你的浏览器不支持AJAX");
        return;
    }
    var uname = document.getElementById("textHint1").value;
    var upwd = document.getElementById("textHint2").value;
    var pwd_question = document.getElementById("textHint4").value;
    var pwd_answer = document.getElementById("textHint5").value;
    var rname = document.getElementById("textHint6").value;
    var phoneNum = document.getElementById("textHint7").value;
    var ID_card = document.getElementById("textHint8").value;
    var sex = document.getElementById("textHint9").value;
    var address = document.getElementById("textHint10").value;
    var postcode = document.getElementById("textHint11").value;
    var email = document.getElementById("textHint12").value;

    var userInfo = "uname=" + encodeURI(uname) + "&upwd=" + encodeURI(upwd) + "&pwd_question=" + encodeURI(pwd_question) + "&pwd_answer=" + encodeURI(pwd_answer) + "&rname="
                   + encodeURI(rname) + "&phoneNum=" + encodeURI(phoneNum) + "&ID_card=" + encodeURI(ID_card) + "&sex=" + encodeURI(sex) + "&address=" + encodeURI(address) +
                   "&postcode=" + encodeURI(postcode) + "&email=" + encodeURI(email) + "&action=register";

    xmlhttp.open("post", "../../backplat/Login.php", true);
    xmlhttp.setRequestHeader("Content-Length", userInfo.length);
    xmlhttp.setRequestHeader("CONTENT-TYPE", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            var xmlDoc = xmlhttp.responseXML;
            if (xmlDoc.getElementsByTagName("error")[0].childNodes[0].nodeValue == "0") {
                document.getElementById("top-head").style.backgroundImage = "url(img/head2.png)";
                document.getElementById("middle-part").style.display = "none";
                document.getElementById("success").style.display = "block";
                setTimeout("javascript:location.href='../homepage/EasyBuying.html'", 5000);
            }
            else {
                alert("未能接收到注册信息！请重试");
                return false;
            }
        }
    }
    xmlhttp.send(userInfo);
}

function showHint1(str, id) {
    if (str.length != 0) {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "&nbsp;";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/勾.png)";
    }
}

function showHint(str, name, id) {
    var xmlhttp;
    if (id == "textHint3") {
        if (document.getElementById(id).value != document.getElementById("textHint2").value)
        {
        if(document.getElementById(id).value != "") {
            document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "两次密码不同";
            document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叉.png)";
        	}
        }
        else if (document.getElementById(id).value != "") {
            document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "&nbsp;";
            document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/勾.png)";
        }
    }

    xmlhttp = GetXmlHttpObject();
    if (xmlhttp == null) {
        alert("你的浏览器不支持AJAX");
        return;
    }

    var url = "../../backplat/Login.php";
    url = url + "?" + name + "=" + str + "&action=check";
    url = url + "&sid=" + Math.random();

    if (name != "uname" && name != "upwd" && name != "upwdconfirm" && name != "rname" && name != "phoneNum" && name != "ID_card" && name != "email") {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "&nbsp;";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/勾.png)";
    }

    xmlhttp.onreadystatechange = function () {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//alert(2);
            var xmlDoc = xmlhttp.responseXML;
            if (name != "upwdconfirm" && xmlDoc.getElementsByTagName("error")[0].childNodes[0].nodeValue == "0") {
                document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "&nbsp;";
                document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/勾.png)";
            }
            else if (xmlDoc.getElementsByTagName("error")[0].childNodes[0].nodeValue == "2") {
                document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "格式不正确";
                document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叉.png)";
            }
            else if (xmlDoc.getElementsByTagName("error")[0].childNodes[0].nodeValue == "3") {
                document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "已存在";
                document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叉.png)";
            }
//            alert(3);
	    else if (xmlDoc.getElementsByTagName("error")[0].childNodes[0].nodeValue == "5"){
                document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "不晓得啥子毛病";
             	document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叉.png)";
	    }
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

function showtip(name, id) {
    //alert("2");
    if (name == "uname") {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "用户名必须为8-16位的数字或大小写字母";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叹.png)";
    }
    else if (name == "upwd") {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "密码必须为8-16位数字或大小写字母";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叹.png)";
    }
    else if (name == "upwdconfirm" && document.getElementById("textHint3").value == "") {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "请再次输入密码";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叹.png)";
    }
    else if (name == "pwd_question") {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "可选";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叹.png)";
    }
    else if (name == "pwd_answer") {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "可选";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叹.png)";
    }
    else if (name == "rname") {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "请输入真实姓名";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叹.png)";
    }
    else if (name == "phoneNum") {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "请输入有效的电话号码";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叹.png)";
    }
    else if (name == "ID_card") {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "请输入有效身份证";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叹.png)";
    }
    else if (name == "sex") {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "可选";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叹.png)";
    }
    else if (name == "address") {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "可选";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叹.png)";
    }
    else if (name == "postcode") {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "可选";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叹.png)";
    }
    else if (name == "email") {
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].innerHTML = "请输入有效的email地址";
        document.getElementById(id).parentNode.getElementsByTagName("span")[0].style.backgroundImage = "url(img/叹.png)";
    }

}