<?php
class ConversionsController extends AppController {
	
	public function admin_add($mode = 'Trailer', $id = null) {
		$this->loadModel('Video');
		$flag = ($mode == 'Trailer')?'has_trailer':'has_video';
		$conditions = array('id' => $id, $flag => 1);
		if ($video = $this->Video->find('first', compact('conditions'))) {
			$conditions = array('model' => $mode, 'foreign_id' => $id);
			if (!$conversion = $this->Conversion->find('first', compact('conditions'))) {
				$this->Conversion->create();
				if ($this->Conversion->save($conditions)) {
					$this->Session->setFlash(__('Conversión del video programada'));
				} else {
					$this->Session->setFlash(__('Error al programar la conversión'));
				}
			} else {
				$this->Session->setFlash(__('Ya se programó la conversión de este vídeo'));
			}
		} else {
			$this->Session->setFlash(__('Vídeo incorrecto'));
		}
		$this->redirect($this->referer());
	}
}
