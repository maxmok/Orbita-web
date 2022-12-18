<?php

use yii\helpers\Html;

use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AttributeCategory $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = $model->isNewRecord ? 'Создать категорию' : 'Изменить категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории атрибутов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-category-create">

    <h1><?= Html::encode($this->title) ?></h1>    

    <div class="attribute-category-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
       
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

