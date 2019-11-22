<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$formatter = \Yii::$app->formatter;
?>

<body>
<div class="btn-group " style="float:right;right:5%;">
  <button type="button" data-toggle="dropdown" class="btn  btn-primary btn-lg dropdown-toggle">Портфолио<span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="diplom">Дипломы</a></li>
      <li><a href="kurs">Курсы</a></li>
      <li><a href="project">Проекты</a></li>
   </ul>
</div>
<p><b>Последние добавления:</b></p>
<table class="table table-condensed">
  <thead>
  <tr>
      <th>Заголовок</th>
      <th>Описание</th>
      <th>Cсылка</th>
      <th>Фото</th>
      <th>Категория</th>
      <th>Дата добавления</th>
</tr>
    </thead>
  <tbody>
<?php foreach ($model as $port):
?> <tr>
      <td><?=$port->heading?></td>
      <td><?=$port->description?></td>
      <td><?=$port->link?></td>
      <td><?=$port->image?></td>
      <td><?=$port->type->type?></td>
      <td><?php
      Yii::$app->formatter->locale = 'ru-RU';
      echo Yii::$app->formatter->asDatetime($port->date, 'medium')
 ?></td>
</tr> 

  <?php
endforeach;
?>
<?php
    echo Html::tag("a", "Добавить", ["class"=>"btn btn-primary","href"=>Url::toRoute('portfolio/create')]);
?>
</tbody>

</table>
</body>
</html>
<?php
echo LinkPager::widget([
    'pagination' => $pages,
    'linkContainerOptions'=>['class'=>'page-item'],
    'linkOptions'=>['class'=>'page-link'],
    'disabledPageCssClass'=>'page-link disabled',
]);
?>