<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Toyota parts parser',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index'],'visible' => !Yii::$app->user->isGuest],
            [
                'label' => 'Parser',
                'items' => [
                    ['label' => 'Catalog', 'url' => ['/catalog/index'],'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Process', 'url' => ['/parser/index'],'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Links', 'url' => ['/link/index'],'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Model', 'url' => ['/model-car/index'],'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Frame', 'url' => ['/frame/index'],'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Complectation', 'url' => ['/complectation/index'],'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Complectation Options', 'url' => ['/complectation-option/index'],'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Groups of parts', 'url' => ['/parts-groups/index'],'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Parts', 'url' => ['/parts/index'],'visible' => !Yii::$app->user->isGuest],


                ]
                ,'visible' => !Yii::$app->user->isGuest],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; ParsingWeb <?= date('Y') ?></p>

        <p class="pull-right"><a href="http://parsingweb.ru">ParsingWeb</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
