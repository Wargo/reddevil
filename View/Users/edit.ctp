<?php
$this->layout = 'home';
$this->Asset->js('clone');
echo $this->Form->create('Profile', array(
	'class' => 'my_account clearfix', 
	'url' => array('controller' => 'users', 'action' => 'edit'),
));
?>
	<div id="account_personal_data" class="register_box clearfix">
		<div class="account_title">
			<h3><?php echo __('Configuración de mi cuenta', true); ?></h3>
			<p><?php echo __('Información de la cuenta', true); ?></p>
	</div><!-- account_title -->

	<?php echo $this->element('static/account_menu'); ?>

		<div class="user_name clearfix clear">
		<?php
		echo $this->Form->inputs(array(
			'fieldset' => false,
			'first_name' => array(
					'div' => 'clearfix',
					'label' => __('Nombre', true),
					'type' => 'text'
			),
			'last_name' => array(
					'div' => 'clearfix',
					'label' => __('Apellidos', true),
					'type' => 'text',
		
			),
		));
		?>
		</div>

		<div class="user_name clear">
		<?php
			echo $this->Form->inputs(array(
			'fieldset' => false,
			'birth' => array(
					'div' => 'clearfix',
					'label' => __('Fecha de nacimiento', true),
					'minYear' => date('Y')-120,
					'maxYear' => date('Y')-12,
					'dateFormat' => 'DMY',
					'monthNames' => Configure::read('MonthNames'),
				),
				'gender' => array(
					'div' => 'clearfix',
					'type' => 'select',
					'label' => __('Sexo', true)
				),
			));
		?>
		</div>
	
</div>

<div id="account_email" class="register_box clearfix">
	<div class="user_email clearfix clear">
		<div id="email_clone" class="clear">
		<?php
		echo $this->Form->inputs(array(
			'fieldset' => false,
			'country_id' => array(
				'div' => 'clearfix',
				'label' => __('País', true)
			),
			'province_id' => array(
				'div' => 'clearfix',
				'label' => __('Provincia', true)
			),
			'city_id' => array(
				'div' => 'clearfix',
				'label' => __('Ciudad', true),
			),		
			'postcode' => array(
				'div' => 'clearfix',
				'label' => __('Código postal', true)
			),
			'phone' => array(
				'div' => 'clearfix',
				'label' => __('Teléfono', true)
			),
		));
		?>
		</div>

		</div>
</div><!-- account_email -->

<div id="account_language" class="register_box clearfix">
	<div class="user_language clearfix clear">
	<?php
		echo $this->Form->inputs(array(
			'fieldset' => false,
			'legend' => false,
			'sponsors' => array(
				'label' => __('Sponsors', true),
				'type' => 'textarea'
			)
		));
		?>
	</div>
</div>

<div id="disable_account" class="register_box clearfix">
	<span class="bold">
		<?php echo __('Desactivar cuenta', true) . ':'; ?>
	</span>
	<?php echo $this->Html->link(__('desactivar cuenta', true), array('controller' => 'users', 'action' => 'delete_account')); ?>
</div><!-- disable_Account -->
<div class="account_savechanges">
	<?php echo $this->Form->submit(__('guardar cambios', true)); ?>
</div><!-- savechanges -->
<?php echo $this->Form->end(); ?>
