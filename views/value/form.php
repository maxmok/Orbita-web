<?php


use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap5\ActiveForm;


/** @var yii\web\View $this */
/** @var app\models\Value $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $attributes */
$error = ' !В разработке!';
$this->title = 'Добавить новое значение';
$this->params['breadcrumbs'][] = ['label' => 'Значение', 'url' => ['index']];

if (!$model->isNewRecord) {
    $this->params['breadcrumbs'][] = ['label' => $model->value, 'url' => ['view', 'id' => $model->id]];    
    $this->title = 'Изменить данные';
}
$this->params['breadcrumbs'][] = $this->title;


$isAdmin = Yii::$app->user->identity->user->isAdmin;

if (!$isAdmin) {
?>    
    <?= Html::img('../../assets/images/forbidden.jpg') ?>
    <p>Вы не должны были попасть на эту страницу.<br> У вас нет прав на Создание и Изменение значений атрибутов.</p>
<?php    
} else {
?>

<div class="value-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_link_value')->textInput() ?>
    
    <?php /*$form->field($model, 'start_date_value')->textInput(['value' => \DateTime::createFromFormat('U',$model->start_date_value)->format('d-m-Y'), 'type' => 'date']) */ ?> 

    <?= $form->field($model, 'start_date_value')->textInput(['value' => $model->start_date_value, 'type' => 'date', 'format'=>'php:d.m.Y']) ?>

    <?= $form->field($model, 'end_date_value')->textInput(['value' => $model->end_date_value, 'type' => 'text']) ?>

    <?= $form->field($model, 'id_attribute')->dropDownList($attributes) ?>

    <?php if ($model->isNewRecord) {echo $form->field($model, 'id_data_portion')->textInput(['value' => '0', 'hidden' => 'true']);} ?>

    <div class="form-group">
        <?= Html::submitButton($this->title.$error, ['class' => 'btn btn-secondary', 'disabled' => 'true']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php } ?>