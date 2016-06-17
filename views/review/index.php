<?php
use yii\helpers\Html;
use yii\grid\GridView;
use pistol88\review\widgets\Informer;

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="review-index">

    <?= Html::a('Добавить отзыв', ['create'], ['class' => 'btn btn-success']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['attribute' => 'id', 'filter' => false, 'options' => ['style' => 'width: 49px;']],
            'name',
            'date',
            'vote',
            [
                'attribute' => 'active',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'active',
                    ['yes' => 'Да', 'no' => 'Нет'],
                    ['class' => 'form-control', 'prompt' => 'Показано']
                ),
                'value' => function($model) {
                    if($model->active == 'yes') {
                        return 'Да';
                    } else {
                        return 'Нет';
                    }
                }
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 145px;']],
        ],
    ]); ?>

</div>