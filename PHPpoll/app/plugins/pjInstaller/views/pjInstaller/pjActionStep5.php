<?php
include dirname(__FILE__) . '/elements/progress.php';
$STORAGE = &$_SESSION[$controller->defaultInstaller];
?>
<div class="i-wrap">
	<?php
	if (isset($_GET['err']) && !empty($_GET['err']) && isset($_SESSION[$controller->defaultErrors][$_GET['err']]))
	{
		?>
		<div class="i-status i-status-error">
			<div class="i-status-icon"><abbr></abbr></div>
			<div class="i-status-txt">
				<h2>Installation error!</h2>
				<p class="t10"><?php echo @$_SESSION[$controller->defaultErrors][$_GET['err']]; ?></p>
			</div>
		</div>
		<?php
	}
	?>
	<p>Enter your licence key. You can find your key under Profile page in your <a href="https://www.phpjabbers.com/accounts/login" target="_blank">PHPJabbers.com account</a>.
	<br /><br />Please, note that it is against our licence policy to install our products without providing valid licence key. You can check our our Licence policy <a href="licence.html" target="_blank">here</a>.</p>
	
	<form action="index.php?controller=pjInstaller&amp;action=pjActionStep6&amp;install=1" method="post" id="frmStep5" class="i-form">
		<input type="hidden" name="step5" value="1" />
	
		<table cellpadding="0" cellspacing="0" class="i-table t20">
			<thead>
				<tr>
					<th>Licence Key</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<p>
							<label class="i-title">Key <span class="i-red">*</span></label>
							<input type="text" tabindex="1" name="license_key" class="pj-form-field w300 required" value="<?php echo isset($STORAGE['license_key']) ? htmlspecialchars($STORAGE['license_key']) : NULL; ?>" />
						</p>
					</td>
				</tr>
			</tbody>
		</table>
		
		<div class="t20">
			<p class="float_left pt5">Need help? <a href="https://www.phpjabbers.com/contact.php" target="_blank">Contact us</a></p>
			<input type="submit" tabindex="2" value="Continue &raquo;" class="pj-button float_right l5" />
			<input type="button" tabindex="3" value="&laquo; Back" class="pj-button float_right" onclick="window.location='index.php?controller=pjInstaller&amp;action=pjActionStep4'" />
			<br class="clear_both" />
		</div>
	</form>
</div>