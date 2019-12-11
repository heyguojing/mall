<?php /*a:1:{s:56:"C:\wamp\www\mall\application\admin\view\rbac\access.html";i:1576077637;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>权限列表</title>
    <link rel="shortcut icon" href="/static/admin/images/favicon.ico">
    <link href="/static/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/static/admin/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="/static/admin/assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="/static/admin/css/style.css" />
    <link rel="stylesheet" href="/static/admin/css/node.css" />
    <script src="/static/admin/js/jquery-1.9.1.min.js"></script>
</head>
<script type="text/javascript">
    $(function(){
    	$("input[level=1]").click(function () {
            var inputs = $(this).parents(".app").find("input");
            $(this).prop('checked')?inputs.attr('checked','checked'):inputs.removeAttr('checked');
	    })
	    $("input[level=2]").click(function () {
            
		    var inputs = $(this).parents("dl").find("input");
		    $(this).prop('checked')?inputs.attr('checked','checked'):inputs.removeAttr('checked');
	    })
    });
</script>
<body>
    <div class="crumbs">
        <ul>
            <li>
                <a href="javascript:;" class="active">权限配置</a>
            </li>
        </ul>
    </div>
    <div id="wrap">
        <a href="<?php echo url('Rbac/role'); ?>" class="add-app">返回</a>
        <form action="<?php echo url('rbac/access'); ?>" method="post">
            <?php if(is_array($page_data) || $page_data instanceof \think\Collection || $page_data instanceof \think\Paginator): $i = 0; $__LIST__ = $page_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$app): $mod = ($i % 2 );++$i;?>
            <div class="app">
                <p>
                    <strong><?php echo htmlentities($app['title']); ?></strong>
                    <input type="checkbox" name="access[]" value="<?php echo htmlentities($app['id']); ?>_1" level="1" <?php if($app['access'] == 1): ?> checked="checked"
                        <?php endif; ?>>
                </p>
                <?php if(is_array($app['child']) || $app['child'] instanceof \think\Collection || $app['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $app['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($i % 2 );++$i;?>
                <dl>
                    <dt>
                        <strong><?php echo htmlentities($action['title']); ?></strong>
                        <input type="checkbox" name="access[]" value="<?php echo htmlentities($action['id']); ?>_2" level="2" <?php if($action['access'] == 1): ?> checked="checked"
                            <?php endif; ?>>
                    </dt>
                    <?php if(is_array($action['child']) || $action['child'] instanceof \think\Collection || $action['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $action['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$method): $mod = ($i % 2 );++$i;?>
                    <dd>
                        <span><?php echo htmlentities($method['title']); ?></span>
                        <input type="checkbox" name="access[]" value="<?php echo htmlentities($method['id']); ?>_3" level="3" <?php if($method['access'] == 1): ?> checked="checked"
                            <?php endif; ?>>
                    </dd>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </dl>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <input type="hidden" name="rid" value="<?php echo htmlentities($rid); ?>">
            <input type="submit" class="btn btn-primary radius submit" value="保存修改">
        </form>
    </div>
</body>

</html>
<style>
    .submit{
        width:80px;margin:0 auto 10px;display: flex;align-content: center;
    }
</style>