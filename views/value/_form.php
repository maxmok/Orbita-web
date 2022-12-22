<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Value $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="value-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_link_value')->textInput() ?>

    <?= $form->field($model, 'start_date_value')->textInput() ?>

    <?= $form->field($model, 'end_date_value')->textInput() ?>

    <?= $form->field($model, 'id_attribute')->textInput() ?>

    <?= $form->field($model, 'id_data_portion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
