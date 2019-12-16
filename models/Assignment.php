<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assignment".
 *
 * @property int $id
 * @property int $user_id
 * @property string $ent_id
 * @property string $char_assignment
 * @property int $type 1 - Single Character, 2 - Blanket
 */
class Assignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type'], 'integer'],
            [['ent_id'], 'string', 'max' => 4],
            [['char_assignment'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Specialist',
            'ent_id' => 'Secondary License',
            'char_assignment' => 'Char Assignment',
            'type' => 'Type',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getSecLic()
    {
        return $this->hasOne(Tbl2ndLicenseLib::className(), ['fld_ent_id' => 'ent_id']);
    }
}
