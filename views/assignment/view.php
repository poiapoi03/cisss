<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Assignment */
?>
<div class="assignment-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'ent_id',
            'char_assignment',
            'type',
        ],
    ]) ?>

</div>
