<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

/* @var $model app\models\AffiliatedTruck */

$this->title = 'เพิ่มข้อมูลรถ';
$this->params['breadcrumbs'][] = ['label' => 'รถบรรทุก', 'url' => ['affiliated/view', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border"><?php echo Html::encode($this->title) ?></div>
    <div class="box-body">
    	<?php echo $this->render('_form', ['model' => $model, 'company_id' => $company_id, ]) ?>
    </div>
</div>
