<?php
echo $this->Session->flash();
$this->set('title_for_layout', __('Quiero afiliarme'));
?>
<div class="page_content">

	<h1><?php echo __('¿Quieres afiliarte a RedDevilX?'); ?></h1>

	<p><?php echo __('En RedDevilX de momento estamos mejorando el sistema de Afiliados, pero pronto podrás afiliarte y conseguir la mayor rentabilidad.'); ?></p>

	<p><?php echo __('El sistema está enfocado a nuestros afiliados, ya que dependemos de vosotros. Con este nuevo sistema nos hemos esforzado en daros lo mejor ya que si vosotros estáis satisfechos, nosotros también lo estamos.'); ?></p>

	<h2><?php echo __('¿Quieres ser el primero en afiliarte en RedDevilX? Rellena este formulario'); ?></h2>

	<div class="clearfix">
		<?php
		echo $this->Form->create('Contact', array('class' => 'wannabe_form', 'url' => array('controller' => 'contacts', 'action' => 'webmaster')));

		echo $this->Form->inputs(array(
			'fieldset' => false,
			'name' => array(
				'label' => __('Tu nombre'),
				'placeholder' => 'Ej: María García',
			),
			'phone' => array(
				'label' => __('Teléfono'),
				'placeholder' => '666666666',
			),
			'email' => array(
				'label' => __('Email'),
				'placeholder' => 'miemail@gmail.com',
			),
			'comment' => array(
				'label' => __('¿Quieres dejarnos algún comentario?'),
				'placeholder' => 'Deja un comentario...',
				'type' => 'textarea',
				'div' => 'input textarea big'
			)
		));

		echo $this->Form->submit(__('Enviar formulario'));
		echo $this->Form->end();
		?>
	</div>

	<p><?php echo __('De momento, puedes añadirte estos vídeos en tu web si quieres disponer de todo nuestro contenido.'); ?></p>

	<?php
	$videos = ClassRegistry::init('Video')->find('all', array(
		'conditions' => array(
			'active' => 1,
			'published <' => date('Y-m-d H:i:s')
		),
		'order' => array('published' => 'desc')
	));

	foreach ($videos as $video) {

		extract($video);

		echo '<h2>' . $Video['title'] . '</h2>';
		
		echo '<textarea onClick="$(\'#' . $Video['id'] . '\').select();" id="' . $Video['id'] . '" width="300" height="100" readonly="true"><iframe height="367" scrolling="no" width="630" src="' . $this->Html->url(array('full_base' => true, 'controller' => 'videos', 'action' => 'external', $Video['id']))  . '"></iframe></textarea>';

	}
	?>

</div>

