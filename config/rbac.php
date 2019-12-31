<?php
return array(
    'RBAC_SUPERADMIN' => 'admin',//指定超级管理员
    'ADMIN_AUTH_KEY' => 'superadmin',//指定超级管理员识别号
    'USER_AUTH_ON' => true, //权限是否开启
    'USER_AUTH_TYPE' => 1,// 验证类型(1:登陆验证 2:实时验证)
    'USER_AUTH_KEY' => 'uid', //用户认证识别号
    'NOT_AUTH_MODULE' => 'index',//无需验证的模块
    'NOT_AUTH_ACTION' => 'copy',//无需验证的方法
    'RBAC_ROLE_TABLE' => 'mall_role',//角色表
    'RBAC_ACCESS_TABLE' => 'mall_access',//权限表
    'RBAC_NODE_TABLE' => 'mall_node',//节点表
    'RBAC_USER_TABLE' => 'mall_role_user',//用户与角色中间表
    'USER_AUTH_MODULE' => 'mall_admin'//管理员表
);