<?php
	function mostrar_fecha($fecha, $hora = true){
		if($hora && strlen($fecha) > 10 && substr($fecha, 11, 2).':'.substr($fecha, 14, 2).':'.substr($fecha, 17, 2) != '00:00:00') {
			return substr($fecha, 8, 2).'-'.substr($fecha, 5, 2).'-'.substr($fecha, 0, 4).' a las '.substr($fecha, 11, 2).':'.substr($fecha, 14, 2).':'.substr($fecha, 17, 2);
		} else {
			return substr($fecha, 8, 2).'-'.substr($fecha, 5, 2).'-'.substr($fecha, 0, 4);
		}
	}
    function formatea_precio($precio,$euro=true,$separador=',',$separador_miles='.',$decimales_precio=0) {

    	$precio_formateado=number_format($precio,$decimales_precio,$separador,$separador_miles);

    	if($euro){
    		$precio_formateado.=" &euro;";
    	}
    	return $precio_formateado;
    }

	function recortar($texto, $cantidad, $link = '...<!-- Texto cortado -->'){
		$texto = strip_tags($texto);
		$fin_link = substr($link, strlen($link)-15);
		$wrap = wordwrap($texto, $cantidad, $link);
		$pos = strpos($wrap, $fin_link)+15;
		if($pos == 15){
			$nuevo_texto = $texto;
		}
		else{
			$nuevo_texto = substr($wrap, 0, $pos);
		}
		return $nuevo_texto;
	}
