<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TempImportCompany;

/**
 * TempImportCompanySearch represents the model behind the search form about `\app\models\TempImportCompany`.
 */
class TempImportCompanySearch extends TempImportCompany
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['sec_reg_no', 'name', 'former_name', 'primary_license', 'secondary_license', 'status', 'with_duplicate', 'duplicate_sec_reg_no', 'duplicate_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TempImportCompany::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'sec_reg_no', $this->sec_reg_no])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'former_name', $this->former_name])
            ->andFilterWhere(['like', 'primary_license', $this->primary_license])
            ->andFilterWhere(['like', 'secondary_license', $this->secondary_license])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'with_duplicate', $this->with_duplicate])
            ->andFilterWhere(['like', 'duplicate_sec_reg_no', $this->duplicate_sec_reg_no])
            ->andFilterWhere(['like', 'duplicate_name', $this->duplicate_name]);

        return $dataProvider;
    }
}
