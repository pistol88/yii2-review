<?php

use yii\helpers\Html;

$this->title = 'Редактирование отзыва';
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="review-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
