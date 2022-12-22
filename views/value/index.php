<?php

use app\models\Value;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ValueSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Данные объекта';
$this->params['breadcrumbs'][] = $this->title;

$actions = '{view} {update}';    
?>
<div class="value-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Value', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'attributeObj.attribute_name',
            'value',
            //'person_link_value',
            'start_date_value:date',
            'end_date_value:date',
            //'id_attribute',
            //'id_data_portion',
            [
                'header' => 'Действия',
                'class' => ActionColumn::className(),
                'template' => $actions,
                'urlCreator' => function ($action, Value $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
