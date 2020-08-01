<?php

use ignatenkovnikita\imagemanager\widgets\Upload;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ignatenkovnikita\vkmarket\models\VkmarketAlbum */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="vkmarket-album-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'main_album')->checkbox() ?>

    <?php
    if (!$model->isNewRecord) {
        echo $form->field($model, 'product_ids')->widget(\kartik\select2\Select2::classname(), [
            'options' => ['placeholder' => 'Введите наименование или код товара', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true,
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['product/list']),
                    'dataType' => 'json',
                    'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                ],
            ],
        ])->label('Наименование или код товара');
    }
    ?>

    <?php echo $form->field($model, 'attachment')->widget(
        Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'sortable' => true,
            'maxFileSize' => 10000000, // 10 MiB
            'maxNumberOfFiles' => 1
        ]);
    ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
