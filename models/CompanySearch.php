<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Company;

/**
 * CompanySearch represents the model behind the search form about `\app\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fld_id'], 'integer'],
            [['fld_sec_reg_no', 'fld_sec_reg_name', 'fld_orig_sec_reg_name', 'fld_primary_license', 'fld_secondary_license', 'fld_office_code_fk', 'fld_emp_id', 'fld_entity_code_fk'], 'safe'],
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
    public function search($params, $char, $ent)
    {
        $query = Company::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'fld_id' => $this->fld_id,
        ]);

        // foreach($assignment as $row){
        //     $query->orFilterWhere(['like', 'fld_sec_reg_name', $row->char_assignment.'%', false,])
        //         ->orFilterWhere(['like','fld_secondary_license', $row->ent_id]);
        // }

        // foreach($assignment_range as $row){
        //     $query->orFilterWhere(['REGEXP', 'fld_sec_reg_name', '^['.$row->char_assignment.']'])
        //         ->orFilterWhere(['like','fld_secondary_license', $row->ent_id]);
        // }
        if($char == '#'){
            $query->andFilterWhere(['regexp', 'fld_sec_reg_name', '^[0-9\'\"]']);
        }else{
            $query->andFilterWhere(['like', 'fld_sec_reg_name', $char.'%', false,]);
        }
     
              

        $query->andFilterWhere(['like', 'fld_sec_reg_no', $this->fld_sec_reg_no])
            ->andFilterWhere(['like', 'fld_sec_reg_name', $this->fld_sec_reg_name])
            ->andFilterWhere(['like', 'fld_orig_sec_reg_name', $this->fld_orig_sec_reg_name])
            ->andFilterWhere(['like', 'fld_primary_license', $this->fld_primary_license])
            ->andFilterWhere(['like', 'fld_secondary_license',  $ent])
            ->andFilterWhere(['like', 'fld_office_code_fk', $this->fld_office_code_fk])
            ->andFilterWhere(['like', 'fld_emp_id', $this->fld_emp_id])
            ->andFilterWhere(['like', 'fld_entity_code_fk', $this->fld_entity_code_fk]);

        return $dataProvider;
    }

    public function searchEncoder($params)
    {
        $query = Company::find();

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
            'fld_id' => $this->fld_id,
        ]);

        // foreach($assignment as $row){
        //     $query->orFilterWhere(['like', 'fld_sec_reg_name', $row->char_assignment.'%', false,])
        //         ->orFilterWhere(['like','fld_secondary_license', $row->ent_id]);
        // }

        // foreach($assignment_range as $row){
        //     $query->orFilterWhere(['REGEXP', 'fld_sec_reg_name', '^['.$row->char_assignment.']'])
        //         ->orFilterWhere(['like','fld_secondary_license', $row->ent_id]);
        // }
    

        $query->andFilterWhere(['like', 'fld_sec_reg_no', $this->fld_sec_reg_no])
            ->andFilterWhere(['like', 'fld_sec_reg_name', $this->fld_sec_reg_name])
            ->andFilterWhere(['like', 'fld_orig_sec_reg_name', $this->fld_orig_sec_reg_name])
            ->andFilterWhere(['like', 'fld_primary_license', $this->fld_primary_license])
            ->andFilterWhere(['like', 'fld_secondary_license',  $this->fld_secondary_license])
            ->andFilterWhere(['like', 'fld_office_code_fk', $this->fld_office_code_fk])
            ->andFilterWhere(['like', 'fld_emp_id', $this->fld_emp_id])
            ->andFilterWhere(['like', 'fld_entity_code_fk', $this->fld_entity_code_fk]);

        return $dataProvider;
    }

}
