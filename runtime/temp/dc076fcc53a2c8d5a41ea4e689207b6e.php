<?php /*a:1:{s:54:"C:\wamp\www\mall\application\admin\view\rbac\role.html";i:1575625964;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>角色列表</title>
    <link href="/static/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/static/admin/css/style.css" />
    <link href="/static/admin/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/static/admin/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/static/admin/font/css/font-awesome.min.css" />
    <script src="/static/admin/js/jquery-1.9.1.min.js"></script>
    <script src="/static/admin/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/admin/Widget/Validform/5.3.2/Validform.min.js"></script>
    <script src="/static/admin/assets/js/typeahead-bs2.min.js"></script>
    <script src="/static/admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/static/admin/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/static/admin/assets/layer/layer.js" type="text/javascript"></script>
    <script src="/static/admin/js/lrtk.js" type="text/javascript"></script>
    <script src="/static/admin/assets/layer/layer.js" type="text/javascript"></script>
    <script src="/static/admin/assets/laydate/laydate.js" type="text/javascript"></script>
</head>

<body>
    <div class="crumbs">
        <ul>
            <li>
                <a class="active" href="javascript:;">角色列表</a>
            </li>
        </ul>
    </div>
    <div class="page-content clearfix">
        <div class="administrator">
            <div class="d_Confirm_Order_style">
                <form action="" method="post">
                    <div class="search_style">
                        <ul class="search_content clearfix">
                            <li>
                                <label class="l_f">角色名称:</label>
                                <input name="remark" type="text" class="text_add" value="<?php if($remark != 'n'): ?> <?php echo htmlentities($remark); ?> <?php endif; ?>"/>
                            </li>
                            <li>
                                <label class="l_f">开启状态:</label>
                                <select name="status">
                                    <option value="-1" <?php if($status == -1): ?> selected <?php endif; ?>>==请选择==</option>
                                    <option value="1" <?php if($status == 1): ?> selected <?php endif; ?>>==开启==</option>
                                    <option value="0" <?php if($status == 0): ?> selected <?php endif; ?>>==关闭==</option>
                                </select>
                            </li>
                            <li style="width:90px;">
                                <button type="submit" class="btn_search">
                                    <i class="fa fa-search"></i>查询
                                </button>
                            </li>
                        </ul>
                    </div>
                </form>
                <!--操作-->
                <div class="border clearfix">
                    <span class="l_f">
                        <a href="javascript:;" class="btn btn-warning">
                            <i class="fa fa-plus"></i> 添加角色</a>
                        <a href="javascript:;" class="btn btn-danger">
                            <i class="fa fa-trash"></i> 批量删除</a>
                    </span>
                </div>
                <!--角色列表-->
                <div class="clearfix">
                    <div class="table_menu_list">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="25px">
                                        <label>
                                            <input type="checkbox" class="ace">
                                            <span class="lbl"></span>
                                        </label>
                                    </th>
                                    <th>角色id</th>
                                    <th>角色名称</th>
                                    <th>描述</th>
                                    <th>开启状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($page_data) || $page_data instanceof \think\Collection || $page_data instanceof \think\Paginator): $i = 0; $__LIST__ = $page_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td>
                                        <label>
                                            <input type="checkbox" class="ace">
                                            <span class="lbl"></span>
                                        </label>
                                    </td>
                                    <td><?php echo htmlentities($role['id']); ?></td>
                                    <td><?php echo htmlentities($role['name']); ?></td>
                                    <td><?php echo htmlentities($role['remark']); ?></td>
                                    <td><?php if($role['status'] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></td>
                                    <td>
                                        <a title="编辑" href="<?php echo url('Rbac/editRole'); ?>" class="btn btn-xs btn-info">
                                            <i class="fa fa-edit bigger-120"></i>
                                        </a>
                                        <a title="删除" href="<?php echo url('Rbac/delRole'); ?>" onclick="confirm_msg(this)" url="<?php echo url('Rbac/delRole'); ?>" class="btn btn-xs btn-warning">
                                            <i class="fa fa-trash  bigger-120"></i>
                                        </a>
                                        <a title="删除" href="javascript:;" onclick="confirm_msg(this)" url="<?php echo url('Rbac/delRole'); ?>" class="btn btn-xs btn-warning">
                                            <i class="fa fa-trash  bigger-120"></i>配置权限
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="dataTables_info">共 <?php echo htmlentities($page_total); ?> 条</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="dataTables_paginate paging_bootstrap">
                            <ul class="pagination">
                                <?php echo htmlspecialchars_decode($page);?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>