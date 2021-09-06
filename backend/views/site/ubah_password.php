<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Ubah Password';
?>
<h1><?= $this->title ?></h1>
<div class="ubah-password-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'old_password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => true]) ?>

	<div class="form-group">
	   <?= Html::submitButton('Ubah Password', ['class' => 'btn btn-primary']) ?>
	</div>

    <?php ActiveForm::end(); ?>
    
</div>

