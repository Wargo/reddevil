<?php
echo $this->Html->script('dtpicker');
//echo $this->Html->css('dtpicker');
?>
<style>
.datepicker {
	background: white;	
	clear: none;
}
.datepicker div {
	clear: none;
}
/* css for timepicker */
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
dl {
	width:100%;
	line-height:18px;
}
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 85px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; }
.ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }
</style>
<?php
echo $this->Form->create('Video', array('url' => array('controller' => 'videos', 'action' => 'edit', $id)));

echo $this->Form->inputs(array(
	'fieldset' => false,
	'title' => array(
		'label' => __('Título'),
	),
	'description' => array(
		'readonly' => true,
		'label' => __('Descripción'),
	),
	'active' => array(
		'label' => __('Publicado')
	),
	'published' => array(
		'label' => __('Fecha de publicación'),
		'id' => 'datepicker',
		'type' => 'text',
		'value' => $id ? $this->request->data['Video']['published'] : '0000-00-00 00:00:00'
	),
	'site' => array(
		'label' => __('Sitio web'),
		'options' => array(
			'reddevilx' => 'RedDevilX',
			'glassman' => 'The Glassman Project',
		)
	),
	'duration' => array(
		'label' => __('Duración'),
	),
));

$c_fields = array('fieldset' => false);
foreach ($categories as $category) {

	extract($category);

	$c_fields['Category.' . $Category['id']] = array(
		'type' => 'checkbox',
		'label' => $Category['name'],
		'div' => 'input checkbox left',
	);

	if (in_array($Category['id'], $myCat)) {
		$c_fields['Category.' . $Category['id']]['checked'] = true; 
	}

}

$a_fields = array('fieldset' => false);
foreach ($actors as $actor) {

	extract($actor);

	$a_fields['Actor.' . $Actor['id']] = array(
		'type' => 'checkbox',
		'label' => $Actor['name'],
		'div' => 'input checkbox left',
	);

	if (in_array($Actor['id'], $myAct)) {
		$a_fields['Actor.' . $Actor['id']]['checked'] = true; 
	}

}

echo '<div>';
	echo '<label>' . __('Categorías', true) . '</label>';
	echo $this->Form->inputs(
		$c_fields
	);
echo '</div>';

echo '<div>';
	echo '<label>' . __('Actores/actrices', true) . '</label>';
	echo $this->Form->inputs(
		$a_fields
	);
echo '</div>';

if (!empty($this->request->data['Video']['has_trailer'])) {
	echo $this->element('Videos/admin_brief', array('mode' => 'Trailer', 'data' => $this->request->data));
}

if (!empty($this->request->data['Video']['has_video'])) {	
	echo $this->element('Videos/admin_brief', array('mode' => 'Video', 'data' => $this->request->data));
}

if (!empty($this->request->data['Video'])) {
	echo '<div style="clear:both;"></div>';
	echo $this->Html->link(__('Ir al vídeo'), array('admin' => false, 'controller' => 'videos', 'action' => 'view', $this->request->data['Video']['slug']), array('target' => '_blank'));
}
echo $this->Form->end(__('Guardar', true));
echo $this->Html->link(__('Cancelar', true), array('controller' => 'videos', 'action' => 'index'));
