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
     * 包车服务的前处理
     */
    private function beforeCharter(&$fields) {
    	if ($this->id > 0) {
    		foreach($fields[MODULE]["fields"] as $field){
    			$fieldName = $field->getName();
    			if ($fieldName == "charter_type") {
    				$field->setActive(0);
    			}
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
}
// 前台的应用
$hotelApp = new Admin($db);

