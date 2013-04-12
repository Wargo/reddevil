<div class="left_part" style="width:200px">
	<p class="text_big small">
		<?php echo __('Bienvenido'); ?>
	</p>
	<p class="text_big small" style="border:solid 1px #3399CC; font-size:20px; padding:3px 5px; margin-right: 15px;">
		<?php echo $this->Session->read('Auth.User.username'); ?>
	</p>
	<p style="color:white">
		<?php echo __('Puedes ahora recargar tu cuenta enviando un mensaje de texto. Y podrás acceder a todo el contenido de RedDevilX durante una semana.'); ?></p>
	</p>
<?php if ($this->Session->read('Auth.User.caducidad') < date('Y-m-d H:i:s')): ?>
	<p>
		<?php
			echo $this->Html->link(__('Pago con Tarjeta'), array('controller' => 'users', 'action' => 'logout_payment'), array('class' => 'register_button'));
		?>
	</p>
<?php endif; ?>
</div>

<div class="right_part">
	<?php
	if ($this->Session->read('Auth.User.caducidad') > date('Y-m-d H:i:s')) {
		?>
		<p class="text_big small" style="text-align: center;">
			<?php
			if ($this->Session->read('Auth.User.caducidad') > '1') {
				echo __('Todavía tienes acceso al contenido privado hasta el') . ' ' . mostrar_fecha($this->Session->read('Auth.User.caducidad'));
			} else {
				echo __('Todavía no tienes ninguna suscripción');
			}
			?>
		</p>
		<?php
			echo $this->Html->link(__('Desconectar'), array('controller' => 'users', 'action' => 'logout'), array('class' => 'logout'));
	} else {
		$user = $this->Session->read('Auth.User.id');
		$total_seconds = 90;
		$ch = curl_init('http://213.27.137.219:8080/SMSGateway/SmsGateway2FlashIn?cid=' . Configure::read('CID_m') . '&uid=' . $user . '&pool=' . Configure::read('pool_m') . '&control=' . Configure::read('pass_m') . '&peticion=SI');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$mobile = curl_exec($ch);

		if ($mobile) {

			$mobile = explode('<SEPARATOR>', $mobile);
			$text = $mobile[0];
			$sms = str_replace('<SENDER>', '', $mobile[1]);
			?>
			<p class="sms" style="color:#FFF;">
				<?php echo sprintf(__('Envía %s al %s, dispones de %s segundos para mandarlo'), '<span class="big">' . $text . '</span>', '<span class="big">' . $sms . '</span>', '<span class="remaining">' . $total_seconds . '</span>'); ?>
				<br />
				<br />
				<?php echo __('¡Este servicio te permite acceder a todo el contenido privado de RedDevilX durante 7 días!'); ?>
				<br />
				<br />
				<span class="info_text"><?php echo Configure::read('info_m'); ?></span>
			</p>
			<?php
		} else {
			?>
			<p class="sms" style="color:#FFF;">
				<?php echo __('Ha ocurrido un error al realizar la consulta para obtener el número y código del SMS'); ?>
				<br />
				<br />
				<span class="info_text"><?php echo Configure::read('info_m'); ?></span>
			</p>
			<?php
		}
	}
	?>
</div>
