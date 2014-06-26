<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>



<meta http-equiv="Content-Type" content="text/html; charset=ANSI" />
<title>Easy Buying</title>
<link type="text/css" rel="Stylesheet" href="CSS/StyleSheet1.css" />
<script type="text/javascript" src="JS/JScript1.js"></script>
</head>

<body>

<?php
include_once ("splitword.php");
include_once ("common/function.php");
if ($_POST[submit] != "") {
    $keyword = $_POST[keyword];
}
if ($_POST[submit2] != "") { //在查询结果中查找

    $h_keyword = $hide_keyword; //获取原始的值
    $keynew = $keyword;
    $h_keyword .= $keyword; //获取老值+新值
    $keyword = $h_keyword; //将最新的值赋给keyword
}
$yuan = trim($keyword);
$tt = $yuan;

$str = gl($tt);

$sp = new SplitWord();
//放在需要开始计时的地方，计算整页放在开头
$time_start = getmicrotime();
$sp->SplitRMM($str);
$tt = $sp->SplitRMM($str);


require_once ("common/db_mysql.class.php");
$DB = new DB_MySQL; //创建对象
$str = array(" ", ""); //定义一个数组
$cc = str_replace($str, "", $tt); //去掉字符串中的空格
if (substr($cc, 0, 2) == "、") {
    $cc = substr($cc, 2); //去掉前面的“、”符号
}
if (substr($cc, -2, 2) == "、") {
    $cc = substr($cc, 0, -2); //去掉后面的“、”符号
}

if (substr($cc, 0, 2) == "、" && substr($cc, -2, 2) == "、") {
    $a = substr($cc, 2); //去掉前面的“、”符号
    $cc = substr($a, 0, -2); //去掉后面的“、”符号
}
$newstr = explode("、", $cc); //应用explode()函数将字符串转换成数组
if (count($newstr) == 1) { //如果数组的元素个数为1个，则按单个条件进行查询
    $sql = "select * from goods where title like '%" . $newstr[0] .
        "%' or content like '%" . $newstr[0] . "%'order by id desc ";
} else {
    if ($_POST[submit2] != "") { //在查询结果中查找
        //二次查询分词
        $keynew = gl($keynew); //过滤标点符号
        $sp1 = new SplitWord();
        $sp1->SplitRMM($keynew);
        $tc = $sp1->SplitRMM($keynew);
        $cc1 = dunhao($tc);
        $newstr1 = explode("、", $cc1); //应用explode()函数将字符串转换成数组
        /***************************************************************************************/
        //二次查找的算法
        $k_sql = "select k_id from goods_temp";
        $info = $DB->fetch_one_array($k_sql);
        $kid = substr($info['k_id'], 0, -1); //去掉最后一个“@”
        $k_id = explode('@', $kid); //将ID号转换成数组
        $sql = "select * from goods "; //查询信息表中的数据
        while (list($name, $value) = each($k_id)) { //遍历数组
            $a .= "$value" . ",";
        }
        $a = substr($a, 0, -1); //去掉最后一个“,”符号
        //使用in关键字查询所有ID号对应的信息
        $sql .= " where id in(" . $a . ") "; //指定多个条件值

        $sql2 = " and (";
        for ($i = 0; $i < count($newstr1); $i++) {
            $sql0 .= " title like '%" . trim($newstr1[$i]) . "%'" . " or";
        }
        for ($j = 0; $j < count($newstr1); $j++) {
            $sql1 .= " content like '%" . trim($newstr1[$j]) . "%'" . " and";
        }
        $sql1 = substr($sql1, 0, -3); //去掉最后一个“and”
        $sql3 = ")";
        $sql .= $sql2 . $sql0 . $sql1 . $sql3 . " order by id desc";
    } else {
        //合并查询结果集
        for ($i = 0; $i < count($newstr); $i++) {
            $sql0 .= " title like '%" . trim($newstr[$i]) . "%'" . " or";
        }
        for ($j = 0; $j < count($newstr); $j++) {
            $sql1 .= " content like '%" . trim($newstr[$j]) . "%'" . " or";
        }
        $sql1 = substr($sql1, 0, -3); //去掉最后一个“or”
        $sql = "select * from goods where" . $sql0 . $sql1 . " order by id desc";
    }
}

if ($_GET) {
    //得到要提取的页码
    $page_num = $_GET['page_num'] ? $_GET['page_num'] : 1;
} else {
    //首次进入时,页码为1
    $page_num = 1;
}
//得到总记录数
$DB->query($sql);
$row_count_sum = $DB->get_rows();
$row_count_sum;
//每页记录数,可以使用默认值或者直接指定值
$row_per_page = 12;
//总页数
$page_count = ceil($row_count_sum / $row_per_page);
//判断是否为第一页或者最后一页
$is_first = (1 == $page_num) ? 1 : 0;
$is_last = ($page_num == $page_count) ? 1 : 0;
//查询起始行位置
$start_row = ($page_num - 1) * $row_per_page;
//为SQL语句添加limit子句
$sql .= " limit $start_row,$row_per_page";
//执行查询
$DB->query($sql);
$res = $DB->get_rows_array();
//结果集行数
$rows_count = count($res);
$time_end = getmicrotime(); //结束计时
$t0 = $time_end - $time_start; //搜索计时



?>




<div id="top-part">
        <div id="top-LogIn">
            <div id="top-LogIn-Items1">
                <form action="/var/www/cqushop/1/网站后台/Log-in.php" method="post">
                用户名
                <input class="inputBox" type="text" name="log_uname" size="12" />
                &nbsp&nbsp&nbsp 密码
                <input class="inputBox" type="password" name="log_upwd" size="12" />
                <a href="" target="_blank" style="text-decoration: none; color: White;">登录</a>&nbsp&nbsp&nbsp
                <a href="" target="_blank" style="text-decoration: none; color: White;">忘记密码</a>
                </form>
            </div>
            <div id="top-LogIn-Items2">
                <span class="top-LogIn-Items2"><a href="../register/register.html" target="_blank" style="text-decoration: none;
                    color: White;">会员注册</a></span> <span class="top-LogIn-Items2"><a href="" target="_blank"
                        style="text-decoration: none; color: White;">收藏夹</a></span> <span class="top-LogIn-Items2">
                            <a href="" target="_blank" style="text-decoration: none; color: White;">在线客服</a></span>
                <span class="top-LogIn-Items2"><a href="" target="_blank" style="text-decoration: none;
                    color: White;">论坛</a></span>
            </div>
        </div>
        <div id="top-head">
            <div id="logo">
                <img src="../../front/new logo/奇葩小组购奇葩.jpg" alt="" /></div>
            <div id="search">
            <div class="searchItems">
            <ol>
                <li><a href="" style="text-decoration: none; color: #999">数码</a></li>
                <li><a href="" style="text-decoration: none; color: #999">创意</a></li>
                <li><a href="" style="text-decoration: none; color: #999">家电</a></li>
                <li><a href="" style="text-decoration: none; color: #999">跳蚤市场</a></li>
            </ol>
            </div>
            <div style="height:32px">
               <?php require_once ("top.php"); ?> 
                </div>
                <div class="searchItems">
            <ol>
                <li><a href="" style="text-decoration: none; color: #999">服饰</a></li>
                <li><a href="" style="text-decoration: none; color: #999">美食</a></li>
                <li><a href="" style="text-decoration: none; color: #999">书本</a></li>
                <li><a href="" style="text-decoration: none; color: #999">动漫周边</a></li>
            </ol>
            </div>
            </div>
        </div>
        <div id="top-banner">
            <ol id="goods-divide">
                <li class="selected"><a href="" style="text-decoration: none; color: #999" onMouseOver="goodsDivideButtonOn(this)"
                    onmouseout="goodsDivideButtonOut(this)">主页</a></li>
                <li><a href="" style="text-decoration: none; color: #999" onMouseOver="goodsDivideButtonOn(this)"
                    onmouseout="goodsDivideButtonOut(this)">推荐商品</a></li>
                <li><a href="" style="text-decoration: none; color: #999" onMouseOver="goodsDivideButtonOn(this)"
                    onmouseout="goodsDivideButtonOut(this)">热卖商品</a></li>
                <li><a href="" style="text-decoration: none; color: #999" onMouseOver="goodsDivideButtonOn(this)"
                    onmouseout="goodsDivideButtonOut(this)">最新商品</a></li>
                <li><a href="" style="text-decoration: none; color: #999" onMouseOver="goodsDivideButtonOn(this)"
                    onmouseout="goodsDivideButtonOut(this)">优惠活动</a></li>
                <li><a href="" style="text-decoration: none; color: #999" onMouseOver="goodsDivideButtonOn(this)"
                    onmouseout="goodsDivideButtonOut(this)">会员俱乐部</a></li>
            </ol>
        </div>
    </div>
    <div id="middle-part">
    <div id="middle-part-top">
   	<div id="searchResult"><span style="width:24px;height:27px;float:left;"><img src="img/心.png" alt="Heart" /></span><p>找到相关商品<span id="goodNumber"><?php echo
$row_count_sum; ?></span>件</p>
    </div>  
    </div>
    
    <div id="middle-part-middle">
    
    
           
           <?php
for ($i = 0; $i < $rows_count; $i++) {
    $id = $res[$i]['id']; //ID号
    $title = $res[$i]['title']; //标题
    $content = $res[$i]['content']; //内容
    $picture = $res[$i]['picture'];
    $price = $res[$i]['price'];
?>
            <?php
    for ($k = 0; $k < count($newstr); $k++) {
        $content = str_ireplace($newstr[$k], "<font color='#FF0000'>" . $newstr[$k] .
            "</font>", $content);

    }
?>
          <?php if (($i + 1) % 4) { ?>
          <div class="goods" id="good1" ><div class="goodsPic"><a href="" target="_blank" ><img src="<?php echo
        "$picture"; ?>" /></a></div>
         <p>￥<span class="price"><?php echo "$price"; ?></span></p>
         <p><a href="" target="_blank"><?php echo "$content"; ?></a></p>
         </div> 
         <?php } else { ?>
         <div class="goods" id="good1" style="padding-right: 0px;"><div class="goodsPic"><a href="" target="_blank" ><img src="<?php echo
        "$picture"; ?>" /></a></div>
         <p>￥<span class="price"><?php echo "$price"; ?></span></p>
         <p><a href="" target="_blank"><?php echo "$content"; ?></a></p>
         </div> 
        <?php } ?>
		<?php
    $key0 .= $id . '@';
}
$key00 = $key0;
if ($row_count_sum > 0) {
    /* 将查询的关键字存储在临时表中*/
    $ins = "update goods_temp set k_id='" . $key00 . "'";
    $DB->query($ins);
}
?>
     <div id="middle-part-bottom">  
    <div id="pagebuttons">
    
    
    <?php
if ($row_count_sum > 0) {
?>
    <?php
    if (!$is_first) {
?>
            <a href="./search.php?page_num=1&keyword=<?php echo $keyword; ?>" onmouseover="onPagebuttonOver(this)" onmouseout="onPagebuttonOut(this)" style="margin-left: 17px;">第一页</a> <a href="./search.php?page_num=<?php echo ($page_num -
        1); ?>&keyword=<?php echo $keyword; ?>" onmouseover="onPagebuttonOver(this)" onmouseout="onPagebuttonOut(this)">上一页</a>
	<?php
    } else {
?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;第一页&nbsp;&nbsp;上一页
            <?php
    }
    if (!$is_last) {
?>
            <a href="./search.php?page_num=<?php echo ($page_num + 1); ?>&keyword=<?php echo
        $keyword; ?>" onmouseover="onPagebuttonOver(this)" onmouseout="onPagebuttonOut(this)">下一页</a> <a href="./search.php?page_num=<?php echo
        $page_count; ?>&keyword=<?php echo $keyword; ?>" onmouseover="onPagebuttonOver(this)" onmouseout="onPagebuttonOut(this)">最后一页</a>
            <?php
    } else {
?>
            下一页&nbsp;&nbsp;最后一页
            <?php
    }
?>
            <?php
} else {
    $z_null = "&nbsp;&nbsp;&nbsp;&nbsp;";
    if ($row_count_sum == 0) {
        echo $z_null . "抱歉，没有检索到与&nbsp;<font color='FF0000'>" . $yuan .
            "</font>&nbsp;相关的商品信息";
    }
}
?>
    </div>
    </div>
     
          
    
           
   
    </div>
    
    
    </div>
    <div id="bottom-service">
        <ol id="bottom-service-Items">
            <li><a href="" style="text-decoration: none; color: #999">关于我们</a>&nbsp&nbsp|</li>
            <li><a href="" style="text-decoration: none; color: #999">品牌合作</a>&nbsp&nbsp|</li>
            <li><a href="" style="text-decoration: none; color: #999">售后服务</a>&nbsp&nbsp|</li>
            <li><a href="" style="text-decoration: none; color: #999">帮助中心</a>&nbsp&nbsp|</li>
            <li><a href="" style="text-decoration: none; color: #999">服务条款</a></li>
            <li style="float: right;margin:0px;">@copyright&nbsp&nbsp重庆大学软件学院奇葩小组</li>
        </ol>
    </div>
    
</body>
</html>
