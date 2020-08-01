<?php

namespace ignatenkovnikita\vkmarket\backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ignatenkovnikita\vkmarket\models\VkmarketAlbum;

/**
 * AlbumSearch represents the model behind the search form about `ignatenkovnikita\vkmarket\models\VkmarketAlbum`.
 */
class AlbumSearch extends VkmarketAlbum
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vk_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title', 'main_album'], 'safe'],
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
        $query = VkmarketAlbum::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'vk_id' => $this->vk_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'main_album', $this->main_album]);

        return $dataProvider;
    }
}
