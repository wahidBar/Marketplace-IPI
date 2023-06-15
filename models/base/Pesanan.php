<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\db\Expression;

use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "pesanan".
 *
 * @property integer $id
 * @property integer $invoice
 * @property string $nama
 * @property integer $nominal
 * @property string $token_midtrans
 * @property integer $usrid
 * @property string $alamat_pembeli
 * @property string $alamat_penjual
 * @property integer $berat
 * @property integer $ongkir
 * @property string $kurir
 * @property string $paket
 * @property integer $dari
 * @property integer $tujuan
 * @property string $resi
 * @property string $kirim
 * @property integer $id_bayar
 * @property integer $ajukanbatal
 * @property string $keterangan
 * @property integer $status_id
 * @property string $selesai
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\User $usr
 * @property \app\models\StatusPesanan $status
 * @property string $aliasModel
 */
abstract class Pesanan extends \yii\db\ActiveRecord
{


    public function fields()
    {
        $parent = parent::fields();
        if (isset($parent['token_midtrans'])) {
            unset($parent['token_midtrans']);

            $parent['token_midtrans'] = function ($model) {
                return $model->token_midtrans;
            };
        }
        if (!isset($parent['url'])) {
            unset($parent['url']);

            $parent['url'] = function ($model) {
                return 'https://app.sandbox.midtrans.com/snap/v2/vtweb/' . $model->token_midtrans;
            };
        }
        // if (isset($parent['status_id'])) {
        //     unset($parent['status_id']);
        //     $parent['status'] = function ($model) {
        //         $curl = curl_init();
        //         curl_setopt_array($curl, array(
        //             CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/" . $model->invoice . "/status",
        //             CURLOPT_RETURNTRANSFER => true,
        //             CURLOPT_ENCODING => "",
        //             CURLOPT_MAXREDIRS => 10,
        //             CURLOPT_TIMEOUT => 0,
        //             CURLOPT_FOLLOWLOCATION => true,
        //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //             CURLOPT_CUSTOMREQUEST => "GET",
        //             CURLOPT_POSTFIELDS => "\n\n",
        //             CURLOPT_HTTPHEADER => array(
        //                 "Accept: application/json",
        //                 "Content-Type: application/json",
        //                 "Authorization: Basic U0ItTWlkLXNlcnZlci1LZk9IdElZUWRNLW1aY1IwR2xzbEprMjg6"
        //             ),
        //         ));

        //         $response = curl_exec($curl);

        //         curl_close($curl);
        //         $a = json_decode($response);
        //         if ($a->status_code == "404") {
        //             return "Pending";
        //         } else {
        //             if ($a->transaction_status == "pending") {
        //                 return "Pending";
        //             } elseif ($a->transaction_status == "capture" || $a->transaction_status == "settlement") {
        //                 return "Pembayaran Berhasil";
        //             } elseif ($a->transaction_status == "deny" || $a->transaction_status == "cancel" || $a->transaction_status == "expire") {
        //                 return "Pembayaran Gagal";
        //             }
        //         }
        //     };
        // }
        unset($parent['updated_at']);
        unset($parent['created_at']);


        return $parent;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pesanan';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice', 'nama', 'nominal', 'token_midtrans', 'usrid', 'alamat_pembeli', 'alamat_penjual', 'berat', 'ongkir', 'kurir', 'paket', 'dari', 'tujuan', 'resi', 'id_bayar', 'ajukanbatal', 'keterangan', 'status_id'], 'required'],
            [['invoice', 'nominal', 'usrid', 'berat', 'ongkir', 'dari', 'tujuan', 'id_bayar', 'ajukanbatal', 'status_id'], 'integer'],
            [['kirim', 'selesai'], 'safe'],
            [['nama', 'token_midtrans', 'alamat_pembeli', 'alamat_penjual', 'kurir', 'paket', 'resi', 'keterangan'], 'string', 'max' => 255],
            [['usrid'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\User::className(), 'targetAttribute' => ['usrid' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\StatusPesanan::className(), 'targetAttribute' => ['status_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice' => 'Invoice',
            'nama' => 'Nama',
            'nominal' => 'Nominal',
            'token_midtrans' => 'Token Midtrans',
            'usrid' => 'Usrid',
            'alamat_pembeli' => 'Alamat Pembeli',
            'alamat_penjual' => 'Alamat Penjual',
            'berat' => 'Berat',
            'ongkir' => 'Ongkir',
            'kurir' => 'Kurir',
            'paket' => 'Paket',
            'dari' => 'Dari',
            'tujuan' => 'Tujuan',
            'resi' => 'Resi',
            'kirim' => 'Kirim',
            'id_bayar' => 'Id Bayar',
            'ajukanbatal' => 'Ajukanbatal',
            'keterangan' => 'Keterangan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status_id' => 'Status ID',
            'selesai' => 'Selesai',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsr()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'usrid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(\app\models\StatusPesanan::className(), ['id' => 'status_id']);
    }
}
