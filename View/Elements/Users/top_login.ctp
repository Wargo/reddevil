<span id="top_login">
<?php
if ($this->Session->read('Auth.User.id')) {
	echo $this->Html->link(__('Conectado como %s', $this->Session->read('Auth.User.username')),
		array('controller' => 'users', 'action' => 'profile')
	);
} else {
	echo $this->Html->link(__('Login miembro'), array('controller' => 'users', 'action' => 'login'));
}
?>
</span>
