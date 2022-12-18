<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\AttributeCategory $model */
/** @var string $rightIndex */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категория атрибутов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$actions = '{view} ';
$isAdmn = Yii::$app->user->identity->user->isAdmin;
$btn_update = '';
if ($isAdmn)
{
    $actions .= '{update}';
    $btn_update = Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); 
}
?>
<div class="attribute-category-view">

    <h1><?= Html::encode('Категория: '.$this->title) ?></h1>

    <p>
        <?= $btn_update ?>        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>
</div>

<?= $rightIndex ?>