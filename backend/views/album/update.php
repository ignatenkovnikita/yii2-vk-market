<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ignatenkovnikita\vkmarket\models\VkmarketAlbum */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Vkmarket Album',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Vkmarket Albums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="vkmarket-album-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
