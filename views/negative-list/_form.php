<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\TblStatus;
/* @var $this yii\web\View */
/* @var $model app\models\TblNegativeList */
/* @var $form yii\widgets\ActiveForm */
// date_default_timezone_set('Asia/Manila');
// echo date('F j, Y H:i:s  ');
?>

<div class="tbl-negative-list-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class='hidden'>
    <?= $form->field($model, 'fld_sec_reg_no_fk')->textInput() ?>
    <?= $form->field($model, 'fld_source_office')->textInput() ?>
    <?= $form->field($model, 'fld_source_specialist')->textInput() ?>
    </div>
 

    
    <?php if($model->isNewRecord){ ?>
        <?php 
    
            echo $form->field($model, 'fld_status_code_fk')->dropDownList(
                ArrayHelper::map(\app\models\TblStatus::find()->where(['fld_office_assign'=>Yii::$app->user->identity->dept_id])->asArray()->all(), 'fld_status_id', 'fld_status_desc'),
                ['prompt'=>'Select Type of Infraction']
                );
        ?>

        <?= $form->field($model, 'fld_remarks')->textarea(['rows' => 6]) ?>
    <?php }else{
        echo '<label class="label-primary">Infraction Type:</label>&nbsp;&nbsp;&nbsp;';
        echo $model->status->fld_status_desc;
        echo '<br>';
        echo '<label class="label-info">Remarks:</label><br>';
        echo $model->fld_remarks;
    } ?>

    <?php if(!$model->isNewRecord){ ?>
    <hr>
    <?= $form->field($model, 'addRemarks')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'fld_cleared')->radioList(['0'=>'NO','1'=>'YES']) ?>
    <?php } ?>

    

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
