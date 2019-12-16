<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fld_sec_reg_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_sec_reg_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_orig_sec_reg_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_primary_license')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_secondary_license')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fld_office_code_fk')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fld_emp_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fld_entity_code_fk')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
