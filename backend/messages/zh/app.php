<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

return [

    /*
     * ------------------------------------
     * 框架及后台通用页面
     * ------------------------------------
    */
    'tips_user_online'              => '在线',
    'tips_user_avatar'              => '用户头像',
    'layout_content_nav_dashboard'  => '控制台',
    'layout_content_nav_search'     => '搜索',
    'layout_content_nav_refresh'    => '刷新',
    'site_copy_right'               => '&copy; '.date('Y').' Inc. 版权所有',
    'pagination_first'              => '首页',
    'pagination_last'               => '尾页',
    'pagination_next'               => '下一页',
    'pagination_previous'           => '上一页',
    'pub_confirm_delete'            => '删除后将不能再恢复此信息,确定操作吗?',

    /*
     * ------------------------------------
     * buttons 系统按钮部分
     * ------------------------------------
     */
    //公共按钮
    'btn_login'     => '登录',
    'btn_save'      => '保存',
    'btn_reset'     => '重置',
    'btn_cancel'    => '取消',
    'btn_profile'   => '个人信息',
    'btn_logout'    => '安全退出',

    //公共Bar
    'btn_bar_refresh'   => '刷新',
    'btn_bar_create'    => '添加',
    'btn_bar_update'    => '编辑',
    'btn_bar_delete'    => '删除',
    'btn_bar_assign_pms'=> '权限分配',
    'btn_bar_detail'    => '查看详情',
    'btn_bar_view'      => '查看',
    'btn_bar_address'   => '收货地址',
    'btn_bar_customer'  => '客户',

    /*
     * ------------------------------------
     * page title 系统页面标题部分
     * ------------------------------------
     */
    'page_title_login'              => '系统登录',
    'page_title_admin_user_index'   => '管理员管理',
    'page_title_admin_menu_index'   => '菜单管理',

    'page_title_customer'           => '客户管理',
    'page_title_rank'               => '等级管理',
    'page_title_receiver'           => '地址管理',
    'page_title_order'              => '订单管理',

    'page_title_log_index'          => '操作日志',
    'page_title_site_index'         => '综合管理面板',
    'page_title_category'           => '分类管理',
    'page_title_admin_role_user'    => '角色管理',
    'page_title_production_index'   => '工艺数据配置',
    'page_title_order_index'        => '订单列表',
    'page_title_order_create'       => '添加订单',

    'page_title_project'            => '作业管理',


    /*
     * ------------------------------------
     * function desc 系统功能清单描述部分
     * ------------------------------------
     */
    'func_desc_admin_user_index'    => '一个管理员可以有多个角色组,左侧的菜单根据管理员所拥有的权限进行生成',
    'func_desc_admin_menu_index'    => '菜单通常对应一个控制器的方法,同时左侧的菜单栏数据也从规则中体现,通常建议通过命令行进行生成规则节点',
    'func_desc_site_index'          => '用于展示当前系统中的统计数据、统计报表及重要实时数据',
    'func_desc_customer'            => '客户信息管理综合模块,可以对客户进行添加/修改/删除/查询及状态操作等功能',
    'func_desc_rank'                => '客户等级主要区分不同级别客户分类,针对不同分类下的客户所享价格/服务/优惠等有所不同',
    'func_desc_category'            => '用于统一管理网站的所有分类,分类可进行无限级分类',
    'func_desc_admin_role_user'     => '角色组可以有多个,角色有上下级层级关系,如果子角色有角色组和管理员的权限则可以派生属于自己组别的下级角色组或管理员',
    'func_desc_receiver'            => '统一化管理客户订单收货人地址信息,专人维护应用时只需要选择,安全/方便',
    'func_desc_production_index'    => '业务相关数据配置项,包括（打印数据/后工装钉/生产工艺等）',
    'func_desc_order_index'         => '业务综合管理模块,包含订单列表/添加订单/修改及常规业务管理操作',
    'func_desc_project'             => '作业管理为订单最基本的元素构成,一个订单可以有多个作业;作业代表客户要求如何制作的商品信息,包括打印方式,装钉方式等',


    /*
     * ------------------------------------
     * form table label 系统表单部分
     * ------------------------------------
     */
    //公共标题
    'pub_created_at'    => '创建时间',
    'pub_updated_at'    => '更新时间',
    'pub_deleted_at'    => '删除时间',
    'pub_list_id'       => '序号',
    'pub_site_url'      => 'URL',
    'pub_http_method'   => '请求方法',
    'pub_browsers'      => '浏览器',
    'pub_route'         => '路由',
    'pub_is_abs'        => '绝对',
    'pub_ip'            => 'IP',
    'pub_unit'          => '单位',


    'pub_sort'          => '排序',
    'pub_date'          => '日期',
    'pub_time'          => '时间',
    'pub_flag'          => '标识',
    'pub_image'         => '图标',
    'pub_keywords'      => '关键字',
    'pub_description'   => '描述',

    'pub_none'          => '无',

    'pub_parent_id'     => '父级分类',
    'pub_remark'        => '备注',
    'pub_is_display'    => '是否显示',
    'pub_table_head_action' => '操作',
    'pub_yes'           => '是',
    'pub_no'            => '否',
    'pub_please_select' => '--请选择--',
    'pub_please_add'    => '请添加',
    'pub_status'        => '状态',
    'pub_status_normal' => '正常',
    'pub_status_break'  => '暂停',
    'pub_status_disabled' => '禁用',
    'pub_unrecorder'    => '暂时没有查询到记录',

    //
    'pub_name'          => '名称',
    'pub_nickname'      => '简称',
    'pub_type'          => '类型',
    'pub_level'         => '等级',
    'pub_is_default'    => '默认',
    'pub_is_delete'     => '删除',
    'pub_title' =>'标题',
    'pub_photo' =>'图片',
    'pub_link' => '链接',
    'pub_position' => '位置',
    'pub_text' => '文字',
    'pub_price' =>'价格',
    'pub_detail' => '详情',
    'pub_add_detail' => ' 添加详情',

    //联系人信息
    'pub_linkman'       => '联系人',
    'pub_mobile'        => '手机',
    'pub_phone'         => '电话',
    'pub_qq'            => 'QQ',
    'pub_wechat'        => '微信',
    'pub_province'      => '省份',
    'pub_city'          => '城市',
    'pub_area'          => '区域',
    'pub_address'       => '地址',
    'pub_zipcode'       => '邮编',
    'pub_building'      => '标志建筑',
    'pub_email'         => 'Email',
    'pub_account'       => '帐号',
    'pub_password'      => '密码',
    'pub_repassword'    => '重复密码',
    'pub_oldpassword'   => '旧密码',
    'pub_avatar'        => '头像',

    //登录表单
    'form_placeholder_name' => '请输入帐号',
    'form_placeholder_pwd'  => '请输入密码',
    'form_keep_active'      => '保持会话',

    //权限及角色部分
    'role_name' => '角色名称',
    'role'      => '角色',

    //客户管理 customers部分
    'serial_no'     => '客户编号',
    'trade_type'    => '是否挂帐',
    'sales_id'      => '业务员',
    'recommend_id'  => '推荐人',
    'customer_type_rank' => '等级',
    'customer_type_case' => '类型',

    //订单管理 order部分
    'customer_id'       => '客户名称',
    'order_no'          => '订单编号',
    'project_id'        => '项目名称',
    'receiver_id'       => '收货地址',
    'pre_payment_amount'=> '预付款',
    'un_pay_amount'     => '未付款',
    'free_pay_amount'   => '减免',
    'discount'          => '折扣',
    'price'             => '单价',
    'express_cost'      => '运费',
    'express_type'      => '配送方式',
    'express_code'      => '物流单号',
    'status_pay'        => '支付状态',
    'status_confirm'    => '确认状态',
    'status_send'       => '发货状态',
    'produce_content'   => '制作要求',
    'appointed_at'      => '交货时间',
    'is_fire'           => '是否加急',

    //收货人信息
    'receiver_name'     => '收货人',

    //分类管理 Category部分
    'label_category_name'     => '名称',
    'label_category_type'     => '类型',
    'label_category_pid'      => '上级分类',
    'label_category_nickname' => '别称',
    'label_category_diyname'  => '自定义名称',
    'label_category_weigh'    => '排序',

    //adminlog
    'log_user_id' => '操作员',

    //生产工艺
    'production_size'       => '规格',
    'production_code'       => '编号',
    'production_paper'      => '纸张',
    'production_weight'     => '克重',
    'production_pages'      => '印面',
    'production_print_type' => '打印',
    'production_amount'     => '数量',
    'production_pcs'        => '面数',
    //作品



    /*
     * ------------------------------------
     * const 常量定义部分
     * ------------------------------------
     */
    'const_status_normal' => '正常',
    'const_status_closed' => '关闭',
    'const_status_break' => '暂停',

    'const_balance_type_cash' => '现金',
    'const_balance_type_prepay' => '预付',
    'const_balance_type_aftpay' => '挂账',

    //category 分类设置
    'const_category_prod'    => '产品',
    'const_category_service' => '服务',
    'const_category_article' => '资讯',
    'const_category_stock'   => '库存',
    'const_category_hr'      => '人事',
    'const_category_equipment' => '设备',
    'const_category_provide'   => '供应商',

    //生产工艺信息配置
    'const_production_size' => '规格',
    'const_production_paper' => '纸张',
    'const_production_weigh' => '克重',
    'const_production_pages' => '面数',
    'const_production_unit'  => '单位',
    'const_production_print' => '打印方式',

    //
    'const_job_boss' => '老板',
    'const_job_sales' => '业务员',
    'const_job_finance' => '财务',
    'const_job_hr' => 'HR',
    'const_job_service' => '客服',
    'const_job_design' => '印前',
    'const_job_worker' => '后工',
    'const_job_clerk' => '前台',



];