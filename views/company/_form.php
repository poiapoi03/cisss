<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Tbl2ndLicenseLib;
/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fld_sec_reg_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_sec_reg_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_orig_sec_reg_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fld_primary_license')->dropDownList($model->getPrimaryLicList()) ?>

    <!-- <?= $form->field($model, 'fld_secondary_license')->textarea(['rows' => 6]) ?> -->

    <?php 
    $data = ArrayHelper::map(Tbl2ndLicenseLib::find()->all(), 'fld_ent_id', 'fld_entity_type');
    $model->fld_secondary_license = trim($model->fld_secondary_license,'|');
    $def = explode('|', $model->fld_secondary_license);
    //echo implode("|", $def);
    //print_r($def);
    echo $form->field($model, 'fld_secondary_license')->widget(Select2::classname(), [
        'data' => $data,
        
        'options' => ['placeholder' => 'Select Secondary License', 'multiple' => true,
            'value' => $def, 
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'tokenSeparators' => [',', ' '],
            'tags' => true,
        ],
    ]);

    // echo '<label class="control-label">Secondary License</label>';
    //     echo Select2::widget([
    //         'model' => $model,
    //         'attribute' => 'fld_secondary_license',
    //         'value'=>['0220'=>'poi'],
    //         'data' => $data,
    //         'options' => [
    //             'placeholder' => 'Select Secondary License',
    //             'multiple' => true
    //         ],
    //         // 'pluginOptions' => [
    //         //     'tags' => true,
    //         //     'tokenSeparators' => ['|', ' '],
    //         // ],
    //     ]);
     
    ?>

    <!-- <?= $form->field($model, 'fld_office_code_fk')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fld_emp_id')->textarea(['rows' => 6]) ?> -->

    <?= $form->field($model, 'fld_entity_code_fk')->dropDownList($model->getEntityStatus()) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
