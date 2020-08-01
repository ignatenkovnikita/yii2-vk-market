<?php
namespace ignatenkovnikita\vkmarket\traits;

trait ProductQuery
{

    public function withText($text)
    {
        return $this
            ->andWhere(['or',
                ['like', 'name', $text],
            ]);

    }

    public function withVkId()
    {
        return $this->andWhere('vk_id is not null');

    }

}