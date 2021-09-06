<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Siswa;

/* @var $this yii\web\View */
/* @var $model backend\models\DetailKelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'siswa_id')->widget(
        Select2::classname(),[
            'data' => ArrayHelper::map(SIswa::find()->all(),'id','DataSiswa'),
            'options' => ['placeholder' => '--Pilih Siswa--'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

