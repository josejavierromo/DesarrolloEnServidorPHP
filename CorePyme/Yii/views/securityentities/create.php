<?php

echo $this->render('_form', [
        'model' => $model,
        'readonly' => false,
        'coreAction' => 'create',
    ]) ;
?>
