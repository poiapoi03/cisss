<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_auth_user".
 *
 * @property int $fld_user_id
 * @property string $fld_empid
 * @property string $fld_username
 * @property string $fld_password
 * @property string $fld_salt
 * @property string $fld_initial
 * @property string $fld_name
 * @property string $fld_position
 * @property string $fld_office
 * @property int $fld_usertype 1 - negative list user; 2 - concerned department; 3 - cfrd
 * @property string $fld_user_access
 * @property int $fld_status 0 active, 1 inactive
 */
class TblAuthUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_auth_user';
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
            [['fld_empid', 'fld_username', 'fld_password', 'fld_salt', 'fld_initial', 'fld_name', 'fld_position', 'fld_office', 'fld_usertype', 'fld_user_access'], 'required'],
            [['fld_name', 'fld_position', 'fld_user_access'], 'string'],
            [['fld_usertype', 'fld_status'], 'integer'],
            [['fld_empid'], 'string', 'max' => 10],
            [['fld_username'], 'string', 'max' => 30],
            [['fld_password', 'fld_salt'], 'string', 'max' => 128],
            [['fld_initial'], 'string', 'max' => 50],
            [['fld_office'], 'string', 'max' => 20],
            [['fld_empid'], 'unique'],
            [['fld_username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fld_user_id' => 'Fld User ID',
            'fld_empid' => 'Fld Empid',
            'fld_username' => 'Fld Username',
            'fld_password' => 'Fld Password',
            'fld_salt' => 'Fld Salt',
            'fld_initial' => 'Fld Initial',
            'fld_name' => 'Fld Name',
            'fld_position' => 'Fld Position',
            'fld_office' => 'Fld Office',
            'fld_usertype' => 'Fld Usertype',
            'fld_user_access' => 'Fld User Access',
            'fld_status' => 'Fld Status',
        ];
    }
}
