<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TempImportCompany */
?>
<div class="temp-import-company-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sec_reg_no',
            'name:ntext',
            'former_name:ntext',
            'primary_license',
            'secondary_license',
            'status',
            'with_duplicate',
            'duplicate_sec_reg_no',
            'duplicate_name:ntext',
        ],
    ]) ?>

</div>
