<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\TblNegativeListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-negative-list-search col-md-6">
<label class="label-primary">Filter:</label>
    <?php $form = ActiveForm::begin([
        'action' => ['record-list'],
        'method' => 'get',
    ]); ?>


    <?php 
    echo $form->field($model, 'fld_neg_date')->label('Date of Infraction')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Date of Infraction'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
     
    ?>

    <?php // echo $form->field($model, 'fld_neg_date') ?>

    <?php // echo $form->field($model, 'fld_date_cleared') ?>

    <?php // echo $form->field($model, 'fld_source_office') ?>

    <?php // echo $form->field($model, 'fld_source_specialist') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <!-- <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?> -->
    </div>

    <?php ActiveForm::end(); ?>

</div>


<div class="clearfix">

</div>
