<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\grid\GridView;

use app\models\User;

/** @var array $result */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = "ПОИСК";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search">

    <h1><?= Html::encode($this->title) ?></h1>    

    <div class="search-form">
        <?php $form = ActiveForm::begin(['method' => 'POST']); ?>

        <?= $form->field($searchModel, 'is_like')->checkbox() ?>
        <?= $form->field($searchModel, 'value')->textInput() ?>
        
        <div class="form-group">
            <?= Html::submitButton('Найти', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],
                'id_person',
//                'name',
//                [
//                    'header' => 'Действия',
//                    'class' => ActionColumn::className(),
//                    'template' => $actions,
//                    'urlCreator' => function ($action, AttributeCategory $model, $key, $index, $column) {
//                        return Url::toRoute([$action, 'id' => $model->id]);
//                    },
//                ],
            ]
        ]);
        ?>

        <?php //var_dump($result); ?>

    </div>

