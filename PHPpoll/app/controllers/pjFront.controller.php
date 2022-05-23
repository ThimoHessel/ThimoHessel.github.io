<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjFront extends pjAppController
{
	public $defaultCaptcha = 'StivaSoftCaptcha';
	
	public $defaultLocale = 'front_locale_id';
	
	public function __construct()
	{
		$this->setLayout('pjActionFront');
		self::allowCORS();
	}
	public function isXHR()
	{
		return parent::isXHR() || isset($_SERVER['HTTP_ORIGIN']);
	}
	
	static protected function allowCORS()
	{
		$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*';
		header("Access-Control-Allow-Origin: $origin");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With");
	}
	public function afterFilter()
	{		
		
	}
	
	public function beforeFilter()
	{
		$OptionModel = pjOptionModel::factory();
		$this->option_arr = $OptionModel->getPairs($this->getForeignId());
		$this->set('option_arr', $this->option_arr);
		$this->setTime();

		if (!isset($_SESSION[$this->defaultLocale]))
		{
			$locale_arr = pjLocaleModel::factory()->where('is_default', 1)->limit(1)->findAll()->getData();
			if (count($locale_arr) === 1)
			{
				$this->setLocaleId($locale_arr[0]['id']);
			}
		}
		if (!in_array($_GET['action'], array('pjActionLoadCss')))
		{
			$this->loadSetFields(true);
		}
	}
	
	public function beforeRender()
	{
		if (isset($_GET['iframe']))
		{
			$this->setLayout('pjActionIframe');
		}
	}
	
	public function pjActionSetLocale()
	{
		$this->setLocaleId(@$_GET['locale']);
		pjUtil::redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function pjActionLoadCss()
	{
		header("Content-type: text/css");
		
		$arr = pjQuestionModel::factory()->find($_GET['id'])->getData();
		
		$skin = 1;
		if(!empty($arr['skin']))
		{
			$skin = $arr['skin'];
		}
		if(isset($_GET['skin']))
		{
			$skin = $_GET['skin'];
		}
		
		$arr = array(
			array('file' => 'theme' . $skin . '.css', 'path' => PJ_CSS_PATH)
		);
		foreach ($arr as $item)
		{
			$css_content = file_get_contents($item['path'] . $item['file']);
			$css_content = str_replace("pjWrapper","pjWrapperPoll_".$_GET['id'],$css_content);
			echo str_replace(array('../img/'), array(PJ_IMG_PATH), $css_content) . "\n";			
		}
		exit;
	}
	
	public function pjActionLoadJs()
	{
		header("Content-type: text/javascript");
		$arr = array(
			array('file' => 'storagePolyfill.js', 'path' => PJ_LIBS_PATH . 'storage_polyfill/'),
			array('file' => 'jabb-0.4.3.js', 'path' => PJ_LIBS_PATH . 'jabb/'),
			array('file' => 'pjLoad.js', 'path' => PJ_JS_PATH)
		);
		foreach ($arr as $item)
		{
			$js_content = file_get_contents($item['path'] . $item['file']);
			echo $js_content . "\n";
		}
		exit;
	}
	
	public function pjActionLoad()
	{
		$arr = pjQuestionModel::factory()->find($_GET['id'])->getData();
		
		$this->set('arr', $arr);
	}
	
	public function pjActionLoadAnswer()
	{
		$this->setAjax(true);
		
		$arr = pjQuestionModel::factory()->find($_GET['question_id'])->getData();
		
		$answer_arr = pjAnswerModel::factory()->where('question_id', $_GET['question_id'])->orderBy("order_id ASC")->findAll()->getData();
		
		$this->set('answer_arr', $answer_arr);
		$this->set('arr', $arr);
	}
	
	public function pjActionSetVote()
	{
		$this->setAjax(true);
		
		$pjVoteModel = pjVoteModel::factory();
		$pjAnswerModel = pjAnswerModel::factory();
		
		$arr = pjQuestionModel::factory()->find($_GET['question_id'])->getData();
		$answer_arr = $pjAnswerModel->where('question_id', $_GET['question_id'])->orderBy("order_id ASC")->findAll()->getData();
		
		$access_ip = $_SERVER["REMOTE_ADDR"];
		$already_voted = false;
		if(!empty($arr['days']))
		{
			if($arr['limit_via'] == 'ip')
			{
				$pjVoteModel->where('question_id', $arr['id']);
				$pjVoteModel->where('ip', $access_ip);
				$pjVoteModel->where("(vote_time + INTERVAL ".$arr['days']." DAY) > NOW()");
				$cnt = $pjVoteModel->findCount()->getData();
				if($cnt > 0)
				{
					$already_voted = true;
				}
			}else{
				if(isset($_COOKIE["PHPPoll_Vote" + $arr['id']])){
					$already_voted = true;
				}
			}
		}
		
		if($already_voted == false)
		{
			foreach($answer_arr as $v)
			{
				if($_POST['answer_' . $v['id']] == 1)
				{
					$data = array();
					$data['question_id'] = $arr['id'];
					$data['answer_id'] = $v['id'];
					$data['ip'] = $access_ip;
					$data['vote_time'] = date('Y-m-d H:i:s');
					
					$pjVoteModel->reset()->setAttributes($data)->insert();
					
					$pjAnswerModel->reset()->set('id', $v['id'])->modify(array('count' => $v['count'] + 1));
				}
			}
			if($arr['limit_via'] == 'cookie'){
				$expire = time() + 60*60*24*$arr['days'];
				setcookie("PHPPoll_Vote" + $arr['id'], 1, $expire);
			}
		}
		
		$answer_arr = $pjAnswerModel->reset()->where('question_id', $_GET['question_id'])->orderBy("order_id ASC")->findAll()->getData();
		$count_arr = $pjAnswerModel->reset()->select("SUM(count) AS total_count")->where('question_id', $_GET['question_id'])->findAll()->getData();
		
		$total_count = intval($count_arr[0]['total_count']);
		
		$this->set('arr', $arr);
		$this->set('already_voted', $already_voted);
		$this->set('answer_arr', $answer_arr);
		$this->set('total_count', $total_count);
	}
	
	public function pjActionLoadResult()
	{
		$this->setAjax(true);
		
		$pjVoteModel = pjVoteModel::factory();
		$pjAnswerModel = pjAnswerModel::factory();
		
		$arr = pjQuestionModel::factory()->find($_GET['question_id'])->getData();
		$answer_arr = $pjAnswerModel->where('question_id', $_GET['question_id'])->orderBy("order_id ASC")->findAll()->getData();
	
		$count_arr = $pjAnswerModel->reset()->select("SUM(count) AS total_count")->where('question_id', $_GET['question_id'])->findAll()->getData();
		
		$total_count = intval($count_arr[0]['total_count']);
		
		$this->set('arr', $arr);
		$this->set('answer_arr', $answer_arr);
		$this->set('total_count', $total_count);
	}
}
?>