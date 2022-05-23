<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjAnswerModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'answers';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'question_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'answer', 'type' => 'text', 'default' => ':NULL'),
		array('name' => 'order_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'count', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'modified', 'type' => 'datetime', 'default' => ':NULL'),
		array('name' => 'created', 'type' => 'datetime', 'default' => ':NOW()'),
		array('name' => 'status', 'type' => 'enum', 'default' => 'T')
	);
	
	public static function factory($attr=array())
	{
		return new pjAnswerModel($attr);
	}
}
?>