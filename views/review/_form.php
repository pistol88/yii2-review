<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
?>

<div class="review-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'active')->dropDownList(['yes' => 'Да', 'no' => 'Нет']) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'date')->textInput() ?>
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'item_id')->textInput(['type' => 'number']) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'vote')->textInput(['type' => 'number']) ?>
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'user_id')->textInput(['type' => 'number']) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'name')->textInput() ?>
            </div>
        </div>
    
        <?= $form->field($model, 'text')->textArea() ?>

        <?= $form->field($model, 'pluses')->textArea() ?>

        <?= $form->field($model, 'minuses')->textArea() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
    <?php ActiveForm::end(); ?>
</div>