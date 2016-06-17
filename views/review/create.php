<?php

use yii\helpers\Html;

$this->title = 'Добавление отзыва';
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавление';
?>
<div class="review-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
