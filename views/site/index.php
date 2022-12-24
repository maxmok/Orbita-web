<?php
use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var bool $isGuest */

$this->title = 'ОРБИТА';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">ОРБИТА-web - поиск объектов в организации</h1>
        <br>
        <?php
        if($isGuest) {
            echo Html::a('Вход', ['site/login'], ['class' => 'btn btn-success btn-lg']);
        } else { ?>
        <p>
            <?= Html::a('ПОИСК', ['search/index'], ['class' => 'btn btn-success btn-lg']) ?>
            &nbsp;&nbsp;
            <?= Html::a('Атрибуты и Категории', ['attribute-category/index'], ['class' => 'btn btn-info btn-lg']) ?>
        </p>
        <?php } ?>

    </div>
</div>
