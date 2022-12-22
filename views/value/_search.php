<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ValueSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="value-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'value') ?>

    <?= $form->field($model, 'person_link_value') ?>

    <?= $form->field($model, 'start_date_value') ?>

    <?= $form->field($model, 'end_date_value') ?>

    <?php // echo $form->field($model, 'id_attribute') ?>

    <?php // echo $form->field($model, 'id_data_portion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
