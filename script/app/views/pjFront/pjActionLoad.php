<div class="pjPollContainerWrapper" id="pjWrapperPoll_<?php echo $tpl['arr']['id'];?>">
	<div class="container-fluid pjPollContainer">
		<div class="row">
			<div class="panel panel-default">
				<?php
				$status = 'T';
				if($tpl['arr']['status'] == 'T')
				{
					if($tpl['arr']['use_interval'] == 'F')
					{
						?>
						<div class="panel-heading pjPollHeading">
							<strong class="pjPollTitle"><?php echo pjSanitize::html($tpl['arr']['question']);?></strong>
						</div><!-- /.panel-heading pjPollHeading -->
						<form name="phppoll_vote_form_<?php echo $tpl['arr']['id'];?>" data-toggle="validator" role="form" method="post" action="">
							<div id="stiva_phppoll_container_<?php echo $tpl['arr']['id'];?>">
								<img src="<?php echo PJ_INSTALL_URL . PJ_IMG_PATH; ?>backend/loader.gif" />
							</div>
						</form>
						<?php
					}else{
						if(date('Y-m-d H:i:s') < $tpl['arr']['start_time']){
							$status = 'F';
							?>
							<div class="panel-heading pjPollHeading">
								<strong class="pjPollTitle"><?php __('front_question_not_started', false, true);?></strong>
							</div>
							<?php
						}else if(date('Y-m-d H:i:s') > $tpl['arr']['stop_time']){
							$status = 'F';
							?>
							<div class="panel-heading pjPollHeading">
								<strong class="pjPollTitle"><?php __('front_question_stopped', false, true);?></strong>
							</div>
							<?php
						}else{
							?>
							<div class="panel-heading pjPollHeading">
								<strong class="pjPollTitle"><?php echo pjSanitize::html($tpl['arr']['question']);?></strong>
							</div><!-- /.panel-heading pjPollHeading -->
							<form name="phppoll_vote_form_<?php echo $tpl['arr']['id'];?>" data-toggle="validator" role="form" method="post" action="">
								<div id="stiva_phppoll_container_<?php echo $tpl['arr']['id'];?>">
									<img src="<?php echo PJ_INSTALL_URL . PJ_IMG_PATH; ?>backend/loader.gif" />
								</div>
							</form>
							<?php
						}	
					}
				} else {
					$status = 'F';
					?>
					<div class="panel-heading pjPollHeading">
						<strong class="pjPollTitle"><?php __('front_question_disabled', false, true);?></strong>
					</div>
					<?php
				}
				?>
			</div><!-- /.panel -->
		</div><!-- /.row -->
	</div>
</div>
<script type="text/javascript">
	var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
	var getSessionId = function () {
		return sessionStorage.getItem("session_id") == null ? "" : sessionStorage.getItem("session_id");
	};
	var createSessionId = function () {
		if(getSessionId()=="") {
			sessionStorage.setItem("session_id", "<?php echo session_id(); ?>");
		}
	};
	var session_id = "";
	if (isSafari) {
		createSessionId();
		session_id = getSessionId();
	}
	var stivaPHPpollObj_<?php echo $tpl['arr']['id'];?> = new stivaPHPpoll({

		question_id: "<?php echo $tpl['arr']['id'];?>",
		session_id: session_id,
		skin: "<?php echo $tpl['arr']['skin'];?>",
		stop_poll: "<?php echo $tpl['arr']['stop_poll'];?>",
		poll_status: "<?php echo $status; ?>",
		multiple_vote: "<?php echo $tpl['arr']['multiple_vote']; ?>",
		limit_answers: "<?php echo $tpl['arr']['limit_answers']; ?>",

		vote_form_name: "phppoll_vote_form_<?php echo $tpl['arr']['id'];?>",

		container_id: "stiva_phppoll_container_<?php echo $tpl['arr']['id'];?>",
		error_container_id: "phppoll_error_container_<?php echo $tpl['arr']['id'];?>",
		limitation_container_id: "phppoll_limitation_container_<?php echo $tpl['arr']['id'];?>",

		load_answer_url: "<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&action=pjActionLoadAnswer&question_id=<?php echo $tpl['arr']['id']; ?>",
		set_vote_url: "<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&action=pjActionSetVote&question_id=<?php echo $tpl['arr']['id']; ?>",
		load_result_url: "<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&action=pjActionLoadResult&question_id=<?php echo $tpl['arr']['id']; ?>"
	});
</script>