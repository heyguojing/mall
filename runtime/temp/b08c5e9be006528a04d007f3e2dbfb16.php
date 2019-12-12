<?php /*a:1:{s:58:"C:\wamp\www\mall\application\admin\view\rbac\add_role.html";i:1575941527;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>角色添加</title>
    <link href="/static/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/static/admin/css/style.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/font-awesome.min.css" />
    <link href="/static/admin/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
    <script src="/static/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/static/admin/assets/js/bootstrap.min.js"></script>
    <script src="/static/admin/js/common.js" type="text/javascript"></script>
</head>

<body>
    <div class="type_style">
        <div class="crumbs">
            <ul>
                <li>
                    <a href="javascript:;">角色管理</a>
                </li>
                <li class="uline">/</li>
                <li>
                    <a class="active" href="javascript:;">添加角色</a>
                </li>
            </ul>
       </div>
        <form action="<?php echo url('Rbac/addRole'); ?>" method="post" class="form form-horizontal">
            <div class="Operate_cont clearfix">
                <label class="form-label">角色英文名称：</label>
                <div class="formControls ">
                    <input type="text" class="input-text" value="" placeholder=""  name="name" datatype="*" nullmsg="角色英文名称不能为空！">
                    <span class="Validform_checktip"></span>
                </div>
            </div>
            <div class="Operate_cont clearfix">
                <label class="form-label">角色描述：</label>
                <div class="formControls ">
                    <input type="text" class="input-text" value="" placeholder=""  name="remark" datatype="*" nullmsg="角色描述不能为空！">
                    <span class="Validform_checktip"></span>
                </div>
            </div>
            <div class="Operate_cont clearfix">
                <label class="form-label text-inline">是否开启：</label>
                <div class="formControls form-inline">
                    <label for="">
                        <input type="radio" name="status" value="1" checked>是
                    </label>
                    <label for="">
                        <input type="radio" name="status" value="0">否
                    </label>
                </div>
            </div>        
            <div class="Operate_cont clearfix">
                <input class="btn btn-primary radius Operate_cont_btn" type="submit" value="提交">
            </div>
        </form>
    </div>

    <script type="text/javascript" src="/static/admin/Widget/Validform/5.3.2/Validform.min.js"></script>
    <script type="text/javascript" src="/static/admin/js/role.js"></script>
</body>
</html>