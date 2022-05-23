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
	?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all b10">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminPolls&amp;action=pjActionIndex"><?php __('menuPolls'); ?></a></li>
			<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminPolls&amp;action=pjActionCreate"><?php __('lblAddPoll'); ?></a></li>
		</ul>
	</div>
	<?php pjUtil::printNotice(__('infoAddPollTitle', true, false), __('infoAddPollBody', true, false));?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?controller=pjAdminPolls&amp;action=pjActionCreate" method="post" id="frmCreateQuestion" class="form pj-form" autocomplete="off">
		<input type="hidden" name="question_create" value="1" />
		
		<p>
			<label class="title"><?php __('lblQuestion'); ?></label>
			<span class="inline_block">
				<input type="text" name="question" id="question" class="pj-form-field w500 required" />
			</span>
		</p>
		<p>
			<label class="title"><?php __('lblStatus'); ?></label>
			<span class="inline_block">
				<select name="status" id="status" class="pj-form-field required">
					<option value="">-- <?php __('lblChoose'); ?>--</option>
					<?php
					foreach (__('u_statarr', true) as $k => $v)
					{
						?><option value="<?php echo $k; ?>"><?php echo $v; ?></option><?php
					}
					?>
				</select>
			</span>
		</p>
		<p>
			<label class="title">&nbsp;</label>
			<input type="submit" value="<?php __('btnSave', false, true); ?>" class="pj-button" />
		</p>
	</form>
	
	<script type="text/javascript">
	var myLabel = myLabel || {};
	myLabel.email_taken = "<?php __('email_taken', false, true); ?>";
	</script>
	<?php
}
?>