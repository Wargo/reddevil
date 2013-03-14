<?php
extract ($user);
?>
	<h2><?php __('Datos del usuario'); ?></h2>
	<h3><?php echo $User['username'] ?></h3>
	<dl>
		<dt>Nombre</dt>
		<dd><?php echo $User['first_name'] . ' ' . $User['last_name']; ?></dd>
		<dt>Email</dt>
		<dd><?php echo $User['email']; ?></dd>
		<dt>Cuenta activa hasta:</dt>
		<dd><?php
			if ($User['caducidad'] > '1') {
				echo mostrar_fecha($User['caducidad']);
			} else {
				echo __('Todavía no tienes ninguna suscripción');
			}
		?></dd>
	</dl>

<ul>
<li>
<?php
	echo $this->Html->link(__('Editar mis datos'), array('controller' => 'users', 'action' => 'edit'));
?>
</li>
<li>
<?php
	echo $this->Html->link(__('Renovar suscripción'), array('controller' => 'users', 'action' => 'renew'));
?>
</li>
<li>
<?php
	echo $this->Html->link(__('Desconectar'), array('controller' => 'users', 'action' => 'logout'));
?>
</li>
