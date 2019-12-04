<?php /*a:1:{s:59:"C:\wamp\www\mall\application\admin\view\rbac\edit_node.html";i:1575425488;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>节点编辑</title>
    <link href="/static/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/static/admin/css/style.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/font-awesome.min.css" />
    <link href="/static/admin/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
    <script src="/static/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/static/admin/assets/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="type_style">
        <div class="crumbs">
            <ul>
                <li>
                    <a href="javascript:;"><?php echo htmlentities($type); ?>管理</a>
                </li>
                <li class="uline">/</li>
                <li>
                    <a class="active" href="javascript:;">编辑<?php echo htmlentities($type); ?></a>
                </li>
            </ul>
       </div>
        <form action="" method="post" class="form form-horizontal">
            <div class="Operate_cont clearfix">
                <label class="form-label"><?php echo htmlentities($type); ?>名称：</label>
                <div class="formControls ">
                    <input type="text" class="input-text" value="<?php echo htmlentities($editdata['name']); ?>" placeholder=""  name="name" datatype="*" nullmsg="<?php echo htmlentities($type); ?>名称不能为空！">
                    <span class="Validform_checktip"></span>
                </div>
            </div>
            <div class="Operate_cont clearfix">
                <label class="form-label"><?php echo htmlentities($type); ?>描述：</label>
                <div class="formControls ">
                    <input type="text" class="input-text" value="<?php echo htmlentities($editdata['title']); ?>" placeholder=""  name="title" datatype="*" nullmsg="<?php echo htmlentities($type); ?>描述不能为空！">
                    <span class="Validform_checktip"></span>
                </div>
            </div>
            <?php if($parameter == 1): ?>
            <div class="Operate_cont clearfix">
                <label class="form-label"><?php echo htmlentities($type); ?>参数名：</label>
                <div class="formControls ">
                    <input type="text" class="input-text" value="" name="<?php echo htmlentities($parameter); ?>" placeholder="">
                </div>
            </div>
            <div class="Operate_cont clearfix">
                <label class="form-label"><?php echo htmlentities($type); ?>参数值：</label>
                <div class="formControls ">
                    <input type="text" class="input-text" value="" name="<?php echo htmlentities($parameter_title); ?>" placeholder="">
                </div>
            </div>
            <?php endif; ?>
            <div class="Operate_cont clearfix">
                <label class="form-label text-inline">状态：</label>
                <div class="formControls form-inline">
                    <label for="">
                        <input type="radio" name="status" value="1" <?php if($editdata['status'] == 1): ?> checked <?php endif; ?> >显示
                    </label>
                    <label for="">
                        <input type="radio" name="status" value="0" <?php if($editdata['status'] == 0): ?> checked <?php endif; ?> >隐藏
                    </label>
                </div>
            </div>
            <div class="Operate_cont clearfix">
                <label class="form-label text-inline">是否显示在菜单栏：</label>
                <div class="formControls form-inline">
                    <label for="">
                        <input type="radio" name="is_show" value="1" <?php if($editdata['is_show'] == 1): ?> checked <?php endif; ?> >显示
                    </label>
                    <label for="">
                        <input type="radio" name="is_show" value="0" <?php if($editdata['is_show'] == 0): ?> checked <?php endif; ?> >隐藏
                    </label>
                </div>
            </div>
            <div class="Operate_cont clearfix">
                <label class="form-label">排序：</label>
                <div class="formControls ">
                    <input type="text" class="input-text" value="<?php echo htmlentities($editdata['sort']); ?>" placeholder=""  name="sort" datatype="*" nullmsg="排序名称不能为空！">
                    <span class="Validform_checktip"></span>
                </div>
            </div>            
            <div class="Operate_cont clearfix">
                <input type="hidden" name="level" value="<?php echo htmlentities($level); ?>">
                <input type="hidden" name="pid" value="<?php echo htmlentities($pid); ?>">
                <input class="btn btn-primary radius Operate_cont_btn" type="submit" value="提交">
            </div>
        </form>
    </div>

    <script type="text/javascript" src="/static/admin/Widget/Validform/5.3.2/Validform.min.js"></script>
    <script type="text/javascript">
         $(function() {
            //表单验证
            $("form").Validform({
                tiptype:function(msg,o,cssctl){
                    if(!o.obj.is("form")){
                        //默认表单
                        var objtip=o.obj.parents(".formControls").find(".Validform_checktip");
                        cssctl(objtip,o.type);
                        objtip.text(msg);
                    }
                },
                showAllError:true
            })
        });
    </script>
</body>
</html>