<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblRequest;

/**
 * TblRequestSearch represents the model behind the search form about `\app\models\TblRequest`.
 */
class TblRequestSearch extends TblRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fld_id', 'fld_entity_type', 'fld_status'], 'integer'],
            [['fld_req_no', 'fld_sec_reg_no', 'fld_co_name', 'fld_req_party', 'fld_address', 'fld_contactno', 'fld_purpose', 'fld_office', 'fld_text_ext', 'fld_encoder', 'fld_req_timestamp', 'fld_req_empid', 'fld_eva_timestamp', 'fld_eva_empid', 'fld_pri_timestamp', 'fld_pri_empid', 'fld_rel_timestamp', 'fld_rel_empid', 'fld_orno', 'fld_ordate', 'fld_signatory', 'fld_printed_by'], 'safe'],
            [['fld_oramount'], 'number'],
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
        $query = TblRequest::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['fld_rel_timestamp'=>'SORT_ASC']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'fld_id' => $this->fld_id,
            'fld_entity_type' => $this->fld_entity_type,
            'fld_status' => 4,
            'fld_req_timestamp' => $this->fld_req_timestamp,
            'fld_eva_timestamp' => $this->fld_eva_timestamp,
            'fld_pri_timestamp' => $this->fld_pri_timestamp,
            'fld_rel_timestamp' => $this->fld_rel_timestamp,
            'fld_ordate' => $this->fld_ordate,
            'fld_oramount' => $this->fld_oramount,
        ]);

        $query->andFilterWhere(['like', 'fld_req_no', $this->fld_req_no])
            ->andFilterWhere(['like', 'fld_sec_reg_no', $this->fld_sec_reg_no])
            ->andFilterWhere(['like', 'fld_co_name', $this->fld_co_name])
            ->andFilterWhere(['like', 'fld_req_party', $this->fld_req_party])
            ->andFilterWhere(['like', 'fld_address', $this->fld_address])
            ->andFilterWhere(['like', 'fld_contactno', $this->fld_contactno])
            ->andFilterWhere(['like', 'fld_purpose', $this->fld_purpose])
            ->andFilterWhere(['like', 'fld_office', $this->fld_office])
            ->andFilterWhere(['like', 'fld_text_ext', $this->fld_text_ext])
            ->andFilterWhere(['like', 'fld_encoder', $this->fld_encoder])
            ->andFilterWhere(['like', 'fld_req_empid', $this->fld_req_empid])
            ->andFilterWhere(['like', 'fld_eva_empid', $this->fld_eva_empid])
            ->andFilterWhere(['like', 'fld_pri_empid', $this->fld_pri_empid])
            ->andFilterWhere(['like', 'fld_rel_empid', $this->fld_rel_empid])
            ->andFilterWhere(['like', 'fld_orno', $this->fld_orno])
            ->andFilterWhere(['like', 'fld_signatory', $this->fld_signatory])
            ->andFilterWhere(['like', 'fld_printed_by', $this->fld_printed_by]);

        return $dataProvider;
    }
}
