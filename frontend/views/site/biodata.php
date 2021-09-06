<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use frontend\models\UploadFoto;

$this->title = 'Biodata ';
?>
<div class="row">
	<div class="col-lg-4">
		<?= Html::img($upload->getImageUrl(),['class'=>'img-thumbnail']); ?>

		<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'] ]); ?>

	    <?= $form->field($upload, 'image')->widget(FileInput::classname(), [
			    'options'=>['accept'=>'image/*'],
			    'pluginOptions'=>['allowedFileExtensions'=>['jpg','jpeg','png']
			]]); ?>


	    <?php ActiveForm::end(); ?>
	</div>
	<div class="col-lg-8">
		<table class="table table-bordered table-stripped table-condensed">
			<tr>
				<th>NUPTK</th>
				<td><?= $model->nuptk ?></td>
			</tr>
			<tr>
				<th>Nama</th>
				<td><?= $model->nama ?></td>
			</tr>
			<tr>
				<th>Tempat, Tanggal Lahir</th>
				<td><?= $model->tempat_lahir ?>, <?= $model->tanggal_lahir ?></td>
			</tr>
			<tr>
				<th>Alamat</th>
				<td><?= $model->alamat ?></td>
			</tr>
			<tr>
				<th>Telepon</th>
				<td><?= $model->telepon ?></td>
			</tr>
		</table>
	</div>
</div>

