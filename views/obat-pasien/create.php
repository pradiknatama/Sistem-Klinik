<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ObatPasien */

$this->title = 'Create Obat Pasien';
$this->params['breadcrumbs'][] = ['label' => 'Obat Pasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obat-pasien-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
