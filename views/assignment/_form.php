<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Assignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
    echo $form->field($model, 'user_id')->dropDownList(
        ArrayHelper::map(\app\models\User::find()
        ->where(['like','office_id', '010501%', false])
        ->asArray()->all(), 'id', 'name'),
        ['prompt'=>'Select User']
        );
    ?>


    <?php 
    // echo $form->field($model, 'ent_id')->dropDownList(
    //     ArrayHelper::map(\app\models\Tbl2ndLicenseLib::find()
    //     ->where(['fld_office_code'=>'|0105010000|'])
    //     ->asArray()->all(), 'fld_ent_id', 'fld_entity_type'),
    //     ['prompt'=>'Select User']
    //     );
    echo $form->field($model, 'ent_id')->dropDownList(['0001'=>'Financing Company','0002'=>'Lending Company','0029'=>'Foundation','0031'=>'CGFD Accredited Microfin NGOs']);
    ?>

    <?= $form->field($model, 'char_assignment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(['1'=>'Single Character','2'=>'Range']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
