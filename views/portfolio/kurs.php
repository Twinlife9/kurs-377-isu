<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="btn-group " style="float:right;right:5%;">
  <button type="button" data-toggle="dropdown" class="btn  btn-primary btn-lg dropdown-toggle">Перейти в...</button>
    <ul class="dropdown-menu">
    <li><a href="index?id=">Портфолио</a></li>
      <li><a href="diplom">Дипломы</a></li>
      <li><a href="project">Проекты</a></li>
   </ul>
</div>
<h3>Курсы</h3>
<div class="conteiner">
    <?php foreach ($model as $port):
?>
    <div class="row">
      <div class="col">
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">
              <?=$port->heading?>
            </h4>
          </div>
          <div class="box-body">
            <h5>
              <?=$port->description?>
            </h5>
            <?php
                echo Html::tag("a", "Редактировать", ["class"=>"btn btn-primary","href"=>Url::toRoute('portfolio/update?id=') . $port->id]);
            ?>
              <!-- Trigger the Modal -->
              <img id="myImg<?=$port->id?>" src="/web/<?=$port->image?>"  alt="Snow" style="width:100%;max-width:200px">

              <!-- The Modal -->
              <div id="myModal<?=$port->id?>" class="modal">

                <!-- The Close Button -->
                <span class="close" onclick="closeimage();">&times;</span>

                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="img01<?=$port->id?>">

                <!-- Modal Caption (Image Text) -->
                <div id="caption<?=$port->id?>"></div>
              </div>
          </div>
          <script>
            // Get the modal
            var modal = document.getElementById("myModal<?=$port->id?>");

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById("myImg<?=$port->id?>");
            var modalImg = document.getElementById("img01<?=$port->id?>");
            var captionText = document.getElementById("caption<?=$port->id?>");
            img.onclick = function () {
              modal.style.display = "block";
              modalImg.src = this.src;
              captionText.innerHTML = this.alt;
            }

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
           function closeimage() {
              modal.style.display = "none";
            }</script>
          <!-- <div class="image">
        </div> -->
          <br>

        </div>
      </div>
    </div>
    <!-- <div class="line_block"

</div> -->
    <?php
endforeach;
?>
  </div>
  <?php
echo LinkPager::widget([
    'pagination' => $pages,
    'linkContainerOptions'=>['class'=>'page-item'],
    'linkOptions'=>['class'=>'page-link'],
    'disabledPageCssClass'=>'page-link disabled',
]);
?>