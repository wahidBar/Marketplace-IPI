<?php

use yii\helpers\Html;
use Faker\Guesser\Name;
use \dmstr\bootstrap\Tabs;
use app\components\Constant;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Alamat $model
 * @var yii\widgets\ActiveForm $form
 */

?>
<hr>
<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <h3 align="center"><b>ALAMAT</b></h3>
                    <br>
                    <br>
                    <?php $form = ActiveForm::begin(
                        [
                            'id' => 'Alamat',
                            'layout' => 'horizontal',
                            'enableClientValidation' => true,
                            'errorSummaryCssClass' => 'error-summary alert alert-error'
                        ]
                    );
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
                            $form->field($model, 'usrid', Constant::COLUMN(1))->dropDownList(
                                \yii\helpers\ArrayHelper::map(app\models\User::find()->all(), 'id', 'name'),
                                [

                                    'prompt' => 'Select',
                                    'disabled' => (isset($relAttributes) && isset($relAttributes['usrid'])),
                                    // 'disabled' => true,
                                ]
                            ); ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'status', Constant::COLUMN(1))->textInput() ?>
                        </div>

                        <div class="col-md-6">
                            <div class="col-md-6">
                                <br>
                                <p class="col-md-12">Provinsi</p>
                                <div class="col-md-12">
                                    <select class="form-control" id="nama_provinsi" name="nama_provinsi">
                                        <option value="" class="active">--Pilih Provinsi--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 form-group field-alamat-idkec required has-success" style="padding-top: 6%;">
                                <label class="control-label col-md-12" for="alamat-idkec">Distrik</label>
                                <div class="col-md-12">
                                    <select id="alamat-idkec" class="form-control" name="Alamat[idkec]" aria-required="true">
                                        <option value="" class="active">Pilih Provinsi Dulu !</option>
                                    </select>
                                    <p class="help-block help-block-error "></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group field-alamat-judul required col-md-12">
                                <br>
                                <label class="control-label col-md-12" for="alamat-judul">Identitas Alamat</label>
                                <div class="col-md-12">
                                    <textarea id="alamat-judul" class="form-control" name="Alamat[judul]" rows="1" placeholder="Simpan sebagai? cth: Alamat Rumah, Alamat Kantor, dll" aria-required="true"></textarea>
                                    <p class="help-block help-block-error "></p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group field-alamat-alamat required col-md-12">
                                <br>
                                <label class="control-label col-md-12" for="alamat-alamat">Alamat Lengkap</label>
                                <div class="col-md-12">
                                    <textarea id="alamat-alamat" class="form-control" name="Alamat[alamat]" rows="6" placeholder="Deskripsi alamat" aria-required="true"></textarea>
                                    <p class="help-block help-block-error "></p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group field-alamat-kodepos required col-md-12">
                                <br>
                                <label class="control-label col-md-12" for="alamat-kodepos">Kodepos</label>
                                <div class="col-md-12">
                                    <input type="text" id="alamat-kodepos" class="form-control" name="Alamat[kodepos]" placeholder="otomatis keisi!" aria-required="true">
                                    <p class="help-block help-block-error "></p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <?php echo $form->errorSummary($model); ?>
                        <div class="row">
                            <div class="col-md-offset-3 col-md-12">
                                <div class="col-md-12">
                                    <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-success']); ?>
                                    <?= Html::a('<i class="fa fa-chevron-left"></i> Kembali', ['home/profile'], ['class' => 'btn btn-default']) ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>





<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js">
</script>
<script>
    console.log('bbbb');
    $(document).ready(function() {
        console.log('aaaa');
        $.ajax({
            type: 'post',
            url: 'http://localhost:8080/ipi4/web/home/ajax-select-provinsi',
            success: function(htmlresponse) {
                $("#nama_provinsi").html(htmlresponse);
                $("#nama_provinsi").niceSelect('update');
            }
        })
        $("#nama_provinsi").on("change", function() {
            var id_provinsi_terpilih = $('option:selected', '#nama_provinsi').attr('id_provinsi');
            $.ajax({
                type: 'post',
                url: 'http://localhost:8080/ipi4/web/home/ajax-select-city',
                data: 'id_provinsi=' + id_provinsi_terpilih,
                success: function(htmlresponse) {
                    $("#alamat-idkec").html(htmlresponse);
                    $("#alamat-idkec").niceSelect('update');
                }
            });
        });
        $('#alamat-idkec').on("change", function() {
            var pos = $('option:selected', '#alamat-idkec').attr('kodepos');
            $("input[id=alamat-kodepos]").val(pos);
        });

    });
</script>