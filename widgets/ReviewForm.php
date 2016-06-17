<?php
namespace pistol88\review\widgets;

use yii\helpers\Html;
use yii\helpers\Url;
use pistol88\review\models\Review;
use yii;

class ReviewForm extends \yii\base\Widget
{
	public $model = null;
    public $votes = [];
    public $defaultVote = 10;

	public function init()
	{
        if(empty($this->votes)) {
            $this->votes = [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10' => '10',
            ];
        }
        
		\pistol88\review\assets\Asset::register($this->getView());
	}

	public function run()
	{
        $reviewModel = new Review(['vote' => $this->defaultVote]);
        
		return $this->render('reviewForm',
            [
                'reviewModel' => $reviewModel,
                'model' => $this->model,
                'votes' => $this->votes
            ]
        );
	}
}