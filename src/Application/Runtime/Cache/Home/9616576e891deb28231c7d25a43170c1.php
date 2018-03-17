<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        学生信息管理系统
    </title>
    <link href="/test/Public/css/StudentStyle.css" rel="stylesheet" type="text/css" />
    <link href="/test/Public/css/jBox/Skins/Blue/jbox.css" rel="stylesheet" type="text/css" />
    <link href="/test/Public/css/ks.css" rel="stylesheet" type="text/css" />
    <script src="/test/Public/js/jBox/jquery-1.4.2.min.js" type="text/javascript"></script>
    <script src="/test/Public/js/jBox/jquery.jBox-2.3.min.js" type="text/javascript"></script>
    <script src="/test/Public/js/jBox/i18n/jquery.jBox-zh-CN.js" type="text/javascript"></script>
    <script src="/test/Public/js/Common.js" type="text/javascript"></script>
    <script src="/test/Public/js/Data.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            setStudMsgHeadTabCheck();
            showUnreadSysMsgCount();
        });

        //我的信息头部选项卡
        function setStudMsgHeadTabCheck() {
            var currentUrl = window.location.href;
            currentUrl = currentUrl.toLowerCase();
            var asmhm = "";
            $("#ulStudMsgHeadTab li").each(function () {
                asmhm = $(this).find('a').attr("href").toLowerCase();
                if (currentUrl.indexOf(asmhm) > 0) {
                    $(this).find('a').attr("class", "tab1");
                    return;
                }
            });
        }

        //显示未读系统信息
        function showUnreadSysMsgCount() {
            var unreadSysMsgCount = "0";
            if (Number(unreadSysMsgCount) > 0) {
                $("#unreadSysMsgCount").html("(" + unreadSysMsgCount + ")");
            }
        }

        //退出
        function loginOut() {
            if (confirm("确定退出吗？")) {
                StudentLogin.loginOut(function (data) {
                    if (data == "true") {
                        window.location = "/Login.aspx";
                    }
                    else {
                        jBox.alert("退出失败！", "提示", new { buttons: { "确定": true } });
                    }
                });
            }
        }
        //更改报考类别
        function changeCateory(thisObj, id) {
            var oldCateoryId = $("#cateoryId").val();
            var cateoryId = "";
            if (id != null) {
                cateoryId = id;
            }
            else {
                cateoryId = thisObj.val();
            }
            var studentId = $("#studentId").val();
            if (cateoryId.length <= 0) {
                jBox.tip("报考类别不能为空！");
                if (id == null) {
                    thisObj.val(oldCateoryId);
                }
            }
            else {
                studentInfo.changeStudentCateory(cateoryId, function (data) {
                    var result = $.parseJSON(data);
                    if ((String(result.ok) == "true")) {
                        window.location.href = "/Index.aspx";
                    }
                    else {
                        jBox.tip(result.message);
                    }
                });
            }
        }
    </script>

    <script src="/test/Public/js/changeOption.js" type="text/javascript"></script>
    <script src="/test/Public/js/rl.js" type="text/javascript"></script>
</head>

<body>



    <div class="banner">
        <div class="bgh">
            <div class="page">
                <div id="logo">
                    <a href="Index.aspx.html">
                        <img src="/test/Public/Images/Student/logo.gif" alt="" width="165" height="48" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page">
        <div class="box mtop">
            <div class="leftbox">
                <div class="l_nav2">
                    <div class="ta1">
                        <strong>个人中心</strong>
                        <div class="leftbgbt">
                        </div>
                    </div>
                    <div class="cdlist">
                        <div><a href="<?php echo U('Index:my_info');?>">我的信息</a></div>
                        <div><a href="<?php echo U('Index:my_grade');?>">我的成绩 </a></div>
                        <div> <a href="#">短信息</a></div>
                        <div><a href="#">学院通知</a></div>
                        <div><a href="#">我的异议</a></div>
                    </div>
                    <div class="ta1">
                        <strong>教务中心</strong>
                        <div class="leftbgbt2">
                        </div>
                    </div>
                    <div class="cdlist">
                        <div>
                            <a href="<?php echo U('Index:changepass');?>">密码修改</a></div>
                        <div>
                            <a href="<?php echo U('index:logout');?>">安全退出</a></div>
                    </div>
                </div>
            </div>
            <div class="rightbox ">

                <h2 class="mbx ">我的学习中心</h2>

                <div class="dhbg ">
                    <div class="dh1 " style="margin: 0 27px 15px 0; ">
                        <div class="dhwz ">
                            <p>
                                您共有 <span class="red ">0</span>条通知信息 <span class="red ">0 </span>条未读
                            </p>
                            <p>
                                共有 <span class="red ">0 </span>条短信息、 <span class="red ">0</span>个投诉、 <span class="red ">
                        0 </span>个异议
                            </p>
                            <p>
                                有 <span class="red ">0</span>个投诉、<span class="red ">0
                    </span>个异议、<span class="red ">0</span>条短信息未处理</p>
                            <div class="btright ">
                                <a href="javascript:; ">
                                    <img src="images/Student/default/bt_bzr.jpg " alt="给班主任发消息 " width="121 " height="25 " /></a>
                            </div>
                        </div>
                    </div>
                    <div class="dh2 ">
                        <div class="dhwz ">
                            <p>
                                你有 <span class="red ">0</span> 门课程要考 <a href="#" class="red ">查看报考计划</a></p>
                            <p>
                                你已经通过 <span class="red ">0 </span>门课程&nbsp;共有 <span class="red ">13</span> 门 <a href="#"
                                    class="red ">查看成绩</a>
                            </p>
                            <p>
                                已经发放了 <span class="red ">0 </span>本书籍 <a href="#" class="red ">查看书籍情况</a></p>
                            <div class="btright ">
                                <a href="javascript:; ">
                                    <img src="images/Student/default/bt_jw.jpg " alt="进入教务中心 " width="121 " height="25 " /></a>
                            </div>
                        </div>
                    </div>
                    <div class="dh3 " style="margin: 0 27px 15px 0; ">
                        <div class="dhwz ">
                            <p>
                                <a href="javascript:; ">模拟考试</a></p>
                            <p>
                                <a href="javascript:; ">章节练习</a>
                            </p>
                            <p>
                                <a href="javascript:; ">网上作业</a></p>
                            <div class="btright ">
                                <a href="javascript:; ">
                                    <img src="images/Student/default/bt_ks.jpg " alt="进入考试中心 " width="121 " height="25 " /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>