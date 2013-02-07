<?php
echo $this->Form->create(null, array('class' => 'autocomplete select_user'));
echo $this->element('find_user');
echo $this->Form->submit(__('Seleccionar', true));
echo $this->Form->end();
