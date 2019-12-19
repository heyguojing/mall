<?php /*a:1:{s:58:"C:\wamp\www\mall\application\admin\view\rbac\add_user.html";i:1576742920;}*/ ?>
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
                    <a href="<?php echo url('rbac/user'); ?>">管理员管理</a>
                </li>
                <li class="uline">/</li>
                <li>
                    <a class="active" href="javascript:;">添加管理员</a>
                </li>
            </ul>
       </div>
        <form action="<?php echo url('Rbac/addUser'); ?>" method="post" class="form form-horizontal">
            <div class="Operate_cont clearfix">
                <label class="form-label">管理员名称：</label>
                <div class="formControls ">
                        <input type="text" class="input-text" value="" placeholder=""  name="username" datatype="*" ajaxUrl="<?php echo url('rbac/ajaxUsername'); ?>" nullmsg="管理员名称不能为空！">
                    <span class="Validform_checktip"></span>
                </div>
            </div>
            <div class="Operate_cont clearfix">
                <label class="form-label">管理员密码：</label>
                <div class="formControls ">
                    <input type="password" class="input-text" value="" name="password" datatype="/^[\w\W]{6,18}$/" nullmsg="管理员密码不能为空！">
                    <span class="Validform_checktip"></span>
                </div>
            </div>
            <div class="Operate_cont clearfix">
                <label class="form-label">所属角色组：</label>
                <div class="formControls ">
                    <?php if(is_array($role_data) || $role_data instanceof \think\Collection || $role_data instanceof \think\Paginator): $i = 0; $__LIST__ = $role_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <label for="">
                        <input type="checkbox" name="role_id[]" value="<?php echo htmlentities($vo['id']); ?>" class="role_id" datatype="*" nullmsg="所属角色组不能为空！"><?php echo htmlentities($vo['remark']); ?>
                    </label>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
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