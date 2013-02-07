<?php
extract ($user);
?>
	<h3><?php echo $User['username'] ?></h3>
	<dl>
		<dt>Name</dt>
		<dd><?php echo $User['first_name'] . ' ' . $User['last_name']; ?></dd>
		<dt>Email</dt>
		<dd><?php echo $User['email']; ?></dd>
	</dl>
<?php
if ($User['id'] == $this->Session->read('Auth.User.id')) {
	$menu->settings(__('Opciones', true));
	$menu->add(array(
		array('title' => __('Edita tu perfil', true), 'url' => array('action' => 'edit')),
		array('title' => __('Cambia tu contraseña', true), 'url' => array('action' => 'change_password')),
	));
}

echo $this->element('friends/petition', array('to_user_id' => $User['id']));
echo '<br />';
echo $this->element('follower/follow', array('foreign_id' => $User['id'], 'model' => 'User'));
