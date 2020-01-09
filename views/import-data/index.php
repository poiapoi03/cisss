
<?php
use yii\widgets\ActiveForm;

$this->title = 'Data Import';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'excelFile')->fileInput() ?>

    <button class="btn btn-success">Submit</button>

<?php ActiveForm::end() ?>