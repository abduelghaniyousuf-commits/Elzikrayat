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
      <!-- flex container   -->
      <div class="container-lg col-lg-11 col-sm-8" id="gallery" style="display: flex; flex-direction:column ;gap:3rem">
        <!-- lay out icons -->
        <div class="container-fluid layout-buttons" style="align-self: flex-start; justify-self:center ">
          <ul class="layout-icons" style="display: flex;
              flex-direction: row;
              gap:1rem;
              list-style: none;">
            <li> <input class="btn btn-primary" id="card-layout" type="button" onclick="cardsLayout(card-layout)" value="Card List"></li>
            <li> <input class="btn btn-primary" id="c3Grid-layout" type="button" onclick="c3Grid(C3Grid-layout)" value="3C Grid"></li>
            <li> <input class="btn btn-primary" id="c2Grid-layout" type="button" onclick="c2Grid(c2Grid-layout)" value="2C Grid"></li>
            <li> <input class="btn btn-primary" id="carousel-layout" type="button" onclick="carousel(carousel)" value="Slides"></li>

          </ul>
        </div>

        <!-- grid container -->

        <div id="grid-container" class="container-fluid col-lg-11 col-sm-8 mb-3" style="display: grid; grid-template-columns:repeat(3,1fr);gap:1rem">
          <!-- card1 -->
          <?php
          function generateCards($data)
          {
            foreach ($data as $photo) {

              echo "<div id=\"card" . $photo->id . "\" class=\"card\" style=\"width: 18rem;\"><img src=\"http://localhost/uploads/" . htmlspecialchars($photo->filename) . ".jpg\" class=\"card-img-top\" alt=" . htmlspecialchars($photo->filename) . "\"
           <div class=\"card-body\">
                 <h5 class=\"card-title ps-1\"  >" . htmlspecialchars($photo->title) . "</h5>
                 <p class=\"card-text ps-1\">" . htmlspecialchars($photo->description) . "</p>
                 <small class\" py-3\" style=\"text-align: right \" >" . htmlspecialchars($photo->date_time) . "</small>
                 <a href=\"http://localhost/photo/" . htmlspecialchars($photo->id) . "\" class=\"btn btn-primary mb-1\">View</a>
               
             </div>";
            }
          }
          generateCards($this->data);
          ?>

        </div>
        <script>
          function cardsLayout($id) {
            document.getElementById($id);
          }
        </script>

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
    // echo "from here";
    // var_dump($this->data);

    if ($this->data):

      require_once "./views/partials/header.php";
    ?>

      <!-- align items in the middle -->
      <div class="container-fluid py-3" style="display: flex; flex-direction:column;  align-items:center;justify-items:center;">
        <div class=" container-fluid frame-container my-5 ">
          <div class="container-lg mt-3 mx-5" id="frame" style="border: 3px solid black; border-radius: 5px; height:60%vh; width:100%">
            <div id="image-container" class=" container-lg" style="padding-top: 20px;">
              <img id="" src="http://localhost/uploads/<?php echo htmlspecialchars($this->data->filename) ?>.jpg" alt="<?php echo htmlspecialchars($this->data->filename) ?>" width="100%">
            </div>
            <div id="image-details" class="my-3 px-5">
              <p id="title" style="text-align: center ;font-weight:bold;"><?php echo htmlspecialchars($this->data->title) ?></p>
              <p id="description" style="text-align: left;"><?php echo htmlspecialchars($this->data->description) ?></p>
              <p id="time" style="text-align: right;"><small><?php echo htmlspecialchars($this->data->date_time) ?></small></p>
            </div>
          </div>
        </div>
      </div>




<?php
    endif;
  }
}
?>