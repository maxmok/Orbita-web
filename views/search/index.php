<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

use app\models\User;
use app\models\Person;
use app\models\Value;

/** @var array $result */
/** @var array @bDay */
/** @var array @bMonths */
/** @var array @bYears */
/** @var array @ages */
/** @var array @inns */
/** @var array @projects */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = "ПОИСК";
$this->params['breadcrumbs'][] = $this->title;
$actions = '{view} {update}';    
?>
<div class="search">

    <h1><?= Html::encode($this->title) ?></h1>    

    <div class="search-form">
        <?php $form = ActiveForm::begin(['method' => 'POST']); ?>   
        
                <?= $form->field($searchModel, 'is_like')->checkbox() ?>
        
        <div class="row">
            <div class="col-md-4"> 
                <?= $form->field($searchModel, 'first_name')->textInput() ?>
            </div> 
            <div class="col-md-4"> 
                <?= $form->field($searchModel, 'second_name')->textInput() ?>
            </div>
            <div class="col-md-4"> 
                <?= $form->field($searchModel, 'father_name')->textInput() ?>                
            </div> 
        </div>
        <div class="row">
            <div class="col-md-2"> 
                <?= $form->field($searchModel, 'b_day')->dropDownList($bDays) ?>
            </div>
            <div class="col-md-2"> 
                <?= $form->field($searchModel, 'b_month')->dropDownList($bMonths) ?>
            </div>
            <div class="col-md-2"> 
                <?= $form->field($searchModel, 'b_year')->dropDownList($bYears) ?>     
            </div>        
            <div class="col-md-1"> 
                <?= $form->field($searchModel, 'min_age')->dropDownList($ages) ?>
            </div>                            
            <div class="col-md-1"> 
                <?= $form->field($searchModel, 'max_age')->dropDownList($ages) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"> 
                <?= $form->field($searchModel, 'inn')->dropDownList($inns) ?>
            </div>
            
            <div class="col-md-2"> 
                <?= $form->field($searchModel, 'project')->dropDownList($projects) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"> 
                <?= $form->field($searchModel, 'tel')->textInput() ?>
            </div>
            
            <div class="col-md-2"> 
                <?= $form->field($searchModel, 'email')->input('email') ?>
            </div>
        </div>
        <div >          
                <?= Html::submitButton('Найти', ['class' => 'btn btn-success btn-lg']) ?>
        </div>
        
        <?php ActiveForm::end(); ?>
    </div>
    <div>
        <br>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],
//                'id:text:ИД',
                [
                    'attribute' => 'id',
                    'value' => function($array) {
                        return Html::a($array['id'], ['value/index', 'ValueSearch[idPerson]' => $array['id']], ['data-pjax' => 0]);
                    },
                    'format' => 'raw',
                ],
                'fio:text:ФИО',
                [
                    'header' => 'Действия',
                    'class' => ActionColumn::className(),
                    'template' => $actions,
                    /*'urlCreator' => function ($action, Value $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },*/
                ],
            ]
        ]);
        ?>

        <?php //var_dump($result); ?>

    </div>
</div>

