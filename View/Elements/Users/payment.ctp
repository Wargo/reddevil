
<?php
		$user = $this->Session->read('Auth.User.id');
		$total_seconds = 90;
		$ch = curl_init('http://213.27.137.219:8080/SMSGateway/SmsGateway2FlashIn?cid=' . Configure::read('CID_m') . '&uid=' . $user . '&pool=' . Configure::read('pool_m') . '&control=' . Configure::read('pass_m') . '&peticion=SI');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$mobile = curl_exec($ch);

		$mobile = explode('<SEPARATOR>', $mobile);
		$text = $mobile[0];
		$sms = str_replace('<SENDER>', '', $mobile[1]);
?>

<?php echo sprintf(__('Envía %s al %s, dispones de %s segundos para mandarlo'), '<span class="big">' . $text . '</span>', '<span class="big">' . $sms . '</span>', '<span class="remaining">' . $total_seconds . '</span>'); ?>
<p class="info_text"><?php echo Configure::read('info_m'); ?></p>
