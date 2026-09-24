<div class="container-fluid  my-5 " style="display:flex">
  <div class="row flex-lg-row-reverse align-items-center g-5 py-3 ">
    <div class="col-10 col-sm-8 col-lg-6 ">
      <img src="http://localhost/uploads/6.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width=100% loading="lazy">
    </div>
    <div class="col-lg-6">
      <p>Welcome </p>
      <h2 class=" fw-bold text-body-emphasis lh-1 mb-3 blue">
        <?php echo htmlspecialchars($data->first_name) ?? ""; ?>
      </h2>
      <span>to</span>
      <h2 class=" display-5 fw-bold text-body-emphasis lh-1 mb-3 blue"> Elzikrayat Gallery</h2>
      <p class="lead" me-5>where memories take place<br>
        making you diving deep in the past ...<br>
        waking you up for making more.</p>
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
      </div>
    </div>
  </div>
</div>