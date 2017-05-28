<?php
/* @var $this yii\web\View */
use backend\models\Branch;
use sjaakp\gcharts\PieChart;

$this->title = 'Gel Expenditure';
?>

<div class="site-index">
    <div class="row">
        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <?= PieChart::widget([
                        'height' => '400px',
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'branch.branch_name:string',
                            'amount:number',


                        ],
                        'options' => [
                            'title' => 'Gel expenditures from '.date('Y').'-'.date('m').'-'.'01'.' To '. date('Y').'-'.date('m').'-'.'31'
                        ],
                    ]) ?>

                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <?= \sjaakp\gcharts\LineChart::widget([
                        'height' => '400px',
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'branch.branch_name:string',
                            'amount:number',


                        ],
                        'options' => [
                            'title' => 'Gel expenditures from '.date('Y').'-'.date('m').'-'.'01'.' To '. date('Y').'-'.date('m').'-'.'31'
                        ],
                    ]) ?>

                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div><!-- ./col -->

    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12"> <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i>Recently posted expenditures</h3>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr style="font-size: large;color: #0a0a0a">
                        <td>Date</td>
                        <td>Maker</td>
                        <td>Amount</td>
                        <td>Description</td>
                        <td>Status</td>
                    </tr>
                    <?php // \backend\models\BookIssued::getLatest();?>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>


</div>
