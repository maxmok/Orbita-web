<?php

// use app\models\Value;
use yii\helpers\Html;
//use yii\helpers\Url;
//use yii\grid\ActionColumn;
//use yii\grid\GridView;
use yii\bootstrap5\Tabs;


/** @var array $category for Tabs */
/** @var yii\web\View $this */
/** @var app\models\ValueSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Данные объекта';
$this->params['breadcrumbs'][] = $this->title;

$isAdmn = Yii::$app->user->identity->user->isAdmin;
$btn_create = $isAdmn  ? Html::a('Задать новые данные', ['create'], ['class' => 'btn btn-success']) : '';

?>
<div class="value-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= $btn_create ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?=Tabs::widget([
        'items' => $category
    ]) ?>
    
    
    <?php
//    GridView::widget([
//        'dataProvider' => $dataProvider,
//        //'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            //'id',
//            'attributeObj.attribute_name',
//            'category.name',
//            'value',
//            //'person_link_value',
//            'start_date_value:date',
//            'end_date_value:date',
//            //'id_attribute',
//            //'id_data_portion',
//            [
//                'header' => 'Действия',
//                'class' => ActionColumn::className(),
//                'template' => $actions,
//                'urlCreator' => function ($action, Value $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                 }
//            ],
//        ],
//    ]); 
    ?>


</div>
