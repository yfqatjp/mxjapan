<?php
require_once(SYSBASE."common/hotel.php");
/**
 * 前台类
 */
class Front extends Hotel {

	public $arrTexts = array();

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

    /////////////////////////////////////////////////////////////////////////////////////
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
	    	$selectSql .= "    ,T4.name AS charter_city_name ";
    	}
    	// 检索的条件和表的设定
    	$sql  = " ";
    	$sql .= " FROM ";
    	$sql .= "      pm_charter T1 ";                 // 包车服务
    	$sql .= " INNER JOIN ";
    	$sql .= "      pm_charter_info T2 ON ( T1.id = T2.id_charter ) ";             // 包车服务详情
    	$sql .= " LEFT JOIN ";
    	$sql .= "      pm_charter_type T3 ON ( T1.charter_type = T3.id and T3.lang = ".LANG_ID." ) ";             // 包车类别
    	$sql .= " LEFT JOIN ";
    	$sql .= "      pm_charter_city T4 ON ( T1.city = T4.id and T4.lang = ".LANG_ID." ) ";             // 包车类别
    	$sql .= " WHERE ";
    	$sql .= "      T1.checked = 1 ";
    	$sql .= "      AND ";
    	$sql .= "      T1.lang = ".LANG_ID;

    	if (isset($arrCondition["charter_type"])) {
    		$sql .= "      AND ";
    		$sql .= "      T1.charter_type = ".$arrCondition["charter_type"];
    	}


    	if (isset($arrCondition["charter_city"])) {
    		$sql .= "      AND ";
    		$sql .= "      T1.city = ".$arrCondition["charter_city"];
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

    /**
     * 包车城市
     */
    public function getCharterCity() {
    	//
    	$arrOption = array();
    	// sql
    	$query_option = "SELECT * FROM pm_charter_city ";
    	if(db_column_exists($this->db, "pm_charter_city", "lang")) $query_option .=  " WHERE lang = ".DEFAULT_LANG;
    	// 排序
    	$query_option .= " ORDER BY id ";
    	$result_option = $this->db->query($query_option);
    	if($result_option !== false){
    		foreach($result_option as $j => $row_option){
    			$arrOption[$row_option["id"]] = $row_option["name"];
    		}
    	}
    	return $arrOption;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    /**
     * 包车服务前的一些check
     *
     */
    public function checkBooking() {
    	//
    	if (!$this->doValidToken()) {
    		// 非法请求处理
    		$this->setBookingCheckMsg("CHARTER_ACCESS");
    		return false;
    	}
    	return true;
    }

    /**
     *
     */
    public function setBookingCheckMsg($msgKey) {
    	$_SESSION["CHARTER_BOOKING_MSG"] = $this->getTextsByName($msgKey);
    }

    /**
     * 保存的消息清空
     */
    public function clearBookingCheck() {
    	if (isset($_SESSION["CHARTER_BOOKING_MSG"])) {
    		unset($_SESSION["CHARTER_BOOKING_MSG"]);
    	}
    }

    /**
     *
     */
    public function getBookingCheckMsg() {
    	if (isset($_SESSION["CHARTER_BOOKING_MSG"])) {
    		$msg = $_SESSION["CHARTER_BOOKING_MSG"];
    		// 保存的信息清空
    		unset($_SESSION["CHARTER_BOOKING_MSG"]);
    		return $msg;
    	} else {
    		return "";
    	}
    }


    //////////////////////////////////////////////////////////////////////
    public function setTexts($texts) {
    	$this->arrTexts = $texts;
    }


    public function getTextsByName($key) {
    	if (array_key_exists($key, $this->arrTexts)) {
    		return $this->arrTexts[$key];
    	}
    	return "";
    }

    /**
     * 判断是否已经登录了
     *
     * @return boolean
     */
    public function isLogin() {
    	if (isset($_SESSION['user'])) {
    		return true;
    	}
    	$this->setBookingCheckMsg("CHARTER_LOGIN");
    	return false;
    }

    public function replaceMsg($msgKey, $replace) {

    	$msg = $this->getTextsByName($msgKey);
    	foreach ($replace as $key => $value) {
    		$msg = str_replace('{'.$key.'}', $value, $msg);
    	}
    	return $msg;
    }

    public function checkBookingForm() {
    	//
    	$requireItemArr = array();
    	$requireItemArr[] = array("key" => "lastname", "name" => "LASTNAME");
    	$requireItemArr[] = array("key" => "firstname", "name" => "FIRSTNAME");
    	$requireItemArr[] = array("key" => "email", "name" => "EMAIL");
    	//$requireItemArr[] = array("key" => "company", "name" => "COMPANY");
    	$requireItemArr[] = array("key" => "address", "name" => "ADDRESS");
    	$requireItemArr[] = array("key" => "postcode", "name" => "POSTCODE");
    	$requireItemArr[] = array("key" => "city", "name" => "CITY");
    	$requireItemArr[] = array("key" => "country", "name" => "COUNTRY");
    	$requireItemArr[] = array("key" => "phone", "name" => "PHONE");
    	$requireItemArr[] = array("key" => "depart_date", "name" => "CHARTER_DEPART_DATE");
    	$requireItemArr[] = array("key" => "depart_num", "name" => "CHARTER_DEPART_NUM");

    	//
    	$arrMsg = array();
    	//
    	foreach($requireItemArr as $checkItem) {
    		$itemValue = $this->query($checkItem["key"]);
    		if ($itemValue == null || strlen($itemValue) == 0) {
    			$arrMsg[$checkItem["key"]] = $this->replaceMsg("CHECK_REQUIRE_MSG", array($this->getTextsByName($checkItem["name"])));
    		}
    	}

    	// 日期的check
    	if (array_key_exists("depart_date", $arrMsg)) {
    		$depart_date = $this->query("depart_date");
    		if (!$this->validateDate($depart_date)) {
    			$arrMsg["depart_date"] = $this->getTextsByName("CHECK_DATE_MSG");
    		}
    	}
    	return $arrMsg;
    }

    //////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////包车的服务预定SESSION处理//////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////
    public function charterSession($charterInfo) {
    	if ($charterInfo == null || count($charterInfo) == 0) {
    		return;
    	}
    	if (!isset($_SESSION["charter_booking"])) {
    		$_SESSION["charter_booking"] = array();
    	}

    	// 包车服务的特有项目的保存
    	$_SESSION["charter_booking"]["charter_id"] = $charterInfo["id"];
    	$_SESSION["charter_booking"]["charter_type"] = $charterInfo["charter_type"];
    	$_SESSION["charter_booking"]["lang"] = $charterInfo["lang"];
    	$_SESSION["charter_booking"]["charter_owner"] = $charterInfo["id_user"];
    	$_SESSION["charter_booking"]["title"] = $charterInfo["title"];
    	$_SESSION["charter_booking"]["subtitle"] = $charterInfo["subtitle"];
    	$_SESSION["charter_booking"]["alias"] = $charterInfo["alias"];
    	$_SESSION["charter_booking"]["charter_phone"] = $charterInfo["phone"];
    	$_SESSION["charter_booking"]["destination"] = $charterInfo["destination"];
    	$_SESSION["charter_booking"]["price"] = $charterInfo["fee"];
    	$_SESSION["charter_booking"]["car_brand"] = $charterInfo["car_brand"];
    	$_SESSION["charter_booking"]["car_model"] = $charterInfo["car_model"];
    	$_SESSION["charter_booking"]["car_no"] = $charterInfo["car_no"];
    	$_SESSION["charter_booking"]["car_seat"] = $charterInfo["car_seat"];
    	$_SESSION["charter_booking"]["safe"] = $charterInfo["safe"];
    	$_SESSION["charter_booking"]["total"] = $this->calTotal($charterInfo);
    	$_SESSION["charter_booking"]["tourist_tax"] = 0;

    	// 根据ID取得当前用户的情报
    	$_SESSION["charter_booking"]["charter_owner"] = array();

    	// 预定人的信息
    	$_SESSION["charter_booking"]["booking_owner"] = array();
    }

    public function setCharterBooking() {
    	$arrKey = array("firstname", "lastname", "email", "company",
    			"address", "postcode", "city", "phone", "mobile", "country", "comments", "depart_num");

    	foreach($arrKey as $key) {
    		$postData = $this->query($key);
    		$_SESSION["charter_booking"]["booking_owner"][$key] = $postData;
    	}

    	$charterDate = strtotime($this->query("depart_date"));
    	$_SESSION["charter_booking"]["booking_owner"]["depart_date"] = $charterDate;

    	$_SESSION["charter_booking"]["booking_owner"]["booking_user_id"] = $_SESSION['user']['id'];
    }

    /**
     *
     * @return number|unknown|string|string
     */
    public function insertCharterBooking($otherVal = array()) {

    	$data = array();
    	$data = array_merge($otherVal, $data);
    	//
    	if (isset($_SESSION["charter_booking"]["booking_owner"])) {
    		$data = array_merge($data, $_SESSION["charter_booking"]["booking_owner"]);
    	}

    	foreach($_SESSION["charter_booking"] as $key => $val) {
    		if (!is_array($key)) {
    			$data[$key] = $val;
    		}
    	}
    	$systime = strtotime("now");
    	$data["status"] = 1;
    	$data["add_date"] = $systime;
    	$data["edit_date"] = $systime;
    	$data["booking_code"] = $this->getBookingOrderCode();
    	$result_insert = db_prepareInsert($this->db, "pm_charter_booking", $data);
    	if($result_insert->execute() !== false){
    		$_SESSION["charter_booking"]["booking_code"] = $data["booking_code"];
    		$_SESSION["charter_booking"]["id"] = $this->db->lastInsertId();
    		return true;
    	}
    	return false;
    }

    /**
     *
     * @param unknown $booking_code
     * @param unknown $arrData
     */
    public function updateCharterBooking($booking_code, $arrData) {
    	$arrBooking = $this->getCharterBookingByCode($booking_code);
    	if (count($arrBooking) > 0) {
    		$arrData["id"] = $arrBooking["id"];
    		$arrData["edit_date"] = time();
    		$result = db_prepareUpdate($this->db, "pm_charter_booking", $arrData);
    		if($result->execute() !== false){
    			return false;
    		}
    		return true;
    	}
    	return false;
    }

    /**
     *
     * @param unknown $booking_code
     * @param unknown $arrData
     */
    public function updateCharterBookingById($bookId, $arrData) {
    	if ($bookId > 0 && count($arrData) > 0) {
    		$arrData["id"] = $bookId;
    		$arrData["edit_date"] = time();
    		$result = db_prepareUpdate($this->db, "pm_charter_booking", $arrData);
    		if($result->execute() !== false){
    			return false;
    		}
    		return true;
    	}
    	return false;
    }

    /**
     *
     * @param unknown $booking_code
     */
    public function getCharterBookingByCode($booking_code) {
    	//
    	$arrBooking = array();
    	//
    	$result = $this->db->query("SELECT * FROM pm_charter_booking  WHERE booking_code = '".$booking_code."' ");
    	if($result !== false && $this->db->last_row_count() == 1){
    		$arrBooking = $result->fetch(PDO::FETCH_ASSOC);
    	}
    	return $arrBooking;
    }


    /**
     *
     * @param unknown $booking_code
     */
    public function getCharterBookingById($bookingId) {
    	//
    	$arrBooking = array();
    	//
    	$result = $this->db->query("SELECT * FROM pm_charter_booking  WHERE id = ".$bookingId);
    	if($result !== false && $this->db->last_row_count() == 1){
    		$arrBooking = $result->fetch(PDO::FETCH_ASSOC);
    	}
    	return $arrBooking;
    }


    public function getBookingOrderCode() {
    	return "B".date("ymdHis").$this->gfRandNumber(4);
    }

    public function clearCharterSession() {
    	unset($_SESSION["charter_booking"]);
    }

    /**
     * 总金额的计算方法
     *
     * @param unknown $charterInfo
     * @return unknown
     */
    public function calTotal($charterInfo) {
    	return $charterInfo["fee"];
    }

    public function getTotal() {
    	return $_SESSION["charter_booking"]["price"];
    }

    public function getPaymentTotal() {
    	return $_SESSION["charter_booking"]["price"];
    }
    //////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////
    /**
     * 包车服务的检索用的SQL文
     *
     */
    public function findChartersHistory() {
    	// SQL文
    	$sql  = " SELECT ";
    	$sql .= "     T1.id AS booking_id ";
    	$sql .= "    ,T1.booking_code AS booking_code ";
    	$sql .= "    ,T1.title AS title ";
    	$sql .= "    ,T1.alias AS alias ";
    	$sql .= "    ,T1.destination AS destination ";
    	$sql .= "    ,T1.car_model AS car_model ";
    	$sql .= "    ,T1.car_no AS car_no ";
   		$sql .= "    ,T1.destination AS destination ";
   		$sql .= "    ,T1.depart_date AS depart_date ";
   		$sql .= "    ,T1.total AS total ";
   		$sql .= "    ,T1.add_date AS add_date ";
   		$sql .= "    ,T1.status AS status ";

   		$sql .= "    ,T1.charter_owner AS charter_owner ";
   		$sql .= "    ,T1.charter_type AS charter_type ";
   		$sql .= "    ,T1.destination AS destination ";
   		$sql .= "    ,T1.depart_date AS depart_date ";
   		$sql .= "    ,T2.name AS charter_name ";
   		$sql .= "    ,T2.phone AS charter_phone ";
    	// 检索的条件和表的设定
    	$sql .= " FROM ";
    	$sql .= "      pm_charter_booking T1 ";
    	$sql .= " LEFT JOIN ";
    	$sql .= "      pm_user T2 ON ( T1.charter_owner = T2.id ) ";             // 包车服务详情
    	$sql .= " WHERE ";
    	$sql .= "      1 = 1 ";
    	$sql .= "      AND ";
    	$sql .= "      T1.booking_user_id = ".$_SESSION['user']['id'];
		// 排序
    	$sql .= " ORDER BY T1.id DESC ";
    	// 检索结果的取得
    	$arrResult = $this->db->query($sql);
    	// 返回检索的结果
    	return $arrResult;
    }


    public function displayStatusName($status) {
    	if ($status == BOOKING_STAUTS_WAITING) {
    		return $this->getTextsByName("BOOKING_STAUTS_WAITING");
    	} else if ($status == BOOKING_STAUTS_CANCEL) {
    		return $this->getTextsByName("BOOKING_STAUTS_CANCEL");
    	} else if ($status == BOOKING_STAUTS_PAYED) {
    		return $this->getTextsByName("BOOKING_STAUTS_PAYED");
    	} else if ($status == BOOKING_STAUTS_COMPLETE) {
    		return $this->getTextsByName("BOOKING_STAUTS_COMPLETE");
    	} else {
    		return "";
    	}
    }
    //////////////////////////////////////////////////////////////////////////////////////

}

// 前台的应用
$hotelApp = new Front($db);

$hotelApp->setTexts($texts);