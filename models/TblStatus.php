<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_urdb_status_lib".
 *
 * @property int $fld_status_id
 * @property string $fld_status_desc
 * @property string $fld_office_assign
 */
class TblStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_urdb_status_lib';
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
            [['fld_status_id', 'fld_status_desc', 'fld_office_assign'], 'required'],
            [['fld_status_id'], 'integer'],
            [['fld_status_desc'], 'string', 'max' => 255],
            [['fld_office_assign'], 'string', 'max' => 10],
            [['fld_status_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fld_status_id' => 'Fld Status ID',
            'fld_status_desc' => 'Fld Status Desc',
            'fld_office_assign' => 'Fld Office Assign',
        ];
    }
}
