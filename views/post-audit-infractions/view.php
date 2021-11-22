<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblNegativeList */
?>
<div class="tbl-negative-list-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'fld_neg_id',
            'fld_sec_reg_no_fk',
            'status.fld_status_desc',
            'fld_remarks:html',
            'fld_cleared',
            'fld_neg_date',
            'fld_date_cleared',
            'fld_source_office:ntext',
            'fld_source_specialist:ntext',
        ],
    ]) ?>

</div>
