<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pasien".
 *
 * @property int $id
 * @property string $nama
 * @property string $ktp
 * @property string $wilayah
 * @property string|null $diagnosa
 * @property int|null $tindakan_id
 * @property int $dokter_id
 *
 * @property User $dokter
 * @property ObatPasien[] $obatPasiens
 * @property Tindakan $tindakan
 */
class Pasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'ktp', 'wilayah', 'dokter_id'], 'required'],
            [['tindakan_id', 'dokter_id'], 'integer'],
            [['nama', 'wilayah', 'diagnosa'], 'string', 'max' => 255],
            [['ktp'], 'string', 'max' => 30],
            [['dokter_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['dokter_id' => 'id']],
            [['tindakan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tindakan::className(), 'targetAttribute' => ['tindakan_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'ktp' => 'Ktp',
            'wilayah' => 'Wilayah',
            'diagnosa' => 'Diagnosa',
            'tindakan_id' => 'Tindakan',
            'dokter_id' => 'Dokter',
        ];
    }

    /**
     * Gets query for [[Dokter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDokter()
    {
        return $this->hasOne(User::className(), ['id' => 'dokter_id']);
    }

    /**
     * Gets query for [[ObatPasiens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObatPasiens()
    {
        return $this->hasMany(ObatPasien::className(), ['pasien_id' => 'id']);
    }

    /**
     * Gets query for [[Tindakan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTindakan()
    {
        return $this->hasOne(Tindakan::className(), ['id' => 'tindakan_id']);
    }
}
