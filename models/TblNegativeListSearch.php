<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblNegativeList;

/**
 * TblNegativeListSearch represents the model behind the search form about `\app\models\TblNegativeList`.
 */
class TblNegativeListSearch extends TblNegativeList
{

    public $viewFlag;
    public $companyDetails;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fld_neg_id', 'fld_cleared'], 'integer'],
            [['fld_sec_reg_no_fk', 'fld_status_code_fk', 'fld_remarks', 'fld_neg_date', 'fld_date_cleared', 'fld_source_office', 'fld_source_specialist','viewFlag','companyDetails'], 'safe'],
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
    public function search($params, $regno = null)
    {
        $query = TblNegativeList::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['fld_neg_date'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'fld_neg_id' => $this->fld_neg_id,
            'fld_cleared' => $this->fld_cleared,
            'fld_neg_date' => $this->fld_neg_date,
            'fld_date_cleared' => $this->fld_date_cleared,
        ]);

        if($this->viewFlag == 0)
        {
            $query->andFilterWhere(['like', 'fld_source_specialist', Yii::$app->user->identity->empid]);
        }

        $query->andFilterWhere(['like', 'fld_sec_reg_no_fk', $regno])
            ->andFilterWhere(['like', 'fld_status_code_fk', $this->fld_status_code_fk])
            ->andFilterWhere(['like', 'fld_remarks', $this->fld_remarks])
            ->andFilterWhere(['like', 'fld_source_office', $this->fld_source_office])
            ->andFilterWhere(['like', 'fld_source_specialist', $this->fld_source_specialist]);

        return $dataProvider;
    }

    public function searchByRecord($params, $regno = null)
    {
        $query = TblNegativeList::find();
        $query->joinWith(['companyDetails']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['fld_neg_date'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $dataProvider->sort->attributes['companyDetails'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['tbl_company.fld_sec_reg_name' => SORT_ASC],
            'desc' => ['tbl_company.fld_sec_reg_name' => SORT_DESC],
        ];
        // echo $this->fld_neg_date;exit;
        $query->andFilterWhere([
            'fld_neg_id' => $this->fld_neg_id,
            'fld_cleared' => $this->fld_cleared,
          //  'fld_neg_date' => $this->fld_neg_date,
            'fld_date_cleared' => $this->fld_date_cleared,
        ]);

        if($this->fld_cleared == "")
        {
            $query->andFilterWhere(['like', 'fld_cleared', 0]);
        }

        if(Yii::$app->user->can('Specialist'))
        {
            $query->andFilterWhere(['like', 'fld_source_specialist', Yii::$app->user->identity->empid]);
        }

        if(Yii::$app->user->can('Supervisor'))
        {
            $query->andFilterWhere(['like', 'fld_source_office', '010501%', false]);
        }

        $query->andFilterWhere(['like', 'fld_sec_reg_no_fk', $regno])
            ->andFilterWhere(['like', 'fld_status_code_fk', $this->fld_status_code_fk, false])
            ->andFilterWhere(['like', 'fld_remarks', $this->fld_remarks])
            ->andFilterWhere(['like', 'fld_source_office', $this->fld_source_office])
            ->andFilterWhere(['like', 'fld_source_specialist', $this->fld_source_specialist])
            ->andFilterWhere(['like', 'fld_neg_date', $this->fld_neg_date])
            ->andFilterWhere(['like', 'tbl_company.fld_sec_reg_name', $this->companyDetails]);

           // echo $this->fld_source_specialist;exit;

        return $dataProvider;
    }

    public function searchByOffice($params, $regno = null)
    {
        $query = TblNegativeList::find();
        $query->joinWith(['companyDetails']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['fld_neg_date'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'fld_neg_id' => $this->fld_neg_id,
            'fld_cleared' => $this->fld_cleared,
            'fld_neg_date' => $this->fld_neg_date,
            'fld_date_cleared' => $this->fld_date_cleared,
            // 'fld_source_office'=>Yii::$app->user->identity->office_id,
        ]);


        $query->andFilterWhere(['like', 'fld_sec_reg_no_fk', $regno])
            ->andFilterWhere(['like', 'fld_status_code_fk', $this->fld_status_code_fk])
            ->andFilterWhere(['like', 'fld_remarks', $this->fld_remarks])
            // ->andFilterWhere(['like', 'fld_source_office', $this->fld_source_office])
            ->andFilterWhere(['like', 'fld_source_specialist', '|'.Yii::$app->user->identity->empid.'|',false])
            ->andFilterWhere(['like', 'tbl_company.fld_sec_reg_name', $this->companyDetails]);

        return $dataProvider;
    }

}
