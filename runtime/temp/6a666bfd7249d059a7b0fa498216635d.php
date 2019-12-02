<?php /*a:1:{s:54:"C:\wamp\www\mall\application\admin\view\rbac\node.html";i:1575249575;}*/ ?>
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
        <a href="/Rbac/addNode.html" class="add-app">添加应用</a>
        <div class="app">
            <p>
                <strong>权限管理</strong> [
                <a href="/Rbac/addNode/pid/1/level/2.html">添加控制器</a>] [
                <a href="/Rbac/editNode/id/1/level/1.html">修改</a>] [
                <a url="/Rbac/deleteNode/id/1/level/1.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
            </p>
            <dl>
                <dt>
						<strong>RBAC用户权限管理</strong>
						[<a href="/Rbac/addNode/pid/2/level/3.html">添加方法</a>]
						[<a href="/Rbac/editNode/id/2/level/2.html">修改</a>]
						[<a url="/Rbac/deleteNode/id/2/level/2.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
					</dt>
                <dd>
                    <span>管理员列表</span> [
                    <a href="/Rbac/editNode/id/3/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/3/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>角色列表</span> [
                    <a href="/Rbac/editNode/id/4/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/4/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>节点列表</span> [
                    <a href="/Rbac/editNode/id/5/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/5/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>添加管理员</span> [
                    <a href="/Rbac/editNode/id/6/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/6/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>添加角色</span> [
                    <a href="/Rbac/editNode/id/7/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/7/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>添加节点</span> [
                    <a href="/Rbac/editNode/id/8/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/8/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>日志列表</span> [
                    <a href="/Rbac/editNode/id/10/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/10/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>编辑节点</span> [
                    <a href="/Rbac/editNode/id/11/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/11/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>删除节点</span> [
                    <a href="/Rbac/editNode/id/12/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/12/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>编辑角色</span> [
                    <a href="/Rbac/editNode/id/13/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/13/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>删除角色</span> [
                    <a href="/Rbac/editNode/id/14/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/14/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>编辑权限</span> [
                    <a href="/Rbac/editNode/id/15/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/15/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>编辑管理员</span> [
                    <a href="/Rbac/editNode/id/16/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/16/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>修改用户密码</span> [
                    <a href="/Rbac/editNode/id/19/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/19/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>是否锁定用户</span> [
                    <a href="/Rbac/editNode/id/20/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/20/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>删除用户</span> [
                    <a href="/Rbac/editNode/id/21/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/21/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>删除日志</span> [
                    <a href="/Rbac/editNode/id/22/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/22/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>配置ip地址</span> [
                    <a href="/Rbac/editNode/id/23/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/23/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>添加ip地址</span> [
                    <a href="/Rbac/editNode/id/24/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/24/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>编辑ip地址</span> [
                    <a href="/Rbac/editNode/id/25/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/25/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>删除ip地址</span> [
                    <a href="/Rbac/editNode/id/26/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/26/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax验证运行登录ip地址</span> [
                    <a href="/Rbac/editNode/id/27/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/27/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>重置密码</span> [
                    <a href="/Rbac/editNode/id/28/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/28/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax验证用户名是否重复</span> [
                    <a href="/Rbac/editNode/id/63/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/63/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
            </dl>
            <dl>
                <dt>
						<strong>公共处理管理</strong>
						[<a href="/Rbac/addNode/pid/29/level/3.html">添加方法</a>]
						[<a href="/Rbac/editNode/id/29/level/2.html">修改</a>]
						[<a url="/Rbac/deleteNode/id/29/level/2.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
					</dt>
                <dd>
                    <span>uploadify做ajax上传</span> [
                    <a href="/Rbac/editNode/id/30/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/30/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>uploadify做ajax删除</span> [
                    <a href="/Rbac/editNode/id/31/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/31/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>编辑器上传</span> [
                    <a href="/Rbac/editNode/id/32/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/32/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>广告ajax上传</span> [
                    <a href="/Rbac/editNode/id/33/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/33/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>广告ajax删除</span> [
                    <a href="/Rbac/editNode/id/34/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/34/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
            </dl>
            <dl>
                <dt>
						<strong>会员管理</strong>
						[<a href="/Rbac/addNode/pid/79/level/3.html">添加方法</a>]
						[<a href="/Rbac/editNode/id/79/level/2.html">修改</a>]
						[<a url="/Rbac/deleteNode/id/79/level/2.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
					</dt>
                <dd>
                    <span>会员列表</span> [
                    <a href="/Rbac/editNode/id/80/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/80/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>添加会员</span> [
                    <a href="/Rbac/editNode/id/81/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/81/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>编辑会员</span> [
                    <a href="/Rbac/editNode/id/82/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/82/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>删除会员</span> [
                    <a href="/Rbac/editNode/id/83/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/83/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax验证用户邮箱是否重复</span> [
                    <a href="/Rbac/editNode/id/84/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/84/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax更新相关属性</span> [
                    <a href="/Rbac/editNode/id/85/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/85/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
            </dl>
        </div>
        <div class="app">
            <p>
                <strong>系统管理</strong> [
                <a href="/Rbac/addNode/pid/35/level/2.html">添加控制器</a>] [
                <a href="/Rbac/editNode/id/35/level/1.html">修改</a>] [
                <a url="/Rbac/deleteNode/id/35/level/1.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
            </p>
            <dl>
                <dt>
						<strong>配置组管理</strong>
						[<a href="/Rbac/addNode/pid/36/level/3.html">添加方法</a>]
						[<a href="/Rbac/editNode/id/36/level/2.html">修改</a>]
						[<a url="/Rbac/deleteNode/id/36/level/2.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
					</dt>
                <dd>
                    <span>配置组列表</span> [
                    <a href="/Rbac/editNode/id/37/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/37/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>添加配置组</span> [
                    <a href="/Rbac/editNode/id/38/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/38/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>编辑配置组</span> [
                    <a href="/Rbac/editNode/id/39/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/39/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>删除配置组</span> [
                    <a href="/Rbac/editNode/id/40/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/40/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax验证标题</span> [
                    <a href="/Rbac/editNode/id/51/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/51/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax更新排序</span> [
                    <a href="/Rbac/editNode/id/52/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/52/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax审核状态</span> [
                    <a href="/Rbac/editNode/id/53/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/53/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
            </dl>
            <dl>
                <dt>
						<strong>网站配置</strong>
						[<a href="/Rbac/addNode/pid/41/level/3.html">添加方法</a>]
						[<a href="/Rbac/editNode/id/41/level/2.html">修改</a>]
						[<a url="/Rbac/deleteNode/id/41/level/2.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
					</dt>
                <dd>
                    <span>网站配置</span> [
                    <a href="/Rbac/editNode/id/42/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/42/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>参数列表</span> [
                    <a href="/Rbac/editNode/id/43/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/43/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>添加参数</span> [
                    <a href="/Rbac/editNode/id/44/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/44/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>编辑参数</span> [
                    <a href="/Rbac/editNode/id/45/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/45/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>删除参数</span> [
                    <a href="/Rbac/editNode/id/46/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/46/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax验证参数名称</span> [
                    <a href="/Rbac/editNode/id/47/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/47/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax验证参数中文名称</span> [
                    <a href="/Rbac/editNode/id/48/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/48/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax更新排序</span> [
                    <a href="/Rbac/editNode/id/49/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/49/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax更新相关属性</span> [
                    <a href="/Rbac/editNode/id/50/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/50/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
            </dl>
        </div>
        <div class="app">
            <p>
                <strong>前台信息</strong> [
                <a href="/Rbac/addNode/pid/54/level/2.html">添加控制器</a>] [
                <a href="/Rbac/editNode/id/54/level/1.html">修改</a>] [
                <a url="/Rbac/deleteNode/id/54/level/1.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
            </p>
            <dl>
                <dt>
						<strong>文章管理</strong>
						[<a href="/Rbac/addNode/pid/55/level/3.html">添加方法</a>]
						[<a href="/Rbac/editNode/id/55/level/2.html">修改</a>]
						[<a url="/Rbac/deleteNode/id/55/level/2.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
					</dt>
                <dd>
                    <span>文章列表</span> [
                    <a href="/Rbac/editNode/id/56/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/56/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>添加文章</span> [
                    <a href="/Rbac/editNode/id/57/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/57/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>编辑文章</span> [
                    <a href="/Rbac/editNode/id/58/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/58/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>删除文章</span> [
                    <a href="/Rbac/editNode/id/59/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/59/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax验证文章标题</span> [
                    <a href="/Rbac/editNode/id/60/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/60/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax更新相关属性</span> [
                    <a href="/Rbac/editNode/id/61/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/61/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax更新排序</span> [
                    <a href="/Rbac/editNode/id/62/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/62/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>批量审核</span> [
                    <a href="/Rbac/editNode/id/78/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/78/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
            </dl>
            <dl>
                <dt>
						<strong>文章分类管理</strong>
						[<a href="/Rbac/addNode/pid/64/level/3.html">添加方法</a>]
						[<a href="/Rbac/editNode/id/64/level/2.html">修改</a>]
						[<a url="/Rbac/deleteNode/id/64/level/2.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
					</dt>
                <dd>
                    <span>分类列表</span> [
                    <a href="/Rbac/editNode/id/65/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/65/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>添加分类</span> [
                    <a href="/Rbac/editNode/id/66/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/66/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>编辑分类</span> [
                    <a href="/Rbac/editNode/id/67/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/67/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>删除分类</span> [
                    <a href="/Rbac/editNode/id/68/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/68/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax验证分类名称</span> [
                    <a href="/Rbac/editNode/id/69/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/69/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax审核状态</span> [
                    <a href="/Rbac/editNode/id/70/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/70/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
            </dl>
            <dl>
                <dt>
						<strong>广告联盟位</strong>
						[<a href="/Rbac/addNode/pid/71/level/3.html">添加方法</a>]
						[<a href="/Rbac/editNode/id/71/level/2.html">修改</a>]
						[<a url="/Rbac/deleteNode/id/71/level/2.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
					</dt>
                <dd>
                    <span>联盟位列表</span> [
                    <a href="/Rbac/editNode/id/72/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/72/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>添加联盟位</span> [
                    <a href="/Rbac/editNode/id/73/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/73/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>编辑联盟位</span> [
                    <a href="/Rbac/editNode/id/74/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/74/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>删除联盟位</span> [
                    <a href="/Rbac/editNode/id/75/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/75/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>ajax审核状态</span> [
                    <a href="/Rbac/editNode/id/76/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/76/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>批量审核</span> [
                    <a href="/Rbac/editNode/id/77/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/77/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
            </dl>
            <dl>
                <dt>
						<strong>统计管理</strong>
						[<a href="/Rbac/addNode/pid/86/level/3.html">添加方法</a>]
						[<a href="/Rbac/editNode/id/86/level/2.html">修改</a>]
						[<a url="/Rbac/deleteNode/id/86/level/2.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
					</dt>
                <dd>
                    <span>联盟统计</span> [
                    <a href="/Rbac/editNode/id/87/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/87/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>文章统计</span> [
                    <a href="/Rbac/editNode/id/88/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/88/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>图表统计</span> [
                    <a href="/Rbac/editNode/id/89/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/89/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
                <dd>
                    <span>查看详情</span> [
                    <a href="/Rbac/editNode/id/90/level/3.html">修改</a>] [
                    <a url="/Rbac/deleteNode/id/90/level/3.html" href="javascript:void(0);" onclick="confirm_msg(this);">删除</a>]
                </dd>
            </dl>
        </div>

    </div>

</body>

</html>
