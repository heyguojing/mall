<?php /*a:4:{s:56:"C:\wamp\www\mall\application\admin\view\index\index.html";i:1575621468;s:56:"C:\wamp\www\mall\application\admin\view\common\head.html";i:1575249575;s:56:"C:\wamp\www\mall\application\admin\view\common\menu.html";i:1575249575;s:56:"C:\wamp\www\mall\application\admin\view\common\left.html";i:1575879808;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>网站后台管理系统 </title>
    <link rel="shortcut icon" href="/static/admin/images/favicon.ico">
    <link href="/static/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/static/admin/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="/static/admin/css/style.css" />
    <script src="/static/admin/assets/js/ace-extra.min.js"></script>
    <script src="/static/admin/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript">
        if ("ontouchend" in document) document.write("<script src='/static/admin/js/jquery.mobile.custom.min.js'>" + "<" + "script>");
    </script>
    <script src="/static/admin/assets/js/bootstrap.min.js"></script>
    <script src="/static/admin/assets/js/typeahead-bs2.min.js"></script>
    <script src="/static/admin/assets/js/ace-elements.min.js"></script>
    <script src="/static/admin/assets/js/ace.min.js"></script>
    <script src="/static/admin/assets/layer/layer.js" type="text/javascript"></script>
    <script src="/static/admin/assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="/static/admin/js/jquery.nicescroll.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function() {
            var cid = $('#nav_list> li>.submenu');
            cid.each(function(i) {
                $(this).attr('id', "Sort_link_" + i);

            })
        })
        jQuery(document).ready(function() {
            $.each($(".submenu"), function() {
                var $aobjs = $(this).children("li");
                var rowCount = $aobjs.size();
                var divHeigth = $(this).height();
                $aobjs.height(divHeigth / rowCount);
            });
            //初始化宽度、高度

            $("#main-container").height($(window).height() - 132);
            $("#iframe").height($(window).height() - 196);

            $(".sidebar").height($(window).height() - 155);
            var thisHeight = $("#nav_list").height($(window).outerHeight() - 229);
            $(".submenu").height();
            $("#nav_list").children(".submenu").css("height", thisHeight);

            //当文档窗口发生改变时 触发  
            $(window).resize(function() {
                $("#main-container").height($(window).height() - 132);
                $("#iframe").height($(window).height() - 196);
                $(".sidebar").height($(window).height() - 155);

                var thisHeight = $("#nav_list").height($(window).outerHeight() - 229);
                $(".submenu").height();
                $("#nav_list").children(".submenu").css("height", thisHeight);
            });
            $(document).on('click', '.iframeurl', function() {
                var cid = $(this).attr("name");
                var cname = $(this).attr("title");
                $("#iframe").attr("src", cid).ready();
                $("#Bcrumbs").attr("href", cid).ready();
                $(".Current_page a").attr('href', cid).ready();
                $(".Current_page").attr('name', cid);
                $(".Current_page").html(cname).css({
                    "color": "#333333",
                    "cursor": "default"
                }).ready();
                $("#parentIframe").html('<span class="parentIframe iframeurl"> </span>').css("display", "none").ready();
                $("#parentIfour").html('').css("display", "none").ready();
            });
            $(".menu .menu-nav li").click(function() {
                $(this).addClass('active').siblings().removeClass('active');
            });


        });
        /******/
        $(document).on('click', '.link_cz > li', function() {
            $('.link_cz > li').removeClass('active');
            $(this).addClass('active');
        });


        /*********************点击事件*********************/
        $(document).ready(function() {
            $('#nav_list,.link_cz').find('li.home').on('click', function() {
                $('#nav_list,.link_cz').find('li.home').removeClass('active');
                $(this).addClass('active');
            });
            //时间设置
            function currentTime() {
                var d = new Date(),
                    str = '';
                str += d.getFullYear() + '年';
                str += d.getMonth() + 1 + '月';
                str += d.getDate() + '日';
                str += d.getHours() + '时';
                str += d.getMinutes() + '分';
                str += d.getSeconds() + '秒';
                return str;
            }

            setInterval(function() {
                $('#time').html(currentTime)
            }, 1000);
            $('#Exit_system').on('click', function() {
                layer.confirm('是否确定退出系统？', {
                        btn: ['是', '否'], //按钮
                        icon: 2,
                    },
                    function() {
                        location.href = "login.html";

                    });
            });
        });
        function link_operating(name, title) {
            var cid = $(this).name;
            var cname = $(this).title;
            $("#iframe").attr("src", cid).ready();
            $("#Bcrumbs").attr("href", cid).ready();
            $(".Current_page a").attr('href', cid).ready();
            $(".Current_page").attr('name', cid);
            $(".Current_page").html(cname).css({
                "color": "#333333",
                "cursor": "default"
            }).ready();
            $("#parentIframe").html('<span class="parentIframe iframeurl"> </span>').css("display", "none").ready();
            $("#parentIfour").html('').css("display", "none").ready();
        }
    </script>
</head>

<body>
    <!-- head -->
<div class="navbar navbar-default" id="navbar">
    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <span class="version">V <i>1.0.01</i></span>
            <a href="#" class="navbar-brand">
                <small>					
                    <img src="/static/admin/images/logo.png" width="300px">
                    </small>
            </a>
        </div>
        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <span class="time"><em id="time"></em></span><span class="user-info"><small>欢迎光临,</small>超级管理员</span>
                        <i class="icon-caret-down"></i>
                    </a>
                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li><a href="javascript:void(0);" name="Systems.html" title="系统设置" class="iframeurl"><i class="icon-cog"></i>网站设置</a></li>
                        <li><a href="javascript:void(0)" name="admin_info.html" title="个人信息" class="iframeurl"><i class="icon-user"></i>个人资料</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo url('index/logout'); ?>" id="Exit_system"><i class="icon-off"></i>退出</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- head end -->
    <div class="main-container" id="main-container">
        <!--menu-->
<div class="menu">
    <div class="sidebar-shortcuts-large menu-icon" id="sidebar-shortcuts-large">
        <a class="btn btn-success">
            <i class="icon-signal"></i>
        </a>

        <a class="btn btn-info">
            <i class="icon-pencil"></i>
        </a>

        <a class="btn btn-warning">
            <i class="icon-group"></i>
        </a>

        <a class="btn btn-danger">
            <i class="icon-cogs"></i>
        </a>
    </div>
    <div class="menu-box">
        <ul class="menu-nav">
            <li class="menu-nav-item active"><a href="javascript:;">权限管理</a></li>
            <li class="menu-nav-item"><a href="javascript:;">前台信息管理</a></li>
            <li class="menu-nav-item"><a href="javascript:;">系统管理</a></li>
            <li class="menu-nav-item"><a href="javascript:;">其他设置</a></li>
            <li class="menu-nav-item"><a href="javascript:;">订单管理</a></li>
            <li class="menu-nav-item"><a href="javascript:;">内容管理</a></li>
            <li class="menu-nav-item"><a href="javascript:;">会员管理</a></li>
            <li class="menu-nav-item"><a href="javascript:;">运营推广</a></li>
            <li class="menu-nav-item"><a href="javascript:;">统计报表</a></li>
        </ul>
    </div>
</div>
<!--menu end-->
        <div class="main-container-inner">
            <a class="menu-toggler" id="menu-toggler" href="#">
                <span class="menu-text"></span>
            </a>
            <div class="sidebar" id="sidebar">
                <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                        <span class="btn btn-success"></span>

                        <span class="btn btn-info"></span>

                        <span class="btn btn-warning"></span>

                        <span class="btn btn-danger"></span>
                    </div>
                </div>
                <!-- #sidebar-shortcuts -->
                <!-- left -->
<div id="menu_style" class="menu_style">
    <ul class="nav nav-list" id="nav_list">
        <li class="home"><a href="javascript:void(0)" name="<?php echo url('index/copy'); ?>" class="iframeurl" title=""><i class="icon"></i><span class="menu-text"> 系统首页 </span></a></li>
        <li><a href="#" class="dropdown-toggle"><i class="icon"></i><span class="menu-text"> rbac </span><b class="arrow icon-angle-down"></b></a>
            <ul class="submenu">
                <li class="home"><a href="javascript:void(0)" name="<?php echo url('rbac/index'); ?>" title="Rbac管理" class="iframeurl"><i class="icon-double-angle-right"></i>管理员列表</a></li>
                <li class="home"><a href="javascript:void(0)" name="<?php echo url('rbac/role'); ?>" title="角色管理" class="iframeurl"><i class="icon-double-angle-right"></i>角色列表</a></li>
                <li class="home"><a href="javascript:void(0)" name="<?php echo url('rbac/node'); ?>" title="节点管理" class="iframeurl"><i class="icon-double-angle-right"></i>节点列表</a></li>
                <li class="home"><a href="javascript:void(0)" name="<?php echo url('rbac/addUser'); ?>" title="添加用户" class="iframeurl"><i class="icon-double-angle-right"></i>添加管理员</a></li>
                <li class="home"><a href="javascript:void(0)" name="<?php echo url('rbac/addRole'); ?>" title="添加角色" class="iframeurl"><i class="icon-double-angle-right"></i>添加角色</a></li>
                <li class="home"><a href="javascript:void(0)" name="<?php echo url('rbac/addNode'); ?>" title="添加节点" class="iframeurl"><i class="icon-double-angle-right"></i>添加节点</a></li>
            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><i class="icon"></i><span class="menu-text"> 产品管理 </span><b class="arrow icon-angle-down"></b></a>
            <ul class="submenu">
                <li class="home"><a href="javascript:void(0)" name="Products_List.html" title="产品类表" class="iframeurl"><i class="icon-double-angle-right"></i>产品类表</a></li>
                <li class="home"><a href="javascript:void(0)" name="Brand_Manage.html" title="品牌管理" class="iframeurl"><i class="icon-double-angle-right"></i>角色管理</a></li>
                <li class="home"><a href="javascript:void(0)" name="Category_Manage.html" title="分类管理" class="iframeurl"><i class="icon-double-angle-right"></i>分类管理</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="dropdown-toggle"><i class="icon"></i><span class="menu-text"> 图片管理 </span><b class="arrow icon-angle-down"></b></a>
            <ul class="submenu">
                <li class="home"><a href="javascript:void(0)" name="advertising.html" title="广告管理" class="iframeurl"><i class="icon-double-angle-right"></i>广告管理</a></li>
                <li class="home"><a href="javascript:void(0)" name="Sort_ads.html" title="分类管理" class="iframeurl"><i class="icon-double-angle-right"></i>分类管理</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="dropdown-toggle"><i class="icon"></i><span class="menu-text"> 交易管理 </span><b class="arrow icon-angle-down"></b></a>
            <ul class="submenu">
                <li class="home"><a href="javascript:void(0)" name="transaction.html" title="交易信息" class="iframeurl"><i class="icon-double-angle-right"></i>交易信息</a></li>
                <li class="home"><a href="javascript:void(0)" name="Order_Chart.html" title="交易订单（图）" class="iframeurl"><i class="icon-double-angle-right"></i>交易订单(图)</a></li>
                <li class="home"><a href="javascript:void(0)" name="Orderform.html" title="订单管理" class="iframeurl"><i class="icon-double-angle-right"></i>订单管理</a></li>
                <li class="home"><a href="javascript:void(0)" name="Amounts.html" title="交易金额" class="iframeurl"><i class="icon-double-angle-right"></i>交易金额</a></li>
                <li class="home"><a href="javascript:void(0)" name="Order_handling.html" title="订单处理" class="iframeurl"><i class="icon-double-angle-right"></i>订单处理</a></li>
                <li class="home"><a href="javascript:void(0)" name="Refund.html" title="退款管理" class="iframeurl"><i class="icon-double-angle-right"></i>退款管理</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="dropdown-toggle"><i class="icon"></i><span class="menu-text"> 支付管理 </span><b class="arrow icon-angle-down"></b></a>
            <ul class="submenu">
                <li class="home"><a href="javascript:void(0)" name="Cover_management.html" title="账户管理" class="iframeurl"><i class="icon-double-angle-right"></i>账户管理</a></li>
                <li class="home"><a href="javascript:void(0)" name="payment_method.html" title="支付方式" class="iframeurl"><i class="icon-double-angle-right"></i>支付方式</a></li>
                <li class="home"><a href="javascript:void(0)" name="Payment_Configure.html" title="支付配置" class="iframeurl"><i class="icon-double-angle-right"></i>支付配置</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="dropdown-toggle"><i class="icon"></i><span class="menu-text"> 会员管理 </span><b class="arrow icon-angle-down"></b></a>
            <ul class="submenu">
                <li class="home"><a href="javascript:void(0)" name="user_list.html" title="会员列表" class="iframeurl"><i class="icon-double-angle-right"></i>会员列表</a></li>
                <li class="home"><a href="javascript:void(0)" name="member-Grading.html" title="等级管理" class="iframeurl"><i class="icon-double-angle-right"></i>等级管理</a></li>
                <li class="home"><a href="javascript:void(0)" name="integration.html" title="会员记录管理" class="iframeurl"><i class="icon-double-angle-right"></i>会员记录管理</a></li>

            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><i class="icon"></i><span class="menu-text"> 店铺管理 </span><b class="arrow icon-angle-down"></b></a>
            <ul class="submenu">
                <li class="home"><a href="javascript:void(0)" name="Shop_list.html" title="店铺列表" class="iframeurl"><i class="icon-double-angle-right"></i>店铺列表</a></li>
                <li class="home"><a href="javascript:void(0)" name="Shops_Audit.html" title="店铺审核" class="iframeurl"><i class="icon-double-angle-right"></i>店铺审核<span class="badge badge-danger">5</span></a></li>
            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><i class="icon"></i><span class="menu-text"> 消息管理 </span><b class="arrow icon-angle-down"></b></a>
            <ul class="submenu">
                <li class="home"><a href="javascript:void(0)" name="Guestbook.html" title="留言列表" class="iframeurl"><i class="icon-double-angle-right"></i>留言列表</a></li>
                <li class="home"><a href="javascript:void(0)" name="Feedback.html" title="意见反馈" class="iframeurl"><i class="icon-double-angle-right"></i>意见反馈</a></li>
            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><i class="icon"></i><span class="menu-text"> 文章管理 </span><b class="arrow icon-angle-down"></b></a>
            <ul class="submenu">
                <li class="home"><a href="javascript:void(0)" name="article_list.html" title="文章列表" class="iframeurl"><i class="icon-double-angle-right"></i>文章列表</a></li>
                <li class="home"><a href="javascript:void(0)" name="article_Sort.html" title="分类管理" class="iframeurl"><i class="icon-double-angle-right"></i>分类管理</a></li>
            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><i class="icon"></i><span class="menu-text"> 系统管理 </span><b class="arrow icon-angle-down"></b></a>
            <ul class="submenu">
                <li class="home"><a href="javascript:void(0)" name="Systems.html" title="系统设置" class="iframeurl"><i class="icon-double-angle-right"></i>系统设置</a></li>
                <li class="home"><a href="javascript:void(0)" name="System_section.html" title="系统栏目管理" class="iframeurl"><i class="icon-double-angle-right"></i>系统栏目管理</a></li>

                <li class="home"><a href="javascript:void(0)" name="System_Logs.html" title="系统日志" class="iframeurl"><i class="icon-double-angle-right"></i>系统日志</a></li>
            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><i class="icon"></i><span class="menu-text"> 管理员管理 </span><b class="arrow icon-angle-down"></b></a>
            <ul class="submenu">

                <li class="home"><a href="javascript:void(0)" name="admin_Competence.html" title="权限管理" class="iframeurl"><i class="icon-double-angle-right"></i>权限管理</a></li>
                <li class="home"><a href="javascript:void(0)" name="administrator.html" title="管理员列表" class="iframeurl"><i class="icon-double-angle-right"></i>管理员列表</a></li>
                <li class="home"><a href="javascript:void(0)" name="admin_info.html" title="个人信息" class="iframeurl"><i class="icon-double-angle-right"></i>个人信息</a></li>
            </ul>
        </li>
    </ul>
</div>
<!-- left end -->
                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
                </div>
            </div>

            <div class="main-content">
                <div class="breadcrumbs" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home home-icon"></i>
                            <a href="index.html">首页</a>
                        </li>
                        <li class="active"><span class="Current_page iframeurl"></span></li>
                        <li class="active" id="parentIframe"><span class="parentIframe iframeurl"></span></li>
                        <li class="active" id="parentIfour"><span class="parentIfour iframeurl"></span></li>
                    </ul>
                </div>
                <iframe id="iframe" style="border:0; width:100%; background-color:#FFF;" name="iframe" frameborder="0" src="<?php echo url('index/copy'); ?>"> </iframe>
                <!-- /.page-content -->
            </div>
            <!-- /.main-content -->

            <div class="ace-settings-container" id="ace-settings-container">
                <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                    <i class="icon-cog bigger-150"></i>
                </div>

                <div class="ace-settings-box" id="ace-settings-box">
                    <div>
                        <div class="pull-left">
                            <select id="skin-colorpicker" class="hide">
                                <option data-skin="default" value="#438EB9">#438EB9</option>
                                <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                            </select>
                        </div>
                        <span>&nbsp; 选择皮肤</span>
                    </div>

                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                        <label class="lbl" for="ace-settings-sidebar"> 固定滑动条</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                        <label class="lbl" for="ace-settings-rtl">切换到左边</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                        <label class="lbl" for="ace-settings-add-container">
                            切换窄屏
                            <b></b>
                        </label>
                    </div>
                </div>
            </div>
            <!-- /#ace-settings-container -->
        </div>
        <!-- /.main-container-inner -->

    </div>
    <!--底部样式-->

    <!-- <div class="footer_style" id="footerstyle">
        <p class="r_f">郭靖 &copy;</p>
    </div> -->
</body>

</html>
