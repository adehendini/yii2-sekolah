<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Ubah Username';
?>

<h1><?= $this->title; ?></h1>
<div class="ubah-username-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Ubah Username', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

