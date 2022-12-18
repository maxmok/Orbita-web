<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Attribute $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = $model->isNewRecord ? 'Создать атрибут' : 'Изменить атрибут';
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->attribute_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="attribute-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'attribute_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'short_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'id_category')->textInput() ?>        

        <div class="form-group">
            <?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
