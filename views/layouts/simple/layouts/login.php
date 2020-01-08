<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */
// You could register AppAsset depended with AdminlteAsset instead
yidas\adminlte\AdminlteAsset::register($this);
// iCheck
yidas\adminlte\plugins\iCheckAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition login-page">

<?php $this->beginBody() ?>  

    <?= $content ?>

    <div class="well" align="center"><a class="btn btn-primary" href="<?= Url::to(['/request/index'])?>">List of Released Certificates of No Derogatory</a></div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>