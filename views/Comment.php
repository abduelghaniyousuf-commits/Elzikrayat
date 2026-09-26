<?php

class Comment
{
  static $data;


  function index()
  {
    $data = $this->data;
?>
    <div class="container-fluid comment-container " style="display: flex; flex-direction:column ;justify-items:center; align-items:center">
      <?php
      if ($data) {
        foreach ($data as $comment):
          
      ?>
          <p style="text-align: left;" class="mx-2 px2 my-3">
            <?php echo htmlspecialchars($comment->comment); ?>
          </p>


      <?php



        endforeach;
      }
      ?>
    </div>

<?php
  }
}
