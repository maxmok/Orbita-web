<?php

use app\models\User;
use app\models\AttributeCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AttributeCategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Категории атрибутов';
$this->params['breadcrumbs'][] = $this->title;


$actions = '{view} ';
$isAdmn = Yii::$app->user->identity->user->isAdmin;
$btn_create = '';
if ($isAdmn)
{
    $actions .= '{update}';
    $btn_create = Html::a('Создать новую категорию', ['create'], ['class' => 'btn btn-success']); 
}
?>
<div class="attribute-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?=  $btn_create ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',            
            [
                'header' => 'Действия',
                'class' => ActionColumn::className(),
                'template' => $actions,             
                'urlCreator' => function ($action, AttributeCategory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],            
        ]        
    ]); ?>


</div>
