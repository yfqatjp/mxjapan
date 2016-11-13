<?php
/**
 * 基本类
 */
abstract class Hotel {

    // 当前数据库操作对象
    public $db               =   null;

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
}