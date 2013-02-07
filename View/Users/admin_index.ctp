<div class="tabla_listado">
	<h2><?php echo __('Listado general de usuarios');?></h2>
	<div class="acciones">
	<ul>
		<li>
			<?php
			echo $this->Form->create('User', array('id'=>'formulario_buscador','url' => array('controller' => 'users', 'action' => 'index')));
			?>
			<div class="wrapper">
			<?php
			echo $this->Form->input('open_search',array(
				'label'=>'Buscar',
				'id'=>'CampoBusqueda')
			);
			?>
			<div class="input button">
			<?php
			/*	
				if (!empty($this->params['named']['group']) && $this->params['named']['group'] == 'api') {
					echo $this->Form->input('homologado', array(
						'type' => 'select',
						'options' => array('' => __('Todos'), 1 => __('API Nabucai'), 0 => __('API no homologado')),
						'label' => false
					));
					echo $this->Form->hidden('group', array('value' => 'api'));
				}
			*/
			echo $this->Form->button($this->Html->image('iconos/buscar.png',array('alt'=>'','width'=>16,'height'=>16)), array('type'=>'submit'));
			?>
			</div>
			</div>
			<?php
			echo $this->Form->end();
			?>
		</li>
	<li>
		<?php
			echo $this->Html->link(
				$this->Html->image('iconos/agregar.png',array('alt'=>'','width'=>16,'height'=>16)).' '.__('Nuevo',true),
				array('action' => 'editar'),
				array('escape'=>false)
		);?>
	</li>

	<?php if(!empty($users)):?>
	<li>

	<?php
		//$url = array('action' => 'activar') + $this->params['named'];

		echo $this->Html->link(
			$this->Html->image('iconos/unlocked.png',array('alt'=>'','width'=>16,'height'=>16)).' '.__('Activar',true),
			array('action'=>'activar'),
			array('escape'=>false, 'onclick'=>"$('#formulario_user').attr('action','".$this->Html->url(array('action' => 'activar',0))."');$('#formulario_user').submit(); return false")
		);?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
			$this->Html->image('iconos/locked.png',
			array('alt'=>'','width'=>16,'height'=>16)).' '.__('Desactivar',true),
			array('action'=>'desactivar'),
			array('escape'=>false,'onclick'=>"$('#formulario_user').attr('action','".$this->Html->url(array('action' => 'desactivar',0))."');$('#formulario_user').submit(); return false")
		);?>
	</li>
	<li>
		<?php
		echo $this->Html->link(
			$this->Html->image('iconos/calendario.png',
			array('alt'=>'','width'=>16,'height'=>16)).' '.__('Exportar CSV',true),	
			array_merge(array('csv' => true), $this->params['named']),
			array('escape'=>false)
		);?>
	</li>
	<?php endif;?>

	</ul>
	</div>
	<?php if(empty($users)):?>
	<h4><?php echo __('No hay usuarios') ?></h4>
	<?php else: ?>
	<?php
	//$this->Paginator->options(array('url'=>'/'.$admin,'escape'=>false));
	echo $this->element('bloque_paginador');

	echo $this->Form->create('User',array('url' => array('action' => 'activar'),'id'=>'formulario_user'));
	?>
	<table class="tabla_listado">
	<thead><tr>
	<?php
		$campo_orden=$this->Paginator->sortKey();
		if(empty($campo_orden)){
			$parametros_paginador=$this->Paginator->params();
			if(is_array($parametros_paginador['order'])){
				$campo_orden=key($parametros_paginador['order']);
				$direccion_orden=$parametros_paginador['order'][$campo_orden];
			}
			else{
				$direccion_orden=null;
			}
		}
		else{
			$direccion_orden=$this->Paginator->sortDir();
		}
		$imagen_neutra=$this->Html->image('iconos/orden_neutro.png',array('alt'=>'','width'=>16,'height'=>16));
		if($direccion_orden=='asc'){
			$imagen_seleccionado=$this->Html->image('iconos/orden_asc.png',array('alt'=>'Ascendente','width'=>16,'height'=>16));
		}
		else{
			$imagen_seleccionado=$this->Html->image('iconos/orden_desc.png',array('alt'=>'Descendente','width'=>16,'height'=>16));
		}

	?>
	<th><?php echo $this->Form->checkbox('principal',array('id'=>'principal'));?></th>
	<th><?php
	echo __('Usuario'); ?>
	</th>
	<?php
	$campos = array( 'email' => __('Email'), 'name' => __('Nombre'), 'created' => __('Creado'));
	foreach ($campos as $campo => $nombre) {
		echo '<th>';
		echo $this->Paginator->sort(
			'User.'.$campo, $nombre.' '. (($campo_orden=='User.'.$campo)?$imagen_seleccionado:$imagen_neutra),
			array('escape'=>false)
		);
		echo '</th>';
	} ?>

	</tr>
	</thead>
	<tbody>
	<?php
	foreach($users as $fila => $user):?>
	<tr class="fila_<?php echo ($fila%4); ?>">
	<td style="text-align:center">
	<?php echo $this->Form->checkbox('seleccionado.'.$user['User']['id'],array('class'=>'seleccion'));?>
	</td>
	<td style="text-align:center">
	<?php
	switch($user['User']['active']){
		case 1: $imagen='unlocked.png';
		$texto=__('activo',true);
		$texto_accion=__('desactivar usuario',true);
		$accion='desactivar';
		break;
		case 0:
		default:
			$imagen='locked.png';
			$texto='inactivo';
			$texto_accion=__('activar usuario',true);
			$accion='activar';
			break;
	}
	echo $this->Paginator->link($this->Html->image('iconos/'.$imagen,array('alt'=>$texto,'width'=>16,'height'=>16)),array('action'=>$accion.'/'.$user['User']['id']),array('escape'=>false,'title'=>$texto_accion));
	echo $this->Paginator->link($this->Html->image('iconos/editar.png',array('alt'=>'Edita usuario','width'=>16,'height'=>16)),array('action'=>'editar/'.$user['User']['id']),array('escape'=>false,'title'=>__('Editar usuario',true)));
	if(isset($user['Api'])){
		echo $this->Paginator->link($this->Html->image('iconos/cliente.png',array('alt'=>'Clientes','width'=>16,'height'=>16)),array('controller'=>'clientes','action'=>'index/'.$user['User']['id']),array('escape'=>false,'title'=>__('Ver clientes de este comercializador',true)));
		echo $this->Paginator->link($this->Html->image('iconos/casa.png',array('alt'=>'Inmuebles','width'=>16,'height'=>16)),array('controller'=>'properties','action'=>'index/'.$user['User']['id']),array('escape'=>false,'title'=>__('Ver inmuebles de este comercializador',true)));
	}
	if(isset($user['Api']['revisiones']) && ($user['Api']['revisiones']==1)){
		echo $this->Html->link($this->Html->image('iconos/revisiones.png',array('alt'=>'Mantenimientos','width'=>16,'height'=>16)),array('controller'=>'api_documentos','action'=>'index/0/'.$user['User']['id']),array('escape'=>false,'title'=>__('Ver documentos de revisiones del comercializador',true)));
	}
	?>
	</td>
	<td><?php echo $this->Html->link($user['User']['email'], 'mailto:' . $user['User']['email']);?></td>
	<td><?php 
			if ($user['User']['group'] == 'api') {
				echo $this->Html->link($user['User']['name'], array('controller' => 'apis', 'action' => 'ver', $user['User']['id']));
			} else {
				echo $user['User']['name'];
			}
		?></td>
	<td><?php echo $this->Fechas->mostrar_fecha('marca',$user['User']['created']);?></td>


	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<?php
	echo $this->Form->end();
	echo $this->element('bloque_paginador');
	echo $this->element('resumen_paginador');
	?>
	<?php endif;?>
</div>
<?php $this->set('extra_js',array('select_all')); ?>
