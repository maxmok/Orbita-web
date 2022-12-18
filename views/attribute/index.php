<?php

use app\models\Attribute;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AttributeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Атрибуты';
$this->params['breadcrumbs'][] = $this->title;

$actions = '{view} ';
$isAdmn = Yii::$app->user->identity->user->isAdmin;
$btn_create = '';
if ($isAdmn)
{
    $actions .= '{update}';
    $btn_create = Html::a('Создать новый атрибут', ['attribute/create'], ['class' => 'btn btn-success']); 
}

?>
<div class="attribute-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?=  $btn_create ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'attribute_name',
            'short_name',
            //'id_category',
            'count_values',
            [
                'header' => 'Действия',
                'class' => ActionColumn::className(),
                'template' => $actions,      
                'urlCreator' => function ($action, Attribute $model, $key, $index, $column) {
                    return Url::toRoute(['attribute/'.$action, 'id' => $model->id]);
                 }       
            ],
        ],
    ]); ?>


</div>
