<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\models\PartsGroups;

echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' => [
        [
            'label' => 'Catalog',
            'url' => ['catalog/index'],
			'title' => 'Catalog'
        ],
        [
            'label' => $model->title,
            'url' => ['catalog/frame','id' => $model->id],
            'title' => $model->title,
        ],
        [
            'label' => $frame->title,
            'url' => ['catalog/complectation','id' => $frame->id],
            'title' => $frame->title,
        ],
        [
            'label' => $complectation->complectation,
            'url' => ['catalog/group','id' => $complectation->id],
            'title' => $complectation->complectation,
        ],
        [
            'label' => PartsGroups::nameTypeByType($type),
        ],
    ],
]);
?>

<?php if (empty($groupParts) === false): ?>
    <ul>
        <?php foreach ($groupParts as $groupPart): ?>
            <li>
                <?= Html::a($groupPart->title,['catalog/parts','id' => $groupPart->id]) ?>
            </li>       
        <?php endforeach ?> 
    </ul>
<?php endif ?>