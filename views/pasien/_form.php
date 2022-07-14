<?php

use app\models\Tindakan;
use app\models\User;
use app\models\Wilayah;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasien-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ktp')->textInput(['maxlength' => true]) ?>

    <?=
        $form->field($model, 'wilayah')->dropDownList(
        ArrayHelper::map(Wilayah::find()->all(), 'nama', 'nama'),
        ['prompt'=>'Pilih Wilayah']
        );?>
    <?php
    if (array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0] == 'dokter') {
        ?><?=$form->field($model, 'diagnosa')->textInput(['maxlength' => true]) ;?>
        <?=$form->field($model, 'tindakan_id')->dropDownList(
        ArrayHelper::map(Tindakan::find()->all(), 'id', 'nama'),
        ['prompt'=>'Pilih Tindakan']
        );
     }
    ?>

    
    <?php $dokterId = Yii::$app->authManager->getUserIdsByRole('dokter'); ?>
    <?php
    if (array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0] == 'staff') {
        ?><?= $form->field($model, 'dokter_id')->dropDownList(
            ArrayHelper::map(User::find()->where(['id'=>$dokterId])->orderBy('username')->asArray()->all(), 'id', 'username'),
            ['prompt'=>'Pilih Dokter']
            );
     }
    ?>
  
    <div class="form-group mt-2">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
     
    <?php ActiveForm::end(); ?>

</div>
