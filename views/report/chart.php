<?php

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

//echo $category;

echo Highcharts::widget([
    'scripts' => [
//'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'credits' => ['enabled' => false],
        'title' => [
            'text' => "$title",
        ],
        'xAxis' => [
            'categories' => $category,
        ],
        'labels' => [
            'items' => [
                [
                    'html' => $labels,
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        /*
         * yAxis: {
          min: 0,
          title: {
          text: 'จำนวน (คน)'
          }
          },
          legend: {
          enabled: false
          },

         */
        'yAxis' => [
            'min' => 0,
            'title' => [
                'text' => 'จำนวน(บาท)'
            ],
            'legend' => [
                'enabled' => false
            ],
            'labels' => [
                'formatter' => new JsExpression('function(){ return this.value; }')
            ]
        ],
        'series' => [
            [
                'type' => 'column',
                'name' => 'รายรับ',
                'data' => $val_income,
            ],
            [
                'type' => 'column',
                'name' => 'รายจ่าย',
                'data' => $val_outcome,
            ],
            [
                'type' => 'pie',
                'name' => 'รวม',
                'data' => [
                    [
                        'name' => 'รายรับ',
                        'y' => $sumIncome,
                        'color' => new JsExpression('Highcharts.getOptions().colors[0]'), // Jane's color
                    ],
                    [
                        'name' => 'รายจ่าย',
                        'y' => $sumOutcome,
                        'color' => new JsExpression('Highcharts.getOptions().colors[1]'), // John's color
                    ],
                ],
                'center' => [100, 80],
                'size' => 100,
                'showInLegend' => false,
                'dataLabels' => [
                    'enabled' => false,
                ],
            ],
        ],
    ]
]);
