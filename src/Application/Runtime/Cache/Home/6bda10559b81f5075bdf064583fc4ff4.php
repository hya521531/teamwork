<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        学生信息管理平台
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

    <script type="text/javascript">
        function submitMail() {
            var mtitle = "联系方式有修改";
            var html = "<div style='padding:10px;'><div style='width:65px; height:120px; float:left;'>修改的地方：</div><div style='width:250px; height:120px; float:left;'><textarea id='objeCont' name='objeCont' style='width:250px; height:105px;'></textarea></div></div>";

            var submit = function (v, h, f) {
                if (f.objeCont == '' || f.objeCont.length > 80) {
                    $.jBox.tip("请您输入有修改的地方，且不超过80个字！", 'error', { focusId: "objeCont" }); // 关闭设置 objeCont 为焦点
                    return false;
                }

                StudentCompain.insertCompain('', mtitle, 5, f.objeCont, function (data) {
                    var obj = $.parseJSON(data);
                    var resultObj = false;
                    if (obj.ok) {
                        $.jBox.tip("成功提交联系方式的修改邮件！");
                    }
                });
            };

            $.jBox(html, { title: "联系方式修改的邮件", submit: submit });
        }
    </script>
</head>

<body>

    <div class="banner">
        <div class="bgh">
            <div class="page">
                <div id="logo">
                    <a href="../Index.aspx.html">
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
                        <div><a href="<?php echo U('Index:stu_info_all');?>">学生信息</a></div>
                        <div> <a href="#">学生反馈</a></div>
                        <div><a href="<?php echo U('Index:add_stu');?>">增加信息</a></div>
                        <div><a href="<?php echo U('Index:delete_stu');?>">删除信息</a></div>
                        <div><a href="<?php echo U('Index:edit_stu');?>">修改信息</a></div>
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
            <div class="rightbox">

                <h2 class="mbx">我的信息 &gt; 个人资料 &nbsp;&nbsp;&nbsp;</h2>
                <div class="cztable">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>学号</td>
                            <td>姓名</td>
                            <td>高等数学</td>
                            <td>英语</td>
                            <td>数据结构</td>
                            <td>数据库</td>
                        </tr>
                        
                            
                            <?php if(is_array($stu_list)): $i = 0; $__LIST__ = $stu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["stu_num"]); ?></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td><?php echo ($vo["gaoshu"]); ?></td>
                            <td><?php echo ($vo["english"]); ?></td>
                            <td><?php echo ($vo["shujujiegou"]); ?></td>
                            <td><?php echo ($vo["shujuku"]); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        
                        
                    </table>
                </div>

            </div>
        </div>
    </div>
</body>

</html>