<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
?>

<div class="add-review">
    <?php if(Yii::$app->session->hasFlash('reviewAddFail')) { ?>
        <div class="alert alert-danger col-md-12" role="alert">
            <p align="center"><?= Yii::$app->session->getFlash('reviewAddFail') ?></p>
        </div>
    <?php } ?>
    
    <?php $form = ActiveForm::begin(['action' => ['/review/review/add']]); ?>
        <div class="col-md-6">
            <?= $form->field($reviewModel, 'name')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($reviewModel, 'vote')->dropDownList($votes) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($reviewModel, 'pluses')->textArea() ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($reviewModel, 'minuses')->textArea() ?>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-success">
                Добавить отзыв
            </button>
            <?= $form->field($reviewModel, 'item_id')->textInput(['value' => $model->id, 'type' => 'hidden'])->label(false) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
