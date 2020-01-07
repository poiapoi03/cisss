<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fld_id') ?>

    <?= $form->field($model, 'fld_req_no') ?>

    <?= $form->field($model, 'fld_sec_reg_no') ?>

    <?= $form->field($model, 'fld_co_name') ?>

    <?= $form->field($model, 'fld_entity_type') ?>

    <?php // echo $form->field($model, 'fld_req_party') ?>

    <?php // echo $form->field($model, 'fld_address') ?>

    <?php // echo $form->field($model, 'fld_contactno') ?>

    <?php // echo $form->field($model, 'fld_purpose') ?>

    <?php // echo $form->field($model, 'fld_office') ?>

    <?php // echo $form->field($model, 'fld_status') ?>

    <?php // echo $form->field($model, 'fld_text_ext') ?>

    <?php // echo $form->field($model, 'fld_encoder') ?>

    <?php // echo $form->field($model, 'fld_req_timestamp') ?>

    <?php // echo $form->field($model, 'fld_req_empid') ?>

    <?php // echo $form->field($model, 'fld_eva_timestamp') ?>

    <?php // echo $form->field($model, 'fld_eva_empid') ?>

    <?php // echo $form->field($model, 'fld_pri_timestamp') ?>

    <?php // echo $form->field($model, 'fld_pri_empid') ?>

    <?php // echo $form->field($model, 'fld_rel_timestamp') ?>

    <?php // echo $form->field($model, 'fld_rel_empid') ?>

    <?php // echo $form->field($model, 'fld_orno') ?>

    <?php // echo $form->field($model, 'fld_ordate') ?>

    <?php // echo $form->field($model, 'fld_oramount') ?>

    <?php // echo $form->field($model, 'fld_signatory') ?>

    <?php // echo $form->field($model, 'fld_printed_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
