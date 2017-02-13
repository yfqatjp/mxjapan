<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/common/hotel.php';
/**
 * 前台类
 */
class HmWeb extends Hotel {

	public $arrTexts = array();

	public $defaultLang = 2;
	
	public $perPageCount = 20;
    /**
     * 初始化处理
     */
    protected function _initialize() {
    	parent::_initialize();

    	$this->createConsts();
    }

    /**
     * 执行动作前的处理
     */
    public function beforeAction() {

    	parent::beforeAction();
    }

    private function createConsts() {
    	// 等待支付
    	define('BOOKING_STAUTS_WAITING', '1');
    	// 取消
    	define('BOOKING_STAUTS_CANCEL', '2');
    	// 已支付
    	define('BOOKING_STAUTS_PAYED', '3');
    	// 服务完成
    	define('BOOKING_STAUTS_COMPLETE', '4');
    }

    /**
     * 分页的数组取得
     *
     */
    public function getPager($rowCount, $currentPage, $perpageCount){
    	//最多显示多少个页码
    	$_pageNum = 6;
    	$arrPager = array();
    	$pageCount = ceil($rowCount/$perpageCount);
    	
    	if ($pageCount <= 1) {
    		return $arrPager;
    	}
    	//当前页面小于1 则为1
    	$currentPage = $currentPage < 1 ? 1:$currentPage;
    	
    	//当前页大于总页数 则为总页数
    	$currentPage = $currentPage > $pageCount ? $pageCount : $currentPage;
    	
    	//计算开始页
    	$_start = $currentPage - floor($_pageNum/2);
    	$_start = $_start<1 ? 1 : $_start;
    	
    	//计算结束页
    	$_end = $currentPage + floor($_pageNum/2);
    	$_end = $_end > $pageCount? $pageCount : $_end;
    	
    	//当前显示的页码个数不够最大页码数，在进行左右调整
    	$_curPageNum = $_end-$_start+1;
    	//左调整
    	if($_curPageNum<$_pageNum && $_start>1){
    		$_start = $_start - ($_pageNum-$_curPageNum);
    		$_start = $_start<1 ? 1 : $_start;
    		$_curPageNum = $_end-$_start+1;
    	}
    	
    	//右边调整
    	if($_curPageNum<$_pageNum && $_end<$pageCount){
    		$_end = $_end + ($_pageNum-$_curPageNum);
    		$_end = $_end>$pageCount? $pageCount : $_end;
    	}
    	
    	// 上一页存在的场合
    	if ($currentPage > 1) {
    		$arrPager[] = array("text" => "上一页", "value" => $currentPage - 1);
    	}
    	
    	if ($pageCount <= 6) {
    		for($i = 1; $i <= $pageCount; $i++ ) {
    			$arrPager[] = array("text" => $i, "value" => $i);
    		}
    	} else {
    		if ($_start == 1) {
    			for($i = $_start; $i<= $_end; $i++ ) {
    				$arrPager[] = array("text" => $i, "value" => $i);
    			}
    			if ($_end < $pageCount) {
	    			if ($_end < $pageCount - 1) {
	    				$arrPager[] = array("text" => "...", "value" => 0);
	    			}
	    			$arrPager[] = array("text" => $pageCount, "value" => $pageCount);
    			}
    		} else {
    			if ($_start > 1) {
	    			$arrPager[] = array("text" => 1, "value" => 1);
	    			if ($_start > 2) {
	    				$arrPager[] = array("text" => "...", "value" => 0);
	    			}
    			}
    			for($i = $_start; $i<= $_end; $i++ ) {
    				$arrPager[] = array("text" => $i, "value" => $i);
    			}
    		}

    	}
    	// 下一页存在的场合
    	if ($currentPage < $pageCount) {
    		$arrPager[] = array("text" => "下一页", "value" => $currentPage + 1);
    	}
    	return $arrPager;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * 包车服务的检索用的---首页展示用
     *
     */
    public function findHomeCharterList() {
    
    	// SQL文
    	$sql  = " SELECT ";
    	$sql .= "     T1.charter_type AS charter_type ";
    	$sql .= "    ,T1.id AS id ";
    	$sql .= "    ,T1.title AS title ";
    	$sql .= "    ,T1.subtitle AS subtitle ";
    	$sql .= "    ,T1.like_count AS like_count ";
    	$sql .= "    ,T4.book_count AS book_count ";
    	$sql .= "    ,T2.name AS charter_type_name ";
    	$sql .= "    ,T3.name AS city_name ";
    	// 检索的条件和表的设定
    	$sql .= " FROM ";
    	$sql .= "      pm_charter T1 ";                 // 包车服务
    	$sql .= " LEFT JOIN ";
    	$sql .= "      pm_charter_type T2 ON ( T1.charter_type = T2.id and T2.lang = ".$this->defaultLang." ) ";             // 包车类别
    	$sql .= " LEFT JOIN ";
    	$sql .= "      pm_charter_city T3 ON ( T1.city = T3.id and T3.lang = ".$this->defaultLang." ) ";             // 包车类别
    	$sql .= " LEFT JOIN ";
    	$sql .= "      ( ";
    	$sql .= "         SELECT count(id) AS book_count, charter_id ";
    	$sql .= "         FROM pm_charter_booking ";
    	$sql .= "         GROUP BY charter_id ";
    	$sql .= "         ";
    	$sql .= "      ) T4 ON (T4.charter_id = T1.id) ";
    	$sql .= " WHERE ";
    	$sql .= "      T1.checked = 1 ";
    	$sql .= "      AND ";
    	$sql .= "      T1.home = 1 ";     //首页展示用
    	$sql .= "      AND ";
    	$sql .= "      T1.lang = ".$this->defaultLang;
    	//  按照type,
    	$sql .= "  ORDER BY charter_type ASC, book_count DESC ";
    	// 检索的结果
    	$arrResult = $this->findAll($sql);
    	
    	// 图片的sql
    	$charterFileSql = "SELECT * FROM pm_charter_file WHERE id_item = ? AND checked = 1 AND lang = ".$this->defaultLang." AND type = 'image' AND file != '' ORDER BY rank LIMIT 1";
    	
		//
		$arrHomeCharters = array();
		
    	foreach($arrResult as $key => $arrRows) {
    		//
    		$charterTypeId = $arrRows["charter_type"];
    		if (!array_key_exists($charterTypeId, $arrHomeCharters)) {
    			$arrHomeCharters[$charterTypeId] = array();
    			$arrHomeCharters[$charterTypeId]["name"] = $arrRows["charter_type_name"];
    			$arrHomeCharters[$charterTypeId]["data"] = array();
    		}
    		
    		$arrDataVal = array();
    		$arrDataVal[] = $arrRows["id"];
    		// 一览的图片设定
    		$arrCharterFileResult = $this->findOne($charterFileSql, $arrDataVal);
    		if ($arrCharterFileResult != null && count($arrCharterFileResult) > 0) {
    			$file_id = $arrCharterFileResult['id'];
    			$filename = $arrCharterFileResult['file'];
    			$realpath = $_SERVER['DOCUMENT_ROOT']."/medias/charter/medium/".$file_id."/".$filename;
    			$thumbpath = "/medias/charter/medium/".$file_id."/".$filename;
    			if (is_file($realpath)) {
    				$arrRows["image_url"] = $thumbpath;
    			} else {
    				$arrRows["image_url"] = "";
    			}
    			$arrRows["image_label"] = $arrRows["title"];
    		} else {
    			$arrRows["image_url"] = "";
    			$arrRows["image_label"] = "";
    		}
    		if (empty($arrRows["book_count"])) {
    			$arrRows["book_count"] = 0;
    		}
    		$arrHomeCharters[$charterTypeId]["data"][] = $arrRows;

    	}
    	return $arrHomeCharters;
    }
    
    /**
     * 包车服务的检索用的
     *
     */
    public function findCharterList($arrParams = array(), $isCount = false) {
    
    	// SQL文
    	$sql  = " SELECT ";
    	if ($isCount) {
    		$sql .= "     COUNT(*) AS row_count ";
    	} else {
    		$sql .= "     T1.charter_type AS charter_type ";
    		$sql .= "    ,T1.id AS id ";
    		$sql .= "    ,T1.title AS title ";
    		$sql .= "    ,T1.subtitle AS subtitle ";
    		$sql .= "    ,T1.descr AS descr ";
    		$sql .= "    ,T1.like_count AS like_count ";
    		$sql .= "    ,T5.book_count AS book_count ";
    		$sql .= "    ,T1.score_count AS score_count ";
    		$sql .= "    ,T1.destination AS destination ";
    		$sql .= "    ,T2.name AS charter_type_name ";
    		$sql .= "    ,T3.name AS city_name ";
    		$sql .= "    ,T4.max_price AS max_price ";
    		$sql .= "    ,T4.min_price AS min_price ";
    	}
    	// 检索的条件和表的设定
    	$sql .= " FROM ";
    	$sql .= "      pm_charter T1 ";                 // 包车服务
    	if (!$isCount) {
	    	$sql .= " LEFT JOIN ";
	    	$sql .= "      pm_charter_type T2 ON ( T1.charter_type = T2.id and T2.lang = ".$this->defaultLang." ) ";             // 包车类别
	    	$sql .= " LEFT JOIN ";
	    	$sql .= "      pm_charter_city T3 ON ( T1.city = T3.id and T3.lang = ".$this->defaultLang." ) ";             // 包车类别
	    	$sql .= " LEFT JOIN ";
	    	$sql .= "      (  ";            
	    	$sql .= "        SELECT  charter_id, max(price) AS max_price, min(price) AS min_price ";   
	    	$sql .= "        FROM pm_charter_classes ";
	    	$sql .= "        GROUP BY charter_id  "; 
	    	$sql .= "      ) T4 ON (T4.charter_id = T1.id)  ";
	    	$sql .= " LEFT JOIN ";
	    	$sql .= "      ( ";
	    	$sql .= "         SELECT count(id) AS book_count, charter_id ";
	    	$sql .= "         FROM pm_charter_booking ";
	    	$sql .= "         GROUP BY charter_id ";
	    	$sql .= "         ";
	    	$sql .= "      ) T5 ON (T5.charter_id = T1.id) ";
    	}
    	$sql .= " WHERE ";
    	$sql .= "      T1.checked = 1 ";
    	$sql .= "      AND ";
    	$sql .= "      T1.lang = ".$this->defaultLang;
    
    	if (isset($arrParams["charter_type"]) && !empty($arrParams["charter_type"])) {
    		$sql .= "      AND ";
    		$sql .= "      T1.charter_type = ".$arrParams["charter_type"];
    	}
    
    
    	if (isset($arrParams["city"]) && !empty($arrParams["city"])) {
    		$sql .= "      AND ";
    		$sql .= "      T1.city = ".$arrParams["city"];
    	}
    
    	if (!$isCount) {
    		// 排序处理
    		if (isset($arrParams["order_by"]) && !empty($arrParams["order_by"])) {
    			//  人气 
    			if ($arrParams["order_by"] == "like") {
    				$sql .= "  ORDER BY T1.like_count DESC ";
    			} else if ($arrParams["order_by"] == "book") {
    				//  销量
    				$sql .= "  ORDER BY book_count DESC ";
    			} else if ($arrParams["order_by"] == "price") {
    				//  价格
    				$sql .= "  ORDER BY max_price DESC ";
    			}
    		} else {
    			$sql .= "  ORDER BY T1.add_date DESC ";
    		}
    		// 分页提取处理
    		if (isset($arrParams["limit"]) && isset($arrParams["page"]) && $arrParams["page"] >= 1) {
    			$sql .= "      LIMIT  ".($arrParams["page"]-1)*$arrParams["limit"].", ".$arrParams["limit"];
    		}
    		// 检索的结果
    		$arrResult = $this->findAll($sql);
    		
    		// 图片的sql
    		$charterFileSql = "SELECT * FROM pm_charter_file WHERE id_item = ? AND checked = 1 AND lang = ".$this->defaultLang." AND type = 'image' AND file != '' ORDER BY rank LIMIT 1";
    		
    		// 设定的座位
    		$charterClassesSql = "SELECT T1.price, T1.class_id, T2.title  
    				FROM pm_charter_classes T1
    				INNER JOIN pm_charter_class T2 ON ( T1.class_id = T2.id and T2.lang = ".$this->defaultLang." )
    				WHERE T1.charter_id = ? ORDER BY T1.price DESC ";
    		foreach($arrResult as $key => $arrRows) {
    			$arrDataVal = array();
    			$arrDataVal[] = $arrRows["id"];
    			
    			// 一览的图片设定
    			$arrCharterFileResult = $this->findOne($charterFileSql, $arrDataVal);
    			if ($arrCharterFileResult != null && count($arrCharterFileResult) > 0) {
    				$file_id = $arrCharterFileResult['id'];
    				$filename = $arrCharterFileResult['file'];
    				$realpath = $_SERVER['DOCUMENT_ROOT']."/medias/charter/medium/".$file_id."/".$filename;
    				$thumbpath = "/medias/charter/medium/".$file_id."/".$filename;
    				if (is_file($realpath)) {
    					$arrResult[$key]["image_url"] = $thumbpath;
    				} else {
    					$arrResult[$key]["image_url"] = "";
    				}
    				$arrResult[$key]["image_label"] = $arrRows["title"];
    			} else {
    				$arrResult[$key]["image_url"] = "";
    				$arrResult[$key]["image_label"] = "";
    			}
    			
    			// 取得包车规格
    			$arrCharterClassResult = $this->findAll($charterClassesSql, $arrDataVal);
    			if ($arrCharterClassResult != null) {
    				$arrResult[$key]["classes"] = $arrCharterClassResult; 
    			} else {
    				$arrResult[$key]["classes"] = array();
    			}
    			
    			// 预约的个数
    			if (empty($arrResult[$key]["book_count"])) {
    				$arrResult[$key]["book_count"] = 0;
    			}
    			
    			// 赞个数
    			if (empty($arrResult[$key]["like_count"])) {
    				$arrResult[$key]["like_count"] = 0;
    			}
    		}
    		return $arrResult;
    	} else {
    		$arrResult = $this->findOne($sql);
    		if ($arrResult != null && isset($arrResult["row_count"])) {
    			return $arrResult["row_count"];
    		}
    		return 0;
    	}
    }
    
    public function getSelectOptions() {
    	return array("1" => "1人","2" => "2人","3" => "3人","4" => "4人",
    			"5" => "5人","6" => "6人","7" => "7人","8" => "8人","9" => "9人","10" => "10人");
    }
    
    
    public function findCharterSetting() {
    	//
    	$arrSetting = array();
    	// sql
    	$sql = "SELECT * FROM pm_charter_guaranteed WHERE  checked = 1 AND lang = ".$this->defaultLang." ORDER BY rank ";
    	
    	// 检索的结果
    	$arrResult = $this->findAll($sql);
    	// 图片的sql
    	$charterFileSql = "SELECT * FROM pm_charter_guaranteed_file WHERE id_item = ? AND checked = 1 AND lang = ".$this->defaultLang." AND type = 'image' AND file != '' ORDER BY rank ";
    	foreach($arrResult as $setting) {
    		$arrData = array();
    		$arrData["name"] = $setting["name"];
    		$arrData["content"] = $setting["content"];
    		
    		// 一览的图片设定
    		$arrCharterFileResult = $this->findAll($charterFileSql, array($setting["id"]));
    		if ($arrCharterFileResult != null && count($arrCharterFileResult) > 0) {
    			$arrImages = array();
    			foreach($arrCharterFileResult as $row) {
	    			$file_id = $row['id'];
	    			$filename = $row['file'];
	    			$realpath = $_SERVER['DOCUMENT_ROOT']."/medias/charter_guaranteed/big/".$file_id."/".$filename;
	    			$thumbpath = "/medias/charter_guaranteed/big/".$file_id."/".$filename;
	    			if (is_file($realpath)) {
	    				$arrImages[] = $thumbpath;
	    			}
    			}
    			$arrData["images"] = $arrImages;
    		} else {
    			$arrData["images"] = array();
    		}
    		
    		$arrSetting[] = $arrData;
    	}
    	return $arrSetting;
    }
    
    /**
     * 包车服务的检索用的(推荐车导)
     *
     */
    public function findRecommendCharterList($arrParams = array()) {
    
    	// SQL文
    	$sql  = " SELECT ";
    	$sql .= "     T1.charter_type AS charter_type ";
    	$sql .= "    ,T1.id AS id ";
    	$sql .= "    ,T1.title AS title ";
    	// 检索的条件和表的设定
    	$sql .= " FROM ";
    	$sql .= "      pm_charter T1 ";                 // 包车服务
    	$sql .= " WHERE ";
    	$sql .= "      T1.checked = 1 ";
    	$sql .= "      AND ";
    	$sql .= "      T1.recommend = 1 ";
    	$sql .= "      AND ";
    	$sql .= "      T1.lang = ".$this->defaultLang;
    
    	// 
    	$sql .= "  ORDER BY T1.add_date DESC ";
    	//
    	$sql .= "      LIMIT  0, 10 ";
    	
    	// 检索的结果
    	$arrResult = $this->findAll($sql);
    
    	// 图片的sql
    	$charterFileSql = "SELECT * FROM pm_charter_file WHERE id_item = ? AND checked = 1 AND lang = ".$this->defaultLang." AND type = 'image' AND file != '' ORDER BY rank LIMIT 1";
    
    	foreach($arrResult as $key => $arrRows) {
    		$arrDataVal = array();
    		$arrDataVal[] = $arrRows["id"];
    	
    		// 一览的图片设定
    		$arrCharterFileResult = $this->findOne($charterFileSql, $arrDataVal);
    		if ($arrCharterFileResult != null && count($arrCharterFileResult) > 0) {
    			$file_id = $arrCharterFileResult['id'];
    			$filename = $arrCharterFileResult['file'];
    			$realpath = $_SERVER['DOCUMENT_ROOT']."/medias/charter/medium/".$file_id."/".$filename;
    			$thumbpath = "/medias/charter/medium/".$file_id."/".$filename;
    			if (is_file($realpath)) {
    				$arrResult[$key]["image_url"] = $thumbpath;
    			} else {
    				$arrResult[$key]["image_url"] = "";
    			}
    			$arrResult[$key]["image_label"] = $arrRows["title"];
    		} else {
    			$arrResult[$key]["image_url"] = "";
    			$arrResult[$key]["image_label"] = "";
    		}
    	}
    	return $arrResult;
    }
    
    // 添加预约情报数据
    public function getBookingData($gwcId, $arrGwc, $arrUser, $arrCharter, $pay, $status, $arrData = array()) {
    	$systime = strtotime("now");
    	//
    	$arrPayMethod = array(0 => "只预约", 1 => "支付宝支付", 2 => "微信支付", 3 => "paypal");
    	$arrBookingData = array();
    	$arrBookingData["gwc_id"] = $gwcId;
    	$arrBookingData["trans"] = $arrGwc["onum"];
    	$arrBookingData["charter_id"] = $arrCharter["id"];
    	$arrBookingData["charter_class_id"] = $arrGwc["charter_class_id"];
    	$arrBookingData["title"] = $arrCharter["title"];
    	$arrBookingData["charter_type"] = $arrCharter["charter_type"];
    	$arrBookingData["charter_class_name"] = $arrGwc["charter_class_name"];
    	$arrBookingData["arrive_time"] = strtotime ($arrGwc["arrive_time"]);
    	$arrBookingData["adults"] = $arrGwc["adults"];
    	$arrBookingData["children"] = $arrGwc["children"];
    	$arrBookingData["charter_owner"] = $arrCharter["default_charter"];
    	$arrBookingData["add_date"] = $systime;
    	$arrBookingData["edit_date"] = $systime;
    	$arrBookingData["price"] = $arrGwc["price"];
    	$arrBookingData["tourist_tax"] = 0;
    	$arrBookingData["total"] = $arrGwc["price"];
    	$arrBookingData["booking_user_id"] = $arrUser["id"];
    	$arrBookingData["firstname"] = $arrUser["name"];
    	//$arrBookingData["lastname"] = "";
    	$arrBookingData["mobile"] = $arrUser["phone"];
    	$arrBookingData["country"] = "中国";
    	//$arrBookingData["comments"] = "";
    	$arrBookingData["status"] = $status;
    	//$arrBookingData["payment_date"] = "";
    	$arrBookingData["payment_method"] = $arrPayMethod[$pay];
    	//$arrBookingData["payment_total"] = 0;
    	$arrBookingData["pay_id"] = $pay;
    	$arrBookingData = array_merge($arrBookingData, $arrData);
    	return $arrBookingData;
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Query 查询
     *
     * @param String $strSql SQL语句
     * @param String $queryMode 查询方式(All or Row)
     * @param Boolean $debug
     * @return Array
     */
    public function findAll($strSql, $arrData = array()) {
    	//
    	return $this->querySql($strSql, $arrData, "ALL");
    }
    
    /**
     * Query 查询
     *
     * @param String $strSql SQL语句
     * @param String $queryMode 查询方式(All or Row)
     * @param Boolean $debug
     * @return Array
     */
    public function findOne($strSql, $arrData = array()) {
    	//
    	return $this->querySql($strSql, $arrData, "ROW");
    }
    
    /**
     * Query 查询
     *
     * @param String $strSql SQL语句
     * @param String $queryMode 查询方式(All or Row)
     * @param Boolean $debug
     * @return Array
     */
    protected function querySql($strSql, $arrData = array(), $queryMode = "ALL")
    {
    	$result = array();
    	$sth = $this->db->prepare($strSql);
    	if($arrData!=null && count($arrData) > 0){
    		$sth->execute($arrData);
    	}else{
    		$sth->execute();
    	}
    	//
    	$sth->setFetchMode(PDO::FETCH_ASSOC);
    	
    	if ($queryMode == 'ALL') {
			$result = $sth->fetchAll();
		} elseif ($queryMode == 'ROW') {
			$result = $sth->fetch();
		}
    	return $result;
    }
    
    /**
     * INSERT文を実行する.
     *
     * @param  string                   $table      テーブル名
     * @param  array                    $arrVal     array('カラム名' => '値', ...)の連想配列
     * @param  array                    $arrSql     array('カラム名' => 'SQL文', ...)の連想配列
     * @param  array                    $arrSqlVal  SQL文の中で使用するプレースホルダ配列
     * @return integer|DB_Error|boolean 挿入件数またはエラー(DB_Error, false)
     */
    public function insert($table, $arrVal)
    {
    	$strcol = '';
    	$strval = '';
    	$find = false;
    	$arrValForQuery = array();
    
    	foreach ($arrVal as $key => $val) {
    		$strcol .= $key . ',';
    		if (strcasecmp('Now()', $val) === 0) {
    			$strval .= 'Now(),';
    		} elseif (strcasecmp('CURRENT_TIMESTAMP', $val) === 0) {
    			$strval .= 'CURRENT_TIMESTAMP,';
    		} else {
    			$strval .= '?,';
    			$arrValForQuery[] = $val;
    		}
    		$find = true;
    	}
    
    	if (!$find) {
    		return false;
    	}
    	// 文末の','を削除
    	$strcol = rtrim($strcol, ',');
    	$strval = rtrim($strval, ',');
    	$sqlin = "INSERT INTO $table($strcol) SELECT $strval";
    
    	//
    	$ret = false;
    	// INSERT文の実行
    	$sth = $this->db->prepare($sqlin);
    	if($arrValForQuery!=null && count($arrValForQuery) > 0){
    		$ret = $sth->execute($arrValForQuery);
    	}else{
    		$ret = $sth->execute();
    	}
    	return $ret;
    }
    
    /**
     * update 更新
     *
     * @param String $strSql SQL语句
     * @param String $queryMode 查询方式(All or Row)
     * @param Boolean $debug
     * @return Array
     */
    public function update($table, $arrVal, $where = '', $arrWhereVal = array())
    {
    	$arrCol = array();
    	$arrValForQuery = array();
    	$find = false;
    
    	foreach ($arrVal as $key => $val) {
    		if (strcasecmp('Now()', $val) === 0) {
    			$arrCol[] = $key . '= Now()';
    		} elseif (strcasecmp('CURRENT_TIMESTAMP', $val) === 0) {
    			$arrCol[] = $key . '= CURRENT_TIMESTAMP';
    		} else {
    			$arrCol[] = $key . '= ?';
    			$arrValForQuery[] = $val;
    		}
    		$find = true;
    	}
    
    
    	if (empty($arrCol)) {
    		return false;
    	}
    
    	// 文末の','を削除
    	$strcol = implode(', ', $arrCol);
    
    	if (is_array($arrWhereVal)) { // 旧版との互換用
    		// プレースホルダー用に配列を追加
    		$arrValForQuery = array_merge($arrValForQuery, $arrWhereVal);
    	}
    
    	$sqlup = "UPDATE $table SET $strcol";
    	if (strlen($where) >= 1) {
    		$sqlup .= " WHERE $where";
    	}
    
    	//
    	$result = false;
    	// UPDATE文の実行
    	$sth = $this->db->prepare($sqlup);
    	if($arrValForQuery!=null && count($arrValForQuery) > 0){
    		$result = $sth->execute($arrValForQuery);
    	}else{
    		$result = $sth->execute();
    	}
    	return $result;
    }
    
    /**
     * レコードの削除
     *
     * @param string $table       テーブル名
     * @param string $where       WHERE句
     * @param array  $arrWhereVal プレースホルダ
     * @return
     */
    public function delete($table, $where = '', $arrWhereVal = array())
    {
    	if (strlen($where) <= 0) {
    		$sqlde = 'DELETE FROM ' . $table;
    	} else {
    		$sqlde = 'DELETE FROM ' . $table . ' WHERE ' . $where;
    	}
		//
    	$ret = false;
    	// UPDATE文の実行
    	$sth = $this->db->prepare($sqlde);
    	if($arrWhereVal!=null && count($arrWhereVal) > 0){
    		$ret = $sth->execute($arrWhereVal);
    	}else{
    		$ret = $sth->execute();
    	}
    	return $ret;
    }
    
    /**
     * beginTransaction 事务开始
     */
    private function beginTransaction()
    {
    	$this->db->beginTransaction();
    }
    
    /**
     * commit 事务提交
     */
    private function commit()
    {
    	$this->db->commit();
    }
    
    /**
     * rollback 事务回滚
     */
    private function rollback()
    {
    	$this->db->rollback();
    }
    
    /**
     * destruct 关闭数据库连接
     */
    public function destruct()
    {
    	$this->db = null;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
}

// 前台的应用
$hmWeb = new HmWeb($pdo);
