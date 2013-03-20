<?php
echo $this->Session->flash();
$this->set('title_for_layout', __('Quiero ser actriz porno'));
?>
<div class="page_content">

	<h1><?php echo __('¿Quieres ser actriz porno?'); ?></h1>

	<p><?php echo __('Si tienes curiosidad, o quieres dedicarte profesionalmente al sector del porno y ser actriz, RedDevilX te da la posibilidad de trabajar con nosotros.'); ?></p>
	<p><?php echo __('Somos una empresa seria y con experiencia en el sector, y queremos dar oportunidades a chicas nuevas que quieran triunfar en este sector.'); ?></p>
	<p><?php echo __('En RedDevilX no sólo te damos la oportunidad de debutar en el porno, sino que además te aconsejamos y te ayudamos a que puedas hacer una carrera larga y beneficiosa para ti, ya que tenemos un gran equipo humano que te ayudará en todas tus decisiones además de colaborar con el resto de productoras para que puedas trabajar con ellas.'); ?></p>

	<p><?php echo __('En RedDevilX buscamos un buen ambiente de trabajo, donde las actrices se encuentren a gusto, cómodas en un ambiente familiar y cordial y puedan disfrutar de su trabajo ganando lo máximo posible, ya que para nosotros lo mas importante es el valor humano que tienen nuestras actrices y nuestro equipo, y por supuesto, que la actriz ganen la mayor cantidad de dinero posible'); ?></p>

	<h2><?php echo __('¿Es necesaria experiencia?'); ?></h2>
	<p><?php echo __('NO HACE FALTA QUE TENGAS EXPERIENCIA, ya que nosotros te ayudamos, aconsejamos y enseñamos a sacar el artista que llevas dentro.'); ?></p>

	<h2><?php echo __('¿Tengo que ser una TOP MODEL o cumplir algún requisito?'); ?></h2>
	<p><?php echo __('Nosotros damos la oportunidad a todo tipo de chicas y de edades, (siempre mayores de 18 años) no es necesario que seas una top model para dedicarte a este sector.'); ?></p>

	<h2><?php echo __('¿Cuánto puedo ganar y cómo pagan?'); ?></h2>
	<p><?php echo __('Nosotros PAGAMOS DESDE EL PRIMER DÍA, y la primera escena, ya que somos una productora seria y totalmente profesional, por eso mismo no hacemos castings gratis.'); ?></p>
	<h2><?php echo __('Estoy convencida y quiero una oportunidad, ¿Cómo puedo empezar?'); ?></h2>

	<p><?php echo __('Es muy sencillo, nos tienes que rellenar este formulario que adjuntamos abajo, y nosotros nos pondremos en contacto contigo en la mayor brevedad posible.'); ?></p>
	<h2><?php echo __('RedDevilX apostando por los nuevos valores'); ?></h2>

	<div class="clearfix">
		<?php
		echo $this->Form->create('Contact', array('class' => 'wannabe_form', 'url' => array('controller' => 'contacts', 'action' => 'contact')));

		echo $this->Form->inputs(array(
			'fieldset' => false,
			'name' => array(
				'label' => __('Tu nombre'),
				'placeholder' => 'Ej: María García',
			),
			'age' => array(
				'label' => __('Tu edad'),
				'placeholder' => 'Ej: 23',
			),
			'country' => array(
				'label' => __('Nacionalidad'),
				'placeholder' => 'Española',
			),
			'city' => array(
				'label' => __('Ciudad'),
				'placeholder' => 'Barcelona',
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
				'placeholder' => 'Háblanos un poco más de ti...',
				'type' => 'textarea',
				'div' => 'input textarea big'
			)
		));

		echo $this->Form->submit(__('Enviar formulario'));
		echo $this->Form->end();
		?>
	</div>

</div>

