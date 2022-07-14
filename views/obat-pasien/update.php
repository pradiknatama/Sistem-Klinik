<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ObatPasien */

$this->title = 'Update Obat Pasien: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Obat Pasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="obat-pasien-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
