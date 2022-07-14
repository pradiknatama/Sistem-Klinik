<?php

use app\models\Pasien;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PasienSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pasien';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasien-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
            if (array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0] == 'staff') {
               ?><?= Html::a('Create Pasien', ['create'], ['class' => 'btn btn-success']);
            }
        ?>

    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php 
    $no=1;
    if ( array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0] == 'dokter') {
        echo "
        <table class='table table-bordered'>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Wilayah</th>
            <th>Ktp</th>
            <th>Diagnosa</th>
            <th>Tindakan</th>
            <th>Action</th>
        </tr>
    
        ";
        foreach ($tes as $value) {
            
            echo "<tr>
                <td> $no </td>
                <td>$value->nama</td>
                <td>$value->wilayah</td>
                <td>$value->ktp</td>
                <td>$value->diagnosa</td>" ?>
                <?php echo "<td>"; if($value->tindakan_id!=null){
                   echo $value->tindakan->nama;
                }
                echo "</td>
                <td><a href=".Url::to(['/pasien/update', 'id' => $value->id])."><i class='fas fa-edit'></i></a></td>
            </tr>";
            $no++;

        }
        echo "</table>";
    }
    else{?>
    <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'nama',
                'ktp',
                'wilayah',
                'diagnosa',
                'tindakan_id',
                'dokter_id',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Pasien $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                     }
                ],
            ],
        ]);
    }?>
    
    <div>
  <canvas id="myChart" width="400" height="100"></canvas>
</div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
       
  const labels = [
    <?php  foreach($data as $wil){
        echo '"' . $wil['wilayah'] . '",';
    }?>

  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'Data Jumlah per Wilayah',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',

      data: [<?php  foreach($data as $wil){
        echo '"' . $wil['total'] . '",';
    }?>],
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {
        height:10,
    }
  };
</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
</div>
