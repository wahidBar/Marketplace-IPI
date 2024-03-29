<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var app\models\DetailPesanan $model
 */

$this->title = 'DetailPesanan ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'DetailPesanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="giiant-crud pesanan-view">

    <!-- menu buttons -->
    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . 'Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'Tambah Baru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p class="pull-right">
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' . 'Daftar DetailPesanan', ['index'], ['class' => 'btn btn-default']) ?>
    </p>

    <div class="clearfix"></div>

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <div class="box box-info">
        <div class="box-body">
            <?php $this->beginBlock('app\models\DetailPesanan'); ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'invoice',
                    'nama',
                    'nominal',
                    // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
                    [
                        'format' => 'html',
                        'attribute' => 'usrid',
                        'value' => ($model->usr ?
                            Html::a('<i class="glyphicon glyphicon-list"></i>', ['user/index']) . ' ' .
                            Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> ' . $model->usr->name, ['user/view', 'id' => $model->usr->id,]) . ' ' .
                            Html::a('<i class="glyphicon glyphicon-paperclip"></i>', ['create', 'DetailPesanan' => ['usrid' => $model->usrid]])
                            :
                            '<span class="label label-warning">?</span>'),
                    ],
                    'alamat_pembeli',
                    'alamat_penjual',
                    'berat',
                    'ongkir',
                    'kurir',
                    'paket',
                    'dari',
                    'tujuan',
                    'resi',
                    'kirim',
                    'id_bayar',
                    'ajukanbatal',
                    'keterangan',
                    'created_at',
                    'updated_at',
                    'status_id',
                ],
            ]); ?>

            <hr />

            <?= Html::a(
                '<span class="glyphicon glyphicon-trash"></span> ' . 'Delete',
                ['delete', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'data-confirm' => '' . 'Are you sure to delete this item?' . '',
                    'data-method' => 'post',
                ]
            ); ?>
            <?php $this->endBlock(); ?>



            <?= Tabs::widget(
                [
                    'id' => 'relation-tabs',
                    'encodeLabels' => false,
                    'items' => [[
                        'label'   => '<b class=""># ' . $model->id . '</b>',
                        'content' => $this->blocks['app\models\DetailPesanan'],
                        'active'  => true,
                    ],]
                ]
            );
            ?>
        </div>
    </div>
</div>