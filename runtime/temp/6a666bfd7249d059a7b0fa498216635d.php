<<<<<<< HEAD
<?php /*a:1:{s:54:"C:\wamp\www\mall\application\admin\view\rbac\node.html";i:1575300564;}*/ ?>
=======
<?php /*a:1:{s:54:"C:\wamp\www\mall\application\admin\view\rbac\node.html";i:1575335162;}*/ ?>
>>>>>>> 83002a61b142ea2c151b293e3cdba29382d4ce64
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>节点列表</title>
    <link rel="shortcut icon" href="/static/admin/images/favicon.ico">
    <link href="/static/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/static/admin/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="/static/admin/css/style.css" />
    <link rel="stylesheet" href="/static/admin/css/node.css" />
</head>

<body>
    <div class="crumbs">
        <ul>
            <li>
                <a href="javascript:;" class="active">节点管理</a>
            </li>
        </ul>
    </div>
    <div id="wrap">
        <a href="<?php echo url('Rbac/addNode'); ?>" class="add-app">添加总模块</a>
        <?php if(is_array($page_data) || $page_data instanceof \think\Collection || $page_data instanceof \think\Paginator): $i = 0; $__LIST__ = $page_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$app): $mod = ($i % 2 );++$i;?>
        <div class="app">
            <p>
                <strong><?php echo htmlentities($app['title']); ?></strong> 
                [<a href="<?php echo url('Rbac/addNode',array('pid' => $app['id'],'level'=>2)); ?>">添加控制器</a>] 
                [<a href="<?php echo url('Rbac/editNode',array('id' => $app['id'],'level'=>1)); ?>">修改</a>] 
                [<a url="<?php echo url('Rbac/delNode',array('id' => $app['id'],'level'=>1)); ?>" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
            </p>
            <?php if(is_array($app['child']) || $app['child'] instanceof \think\Collection || $app['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $app['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($i % 2 );++$i;?>
            <dl>
                <dt>
                    <strong><?php echo htmlentities($action['title']); ?></strong> 
                    [<a href="<?php echo url('Rbac/addNode',array('pid'=>$action['id'],'level'=>3)); ?>">添加方法</a>] 
                    [<a href="<?php echo url('Rbac/editNode',array('id'=>$action['id'],'level'=>2)); ?>">修改</a>] 
                    [<a url="<?php echo url('Rbac/delNode',array('id'=>$action['id'],'level'=>2)); ?>" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dt>
                <?php if(is_array($action['child']) || $action['child'] instanceof \think\Collection || $action['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $action['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$method): $mod = ($i % 2 );++$i;?>
                <dd>
                    <span><?php echo htmlentities($method['title']); ?></span> 
                    [<a href="<?php echo url('Rbac/editNode',array('id'=>$method['id'],'level'=>3)); ?>">修改</a>]
                    [<a url="<?php echo url('Rbac/delNode',array('id'=>$method['id'],'level'=>3)); ?>" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </dl>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</body>

</html>