<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css">
   <title><?= $appName; ?> | Home</title>
</head>
<body>
<div class="wrap">
   <?= $this->include('layout/header-home'); ?>
   <?php 
      use \App\Models\ArticleModel;
      $this->articleModel = new ArticleModel();
   ?>
   <div id="blog"></div>
   <div class="container">
      <div class="title">
         <h1 class="text-center fw-bold t-primary">RECENTLY UPDATED</h1>
         <p class="text-center t-secondary">Showing recently updated articles</p>
      </div>
      <div class="cards cards-list1">
         <?php foreach ($two_articles as $articles): ?>
         <div class="card card1" data-aos="flip-left" data-aos-duration="900" onclick="location.href='<?= base_url(); ?>/view/<?= $articles->slug ?>';">
            <div class="row g-0">
            <div class="col-md-4">
               <img src="/img/article-images/<?= $articles->cover ?>" alt="<?= $articles->cover ?>">
            </div>
            <div class="col-md-7">
               <div class="card-body">
                  <div class="desc d-flex">
                     <p class="text-white <?= $articles->class ?>"><?= strtoupper($articles->category); ?></p>
                     <span class="card-dot t-secondary">&#9679;</span>
                     <p class="card-time t-black"><?= $this->articleModel->time_elapsed_string($articles->updated_at) ?></p>
                  </div>
                  <h3 class="t-black"><?= substr($articles->title, 0, 49) . '...'; ?></h3>
                  <p class="card-text t-secondary"><?= htmlspecialchars(substr($articles->content, 5, 95)) . '...'; ?></p>
                  <p class="t-black">Posted by <a href="#" class="text-decoration-none" style="color: #555555;"><?= $articles->author; ?></a></p>
               </div>
            </div>
            </div>
            </a>
         </div>
         <?php endforeach; ?>
      </div>

      <div class="cards cards-list2">
         <?php foreach ($three_articles as $articles): ?>
         <div class="card card2" data-aos="flip-left" data-aos-duration="900" onclick="location.href='<?= base_url(); ?>/view/<?= $articles->slug ?>';">
            <img src="/img/article-images/<?= $articles->cover ?>" alt="<?= $articles->cover ?>" class="card-img-top">
            <div class="card-body">
               <div class="desc d-flex">
                  <p class="text-white <?= $articles->class ?>"><?= strtoupper($articles->category); ?></p>
                  <span class="card-dot t-secondary">&#9679;</span>
                  <p class="card-time t-black"><?= $this->articleModel->time_elapsed_string($articles->updated_at) ?></p>
               </div>
               <h3 class="t-black"><?= substr($articles->title, 0, 49) . '...'; ?></h3>
               <p class="card-text t-secondary"><?= htmlspecialchars(substr($articles->content, 5, 95)) . '...'; ?></p>
               <p class="t-black">Posted by <a href="#" class="text-decoration-none" style="color: #555555;"><?= $articles->author ?></a></p>
            </div>
         </div>
         <?php endforeach; ?>
      </div>

      <div id="contact"></div>
      <?= $this->include('layout/contact'); ?>

      <div id="about"></div>
      <?= $this->include('layout/about'); ?>
   </div>

   <?= $this->include('layout/footer'); ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/TextPlugin.min.js"></script>
<script>
   gsap.registerPlugin(TextPlugin);
   gsap.from("#banner-title", {duration: 1, y: -100, opacity: 0, delay: 0.4});
   gsap.from('#banner-desc', {duration: 3, text: "", delay: 1.3});
   gsap.from('#banner-button', {duration: 2, y: -100, opacity: 0, delay: 4.1});
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/b632dc8495.js" crossorigin="anonymous"></script>
<script>
   AOS.init();
</script>
</body>
</html>
