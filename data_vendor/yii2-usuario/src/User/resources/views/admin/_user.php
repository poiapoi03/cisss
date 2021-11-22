<?php
use app\models\TblOffice;
use yii\helpers\ArrayHelper;

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

/**
 * @var yii\widgets\ActiveForm
 * @var \Da\User\Model\User    $user
 */

 
$office=TblOffice::find()->all();
$listData=ArrayHelper::map($office,'fld_officecode',function($model){ return $model->fld_officename .' - '. $model->fld_officecodename; });

?>

<?= $form->field($user, 'empid')->textInput() ?>
<?= $form->field($user, 'name')->textInput() ?>
<?= $form->field($user, 'initial')->textInput() ?>
<?= $form->field($user, 'office_id')->label('Division')->dropDownList(
        $listData,
        ['prompt'=>'--Select Division--']
        ); 
        ?>
<?= $form->field($user, 'dept_id')->label('Department')->dropDownList(
        $listData,
        ['prompt'=>'--Select Department--']
        ); 
        ?>
<?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'password')->passwordInput() ?>
