<dl>
	<dt><?php echo __('Sobre %s',$nice_nick);?></dt>
	<dd class="newline"><?php echo $room->Room->description;?></dd>
	<dt><?php echo __('¿Cómo es %s?',$nice_nick);?></dt>
	<dd class="newline"><?php
	echo __('Soy una chica %s, tengo el cabello %s y los ojos de color %s',$room->EthnicType->type,$room->HairType->type,$room->EyeType->type);
	?>
	</dd>
	<dd class="newline"><?php
	$texto_altura=$room->Room->height.'&nbsp;cm';
	$texto_talla_pecho=$room->Room->breast;
	if($room->Room->natural_breast==1){
		$texto_pechos_naturales=__(' que es natural,');
	}
	else{
		$texto_pechos_naturales='';
	}
	$texto_talla_pies=$room->Room->foot;
	echo __('Mido %s de altura, uso una talla %s para mi pecho,%s y calzo un número %s de pie', $texto_altura, $texto_talla_pecho, $texto_pechos_naturales, $texto_talla_pies);


	if(strtolower($room->Room->tatoos)!='no'){
		$tengo_tatoos=true;
		?><dd class="newline"><?php
			if(strtolower($room->Room->tatoos)=='si'){
				echo __('Tengo tatoos');
			}
			else{
				echo __('Tengo tatoos %s', str_replace(
							array('SI, ','Si, ','si, ','SÍ, ','Sí, ','sí, ','SI','Si','si','SÍ','Sí','sí'),
							'',
							$room->Room->tatoos));
			}
	}
	else{
		$tengo_tatoos=false;
	}

	if(strtolower($room->Room->piercings)!='no'){
		if(!$tengo_tatoos){
			?><dd class="newline"><?php
		}
		if(strtolower($room->Room->piercings)=='si'){
			if($tengo_tatoos){
				echo __(', y también tengo piercings');
			}
			else{
				echo __('Tengo piercings');
			}
		}
		else{
			if($tengo_tatoos){
				echo __(', y también tengo piercings %s', str_replace(
							array('SI, ','Si, ','si, ','SÍ, ','Sí, ','sí, ','SI','Si','si','SÍ','Sí','sí'),
							'',
							$room->Room->piercings));
			}
			else{
				echo __('Tengo piercings %s', str_replace(

							array('SI, ','Si, ','si, ','SÍ, ','Sí, ','sí, ','SI','Si','si','SÍ','Sí','sí'),
							'',
							$room->Room->piercings));
			}
		}
		if(!$tengo_tatoos){
			?></dd><?php
		}
	}
	elseif($tengo_tatoos){
		?></dd><?php
	}
	?>
	</dd>
	<dt><?php echo __('Mi edad');?></dt>
	<dd><?php echo __('%s tiene %s años',$nice_nick,$room->Room->age);?></dd>

	<dt><?php echo __('Las fantasías de %s',$nice_nick);?></dt>
	<dd class=newline><?php echo $room->Room->fantasies;?></dd>

	<dt><?php echo __('¿Cómo le gusta a %s en la cama?',$nice_nick);?></dt>
	<dd class=newline><?php
	if(($room->Room->pref_hetero==1) && ($room->Room->pref_lesbian==1)){
		echo __('Con hombres y mujeres');
	}
	elseif(($room->Room->pref_hetero==1)){
		echo __('Con hombres');
	}
	elseif(($room->Room->pref_lesbian==1)){
		echo __('Con mujeres');
	}
	else{
		// en teoria no hay ninguna
		echo __('Yo solita');
	}
	if(($room->Room->pref_interracial==1)){
		echo __(' de cualquier raza');
	}
	echo '.';
	?></dd><?php
	$extras=array();
	if(($room->Room->pref_anal==1)){
		$extras[]=__('el sexo anal');
	}
	if(($room->Room->pref_double_penetration==1)){
		$extras[]=__('la doble penetración');
	}
	if(($room->Room->pref_double_vaginal==1)){
		$extras[]=__('el doble vaginal');
	}
	if(($room->Room->pref_bdsm==1)){
		$extras[]=__('el sado');
	}
	if(!empty($extras)){
		?><dd class=newline><?php
			$num_extras=sizeof($extras);
		echo __('También me gusta ');
		if($num_extras>1){
			foreach($extras as $n=>$extra):
				if($n>=$num_extras-1){
					echo __(' y ');
				}
			elseif($n>0){
				echo ', ';
			}
			echo $extra;
			endforeach;
		}
		else{
			echo $extras[0];
		}
		echo '.';
		?></dd><?php
	}


	?>
	<dt><?php echo __('Las aficiones de %s',$nice_nick);?></dt>
	<dd class=newline><?php echo $room->Room->hobbies;?></dd>
</dl>
