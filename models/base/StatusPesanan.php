<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "status_pesanan".
 *
 * @property integer $id
 * @property string $name
 *
 * @property \app\models\Pesanan[] $pesanans
 * @property string $aliasModel
 */
abstract class StatusPesanan extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status_pesanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesanans()
    {
        return $this->hasMany(\app\models\Pesanan::className(), ['status_id' => 'id']);
    }




}