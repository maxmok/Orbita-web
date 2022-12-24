<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$src = Yii::getAlias('@root').'\assets\images\404.jpg';

?>

<div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
</div><!-- comment -->
<div class="site-error">
    
    <?= Html::img($src);  ?>

</div>


