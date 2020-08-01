<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model ignatenkovnikita\vkmarket\models\VkmarketAlbum */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Vkmarket Album',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Vkmarket Albums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vkmarket-album-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
