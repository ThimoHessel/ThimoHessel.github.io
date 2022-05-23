<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjAdminPolls extends pjAdmin
{
	public function pjActionIndex()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			$this->appendJs('jquery.datagrid.js', PJ_FRAMEWORK_LIBS_PATH . 'pj/js/');
			$this->appendJs('pjAdminPolls.js');
			$this->appendJs('index.php?controller=pjAdmin&action=pjActionMessages', PJ_INSTALL_URL, true);
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionGetPoll()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$pjQuestionModel = pjQuestionModel::factory();
			
			if (isset($_GET['q']) && !empty($_GET['q']))
			{
				$q = pjObject::escapeString($_GET['q']);
				$pjQuestionModel->where('t1.question LIKE', "%$q%");
			}

			if (isset($_GET['status']) && !empty($_GET['status']) && in_array($_GET['status'], array('T', 'F')))
			{
				$pjQuestionModel->where('t1.status', $_GET['status']);
			}
				
			$column = 'created';
			$direction = 'DESC';
			if (isset($_GET['direction']) && isset($_GET['column']) && in_array(strtoupper($_GET['direction']), array('ASC', 'DESC')))
			{
				$column = $_GET['column'];
				$direction = strtoupper($_GET['direction']);
			}

			$total = $pjQuestionModel->findCount()->getData();
			$rowCount = isset($_GET['rowCount']) && (int) $_GET['rowCount'] > 0 ? (int) $_GET['rowCount'] : 10;
			$pages = ceil($total / $rowCount);
			$page = isset($_GET['page']) && (int) $_GET['page'] > 0 ? intval($_GET['page']) : 1;
			$offset = ((int) $page - 1) * $rowCount;
			if ($page > $pages)
			{
				$page = $pages;
			}

			$data = array();
			
			$data = $pjQuestionModel->select("t1.*, (SELECT COUNT(question_id) FROM `".pjVoteModel::factory()->getTable()."` AS TV1 WHERE TV1.question_id = t1.id) AS total_votes")
									->orderBy("$column $direction")->limit($rowCount, $offset)->findAll()->getData();
				
			pjAppController::jsonResponse(compact('data', 'total', 'pages', 'page', 'rowCount', 'column', 'direction'));
		}
		exit;
	}
	
	public function pjActionCreate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			if (isset($_POST['question_create']))
			{
				$id = pjQuestionModel::factory($_POST)->insert()->getInsertId();
				if ($id !== false && (int) $id > 0)
				{
					$err = 'AP03';
				} else {
					$err = 'AP04';
				}
				pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminPolls&action=pjActionUpdate&id=" . $id . "&tab_id=tabs-1&err=$err");
			} else {
						
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminPolls.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionDeletePoll()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$response = array();
			
			if (pjQuestionModel::factory()->setAttributes(array('id' => $_GET['id']))->erase()->getAffectedRows() == 1)
			{
				pjAnswerModel::factory()->where('question_id', $_GET['id'])->eraseAll();
				pjVoteModel::factory()->where('question_id', $_GET['id'])->eraseAll();
				$response['code'] = 200;
			} else {
				$response['code'] = 100;
			}
			
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionDeletePollBulk()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjQuestionModel::factory()->whereIn('id', $_POST['record'])->eraseAll();
				pjAnswerModel::factory()->whereIn('question_id', $_POST['record'])->eraseAll();
				pjVoteModel::factory()->whereIn('question_id', $_POST['record'])->eraseAll();
			}
		}
		exit;
	}
	
	public function pjActionExportPoll()
	{
		$this->checkLogin();
		
		if (isset($_POST['record']) && is_array($_POST['record']))
		{
			$arr = pjQuestionModel::factory()->whereIn('id', $_POST['record'])->findAll()->getData();
			$csv = new pjCSV();
			$csv
				->setHeader(true)
				->setName("Questions-".time().".csv")
				->process($arr)
				->download();
		}
		exit;
	}
	
	public function pjActionSetActive()
	{
		$this->setAjax(true);

		if ($this->isXHR())
		{
			$pjQuestionModel = pjQuestionModel::factory();
			
			$arr = $pjQuestionModel->find($_POST['id'])->getData();
			
			if (count($arr) > 0)
			{
				switch ($arr['is_active'])
				{
					case 'T':
						$sql_status = 'F';
						break;
					case 'F':
						$sql_status = 'T';
						break;
					default:
						return;
				}
				$pjQuestionModel->reset()->setAttributes(array('id' => $_POST['id']))->modify(array('is_active' => $sql_status));
			}
		}
		exit;
	}
	
	public function pjActionSavePoll()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			pjQuestionModel::factory()->where('id', $_GET['id'])->limit(1)->modifyAll(array($_POST['column'] => $_POST['value']));
		}
		exit;
	}
	
	public function pjActionStatusPoll()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			if (isset($_POST['record']) && count($_POST['record']) > 0)
			{
				pjQuestionModel::factory()->whereIn('id', $_POST['record'])->modifyAll(array(
					'status' => ":IF(`status`='F','T','F')"
				));
			}
		}
		exit;
	}
	
	public function pjActionUpdate()
	{
		$this->checkLogin();
		
		if ($this->isAdmin())
		{
			if (isset($_POST['question_update']))
			{
				$data = array();
				
				if($_POST['use_interval'] == 'T')
				{
					$_start = $_POST['start_time']; unset($_POST['start_time']);
					$_end = $_POST['stop_time']; unset($_POST['stop_time']);
					
					if(count(explode(" ", $_start)) == 3)
					{
						list($_start_date, $_start_time, $_start_period) = explode(" ", $_start);
						list($_end_date, $_end_time, $_end_period) = explode(" ", $_end);
						$_start_time = pjUtil::formatTime($_start_time . ' ' . $_start_period, $this->option_arr['o_time_format']);
						$_end_time = pjUtil::formatTime($_end_time . ' ' . $_end_period, $this->option_arr['o_time_format']);
					}else{
						list($_start_date, $_start_time) = explode(" ", $_start);
						list($_end_date, $_end_time) = explode(" ", $_end);
						$_start_time = pjUtil::formatTime($_start_time, $this->option_arr['o_time_format']);
						$_end_time = pjUtil::formatTime($_end_time, $this->option_arr['o_time_format']);
					}
					
					$data['start_time'] = date('Y-m-d H:i:s', strtotime(pjUtil::formatDate($_start_date, $this->option_arr['o_date_format']) . ' ' . $_start_time));
					$data['stop_time'] = date('Y-m-d H:i:s', strtotime(pjUtil::formatDate($_end_date, $this->option_arr['o_date_format']) . ' ' . $_end_time));
				}else{
					unset($_POST['start_time']);
					unset($_POST['stop_time']);
					$data['start_time'] = ":NULL";
					$data['stop_time'] = ":NULL";
				}
				
				$pjAnswerModel = pjAnswerModel::factory();
				
				$answer_arr = pjAnswerModel::factory()
					->select("t1.*, (SELECT COUNT(question_id) FROM `".pjVoteModel::factory()->getTable()."` AS TV1 WHERE TV1.answer_id = t1.id) AS total_votes")
					->where('question_id', $_POST['id'])
					->orderBy("order_id DESC")
					->findAll()->getData();				
				$order_id = 1;
				if(!empty($answer_arr))
				{
					$order_id = $answer_arr[0]['order_id'] + 1;
				}
				
				foreach ($_POST['answer'] as $key => $value)
				{
					if (strpos($key, 'new_') === 0)
					{
						$pjAnswerModel->reset()->setAttributes(array('question_id' => $_POST['id'], 'answer' => $_POST['answer'][$key], 'count' => $_POST['count'][$key], 'order_id' => $order_id))->insert();
						$order_id++;
					} else {
						$update_arr = array('answer' => $_POST['answer'][$key], 'count' => $_POST['count'][$key], 'modified' => date('Y-m-d H:i:s'));
						$pjAnswerModel->reset()->setAttributes(array('id' => $key))->modify($update_arr);
					}
				}
				
				pjQuestionModel::factory()->where('id', $_POST['id'])->limit(1)->modifyAll(array_merge($_POST, $data));
				
				pjUtil::redirect(PJ_INSTALL_URL . "index.php?controller=pjAdminPolls&action=pjActionUpdate&id=" . $_POST['id'] . "&tab_id=" . $_POST['tab_id'] . "&err=AP01");
				
			} else {
				
				$arr =  pjQuestionModel::factory()->select("t1.*, (SELECT COUNT(question_id) FROM `".pjVoteModel::factory()->getTable()."` AS TV1 WHERE TV1.question_id = ".$_GET['id'].") AS total_votes, (SELECT COUNT(question_id) FROM `".pjVoteModel::factory()->getTable()."` AS TV2 WHERE TV2.question_id = ".$_GET['id']." AND TV2.vote_time LIKE '%".date('Y-m-d')."%') AS today_votes")
												->find($_GET['id'])->getData();
				if (count($arr) === 0)
				{
					pjUtil::redirect(PJ_INSTALL_URL. "index.php?controller=pjAdminPolls&action=pjActionIndex&err=AP08");
				}
				
				$answer_arr = pjAnswerModel::factory()
					->select("t1.*, (SELECT COUNT(question_id) FROM `".pjVoteModel::factory()->getTable()."` AS TV1 WHERE TV1.answer_id = t1.id) AS total_votes")
					->where('question_id', $_GET['id'])
					->orderBy("order_id ASC")
					->findAll()->getData();
				
				$this->set('arr', $arr);
				
				$this->set('answer_arr', $answer_arr);
				
				$this->appendJs('jquery-ui-timepicker-addon.js', PJ_THIRD_PARTY_PATH . 'timepicker/');
				$this->appendCss('jquery-ui-timepicker-addon.css', PJ_THIRD_PARTY_PATH . 'timepicker/');
				
				$this->appendJs('jquery.tipsy.js', PJ_THIRD_PARTY_PATH . 'tipsy/');
				$this->appendCss('jquery.tipsy.css', PJ_THIRD_PARTY_PATH . 'tipsy/');
				
				$this->appendJs('jquery.validate.min.js', PJ_THIRD_PARTY_PATH . 'validate/');
				$this->appendJs('pjAdminPolls.js');
			}
		} else {
			$this->set('status', 2);
		}
	}
	
	public function pjActionSaveTheme()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$response = array();
			if(isset($_GET['id']) && (int) $_GET['id'] > 0)
			{
				pjQuestionModel::factory()->set('id', $_GET['id'])->modify(array('skin' => $_GET['skin']));
				
				$response['code'] = 200;
			}else{
				$response['code'] = 100;
			}
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionSortAnswer()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$response = array();
			
			$pjAnswerModel = pjAnswerModel::factory();
			
			foreach($_POST['answer_row'] as $k => $v)
			{
				$pjAnswerModel->reset()->set('id', $v)->modify(array('order_id' => $k+1));
			}
			
			$response['code'] = 200;
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionDeleteAnswer()
	{
		$this->setAjax(true);
	
		if ($this->isXHR())
		{
			$response = array();
			$limit_answers = 1;
			$pjAnswerModel = pjAnswerModel::factory();
			$pjQuestionModel = pjQuestionModel::factory();
			$anwer_arr = $pjAnswerModel->find($_GET['id'])->getData();
			$question_arr = $pjQuestionModel->find($anwer_arr['question_id'])->getData();
			$limit_answers = $question_arr['limit_answers'];
			if ($pjAnswerModel->reset()->setAttributes(array('id' => $_GET['id']))->erase()->getAffectedRows() == 1)
			{
				pjVoteModel::factory()->where('answer_id', $_GET['id'])->eraseAll();
				$cnt_answers = $pjAnswerModel->reset()->where("question_id", $anwer_arr['question_id'])->findCount()->getData();
				if($cnt_answers < $question_arr['limit_answers'])
				{
					$pjQuestionModel->reset()->setAttributes(array('id' => $anwer_arr['question_id']))->modify(array('limit_answers' => $cnt_answers));
					$limit_answers = $cnt_answers;
				}
				$response['code'] = 200;
				$response['html'] = pjUtil::getLimitAnswers($cnt_answers, $limit_answers);
			} else {
				$response['code'] = 100;
			}
			
			pjAppController::jsonResponse($response);
		}
		exit;
	}
	
	public function pjActionStatistics()
	{
		$this->setAjax(true);
		if ($this->isXHR())
		{
			$arr =  pjQuestionModel::factory()->select("t1.*, (SELECT COUNT(question_id) FROM `".pjVoteModel::factory()->getTable()."` AS TV1 WHERE TV1.question_id = ".$_GET['id'].") AS total_votes, (SELECT COUNT(question_id) FROM `".pjVoteModel::factory()->getTable()."` AS TV2 WHERE TV2.question_id = ".$_GET['id']." AND TV2.vote_time LIKE '%".date('Y-m-d')."%') AS today_votes")
													->find($_GET['id'])->getData();
			$answer_arr = pjAnswerModel::factory()->select("t1.*, (SELECT COUNT(question_id) FROM `".pjVoteModel::factory()->getTable()."` AS TV1 WHERE TV1.answer_id = t1.id) AS total_votes")
							->where('question_id', $_GET['id'])
							->orderBy("order_id ASC")->findAll()->getData();
			
			$this->set('arr', $arr);
			$this->set('answer_arr', $answer_arr);
		}
	}
}
?>