<?php /*a:1:{s:56:"C:\wamp\www\mall\application\admin\view\login\index.html";i:1574760671;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登陆</title>
    <link rel="shortcut icon" href="/static/admin/images/favicon.ico">
    <link href="/static/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/static/admin/assets/css/font-awesome.min.css" />
    <!--[if IE 7]>
		  <link rel="stylesheet" href="/static/admin/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
    <link rel="stylesheet" href="/static/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="/static/admin/css/style.css" />
    <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/static/admin/assets/css/ace-ie.min.css" />
		<![endif]-->
    <script src="/static/admin/assets/js/ace-extra.min.js"></script>
    <!--[if lt IE 9]>
		<script src="/static/admin/assets//static/admin/js/html5shiv.js"></script>
		<script src="/static/admin/assets//static/admin/js/respond.min.js"></script>
		<![endif]-->
    <script src="/static/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/static/admin/assets/layer/layer.js" type="text/javascript"></script>
</head>

<body class="login-layout Reg_log_style">
    <div class="logintop">
        <span>欢迎后台管理界面平台</span>
        <ul>
            <li>
                <a href="#">返回首页</a>
            </li>
        </ul>
    </div>
    <div class="loginbody">
        <div class="login-container">
            <div class="center">

            </div>
            <div class="position-relative">
                <span class="version">V
                    <i>1.0.1</i>
                </span>
                <div id="login-box" class="login-box widget-box no-border visible">
                    <div class="widget-body">
                        <div class="widget-main">
                            <h4 class="header blue lighter bigger">
                                <i class="icon-coffee green"></i>
                                管理员登录
                            </h4>

                            <div class="login_icon">
                                <img src="/static/admin/images/login.png" />
                            </div>

                            <form class="">
                                <fieldset>
                                    <ul>
                                        <li class="frame_style form_error">
                                            <label class="user_icon"></label>
                                            <input name="username" type="text" id="username" prename="用户名" />
                                            <i>用户名</i>
                                        </li>
                                        <li class="frame_style form_error">
                                            <label class="password_icon"></label>
                                            <input name="password" type="password" id="password" prename="密码" />
                                            <i>密码</i>
                                        </li>
                                        <li class="frame_style form_error">
                                            <label class="Codes_icon"></label>
                                            <input name="code" type="text" id="code" prename="验证码" />
                                            <i>验证码</i>
                                            <div class="Codes_region">
                                                <img src="<?php echo url('Login/verify'); ?>" alt="captcha" class="verify">
                                            </div>
                                        </li>

                                    </ul>
                                    <div class="space"></div>

                                    <div class="clearfix">
                                        <label class="inline">
                                            <input type="checkbox" class="ace">
                                            <span class="lbl">保存密码</span>
                                        </label>

                                        <button type="button" class="width-35 pull-right btn btn-sm btn-primary" id="login_btn">
                                            <i class="icon-key"></i> 登录
                                        </button>
                                    </div>

                                    <div class="space-4"></div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <!-- /widget-body -->
                </div>
                <!-- /login-box -->
            </div>
            <!-- /position-relative -->
        </div>
    </div>
    <!-- <div class="loginbm">版权所有 2020
        <a href="javascript:void(0);">郭靖</a>
    </div> -->

    <script>
        $('#login_btn').on('click', function () {
            var num = 0;
            var str = "";
            var username = $.trim($("#username").val());
            var password = $.trim($("#password").val());
            var code = $.trim($("#code").val());
            $("input[type$='text'],input[type$='password']").each(function (n) {
                if ($(this).val() == "") {
                    layer.alert(str += "" + $(this).attr("prename") + "不能为空！\r\n", {
                        title: '提示框',
                        icon: 0,
                    });
                    num++;
                    return false;
                }
            });
            if (num > 0) {
                return false;
            } else {
                $.ajax({
                    url:"<?php echo url('Login/login'); ?>",
                    type:"post",
                    data:{
                        "username":username,
                        "password":password,
                        "code":code
                    },
                    dataType:"json",
                    success:function(data){
                        if(data.status == 1){
                            layer.alert(
                                data.msg,
                                {
                                    title:'提示框',
                                    icon:1
                                }
                            );
                            setTimeout(function(){
                                location.href = "<?php echo url('Index/index'); ?>";
                            },1000);
                        }else{
                            layer.alert(data.msg,{title:'提示',icon:2});
                            setTimeout(function(){
                                window.location.reload();
                            },1000)
                        }
                    }
                })
            }

        });
        //按照回车键登录
        $(document).keydown(function (event) {
            if (event.keyCode == 13) {
                $("#login_btn").click();
            }
        });
        $(document).ready(function () {
            $("input[type='text'],input[type='password']").blur(function () {
                var $el = $(this);
                var $parent = $el.parent();
                $parent.attr('class', 'frame_style').removeClass(' form_error');
                if ($el.val() == '') {
                    $parent.attr('class', 'frame_style').addClass(' form_error');
                }
            });
            $("input[type='text'],input[type='password']").focus(function () {
                var $el = $(this);
                var $parent = $el.parent();
                $parent.attr('class', 'frame_style').removeClass(' form_errors');
                if ($el.val() == '') {
                    $parent.attr('class', 'frame_style').addClass(' form_errors');
                } else {
                    $parent.attr('class', 'frame_style').removeClass(' form_errors');
                }
            });
        })
        $(".verify").on("click",function(){
            var src = "<?php echo url('Login/verify'); ?>" + "?rand=" + Math.random(Math.random * 1000);
            $(this).attr("src",src);
        })
    </script>
</body>

</html>