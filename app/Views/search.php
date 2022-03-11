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
   <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css">
   <title><?= $appName; ?> | Search</title>
</head>
<body>
<?= $this->include('layout/header'); ?>
   <?php 
      use \App\Models\ArticleModel;
      $this->articleModel = new ArticleModel();
   ?>
   <div class="container animate__animated animate__fadeIn">
      <?php if(!empty($keyword)): ?>
         <h2 class="text-secondary search-title">Search for '<?= $keyword ?>'</h2>
      <?php else: ?>
         <h2 class="text-secondary search-title">Showing all articles</h2>
      <?php endif; ?>
      <hr class="text-secondary search-line">
      <div class="container">
         <div class="row row-cols-1 row-cols-md-3 g-4">
         <?php if(!empty($articles)): ?>
            <?php foreach ($articles as $article): ?>
            <div class="col mt-5">
               <div class="card2" onclick="location.href='<?= base_url(); ?>/view/<?= $article['slug'] ?>';">
                  <img src="/img/article-images/<?= $article['cover'] ?>" alt="<?= $article['cover'] ?>" class="card-img-top">
                  <div class="card-body">
                     <div class="desc d-flex">
                        <p class="<?= $article['class'] ?> text-light"><?= strtoupper($article['category']); ?></p>
                        <span class="card-dot t-secondary">&#9679;</span>
                        <p class="card-time t-black"><?= $this->articleModel->time_elapsed_string($article['updated_at']) ?></p>
                     </div>
                     <h3 class="t-black"><?= substr($article['title'], 0, 49) . '...'; ?></h3>
                     <p class="card-text t-secondary"><?= htmlspecialchars(substr($article['content'], 5, 100)) . '...'; ?></p>
                     <p class="t-black">Posted by <a href="#" class="text-decoration-none t-black"><?= $article['author'] ?></a></p>
                  </div>
               </div>
            </div>
            <?php endforeach; ?>
            <div class="col-lg-12 mt-5">
               <div class="d-flex justify-content-center">
                  <?= $pager->links('article', 'bootstrap_5_full'); ?>
               </div>
            </div>
         <?php else: ?>
            <div class="container" style="min-height: 100vh;">
               <div class="col-lg-12">
                     <h1 class="t-black mb-5 mt-4 text-center">Article Not Found</h1>
                     <img src="/img/404.svg" style="max-height: 300px;">
               </div>
            </div>
         <?php endif; ?>
         </div>
      </div>
   </div>

<?= $this->include('layout/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/b632dc8495.js" crossorigin="anonymous"></script>
</body>
</html>