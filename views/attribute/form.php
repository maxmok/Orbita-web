<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Attribute $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $categories */

$this->title = 'Создать атрибут';
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты', 'url' => ['index']];
if (!$model->isNewRecord) {
    $this->params['breadcrumbs'][] = ['label' => $model->attribute_name, 'url' => ['view', 'id' => $model->id]];
    $this->title = 'Изменить атрибут';      
} 
$this->params['breadcrumbs'][] = $this->title;
$isAdmin = Yii::$app->user->identity->user->isAdmin;

if (!$isAdmin) {
?>        
    <?= Html::img('../../assets/images/forbidden.jpg') ?>
    <p>Вы не должны были попасть на эту страницу.<br> У вас нет прав на Создание и Изменение атрибутов.</p>
<?php    
} else {
?>
<div class="attribute-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="attribute-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'attribute_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'short_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'id_category')->dropDownList($categories); ?>        

        <div class="form-group">
            <?= Html::submitButton($this->title, ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php } ?>    
