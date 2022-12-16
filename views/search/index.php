<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var array $result */

$this->params['breadcrumbs'][] = ['label' => 'Категории атрибутов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-category-create">

    <h1><?= Html::encode($this->title) ?></h1>    

    <div class="attribute-category-form">
        <?php ActiveForm::begin(['method' => 'GET']); ?>

        <?= Html::input('hidden', 'search', 'search') ?>

        <?= Html::input('checkbox', 'fio_like') ?> 
        <?= Html::input('text', 'fio') ?>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <?php var_dump($result); ?>

    </div>

