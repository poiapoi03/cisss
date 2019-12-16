<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
?>
<div class="company-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fld_id',
            'fld_sec_reg_no',
            'fld_sec_reg_name',
            'fld_orig_sec_reg_name',
            'fld_primary_license',
            'fld_secondary_license:ntext',
            'fld_office_code_fk:ntext',
            'fld_emp_id:ntext',
            'fld_entity_code_fk',
        ],
    ]) ?>

</div>
