<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = 'Company Details';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="company-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          
            'fld_sec_reg_no',
            'fld_sec_reg_name',
            #'fld_orig_sec_reg_name',
            #'fld_primary_license',
            'secLic',
            'fld_entity_code_fk',
        ],
    ]) ?>

    <?= $this->render('/negative-list/index',[
        'model'=>$model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,

    ]) ?>

</div>
