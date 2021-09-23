<?php

use kartik\grid\GridView;
use kartik\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Libro */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Libros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<p><?= Html::a('Update',['update','id' => $model->id],['class'=>'btn btn-primary']) ?>
   <?= Html::a('Delete',['delete','id' => $model->id],[
    'class'=>'btn btn-danger',
    'data'=>[
    'confirm' => 'Esta seguro que desea borrar este item?',
    'method' => 'post',
    ],
    ]) ?>
</p>

<?php

echo DetailView::widget([
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            'heading'=>'Libro #' . $model->id,
            'type' => DetailView::TYPE_INFO
        ],

        'attributes'=>[
            'id',
            'titulo',
            'autor',
            ['attribute'=>'anio_publicacion','type'=>DetailView::INPUT_DATE],
            'disponible:boolean',   

        ]
        
        ]);       
?>


</div>
