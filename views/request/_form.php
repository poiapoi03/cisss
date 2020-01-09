<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fld_req_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_sec_reg_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_co_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fld_entity_type')->textInput() ?>

    <?= $form->field($model, 'fld_req_party')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fld_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fld_contactno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_purpose')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fld_office')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_status')->textInput() ?>

    <?= $form->field($model, 'fld_text_ext')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fld_encoder')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fld_req_timestamp')->textInput() ?>

    <?= $form->field($model, 'fld_req_empid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_eva_timestamp')->textInput() ?>

    <?= $form->field($model, 'fld_eva_empid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_pri_timestamp')->textInput() ?>

    <?= $form->field($model, 'fld_pri_empid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_rel_timestamp')->textInput() ?>

    <?= $form->field($model, 'fld_rel_empid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_orno')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fld_ordate')->textInput() ?>

    <?= $form->field($model, 'fld_oramount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_signatory')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_printed_by')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
