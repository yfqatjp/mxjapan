<?php
require_once(SYSBASE."common/hotel.php");
/**
 * 前台类
 */
class Front extends Hotel {

    /**
     * 初始化处理
     */
    protected function _initialize() {
    	parent::_initialize();
    	
    }
    
    /**
     * 执行动作前的处理
     */
    public function beforeAction() {
    	parent::beforeAction();
    }
    
    /**
     * 包车服务的检索用的SQL文
     * 
     */
    public function getChartersSql($arrCondition = array(), $isCount = false) {
   
    	// SQL文
    	$selectSql  = " SELECT ";
    	if ($isCount) {
    		$selectSql .= "     COUNT(*) ";
    	} else {
	    	$selectSql .= "     T1.charter_type AS charter_type ";
	    	$selectSql .= "    ,T1.id AS id ";
	    	$selectSql .= "    ,T1.title AS title ";
	    	$selectSql .= "    ,T1.alias AS alias ";
	    	$selectSql .= "    ,T1.subtitle AS subtitle ";
	    	$selectSql .= "    ,T1.descr AS descr ";
	    	$selectSql .= "    ,T1.lat AS lat ";
	    	$selectSql .= "    ,T1.lng AS lng ";
	    	$selectSql .= "    ,T1.charter_type AS charter_type ";
	    	$selectSql .= "    ,T1.destination AS destination ";
	    	$selectSql .= "    ,T2.fee AS charter_price ";
	    	$selectSql .= "    ,T2.car_type AS car_type ";
	    	$selectSql .= "    ,T3.name AS charter_type_name ";
    	}
    	// 检索的条件和表的设定
    	$sql  = " ";
    	$sql .= " FROM ";
    	$sql .= "      pm_charter T1 ";                 // 包车服务
    	$sql .= " INNER JOIN ";
    	$sql .= "      pm_charter_info T2 ON ( T1.id = T2.id_charter ) ";             // 包车服务详情
    	$sql .= " LEFT JOIN ";
    	$sql .= "      pm_charter_type T3 ON ( T1.charter_type = T3.id and T3.lang = ".LANG_ID." ) ";             // 包车类别
    	$sql .= " WHERE ";
    	$sql .= "      T1.checked = 1 ";
    	$sql .= "      AND ";
    	$sql .= "      T1.lang = ".LANG_ID;
    	
    	if (isset($arrCondition["charter_type"])) {
    		$sql .= "      AND ";
    		$sql .= "      T1.charter_type = ".$arrCondition["charter_type"];
    	}
    	if (!$isCount) {
    		// 排序处理
    		
    		// 分页提取处理
    		if (isset($arrCondition["limit"]) && isset($arrCondition["offset"])) {
    			$sql .= "      LIMIT  ".($arrCondition["offset"]-1)*$arrCondition["limit"].", ".$arrCondition["limit"];
    		}
    	}
		// 返回检索的SQL文
    	return $selectSql.$sql;
    }
    
    /**
     * 包车类别
     */
    public function getCharterType() {
    	//
    	$arrOption = array();
    	// sql
    	$query_option = "SELECT * FROM pm_charter_type ";
    	if(db_column_exists($this->db, "pm_charter_type", "lang")) $query_option .=  " WHERE lang = ".DEFAULT_LANG;
    	// 排序
    	$query_option .= " ORDER BY rank ";
    	$result_option = $this->db->query($query_option);
    	if($result_option !== false){
    		foreach($result_option as $j => $row_option){
    			$arrOption[$row_option["id"]] = $row_option["name"];
    		}
    	}
    	return $arrOption;
    }
    
}

// 前台的应用
$hotelApp = new Front($db);
