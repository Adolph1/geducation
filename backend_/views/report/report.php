<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ExpenditureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Expenditures list');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $gridColumns=[
        ['class' => 'kartik\grid\SerialColumn'],

        //'id',
        [
            'attribute'=>'exp_dt',
            'pageSummary'=>'Total',
        ],
        [
                'attribute'=>'amount',
            'format'=>['decimal', 2],
                'pageSummary'=>true,
                'footer'=>true
        ],
        [
            'attribute'=>'type',
            'value'=>'expType.type',
        ],
        'description',
        [
            'attribute'=>'payment_method',
            'value'=>function($model){

                if($model->payment_method==null){

                    return "";
                }
                elseif($model->payment_method!=null){

                    return $model->payment->method_name;

                }

            }
        ],
        [
            'attribute'=>'fund_source',
            'value'=>function($model){
                if($model->fund_source=='I'){
                    return 'Within budget';
                }
                elseif($model->fund_source=='O'){

                    return 'Out of budget';

                }
            }
        ],
        'reference_no',
        'maker_id',
        'maker_time',
        'checker',
        'checker_time'


    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' =>$gridColumns,
        'showPageSummary'=>true,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],


    ]); ?>
</div>
