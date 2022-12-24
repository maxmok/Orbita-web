<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Value $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Значение атрибута',/* 'url' => ['index']*/];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="value-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton('Удалить !В разработке!', ['class' => 'btn btn-secondary', 'disabled' => 'true']) ?>
        <!-- <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],            
        ]) 
        ?> -->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'value',
            'person_link_value',
            'start_date_value',
            'end_date_value',
            'id_attribute',
            'id_data_portion',
        ],
    ]) ?>

</div>
