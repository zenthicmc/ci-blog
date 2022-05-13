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
   <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css">
   <title><?= $appName; ?> | Search</title>
</head>
<body>
<?= $this->include('layout/header'); ?>
   <?php 
      use \App\Models\ArticleModel;
      $this->articleModel = new ArticleModel();
   ?>
   <?php if(session()->getFlashdata('msg')) : ?>
      <script>
         const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: false,
            didOpen: (toast) => {
               toast.addEventListener('mouseenter', Swal.stopTimer)
               toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
         })

         Toast.fire({
            icon: 'success',
            title: '<?= session()->getFlashdata('msg'); ?>'
         })
      </script>
   <?php elseif(session()->getFlashdata('error')) : ?>
      <script>
         const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: false,
            didOpen: (toast) => {
               toast.addEventListener('mouseenter', Swal.stopTimer)
               toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
         })

         Toast.fire({
            icon: 'error',
            title: '<?= session()->getFlashdata('error'); ?>'
         })
      </script>
   <?php endif; ?>
   <div class="container animate__animated animate__fadeIn">
      <div class="container">
         <div class="row row-cols-1 row-cols-md-3 g-4" style="margin-top: 80px;">
         <?php if(!empty($user)): ?>
            <div class="col-lg-8 m-auto rounded d-flex" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
               <div class="col-lg-5 p-4">
                  <img class="img-fluid rounded-circle border border-2" style="min-width: 100%;" src="/img/user-images/<?= strip_tags($user['image']) ?>">
               </div>
               <div class="col-lg-7 ps-5" style="padding-top: 5%;">
                  <h4><span class="badge <?= $user['role'] == 'admin' ? 'b-danger' : 'b-primary' ?>"><?= ucwords($user['role']) ?></span></h4>
                  <h3 class="pt-1"><?= strip_tags($user['username']) ?></h3>
                  <h5 class="t-black"><?= strip_tags(ucwords($user['firstname'])) ?>&nbsp;<?= strip_tags(ucwords($user['lastname'])) ?></h5>
                  <div class="row mt-4">
                     <div class="col-lg-3">
                        <h6 class="t-black"><bold class="fw-bold"><?= $count_articles ?></bold>&nbsp;&nbsp;Articles</h6>
                     </div>
                     <div class="col-lg-3">
                        <h6 class="t-black"><bold class="fw-bold"><?= $count_followers ?></bold>&nbsp;&nbsp;Followers</h6>
                     </div>
                     <div class="col-lg-3">
                        <h6 class="t-black"><bold class="fw-bold"><?= $count_likes ?></bold>&nbsp;&nbsp;Likes</h6>
                     </div>
                  </div>
                  <form method="post" action="/followsave/<?= $user['id'] ?>">
                     <?= csrf_field() ?>
                     <?php if($data_following == 'Not logged in') :?>
                        <a href="#" class="btn w-75 mt-4 text-white mb-5" style="background: #7e56da;border-style: none;">Login to follow</a>
                     <?php elseif($data_following == 'true'): ?>
                        <button type="submit" class="btn w-75 mt-4 text-white mb-5" style="background: #7e56da;border-style: none;">Unfollow</button>
                     <?php elseif($data_following == 'false'): ?>
                        <button type="submit" class="btn w-75 mt-4 text-white mb-5" style="background: #7e56da;border-style: none;">Follow</button>
                     <?php endif; ?>
                  </form>
               </div>
            </div>
         <?php else: ?>
            <div class="container" style="min-height: 100vh;">
               <div class="col-lg-12 mt-5">
                  <h1 class="t-black text-center">User Not Found</h1>
                  <img src="/img/404.svg" style="max-height: 300px;">
               </div>
            </div>
         <?php endif; ?>
         </div>
         <?php if(!empty($user)): ?>
            <h2 class="text-center fw-bold t-primary" style="margin-top: 8%;"><?= strtoupper($user['username']) ?>'S RECENT ARTICLES</h3>
            <p class="text-center t-secondary">Showing recently updated articles</p>
         <?php endif; ?>
         <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
         <?php if(!empty($user)): ?>
            <?php if(!empty($articles)): ?>
               <?php foreach ($articles as $article): ?>
               <div class="col mt-5">
                  <div class="card2" onclick="location.href='<?= base_url(); ?>/view/<?= $article->slug ?>';">
                     <img src="/img/article-images/<?= $article->cover ?>" alt="<?= $article->cover ?>" class="card-img-top">
                     <div class="card-body">
                        <div class="desc d-flex">
                           <p class="<?= $article->class ?> text-light"><?= strtoupper($article->category); ?></p>
                           <span class="card-dot t-secondary">&#9679;</span>
                           <p class="card-time t-black"><?= $this->articleModel->time_elapsed_string($article->updated_at) ?></p>
                        </div>
                        <h3 class="t-black"><?= strip_tags(substr($article->title, 0, 49) . '...'); ?></h3>
                        <p class="card-text t-secondary"><?= strip_tags(substr($article->content, 0, 100)) . '...'; ?></p>
                        <p class="t-black">Posted by <a href="/user/<?= $article->author ?>" class="text-decoration-none t-black"><?= $article->author ?></a></p>
                     </div>
                  </div>
               </div>
               <?php endforeach; ?>
            <?php else: ?>
               <div class="container">
                  <div class="col-lg-12">
                     <h3 class="t-black mt-4 text-center">This user doesn't have any articles yet</h3>
                  </div>
               </div>
            <?php endif; ?>
         <?php endif; ?>
         </div>
      </div>
   </div>

<?= $this->include('layout/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/b632dc8495.js" crossorigin="anonymous"></script>
</body>
</html>