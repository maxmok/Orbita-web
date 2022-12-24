<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Attribute $model */

$this->title = $model->attribute_name;
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


$isAdmn = Yii::$app->user->identity->user->isAdmin;
$btn_update = '';
if ($isAdmn)
{
    $btn_update = Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); 
}

?>
<div class="attribute-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= $btn_update ?>
        <!-- <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> -->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'attribute_name',
            'short_name',
            'attributeCategory.name',
            'count_values',
        ],
    ]) ?>

</div>
