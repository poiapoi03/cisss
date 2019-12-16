<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_2nd_license_lib".
 *
 * @property int $fld_ent_id
 * @property string $fld_entity_type
 * @property string $fld_office_code
 */
class Tbl2ndLicenseLib extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_2nd_license_lib';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_cisurdb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fld_entity_type', 'fld_office_code'], 'required'],
            [['fld_entity_type', 'fld_office_code'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fld_ent_id' => 'Fld Ent ID',
            'fld_entity_type' => 'Fld Entity Type',
            'fld_office_code' => 'Fld Office Code',
        ];
    }
}
