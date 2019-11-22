<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="btn-group " style="float:right;right:5%;">
  <button type="button" data-toggle="dropdown" class="btn  btn-primary btn-lg dropdown-toggle">Перейти в...</button>
    <ul class="dropdown-menu">
    <li><a href="index?id=">Портфолио</a></li>
      <li><a href="kurs">Курсы</a></li>
      <li><a href="project">Проекты</a></li>
   </ul>
</div>
<h3>Мои проекты</h3>


<div class="conteiner">
<?php foreach ($model as $port):
?>
<div class="line_block"
<h4><b><?=$port->heading?></b></h4>
<h5><?=$port->description?></h5>
<a href="<?=$port->link?>" class="stretched-link">Ссылка на проект</a>
<br><?php
    echo Html::tag("a", "Редактировать", ["class"=>"btn btn-primary","href"=>Url::toRoute('portfolio/update?id=') . $port->id]);
?>
</div>
  <?php
endforeach;
?>
<div>