<?php
class PhotoView
{
  public $data;
  public function __construct($data)
  {
    $this->data = $data;
  }

  public function viewAll()
  {

    if ($this->data && count($this->data) >= 1) {


      if (isset($photo->message)) {
        echo $photo->message;
        return;
      }





?>
      <!-- fllex container wirh  -->
      <div class="container-lg col-lg-12 col-sm-8" id="gallery" style="display: flex; flex-direction:column ;gap:3rem">
        <!-- lay out icons -->
        <div class="layout-buttons" style="align-self: flex-end; ">
          <ul class="layout-icons" style="display: flex;
              flex-direction: row;
              gap:1rem;
              list-style: none;">
            <li> <input class="btn-primary" id="card-layout" type="button" value="Card List" placeholder="Card List"></li>
            <li id="3-layout"> 3 columns</li>
            <li id="2-layout"> 2 columns</li>
            <li id="slider-layout"> carousel slider</li>
          </ul>
        </div>

        <!-- grid container -->

        <div id="grid-container" class="container-fluid col-lg-11 col-sm-8 mb-3" style="display: grid; grid-template-columns:repeat(3,1fr);gap:1rem">
          <!-- card1 -->
          <?php
          function generateCards($data)
          {
            foreach ($data as $photo) {

              echo "<div id=\"card" . $photo->id . "\" class=\"card\" style=\"width: 18rem;\"><img src=\"http://localhost/uploads/" . $photo->filename . ".jpg\" class=\"card-img-top\" alt=" . htmlspecialchars($photo->filename) . "\"
           <div class=\"card-body\">
                 <h5 class=\"card-title ps-1\"  >" . htmlspecialchars($photo->title) . "</h5>
                 <p class=\"card-text ps-1\">" . htmlspecialchars($photo->description) . "</p>
                 <small class\" py-3\" style=\"text-align: right \" >" . htmlspecialchars($photo->date_time) . "</small>
                 <a href=\"#\" class=\"btn btn-primary mb-1\">View</a>
               
             </div>";
            }
          }
          generateCards($this->data);
          ?>

        </div>

      </div>

<?php


      // generateCards($this->data);
      // var_dump($this->data);
      // foreach ($this->data as $photo) {


      //   echo ($photo->id) . "<br>";
      //   echo ($photo->title) . "<br>";
      //   echo ($photo->description) . "<br>";
      //   echo ($photo->filename) . "<br>";
      //   echo ($photo->date_time) . "<br>";
      //   echo ($photo->student_id) . "<br>";
      // }
      require_once("./views/partials/footer.php");
    } else {

      return;
    }
  }


  public function viewOne()
  {
    var_dump($this->data);
  }
}
?>