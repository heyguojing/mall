<?php /*a:1:{s:58:"C:\wamp\www\mall\application\admin\view\rbac\add_node.html";i:1574932929;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>添加产品分类</title>
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
                    <a href="index.html">产品分类管理</a>
                </li>
                <li class="uline">/</li>
                <li>
                    <a class="active" href="javascript:;">产品分类</a>
                </li>
            </ul>
       </div>
        <form action="" method="post" class="form form-horizontal">
            <div class="Operate_cont clearfix">
                <label class="form-label">节点名称：</label>
                <div class="formControls ">
                    <input type="text" class="input-text" value="" placeholder=""  name="name" datatype="*" nullmsg="节点名称不能为空！">
                    <span class="Validform_checktip"></span>
                </div>
            </div>
            <div class="Operate_cont clearfix">
                <label class="form-label">中文名称：</label>
                <div class="formControls ">
                    <input type="text" class="input-text" value="" placeholder=""  name="title" datatype="*" nullmsg="中文名称不能为空！">
                    <span class="Validform_checktip"></span>
                </div>
            </div>
            <div class="Operate_cont clearfix">
                <label class="form-label text-inline">状态：</label>
                <div class="formControls form-inline">
                    <label for="">
                        <input type="radio" name="status" value="1" checked>显示
                    </label>
                    <label for="">
                        <input type="radio" name="status" value="">隐藏
                    </label>
                </div>
            </div>
            <div class="Operate_cont clearfix">
                <label class="form-label text-inline">是否显示在菜单栏：</label>
                <div class="formControls form-inline">
                    <label for="">
                        <input type="radio" name="is_show" value="1" checked>显示
                    </label>
                    <label for="">
                        <input type="radio" name="is_show" value="">隐藏
                    </label>
                </div>
            </div>
            <div class="Operate_cont clearfix">
                <label class="form-label">排序：</label>
                <div class="formControls ">
                    <input type="text" class="input-text" value="" placeholder=""  name="sort" datatype="*" nullmsg="排序名称不能为空！">
                    <span class="Validform_checktip"></span>
                </div>
            </div>            
            <div class="Operate_cont clearfix">
                <label class="form-label">备注：</label>
                <div class="formControls">
                    <textarea name="" rows="" class="textarea" placeholder="说点什么...最少输入10个字符"  onKeyUp="textarealength(this,100)" datatype="*" nullmsg="备注不能为空！"></textarea>
                    <span class="Validform_checktip"></span>
                    <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
                </div>
            </div>
            <div class="Operate_cont clearfix">
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