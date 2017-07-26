<?php

/**
 * ECSHOP 管理中心供货商管理
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.68ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: 68ecshop $
 * $Id: suppliers.php 15013 2009-05-13 09:31:42Z 68ecshop $
 */

define('IN_ECS', true);
error_reporting(0);
ini_set('display_errors', 0);
ini_set('short_open_tag', 0);
require(dirname(__FILE__) . '/includes/init.php');
require(ROOT_PATH . 'languages/' . $_CFG['lang'] . '/admin/supplier.php');
require(ROOT_PATH . 'includes/lib_virtual_goods.php');
$smarty->assign('lang', $_LANG);

/*------------------------------------------------------ */
//-- 分站申请列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list') {
    /* 检查权限 */
    admin_priv('supplier_manage');


    $listState=isset($_REQUEST['state'])?$_REQUEST['state']:0;
    if ($_REQUEST['state'] == 1) {
        /* 查询 */
        $result = suppliers_list(false);
    } else {
        /* 查询 */
        $result = suppliers_list();
    }


    /* 模板赋值 */
    $ur_here_lang = $_REQUEST['state'] == '1' ? '分站列表' : '分站申请表';
    $smarty->assign('ur_here', $ur_here_lang); // 当前导航

    $smarty->assign('full_page', 1); // 翻页参数

    $smarty->assign('status', $_REQUEST['status']);
    $smarty->assign('state',$listState);
    $smarty->assign('supplier_list', $result['result']);
    $smarty->assign('filter', $result['filter']);
    $smarty->assign('record_count', $result['record_count']);
    $smarty->assign('page_count', $result['page_count']);
    $smarty->assign('sort_suppliers_id', '<img src="images/sort_desc.gif">');
    $sql = "select rank_id,rank_name from " . $ecs->table('supplier_rank') . " order by sort_order";
    $supplier_rank = $db->getAll($sql);
    $smarty->assign('supplier_rank', $supplier_rank);

    /* 显示模板 */
    assign_query_info();
    $smarty->display('substation_list.htm');
}

/*------------------------------------------------------ */
//-- 排序、分页、查询
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query') {
    check_authz_json('supplier_manage');

    $status = isset($_REQUEST['status'])?intval($_REQUEST['status']):'0' ;
    if ($status) {
        $switch = true;
    } else {
        $switch = false;
    }

    $result = suppliers_list($switch);

    $smarty->assign('supplier_list', $result['result']);
    $smarty->assign('filter', $result['filter']);
    $smarty->assign('record_count', $result['record_count']);
    $smarty->assign('page_count', $result['page_count']);
    $smarty->assign('sql', $result['sql']);
    /* 排序标记 */
    $sort_flag = sort_flag($result['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('substation_list.htm'), '',
        array('filter' => $result['filter'], 'page_count' => $result['page_count']));
}


/*------------------------------------------------------ */
//-- 查看、编辑供货商
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit') {
    /* 检查权限 */
    admin_priv('supplier_manage');
    $suppliers = array();

    /* 取得供货商信息 */
    $id = $_REQUEST['id'];
// 	 $status = intval($_REQUEST['status']);
    $sql = "SELECT * FROM " . $ecs->table('substation_apply') . " WHERE member_id = '$id'";
    $supplier = $db->getRow($sql);
    if (count($supplier) <= 0) {
        sys_msg('分站申请不存在！');
    }
    $supplier['status'] = $supplier['state'];
    /* 省市县 */
    $supplier_country = $supplier['country'] ? $supplier['country'] : $_CFG['shop_country'];
    $smarty->assign('country_list', get_regions());
    $smarty->assign('province_list', get_regions(1, $supplier_country));
    $smarty->assign('city_list', get_regions(2, $supplier['province']));
    $smarty->assign('district_list', get_regions(3, $supplier['city']));
    $smarty->assign('supplier_country', $supplier_country);
    /* 供货商等级 */
    //$sql="select rank_name from ". $ecs->table('supplier_rank') ." where rank_id = ".$supplier['rank_id'];
    //$rank_name=$db->getOne($sql);
    $supplier['rank_name'] = '';
    // $smarty->assign('supplier_rank', $supplier_rank);

    /* 店铺类型 */

    $supplier['type_name'] = '';

    $smarty->assign('ur_here', '查看分站详情');
    $lang_supplier_list = '分站申请列表';
    $smarty->assign('action_link', array('href' => 'substations.php?act=list', 'text' => $lang_supplier_list));
    if ($_REQUEST['status'] == '1') {

        $smarty->assign('action_link', array('href' => 'substations.php?act=list&state=1', 'text' => $lang_supplier_list));
    } else {
        $smarty->assign('action_link', array('href' => 'substations.php?act=list', 'text' => $lang_supplier_list));
    }

    $smarty->assign('form_action', 'update');
    $smarty->assign('supplier', $supplier);
    /* 代码增加 By  www.68ecshop.com Start */
    // 商品等级

    $levelList = array('3' => '省级', '2' => '市级', '1' => '区级');
    $smarty->assign('rank_id', $supplier['level']);
    $smarty->assign('supplier_rank_list', $levelList);
    /* 代码增加 By  www.68ecshop.com End */
    assign_query_info();

    $smarty->display('substation_info.htm');


}

/*------------------------------------------------------ */
//-- 查看供货商佣金日志
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'view') {
    /* 检查权限 */
    admin_priv('supplier_manage');

    /* 查询 */
    $result = rebate_log_list();

    /* 模板赋值 */
    $smarty->assign('ur_here', '佣金日志记录'); // 当前导航

    $smarty->assign('full_page', 1); // 翻页参数

    $smarty->assign('log_list', $result['result']);
    $smarty->assign('filter', $result['filter']);
    $smarty->assign('record_count', $result['record_count']);
    $smarty->assign('page_count', $result['page_count']);
    $smarty->assign('sort_suppliers_id', '<img src="images/sort_desc.gif">');

    /* 显示模板 */
    assign_query_info();
    $smarty->display('supplier_log_list.htm');
}

/*------------------------------------------------------ */
//-- 排序、分页、查询
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query_log') {
    check_authz_json('supplier_manage');

    $result = rebate_log_list();

    $smarty->assign('log_list', $result['result']);
    $smarty->assign('filter', $result['filter']);
    $smarty->assign('record_count', $result['record_count']);
    $smarty->assign('page_count', $result['page_count']);;

    make_json_result($smarty->fetch('supplier_log_list.htm'), '',
        array('filter' => $result['filter'], 'page_count' => $result['page_count']));
}

/*------------------------------------------------------ */
//-- 提交添加、编辑供货商
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'update') {
    /* 检查权限 */
    admin_priv('supplier_manage');

    //审核通过，必须要填写的项目
    /* 代码删除 By www.68ecshop.com Start */
//    if(intval($_POST['status']) == 1){
//        if(intval($_POST['supplier_rebate_paytime'])<=0){
//            sys_msg('结算类型必须选择！');
//        }
//    }
    /* 代码删除 By www.68ecshop.com End */
    /* 提交值 */
    $supplier_id = intval($_POST['id']);
    $status_url = intval($_POST['status_url']);
    $supplier = array(
        //'rank_id'   => intval($_POST['rank_id']),
        //'country'   => intval($_POST['country']),
        //'province'   => intval($_POST['province']),
        //'city'   => intval($_POST['city']),
        //'district'   => intval($_POST['district']),
        //'address'   => trim($_POST['address']),
        //'tel'   => trim($_POST['tel']),
        //'email'   => trim($_POST['email']),
        //'contact_back'   => trim($_POST['contact_back']),
        //'contact_shop'   => trim($_POST['contact_shop']),
        //'contact_yunying'   => trim($_POST['contact_yunying']),
        //'contact_shouhou'   => trim($_POST['contact_shouhou']),
        //'contact_caiwu'   => trim($_POST['contact_caiwu']),
        //'contact_jishu'   => trim($_POST['contact_jishu']),
        'full_name' => trim($_POST['contacts_name']),
        'address' => trim($_POST['address']),
        'telephone' => trim($_POST['contacts_phone']),
        'email' => trim($_POST['email']),
        'level' => trim($_POST['rank_id']),
        'profit' => trim($_POST['supplier_rebate']),
        'remark' => trim($_POST['supplier_remark']),
        'state' => trim($_POST['status']),
        'is_unique' => trim($_POST['is_unique']),
        'updated_at' => time()
    );
    /* 代码增加_start  By  supplier.68ecshop.com */
    /* 取得供货商信息 */
    $sql = "SELECT * FROM " . $ecs->table('users') . " WHERE user_id = '" . $supplier_id . "' ";
    $supplier_old = $db->getRow($sql);
    if (empty($supplier_old['user_id'])) {
        sys_msg('该用户信息不存在！');

    }
    $sql = "SELECT * FROM " . $ecs->table('substation_apply') . " WHERE member_id = '" . $supplier_id . "' AND state>-1 ORDER BY created_at DESC ";
    $applyInfo = $db->getRow($sql);

    /* 代码增加_end  By  supplier.68ecshop.com */

    /* 保存供货商信息 */
    $db->autoExecute($ecs->table('substation_apply'), $supplier, 'UPDATE', "id = '" . $applyInfo['id'] . "'");
    /* 清除缓存 */
    clear_cache_files();

    /* 提示信息 */
    $links[] = array('href' => ($status_url > 0 ? 'substations.php?act=list&status=1' : 'substations.php?act=list'), 'text' => ($status_url > 0 ? $_LANG['back_supplier_list'] : $_LANG['back_supplier_reg']));
    sys_msg($_LANG['edit_supplier_ok'], 0, $links);

} //删除店铺信息
elseif ($_REQUEST['act'] == 'delete') {
    /* 检查权限 */
    admin_priv('supplier_manage');
    $supplier_id = intval($_GET['id']);

    $sql = "SELECT * FROM " . $ecs->table('users') . " WHERE user_id = " . $supplier_id;
    $supplier = $db->getRow($sql);
    if (count($supplier) <= 0) {
        sys_msg('该会员不存在！');
    }

    //更新 分站申请列表

    $db->autoExecute($ecs->table('substation_apply'), array('state' => -1), 'UPDATE', "id = '" . $supplier_id . "'");

    /* 提示信息 */
    $links[0] = array('href' => 'substations.php?act=list&state=' . $supplier['state'], 'text' => '返回上一页');
    sys_msg('删除成功!', 0, $links);
}

/* 代码增加 By  www.68ecshop.com Start */
/*------------------------------------------------------ */
//-- 批量导出供货商
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'export') {
    $where = " WHERE s.applynum = 3 AND s.status = 1 ";

    // 入驻商名称
    if (isset($_REQUEST['supplier_name']) && !empty($_REQUEST['supplier_name'])) {
        $where .= " AND s.supplier_name LIKE '%" . mysql_like_quote($_REQUEST['supplier_name']) . "%'";
    }
    // 入驻商等级
    if (isset($_REQUEST['rank_id']) && !empty($_REQUEST['rank_id'])) {
        $where .= " AND s.rank_id = " . $_REQUEST['rank_id'];
    }

    /* 查询 */
    $sql = "SELECT "
        . "u.user_name, " // 会员名称
        . "s.supplier_name, " // 入驻商名称
        . "s.rank_id, " // 入驻商等级
        . "s.tel, " // 公司电话
        . "s.system_fee, " // 平台使用费
        . "s.supplier_bond, " // 商家保证金
        . "s.supplier_rebate, " // 分成利率
        . "s.supplier_remark, " // 入驻商备注
        . "s.status " // 状态
        . "FROM "
        . $GLOBALS['ecs']->table("supplier") . " AS s LEFT JOIN "
        . $GLOBALS['ecs']->table("users") . " AS u ON s.user_id = u.user_id "
        . $where;

    $res = $GLOBALS['db']->getAll($sql);

    // 引入phpexcel核心类文件
    require_once ROOT_PATH . '/includes/phpexcel/Classes/PHPExcel.php';
    // 实例化excel类
    $objPHPExcel = new PHPExcel();
    // 操作第一个工作表
    $objPHPExcel->setActiveSheetIndex(0);
    // 设置sheet名
    $objPHPExcel->getActiveSheet()->setTitle('入驻商列表');
    // 设置表格宽度
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    // 列名表头文字加粗
    $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
    // 列表头文字居中
    $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    // 列名赋值
    $objPHPExcel->getActiveSheet()->setCellValue('A1', '会员名称');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', '入驻商名称');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', '入驻商等级');
    $objPHPExcel->getActiveSheet()->setCellValue('D1', '公司电话');
    $objPHPExcel->getActiveSheet()->setCellValue('E1', '平台使用费');
    $objPHPExcel->getActiveSheet()->setCellValue('F1', '商家保证金');
    $objPHPExcel->getActiveSheet()->setCellValue('G1', '分成利率');
    $objPHPExcel->getActiveSheet()->setCellValue('H1', '入驻商备注');
    $objPHPExcel->getActiveSheet()->setCellValue('I1', '状态');

    // 数据起始行
    $row_num = 2;
    // 向每行单元格插入数据
    foreach ($res as $value) {
        // 入驻商等级
        switch ($value['rank_id']) {
            case 1:
                $rank_name = '初级店铺';
                break;
            case 2:
                $rank_name = '中级店铺';
                break;
            case 3:
                $rank_name = '高级店铺';
                break;
            default:
                $rank_name = '';
        }

        // 设置所有垂直居中
        $objPHPExcel->getActiveSheet()->getStyle('A' . $row_num . ':' . 'I' . $row_num)->getAlignment()
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        // 设置平台使用费和商家保证金为数字格式
        $objPHPExcel->getActiveSheet()->getStyle('E' . $row_num . ':' . 'F' . $row_num)->getNumberFormat()
            ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        // 设置分成利率为数字格式
        $objPHPExcel->getActiveSheet()->getStyle('G' . $row_num)->getNumberFormat()
            ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);

        // 设置单元格数值
        $objPHPExcel->getActiveSheet()->setCellValueExplicit('A' . $row_num, $value['user_name'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $row_num, $value['supplier_name']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $row_num, $rank_name);
        $objPHPExcel->getActiveSheet()->setCellValueExplicit('D' . $row_num, $value['tel'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $row_num, $value['system_fee']);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $row_num, $value['supplier_bond']);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $row_num, $value['supplier_rebate']);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $row_num, $value['supplier_remark']);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $row_num, $value['status'] ? '通过' : '');
        $row_num++;
    }
    $outputFileName = '入驻商_' . time() . '.xls';
    $xlsWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header('Content-Disposition:inline;filename="' . $outputFileName . '"');
    header("Content-Transfer-Encoding: binary");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Pragma: no-cache");
    $xlsWriter->save("php://output");
    echo file_get_contents($outputFileName);
}
/* 代码增加 By  www.68ecshop.com End */

/**
 *  // 获取 新申请的列表  By Jason
 * @access  public
 * @param
 *
 * @return void
 */
function suppliers_list($isNew = true)
{
    $result = get_filter();

    if ($result === false) {
        $aiax = isset($_GET['is_ajax']) ? $_GET['is_ajax'] : 0;

        /* 过滤信息 */
        $filter['member_name'] = empty($_REQUEST['supplier_name']) ? '' : trim($_REQUEST['supplier_name']);
        $filter['sort_by'] = empty($_REQUEST['sort_by']) ? 'supplier_id' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'ASC' : trim($_REQUEST['sort_order']);
        $filter['status'] = empty($_REQUEST['status']) ? '0' : intval($_REQUEST['status']);

        if ($isNew) {
            $where = ' WHERE state = 11 ';
        } else {
            $where = ' WHERE state > 11 ';
        }


        if ($filter['member_name']) {
            $where .= " AND full_name LIKE '%" . $filter['member_name'] . "%'";
        }

        /* 分页大小 */
        $filter['page'] = empty($_REQUEST['page']) || (intval($_REQUEST['page']) <= 0) ? 1 : intval($_REQUEST['page']);

        if (isset($_REQUEST['page_size']) && intval($_REQUEST['page_size']) > 0) {
            $filter['page_size'] = intval($_REQUEST['page_size']);
        } elseif (isset($_COOKIE['ECSCP']['page_size']) && intval($_COOKIE['ECSCP']['page_size']) > 0) {
            $filter['page_size'] = intval($_COOKIE['ECSCP']['page_size']);
        } else {
            $filter['page_size'] = 15;
        }

        /* 记录总数 */
        $sql = "SELECT COUNT(*) FROM " . $GLOBALS['ecs']->table('substation_apply') . "  " . $where;
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        $filter['page_count'] = $filter['record_count'] > 0 ? ceil($filter['record_count'] / $filter['page_size']) : 1;

        /* 查询 */
//        $sql = "SELECT *,u.user_name, rank_id, supplier_name, tel, system_fee, supplier_bond, supplier_rebate, supplier_remark,  ".
//            "s.status ".
//            "FROM " . $GLOBALS['ecs']->table("supplier") . " as s left join " . $GLOBALS['ecs']->table("users") . " as u on s.user_id = u.user_id
//                $where
//                ORDER BY " . $filter['sort_by'] . " " . $filter['sort_order']. "
//                LIMIT " . ($filter['page'] - 1) * $filter['page_size'] . ", " . $filter['page_size'] . " ";

        $sql = "select * from " . $GLOBALS['ecs']->table("substation_apply") . $where . ' order by created_at desc ' . "
                LIMIT " . ($filter['page'] - 1) * $filter['page_size'] . ", " . $filter['page_size'] . " ";;
        set_filter($filter, $sql);
    } else {
        $sql = $result['sql'];
        $filter = $result['filter'];
    }

    $list = array();
    $res = $GLOBALS['db']->query($sql);
    while ($row = $GLOBALS['db']->fetchRow($res)) {
        $row['status_name'] = $row['state'] == '12' ? '通过' : ($row['state'] == '11' ? "未审核" : "未通过");
        $row['level_name'] = $row['level'] == '3' ? '省级' : ($row['level'] == '2' ? "市级" : "区级");
        // 获得省市区名称
        if($row['level'] == '3'){
            $row['sub_name']=get_region_name($row['province']).' 分站';
        }else if($row['level'] == '2')
        {
            $row['sub_name']=get_region_name($row['province']).'-'.get_region_name($row['city']).' 分站';
        }else
        {
            $row['sub_name']=get_region_name($row['province']).'-'.get_region_name($row['city']).'-'.get_region_name($row['district']).' 分站';
        }


        $list[] = $row;
    }

    $arr = array('result' => $list, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count'], 'sql' => $sql);

    return $arr;
}

/*
* 入驻商的佣金记录
*/
function rebate_log_list()
{
    $result = get_filter();
    if ($result === false) {
        /* 过滤信息 */
        $filter['id'] = intval($_REQUEST['id']);
        $filter['addtime_start'] = !empty($_REQUEST['addtime_start']) ? local_strtotime($_REQUEST['addtime_start']) : 0;
        $filter['addtime_end'] = !empty($_REQUEST['addtime_end']) ? local_strtotime($_REQUEST['addtime_end'] . " 23:59:59") : 0;
        $filter['status'] = empty($_REQUEST['status']) ? '0' : intval($_REQUEST['status']);

        $where = ' WHERE supplier_id = ' . $filter['id'];
        $where .= $filter['addtime_start'] ? " AND addtime >= '" . $filter['addtime_start'] . "' " : " ";
        $where .= $filter['addtime_end'] ? " AND addtime_end <= '" . $filter['addtime_end'] . "' " : " ";
        $where .= $filter['status'] > 0 ? " AND status = '" . $filter['status'] . "' " : "";

        /* 分页大小 */
        $filter['page'] = empty($_REQUEST['page']) || (intval($_REQUEST['page']) <= 0) ? 1 : intval($_REQUEST['page']);

        if (isset($_REQUEST['page_size']) && intval($_REQUEST['page_size']) > 0) {
            $filter['page_size'] = intval($_REQUEST['page_size']);
        } elseif (isset($_COOKIE['ECSCP']['page_size']) && intval($_COOKIE['ECSCP']['page_size']) > 0) {
            $filter['page_size'] = intval($_COOKIE['ECSCP']['page_size']);
        } else {
            $filter['page_size'] = 15;
        }

        /* 记录总数 */
        $sql = "SELECT COUNT(*) FROM " . $GLOBALS['ecs']->table('supplier_money_log') . $where;
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);
        $filter['page_count'] = $filter['record_count'] > 0 ? ceil($filter['record_count'] / $filter['page_size']) : 1;

        /* 查询 */
        $sql = "SELECT * " .
            "FROM " . $GLOBALS['ecs']->table("supplier_money_log") . $where . "
                ORDER BY addtime desc 
                LIMIT " . ($filter['page'] - 1) * $filter['page_size'] . ", " . $filter['page_size'] . " ";

        set_filter($filter, $sql);
    } else {
        $sql = $result['sql'];
        $filter = $result['filter'];
    }

    $list = array();
    $res = $GLOBALS['db']->query($sql);
    while ($row = $GLOBALS['db']->fetchRow($res)) {
        $row['add_time'] = local_date("Y-m-d H:i:s", $row['addtime']);
        $list[] = $row;
    }

    $arr = array('result' => $list, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
}

/*
删除店铺下所有商品的上传的图片
*/
function delete_supplier_pic($suppid)
{
    global $db, $ecs;

    $sql = "select goods_thumb,goods_img,original_img from " . $ecs->table('goods') . " where supplier_id=" . $suppid;

    $query = $db->query($sql);
    while ($row = $db->fetchRow($query)) {
        @unlink(ROOT_PATH . $row['goods_thumb']);
        @unlink(ROOT_PATH . $row['goods_img']);
        @unlink(ROOT_PATH . $row['original_img']);
    }

    $sql = "select gg.img_url,gg.thumb_url,gg.img_original from " . $ecs->table('goods_gallery') . " as gg," . $ecs->table('goods') . " as g where g.supplier_id=" . $suppid . " and g.goods_id=gg.goods_id";

    $query = $db->query($sql);
    while ($row = $db->fetchRow($query)) {
        @unlink(ROOT_PATH . $row['img_url']);
        @unlink(ROOT_PATH . $row['thumb_url']);
        @unlink(ROOT_PATH . $row['img_original']);
    }
}

/* 代码增加 By  www.68ecshop.com Start */
/**
 * 取得店铺等级列表
 * @return array 店铺等级列表 id => name
 */
function get_supplier_rank_list()
{
    $sql = 'SELECT rank_id, rank_name FROM ' . $GLOBALS['ecs']->table('supplier_rank') . ' ORDER BY sort_order';
    $res = $GLOBALS['db']->getAll($sql);

    $rank_list = array();
    foreach ($res AS $row) {
        $rank_list[$row['rank_id']] = addslashes($row['rank_name']);
    }

    return $rank_list;
}

/* 代码增加 By  www.68ecshop.com End */


?>