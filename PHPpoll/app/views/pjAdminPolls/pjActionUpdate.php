<?php
if (isset($tpl['status']))
{
	$status = __('status', true);
	switch ($tpl['status'])
	{
		case 2:
			pjUtil::printNotice(NULL, $status[2]);
			break;
	}
} else {
	$titles = __('error_titles', true);
	$bodies = __('error_bodies', true);
	if (isset($_GET['err']))
	{
		pjUtil::printNotice(@$titles[$_GET['err']], @$bodies[$_GET['err']]);
	}
	$week_start = isset($tpl['option_arr']['o_week_start']) && in_array((int) $tpl['option_arr']['o_week_start'], range(0,6)) ? (int) $tpl['option_arr']['o_week_start'] : 0;
	$jqDateFormat = pjUtil::jqDateFormat($tpl['option_arr']['o_date_format']);
	$jqTimeFormat = pjUtil::jqTimeFormat($tpl['option_arr']['o_time_format']);
	
	$start_time = date($tpl['option_arr']['o_date_format']) . ' ' . pjUtil::formatTime(date('H:i:s'), 'H:i:s', $tpl['option_arr']['o_time_format']);
	$stop_time = pjUtil::formatDate(date('Y-m-d', strtotime("+1 day")), 'Y-m-d', $tpl['option_arr']['o_date_format']) . ' ' . pjUtil::formatTime(date('H:i:s'), 'H:i:s', $tpl['option_arr']['o_time_format']);
	
	if(!empty($tpl['arr']['start_time']))
	{
		$start_time = pjUtil::formatDate(date('Y-m-d', strtotime($tpl['arr']['start_time'])), 'Y-m-d', $tpl['option_arr']['o_date_format']) . ' ' . pjUtil::formatTime(date('H:i:s', strtotime($tpl['arr']['start_time'])), 'H:i:s', $tpl['option_arr']['o_time_format']);
	}
	if(!empty($tpl['arr']['stop_time']))
	{
		$stop_time = pjUtil::formatDate(date('Y-m-d', strtotime($tpl['arr']['stop_time'])), 'Y-m-d', $tpl['option_arr']['o_date_format']) . ' ' . pjUtil::formatTime(date('H:i:s', strtotime($tpl['arr']['stop_time'])), 'H:i:s', $tpl['option_arr']['o_time_format']);
	}
	?>
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminPolls&amp;action=pjActionUpdate" method="post" id="frmUpdateQuestion" class="form pj-form">
		<input type="hidden" name="question_update" value="1" />
		<input type="hidden" id="post_id" name="id" value="<?php echo $tpl['arr']['id']; ?>" />
		<input type="hidden" id="tab_id" name="tab_id" value="<?php echo isset($_GET['tab_id']) && !empty($_GET['tab_id']) ? $_GET['tab_id'] : 'tabs-1'; ?>" />
		
		<div id="tabs">
		
			<ul>
				<li><a href="#tabs-1"><?php __('lblQuestionAndAnswer'); ?></a></li>
				<li><a href="#tabs-2"><?php __('lblOptions'); ?></a></li>
				<li><a href="#tabs-3"><?php __('lblPreview'); ?></a></li>
				<li><a href="#tabs-4"><?php __('lblStatistic'); ?></a></li>
				<li><a href="#tabs-5"><?php __('lblInstall'); ?></a></li>
			</ul>
		
			<div id="tabs-1">
				<?php
				pjUtil::printNotice(__('infoQuestionAnswerTitle', true, true), __('infoQuestionAnswerBody2', true, true), false); 
				?>
				<fieldset class="overflow b10 question-container">
					<legend><?php __('lblQuestion', false, true); ?></legend>
					<p style="padding:0px;">
						<span class="inline_block">
							<input type="text" name="question" id="question" value="<?php echo pjSanitize::html($tpl['arr']['question']);?>" class="pj-form-field w638 required" />
							<input type="submit" value="<?php __('btnSave', false, true); ?>" class="pj-button" />
						</span>
					</p>
				</fieldset>
				
				<fieldset class="overflow b10">
					<legend><?php __('lblAnswerList', false, true); ?></legend>
					<div class="answer-container">
						<table cellspacing="0" cellpadding="0" class="pj-table" style="width: 100%;">
							<thead>
								<tr>
									<th style="width: 420px;"><?php __('lblAnswer', false, true); ?></th>
									<th style="width: 50px;"><?php __('lblVotes', false, true); ?></th>
									<th style="width: 120px;"><span><?php __('lblShowResults2', false, true); ?></span><a href="#" class="pj-form-langbar-tip poll-tip" title="<?php __('lblShowResultTip'); ?>"></a></th>
									<th style="width: 70px;">&nbsp;</th>
								</tr>
							</thead>
							<tbody id="tblAnswerList" >
								<?php
								if(!empty($tpl['answer_arr']))
								{ 
									$i = 1;
									foreach($tpl['answer_arr'] as $k => $v)
									{
										?>
										<tr id="answer_row_<?php echo $v['id'];?>"  class="<?php echo $i % 2 == 0 ? 'pj-table-row-even' : 'pj-table-row-odd';?>">
											<td>
												<span class="inline_block">
													<input type="text" style="width: 400px;" name="answer[<?php echo $v['id'];?>]" class="pj-form-field pj-form-text required" value="<?php echo pjSanitize::html($v['answer']);?>">
												</span>
											</td>
											<td class="center">
												<div style="width: 60px;"><?php echo pjSanitize::html($v['total_votes']);?></div>
											</td>
											<td>
												<input type="text"  style="width: 80px;" name="count[<?php echo $v['id'];?>]" class="pj-form-field pj-form-text field-int" value="<?php echo pjSanitize::html($v['count']);?>">
											</td>
											<td>
												<a href="index.php?controller=pjAdminPolls&amp;action=pjActionDeleteAnswer&amp;id=<?php echo $v['id'];?>" rev="<?php echo $v['id'];?>" class="pj-table-icon-delete phppoll-delete"></a>
												<a href="javascript:void(0)" class="pj-table-icon-move"></a>
											</td>
										</tr>
										<?php
										$i++;
									}
								}
								?>
							</tbody>
						</table>
					</div>
					<p>
						<input type="submit" value="<?php __('btnSave', false, true); ?>" class="pj-button" />
						<input type="button" value="<?php __('btnAddAnswer'); ?>" class="pj-button btnAddAnswer" />
					</p>
				</fieldset>
				
			</div><!-- tabs-1 -->
			<div id="tabs-2">
				<?php
				pjUtil::printNotice(__('infoQuestionOptionsTitle', true, true), __('infoQuestionOptionsBody', true, true));

				$option_themes = __('option_themes', true, false);
				$limit_via = __('option_limit_via', true, false);
				$show_results = __('show_results', true, false);
				$__yesno = __('_yesno', true, false);
				ksort($option_themes);
				?>
				<p>
					<label class="title"><?php __('lblStatus', false, true); ?></label>
					<span class="inline_block">
						<select name="status" id="status" class="pj-form-field required">
							<option value="">-- <?php __('lblChoose', false, true); ?>--</option>
							<?php
							foreach (__('u_statarr', true) as $k => $v)
							{
								?><option value="<?php echo $k; ?>" <?php echo $tpl['arr']['status'] == $k ? 'selected="selected"' : null; ?>><?php echo $v; ?></option><?php
							}
							?>
						</select>
					</span>
				</p>
				<p>
					<label class="title"><?php __('lblLimitVotes', false, true); ?></label>
					<span class="inline_block">
						<span class="block float_left">
							<input type="text" name="days" id="days" value="<?php echo !empty($tpl['arr']['days']) ? $tpl['arr']['days'] : 0;?>" class="pj-form-field field-int w80" />
						</span>
						<label class="content float_left l5 r5"><?php __('lblDays', false, true); ?></label>
						<a href="#" class="pj-form-langbar-tip listing-tip" title="<?php __('lblLimitVotesTip'); ?>"></a>
					</span>
				</p>
				<p>
					<label class="title"><?php __('lblLimitVia', false, true); ?></label>
					<span class="inline_block">
						<select name="limit_via" id="limit_via" class="pj-form-field w100">
							<?php
							foreach ($limit_via as $k => $v)
							{
								?><option value="<?php echo $k; ?>" <?php echo $tpl['arr']['limit_via'] == $k ? 'selected="selected"' : null; ?>><?php echo $v; ?></option><?php
							}
							?>
						</select>
						<a href="#" class="pj-form-langbar-tip listing-tip" title="<?php __('lblLimitViaTip'); ?>"></a>
					</span>
				</p>
				<p>
					<label class="title"><?php __('lblShowResults', false, true); ?></label>
					<span class="inline_block">
						<select name="show_result" id="show_result" class="pj-form-field w250">
							<?php
							foreach ($show_results as $k => $v)
							{
								?><option value="<?php echo $k; ?>" <?php echo $tpl['arr']['show_result'] == $k ? 'selected="selected"' : null; ?>><?php echo $v; ?></option><?php
							}
							?>
						</select>
						<a href="#" class="pj-form-langbar-tip listing-tip" title="<?php __('lblShowResultsTip'); ?>"></a>
					</span>
				</p>
				<p>
					<label class="title"><?php __('lblAllowMultipleVotes', false, true); ?></label>
					<span class="inline_block">
						<select name="multiple_vote" id="multiple_vote" class="pj-form-field w100">
							<?php
							foreach ($__yesno as $k => $v)
							{
								?><option value="<?php echo $k; ?>" <?php echo $tpl['arr']['multiple_vote'] == $k ? 'selected="selected"' : null; ?>><?php echo $v; ?></option><?php
							}
							?>
						</select>
						<a href="#" class="pj-form-langbar-tip listing-tip" title="<?php __('lblAllowMultipleVotesTip'); ?>"></a>
					</span>
				</p>
				<?php
				if(!empty($tpl['answer_arr']))
				{ 
					?>
					<p style="display:<?php echo $tpl['arr']['multiple_vote'] == 'T' ? 'block' : 'none'; ?>">
						<label class="title"><?php __('lblSelectUpTo', false, true); ?></label>
						<span class="inline_block">
							<span id="selectupto_answers">
								<select name="limit_answers" id="limit_answers" class="pj-form-field w80">
									<?php
									for($i = 1; $i <= count($tpl['answer_arr']); $i++)
									{
										?><option value="<?php echo $i; ?>" <?php echo $tpl['arr']['limit_answers'] == $i ? 'selected="selected"' : null; ?>><?php echo $i; ?></option><?php
									}
									?>
								</select>
							</span>
							<a href="#" class="pj-form-langbar-tip listing-tip" title="<?php __('lblLimitAnswersTip'); ?>"></a>
						</span>
					</p>
					<?php
				} 
				?>
				<p>
					<label class="title"><?php __('lblStopPoll', false, true); ?></label>
					<span class="inline_block">
						<select name="stop_poll" id="stop_poll" class="pj-form-field w100">
							<?php
							foreach ($__yesno as $k => $v)
							{
								?><option value="<?php echo $k; ?>" <?php echo $tpl['arr']['stop_poll'] == $k ? 'selected="selected"' : null; ?>><?php echo $v; ?></option><?php
							}
							?>
						</select>
						<a href="#" class="pj-form-langbar-tip listing-tip" title="<?php __('lblStopPollTip'); ?>"></a>
					</span>
				</p>
				<p>
					<label class="title"><?php __('lblEnableStarStopTime', false, true); ?></label>
					<span class="inline_block">
						<select name="use_interval" id="use_interval" class="pj-form-field w100">
							<?php
							foreach ($__yesno as $k => $v)
							{
								?><option value="<?php echo $k; ?>" <?php echo $tpl['arr']['use_interval'] == $k ? 'selected="selected"' : null; ?>><?php echo $v; ?></option><?php
							}
							?>
						</select>
						<a href="#" class="pj-form-langbar-tip listing-tip" title="<?php __('lblEnableStarStopTimeTip'); ?>"></a>
					</span>
				</p>
				<p>
					<label class="title"><?php __('lblCurrentServerTime', false, true); ?></label>
					<span class="inline_block">
						<label class="content"><?php echo pjUtil::formatDate(date('Y-m-d'), 'Y-m-d', $tpl['option_arr']['o_date_format']) . ' ' . pjUtil::formatTime(date('H:i:s'), 'H:i:s', $tpl['option_arr']['o_time_format']); ?></label>
					</span>
				</p>
				<p class="time-container" style="display:<?php echo $tpl['arr']['use_interval'] == 'T' ? 'block' : 'none'; ?>">
					<label class="title"><?php __('lblStartDateTime'); ?></label>
					<span class="inline_block">
						<span class="pj-form-field-custom pj-form-field-custom-after">
							<input type="text" name="start_time" id="start_time" class="pj-form-field pointer w120 datepick" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" lang="<?php echo $jqTimeFormat; ?>" value="<?php echo $start_time; ?>" />
							<span class="pj-form-field-after"><abbr class="pj-form-field-icon-date"></abbr></span>
						</span>
					</span>
				</p>
				<p class="time-container" style="display:<?php echo $tpl['arr']['use_interval'] == 'T' ? 'block' : 'none'; ?>">
					<label class="title"><?php __('lblStopDateTime'); ?></label>
					<span class="inline_block">
						<span class="pj-form-field-custom pj-form-field-custom-after">
							<input type="text" name="stop_time" id="stop_time" class="pj-form-field pointer w120 datepick" readonly="readonly" rel="<?php echo $week_start; ?>" rev="<?php echo $jqDateFormat; ?>" lang="<?php echo $jqTimeFormat; ?>" value="<?php echo $stop_time; ?>" />
							<span class="pj-form-field-after"><abbr class="pj-form-field-icon-date"></abbr></span>
						</span>
					</span>
				</p>
				<p>
					<label class="title">&nbsp;</label>
					<input type="submit" value="<?php __('btnSave', false, true); ?>" class="pj-button" />
				</p>
			</div><!-- tabs-2 -->
			<div id="tabs-3">
				<?php
				pjUtil::printNotice(__('infoPreviewTitle', true, true), __('infoPreviewDesc', true, true), false); 
				?>
				<p>
					<label class="title"><?php __('lblTheme', false, true); ?></label>
					<span class="inline_block">
						<select name="skin" id="theme" class="pj-form-field w100 block float_left">
							<?php
							foreach ($option_themes as $k => $v)
							{
								?><option value="<?php echo $k; ?>" <?php echo $tpl['arr']['skin'] == $k ? 'selected="selected"' : null; ?>><?php echo $v; ?></option><?php
							}
							?>
						</select>
					</span>
				</p>
                <div style="width:300px">
        <link href="<?php echo PJ_INSTALL_FOLDER.PJ_FRAMEWORK_LIBS_PATH . 'pj/css/'; ?>pj.bootstrap.min.css" type="text/css" rel="stylesheet" />
				<link href="<?php echo PJ_INSTALL_FOLDER; ?>/index.php?controller=pjFront&action=pjActionLoadCss&id=<?php echo $_GET['id']; ?>" type="text/css" rel="stylesheet" />
				<script type="text/javascript" src="<?php echo PJ_INSTALL_FOLDER; ?>/index.php?controller=pjFront&action=pjActionLoadJs"></script>
				<script type="text/javascript" src="<?php echo PJ_INSTALL_FOLDER; ?>index.php?controller=pjFront&action=pjActionLoad&id=<?php echo $_GET['id'];?>"></script>
                </div>
			</div>
			<div id="tabs-4">
				<?php
				pjUtil::printNotice(__('infoPollStatisticTitle', true, false), __('infoPollStatisticBody', true, false)); 
				?>
				<div id="statistic_container"></div>
			</div><!-- tabs-4 -->
			<div id="tabs-5">
				<?php pjUtil::printNotice(__('infoInstallPollTitle', true), __('infoInstallPollDesc', true), false, false); ?>
				<p>
					<label class="title"><?php __('lblPollWidth', false, true); ?></label>
					<span class="inline_block">
						<input type="radio" name="poll_width" id="fixed" value="fixed" class="pj-radio"/><label for="fixed" class="pj-for-label"><?php __('lblFixedSize');?></label>
					</span>
					&nbsp;&nbsp;
					<span class="inline_block">
						<input type="radio" name="poll_width" id="auto" value="auto" class="pj-radio" checked="checked"/><label for="auto" class="pj-for-label"><?php __('lblAuto');?></label>
					</span>
				</p>
				<p class="fixed-size-container" style="display:none;">
					<label class="title"><?php __('lblWidth'); ?></label>
					<span class="inline_block">
						<span class="block float_left">
							<input type="text" name="install_width" id="install_width" class="pj-form-field align_right w100 digits" />
						</span>
						<label class="content float_left l5 r5"><?php __('lblPixels', false, true); ?></label>
					</span>
				</p>
				<br/>
				<textarea id="install_code" class="pj-form-field textarea_install" style="overflow: auto; height:120px;width:725px;"></textarea>
				<div id="install_clone" style="display:none;">&lt;link href="<?php echo PJ_INSTALL_URL.PJ_FRAMEWORK_LIBS_PATH . 'pj/css/'; ?>pj.bootstrap.min.css" type="text/css" rel="stylesheet" /&gt;
&lt;link href="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionLoadCss&amp;id=<?php echo $tpl['arr']['id'];?>" type="text/css" rel="stylesheet" /&gt;
&lt;script type="text/javascript" src="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionLoadJS"&gt;&lt;/script&gt;
&lt;script type="text/javascript" src="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionLoad&amp;id=<?php echo $tpl['arr']['id'];?>"&gt;&lt;/script&gt;</div>
			</div><!-- tabs-5 -->
			
		</div> <!-- #tabs -->
	</form>
	
	<div id="dialogDelete" title="<?php __('lblDeleteAnswerTitle', false, true); ?>" style="display:none">
		<p><?php __('lblDeleteAnswerConfirm', false, true); ?></p>
	</div>
	<div id="delete_answer_url" style="display:none;"></div>
	<div id="answer_row_index" style="display:none;"></div>
	
	<table id="tblAnswerClone" style="display: none">
		<tbody>
			<tr class="tr-clone">
				<td>
					<span class="inline_block">
						<input type="text" style="width: 440px;" name="answer[{INDEX}]" class="pj-form-field required pj-form-text">
					</span>
				</td>
				<td class="center">0</td>
				<td>
					<input type="text"  style="width: 80px;" id="count_{INDEX}" name="count[{INDEX}]" value="0" class="pj-form-field pj-form-text">
				</td>
				<td>
					<a href="#" class="pj-table-icon-delete phppoll-remove"></a>
				</td>
			</tr>
		</tbody>
	</table>
	
	<script type="text/javascript">
		var myLabel = myLabel || {};
		myLabel.question_id = "<?php echo $tpl['arr']['id']; ?>";
		myLabel.number_of_answers = "<?php echo count($tpl['answer_arr']);?>";
		myLabel.loader_img = "<?php echo PJ_INSTALL_URL . PJ_IMG_PATH;?>";
	</script>
	
	<?php
	if (isset($_GET['tab_id']) && !empty($_GET['tab_id']))
	{
		$tab_id = explode("-", $_GET['tab_id']);
		$tab_id = (int) $tab_id[1] - 1;
		$tab_id = $tab_id < 0 ? 0 : $tab_id;
		?>
		<script type="text/javascript">
		(function ($) {
			$(function () {
				$("#tabs").tabs("option", "selected", <?php echo $tab_id; ?>);
			});
		})(jQuery_1_8_2);
		</script>
		<?php
	}
}
?>