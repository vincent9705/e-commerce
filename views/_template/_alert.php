<?php

use yii\widgets\Pjax;
?>
<?php Pjax::begin(['id' => 'flash-alert']) ?>
<?php $hide_success = Yii::$app->session->hasFlash('success') ? '' : 'display:none;' ?>
<div id="alert-success" class="alert alert-success alert-dismissable" style=<?= $hide_success ?>>
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<span><?= Yii::$app->session->getFlash('success') ?></span>
</div>

<?php $hide_error = Yii::$app->session->hasFlash('error') ? '' : 'display:none;' ?>
<div id="alert-error" class="alert alert-danger alert-dismissable" style=<?= $hide_error ?>>
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<span><?= Yii::$app->session->getFlash('error') ?></span>
</div>
<?php Pjax::end() ?>