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
            'url' => ['catalog/group-parts','id' => $complectation->id,'type' => $type],
            'title' => PartsGroups::nameTypeByType($type),
        ],
        [
            'label' => $groupPart->title,
        ],
    ],
]);
?>

<?php if (empty($parts) === false): ?>
    <ul>
        <?php foreach ($parts as $part): ?>
            <li>
                <ul class="list-inline">
                    <li>
                        <?= $part->pnc ?>
                    </li>
                    <li>
                        <?= $part->oem ?>
                    </li>
                    <li>
                        <?= $part->required ?>
                    </li>
                    <li>
                        <?= $part->period ?>
                    </li>
                    <li>
                        <?= $part->name ?>
                    </li>
                    <li>
                        <?= $part->applicability ?>
                    </li>
                    <li>
                        <?= $part->price ?>
                    </li>
                </ul>
                
            </li>       
        <?php endforeach ?> 
    </ul>
<?php endif ?>