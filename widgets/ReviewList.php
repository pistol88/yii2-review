<?php
namespace pistol88\review\widgets;

use yii\helpers\Html;
use yii\helpers\Url;
use pistol88\review\models\Review;
use Yii;

class ReviewList extends \yii\base\Widget
{
	public $itemId = null;
	public $limit = 200;

	public function init()
	{
		\pistol88\review\assets\Asset::register($this->getView());
	}

	public function run()
	{
        $list = Review::find()->limit($this->limit)->where(['item_id' => $this->itemId, 'active' => 'yes'])->all();
        
		return $this->render('reviews',[
			'list' => $list,
		]);
	}
}