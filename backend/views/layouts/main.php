<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use cmscore\components\Skinset;

AppAsset::register($this);
if (Yii::$app->controller->action->id === 'login'){
    echo $this->render('main-login', ['content' => $content]);

} else {

    $directoryAsset = Skinset::getThemePath();
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Yii::$app->name.' - '.Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
<!--
sidebar-collapse
-->
    <body class="hold-transition <?=Skinset::skinClass()?> sidebar-mini ">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
