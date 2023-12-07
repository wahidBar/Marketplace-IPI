<?php

\app\components\MapAsset::register($this);

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\TokoSearch $searchModel
 */
$this->title = 'Toko';
$this->params['breadcrumbs'][] = $this->title;
// var_dump($toko->latitude);

// die;
?>
<?php if (YII::$app->user->identity->role_id == 1) { ?>
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Tambah Baru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php } ?>


<?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
<style>
    #map_canvas {
        width: 100%;
        height: 70vh;
        margin-bottom: 1rem;
        border-radius: 20px;
        box-shadow: 0 8px 4px 5px #eee;
    }
</style>
<?php if (Yii::$app->session->hasFlash('success')) : ?>
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <p><i class="icon fa fa-check"></i>Saved!</p>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i>Not Saved!</h4>
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>
<div class="box box-info">
    <div class="box-body">
        <div class="table-responsive">
            <?= GridView::widget([
                'layout' => '{summary}{pager}{items}{pager}',
                'dataProvider' => $dataProvider,
                'pager'        => [
                    'class'          => yii\widgets\LinkPager::className(),
                    'firstPageLabel' => 'First',
                    'lastPageLabel'  => 'Last'
                ],
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
                'headerRowOptions' => ['class' => 'x'],
                'columns' => [

                    \app\components\ActionButton::getButtons(),

                    'nama',
                    // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
                    [
                        'class' => yii\grid\DataColumn::className(),
                        'attribute' => 'id_user',
                        'value' => function ($model) {
                            if ($rel = $model->user) {
                                return Html::a($rel->name, ['user/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                            } else {
                                return '';
                            }
                        },
                        'format' => 'raw',
                    ],
                    'alamat:ntext',
                    'no_whatsapp',
                    'flag',
                    /*'updated_at'*/
                ],
            ]); ?>
        </div>
    </div>
</div>
<div class="col-md-12 col-12" id="map_canvas"></div>
<?php

$lat = ($toko->latitude) ? $toko->latitude : 0;
$long = ($toko->longitude) ? $toko->longitude : 0;

$js = <<<JS
$(function() {
    var lat = $lat,
     lng = $long,
    
    map = L.map("map_canvas").setView([lat, lng], 13);
   var marker = L.marker([lat, lng]).addTo(map);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiZGVmcmluZHIiLCJhIjoiY2s4ZTN5ZjM0MDFrNzNsdG1tNXk2M2dlMSJ9.YXJM0PTu8PSsCCtYVjJNmw'
}).addTo(map);
});
JS;

$this->registerJs($js);
