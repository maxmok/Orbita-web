<?php 
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;
/** @var AttributeCategory $category */ 
/** @var DataProvider $dataProvider */ 


$isAdmin = Yii::$app->user->identity->user->isAdmin;

$btn_actions = $isAdmin ? [
                'header' => 'Действия',
                'class' => ActionColumn::className(),
                'template' => '{update} {delete}',
            ] : [];    

$widgetColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            'attributeObj.attribute_name',
            [
                    'attribute' => 'Зачение',
                    'value' => function($array) {                        
                        return $array['person_link_value'] > 0 ? Html::a($array['value'], ['value/index', 'ValueSearch[idPerson]' => $array['person_link_value'], 'ValueSearch[fio]' => $array['value']], ['data-pjax' => 0]) : $array['value'];
                    },
                    'format' => 'raw',
                ],            
            'start_date_value:date',
            'end_date_value:date'                
        ];

if ($isAdmin){
    $widgetColumns = array_merge($widgetColumns,[$btn_actions]);    
}


echo    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $widgetColumns
        
        ]); 
   