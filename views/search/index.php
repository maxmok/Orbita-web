<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\grid\GridView;

use app\models\User;
use app\models\Person;

/** @var array $result */
/** @var array @bDay */
/** @var array @bMonths */
/** @var array @bYears */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = "ПОИСК";
$this->params['breadcrumbs'][] = $this->title;
    
?>
<div class="search">

    <h1><?= Html::encode($this->title) ?></h1>    

    <div class="search-form">
        <?php $form = ActiveForm::begin(['method' => 'POST']); ?>
         
        <?= $form->field($searchModel, 'main_id')->textInput() ?>
        <?= $form->field($searchModel, 'first_name')->textInput() ?>
        <?= $form->field($searchModel, 'second_name')->textInput() ?>
        <?= $form->field($searchModel, 'father_name')->textInput() ?>
        <?= $form->field($searchModel, 'b_day')->dropDownList($bDays) ?>
        <?= $form->field($searchModel, 'b_month')->dropDownList($bMonths) ?>
        <?= $form->field($searchModel, 'b_year')->dropDownList($bYears) ?>
        
        
        
        <?= Html::submitButton('Найти', ['class' => 'btn btn-success']) ?>
        

        <?php ActiveForm::end(); ?>
        </div>
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

