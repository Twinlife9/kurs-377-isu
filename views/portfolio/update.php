<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Type;
use app\models\User;
use yii\helpers\ArrayHelper;

?>
<div class="col-lg-6 col-sm-12">


<h1>Создание</h1>

<?php  $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); 
 ?>

<?= $form->field($model, 'heading')?>
<?= $form->field($model, 'description')?>
<?= $form->field($model, 'link')?>
<?= $form->field($model, 'imageFile')->fileInput() ?>

<?php
 $type = Type::find()->all();
$items = ArrayHelper::map($type,'id','type');
    $params = [
        'prompt' => 'Укажите тип'
    ];
    echo $form->field($model, 'id_type')->dropDownList($items,$params)->label('Тип данных');


?>




<?= Html::submitButton('Добавить', ['class'=> "btn btn-primary"]) ?>


<?php ActiveForm::end() ?>
</div>