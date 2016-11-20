<?php
/**
 * 基本类
 */
abstract class Hotel {

    // 当前数据库操作对象
    public $db               =   null;

    public $token_name = "token";
    
    /**
     * 架构函数
     * @access public
     * @param mixed $connection 数据库连接信息
     */
    public function __construct($db) {
    	//
    	$this->db = $db;
        // 模型初始化
        $this->_initialize();
    }

    /**
     * 初始化处理
     */
    protected function _initialize() {
    	
    }
    
    /**
     * 执行动作前的处理
     */
    public function beforeAction() {
    }
    
    public function toHtmlEntities ($value) {
    	return htmlentities($value, ENT_QUOTES, "UTF-8");
    }
    
    
    /**
     * 访问请求参数
     *
     * 查找请求参数的顺行是 $_GET、$_POST 对象附加参数。
     *
     * @param string $parameter 要访问的请求参数
     * @param mixed $default 参数不存在时要返回的默认值
     *
     * @return mixed 参数值
     */
    public function query($parameter, $default = null)
    {
    	if (isset($_GET[$parameter]))
    		return $_GET[$parameter];
    		elseif (isset($_POST[$parameter]))
    		return $_POST[$parameter];
    		else
    			return $default;
    }
    
    /**
     * 是否是 GET 请求
     *
     * @return boolean
     */
    public function isGET()
    {
    	return $this->requestMethod() == 'GET';
    }
    
    /**
     * 是否是 POST 请求
     *
     * @return boolean
     */
    public function isPOST()
    {
    	return $this->requestMethod() == 'POST';
    }
    
    /**
     * 返回请求使用的方法
     *
     * @return string
     */
    public function requestMethod()
    {
    	return $_SERVER['REQUEST_METHOD'];
    }
    
    public function getToken() {
    	if (empty($_SESSION[$this->token_name])) {
    		$_SESSION[$this->token_name] = $this->createToken();
    	}
    	return $_SESSION[$this->token_name];
    }
    
    /**
     * トランザクショントークン用の予測困難な文字列を生成して返す.
     *
     * @access private
     * @return string トランザクショントークン用の文字列
     */
    private function createToken() {
    	return sha1(uniqid(rand(), true));
    }
    
    
    public function isValidToken() {
    	if (!isset($_SESSION[$this->token_name])) {
    		return false;
    	}
    	// token の妥当性チェック
    	$ret = $_POST[$this->token_name] === $_SESSION[$this->token_name];
    
    	return $ret;
    }
    
    public function doValidToken() {
    	if ($this->isPOST()) {
    		if (!$this->isValidToken()) {
    			return false;
    		}
    	}
    	return true;
    }
    
    public function t($key, $arr = array()) {
    	if (count($arr) == 0) {
    		return $key;
    	} else {
    		if (array_key_exists($key, $arr)) {
    			return $arr[$key];
    		} else {
    			return "";
    		}
    	}
    	return $key;
    }
    
    /**
     * Validate that an attribute is a valid date.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function validateDate($value)
    {
    	if ($value instanceof DateTime) {
    		return true;
    	}
    
    	if (strtotime($value) === false) {
    		return false;
    	}
    
    	$date = date_parse($value);
    
    	return checkdate($date['month'], $date['day'], $date['year']);
    }
    
    /**
     * Validate that an attribute matches a date format.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  array   $parameters
     * @return bool
     */
    public function validateDateFormat($value, $format = "Y-m-d")
    {
    	$parsed = date_parse_from_format($format, $value);
    
    	return $parsed['error_count'] === 0 && $parsed['warning_count'] === 0;
    }
    
    /*----------------------------------------------------------------------
     * [名称] gfRandNumber
     * [概要] ランダムパスワード生成（英数字）
     * [引数] パスワードの桁数
     * [戻値] ランダム生成されたパスワード
     * [依存] なし
     * [注釈] -
     *----------------------------------------------------------------------*/
    public function gfRandNumber($length) {
    
    	// 乱数表のシードを決定
    	srand((double)microtime() * 54234853);
    
    	// パスワード文字列の配列を作成
    	$character = '012345679';
    	$pw = preg_split('//', $character, 0, PREG_SPLIT_NO_EMPTY);
    
    	$password = '';
    	for ($i = 0; $i<$length; $i++) {
    		$password .= $pw[array_rand($pw, 1)];
    	}
    
    	return $password;
    }
    
    /***********************************************************************
     * db_prepareUpdate() prepare a query for an update into the database
     *
     * @param PDOStatement $db  database connection ressource
     * @param string $table     concerned table
     * @param array $data       array of values indexed by columns name
     *
     * @return PDOStatement
     *
     */
    function dbUpdate($db, $table, $data)
    {
    	$result = $db->query("SELECT * FROM ".$table." LIMIT 1");
    	$list_cols = db_list_columns($db, $table);
    	$count_cols = 0;
    	$nb_cols = 0;
    	foreach($list_cols as $column)
    		if(array_key_exists($column, $data)) $nb_cols++;
    		$query = "UPDATE ".$table." SET ";
    		foreach($list_cols as $i => $column){
    			if(array_key_exists($column, $data)){
    				$query .= $column." = :".$column;
    				if($count_cols < $nb_cols-1) $query .= ", ";
    				$count_cols++;
    			}
    		}
    		$query .= " WHERE id = ".$data['id'];
    		if(isset($data['lang']) && db_column_exists($db, $table, "lang")) $query .= " AND lang = '".$data['lang']."'";
    		$result = $db->prepare($query);
    		foreach($list_cols as $i => $column){
    			if(array_key_exists($column, $data)){
    				$col_type = db_column_type($db, $table, $column);
    				$value = (is_null($data[$column]) || (preg_match("/.*(char|text).*/i", $col_type) !== 1 && $data[$column] == "")) ? null : $data[$column];
    				$result->bindValue(":".$column, $value);
    			}
    		}
    		return $result;
    }
}