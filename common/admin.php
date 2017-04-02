<?php
require_once(SYSBASE."common/hotel.php");
/**
 * 前台类
 */
class Admin extends Hotel {

	private $model = "";
	
	private $id = "";
    /**
     * 初始化处理
     */
    protected function _initialize() {
    	parent::_initialize();
    	//
    	$this->model = MODULE;
    }
    
    /**
     * 执行动作前的处理
     */
    public function beforeAction(&$fields, $id) {
    	$this->id = $id;
    	if ($this->model == "charter") {
    		$this->beforeCharter($fields);
    	}
    }
    
    /**
     * 画面输入的check
     */
    public function checkAction(&$fields, $id, $arrMsg) {
    	$this->id = $id;
    	if ($this->model == "charter_info") {
    		$this->checkCharterInfo($fields, $arrMsg);
    	}
    }
    

    /**
     * 服务详细情报的check
     */
    public function checkCharterOwner(&$fields, $id) {
    	//
    	$charterOwnerValue = 0;
    	$arriveTime = "";
    	foreach($fields[MODULE]["fields"] as $field){
    		$fieldName = $field->getName();
    		$value = $field->getValue();
    		if ($fieldName == "charter_owner") {
    			$charterOwnerValue = $value;
    		}
    		if ($fieldName == "arrive_time") {
    			$arriveTime = $value;
    		}
    	}
    	
    	if ($charterOwnerValue > 0 && !empty($arriveTime)) {
    		$sql = "SELECT count(id) as owner_count 
    				FROM pm_charter_booking 
    				WHERE id <> ".$id." and charter_owner = ".$charterOwnerValue." and arrive_time =".$arriveTime;
    		$result1 = $this->db->query($sql);
    		if($result1 !== false){
    			if ($result1->fetchColumn(0) > 0) {
    				return false;
    			}
    		}
    		
    		// 确认车主的不接单时间
    		$settingsql = "SELECT count(id) as time_count 
    				FROM pm_charter_user_setting 
    				WHERE  user_id = ".$charterOwnerValue." and start_date <= ".$arriveTime." and end_date >= ".$arriveTime;
    		$result2 = $this->db->query($settingsql);
    		if($result2 !== false){
    			if ($result2->fetchColumn(0) > 0) {
    				return false;
    			}
    		}
    	}
    	return true;
    }
    
    /**
     * 包车服务的前处理
     */
    private function beforeCharter(&$fields) {
    	if ($this->id > 0) {
    		foreach($fields[MODULE]["fields"] as $field){
    			$fieldName = $field->getName();
    			/*
    			if ($fieldName == "charter_type") {
    				$field->setActive(0);
    			}
    			*/
    		}
    	}
    }
    
    /**
     * 服务详细情报的check
     */
    private function checkCharterInfo(&$fields, $arrMsg) {
		foreach($fields[MODULE]["fields"] as $field){
			$fieldName = $field->getName();
			$value = $field->getValue();
    		if ($fieldName == "car_seat" || 
    			$fieldName == "driving_year" || 
    			$fieldName == "fee") {
    			if(!is_numeric($value) || $value <= 0){
    				if (isset($arrMsg['NUMERIC_MIN_MSG'])) {
    					$field->setNotice($arrMsg['NUMERIC_MIN_MSG']);
    				}
    			}
    		}
    	}
    }
    
    public function getCharterClass($charterId) {
    	
    	// 
    	$arrCharterClass = array();
    	if ($charterId > 0) {
    		$result1 = $this->db->query("SELECT * FROM pm_charter_classes WHERE charter_id = ".$charterId);
    		if($result1 !== false){
    			// Datas of the module
    			foreach($result1 as $row){
    				$arrCharterClass[$row["class_id"]] = array();
    				$arrCharterClass[$row["class_id"]]["charter_id"] = $row["charter_id"];
    				$arrCharterClass[$row["class_id"]]["class_id"] = $row["class_id"];
    				$arrCharterClass[$row["class_id"]]["price"] = $row["price"];
    			}
    		}
    	}
    	$arrClass = array();
    	$result = $this->db->query("SELECT * FROM pm_charter_class WHERE checked = 1 order by rank ASC ");
    	if($result !== false){
    		// Datas of the module
    		foreach($result as $row){
    			$arrClassT = array();
    			$arrClassT["title"] = $row["title"];
    			$arrClassT["class_id"] = $row["id"];
    			if (array_key_exists($row["id"], $arrCharterClass)) {
    				$arrClassT["price"] = $arrCharterClass[$row["id"]]["price"];
    				$arrClassT["checked"] = "1";
    			} else {
    				$arrClassT["checked"] = "0";
    				$arrClassT["price"] = "";
    			}
    			$arrClassT["msg"] = "";
    			$arrClass[$row["id"]] = $arrClassT;
    		}
    	}
    	return $arrClass;
    }
    
    public function updateCharterClass($id, $arrClasses) {
    	if ($id > 0) {
    		// 先删除
    		$this->db->query("DELETE FROM pm_charter_classes WHERE charter_id = ".$id);
    		
    		$error = false;
    		// 在登录
    		foreach($arrClasses as $rowClass) {
    			if ($rowClass["checked"] == "1") {
    				$arrData = array();
    				$arrData["charter_id"] = $id;
    				$arrData["class_id"] = $rowClass["class_id"];
    				$arrData["price"] = $rowClass["price"];
    				$result = db_prepareInsert($this->db, "pm_charter_classes", $arrData);
    				if($result->execute() !== false){
    					
    				} else {
    					$error = true;
    				}
    			}
    		}
    		
    		if ($error) {
    			$this->db->query("DELETE FROM pm_charter_classes WHERE charter_id = ".$id);
    		}
    	}
    }
}
// 前台的应用
$hotelApp = new Admin($db);

