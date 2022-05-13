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
   <link rel="stylesheet" href="<?= base_url(); ?>/css/view.css">
   <title><?= $appName; ?> | View</title>
</head>
<body>
<?= $this->include('layout/header'); ?>
   <?php 
      use App\Models\ArticleModel;
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
   <?php endif; ?>
   <div class="container post">
      <?php if(empty($articles)): ?>
         <div class="row" style="min-height: 100vh;">
            <div class="col-lg-8 m-auto text-center">
               <h1 class="t-black mb-5">Title Not Found</h1>
               <img src="/img/404.svg" style="max-height: 300px;">
            </div>
         </div>
      <?php endif; ?>
      <?php foreach ($articles as $article) :?>
      <div class="col-8 m-auto">
         <h2 class="text-center t-black animate__animated animate__fadeIn"><?= strip_tags($article->title); ?></h2>
      </div>
      <div class="col-7 m-auto animate__animated animate__fadeIn" style="padding-top: 5%;">
         <div class="d-flex justify-content-between">
            <div class="col-2">
               <p class="text-white <?= $article->class; ?>" style="border-radius: 5px;"><?= strtoupper($article->category); ?></p>
            </div>
            <div class="col-5">
               <p class="t-black" style="float: right;">Posted by <a class="t-black" href="/user/<?= $article->author ?>" style="text-decoration: none;"><?= $article->author ?></a></p>
            </div>
         </div>
         <img class="img-post" src="/img/article-images/<?= $article->cover ?>">
         <div class="col-2 mt-2 like" style="float: left;">
            <p class="t-black text-start" style="font-size: 18px;"><span class="badge bg-success"><i class="fa-solid fa-heart"></i>&nbsp;<?= $count_likes ?> Likes</span></p>
         </div>
         <div class="col-2 mt-2 author" style="float: right;">
            <p class="t-black text-end"><?= $this->articleModel->time_elapsed_string($article->updated_at) ?></p>
         </div>
      </div>
      <div class="col-9 m-auto post-content animate__animated animate__fadeIn">
         <div class="trix-content t-black">
            <?= $article->content ?>
         </div>
         <form method="post" action="/like/<?= $article->id; ?>">
            <?= csrf_field() ?>
            <?php if($data_like == 'Not logged in') :?>
               <a href="#" class="btn w-100 b-primary btn-lg btn-block mt-5 text-white" style="background: #7e56da;border-style: none;font-size: 16px;"><i class="fa-solid fa-heart"></i>&nbsp;Login to like</a>
            <?php elseif($data_like == 'true'): ?>
               <button type="submit" class="btn w-100 b-primary btn-lg btn-block mt-5 text-white" style="background: #7e56da;border-style: none;font-size: 16px;"><i class="fa-solid fa-heart"></i>&nbsp;Unlike</button>
            <?php elseif($data_like == 'false'): ?>
               <button type="submit" class="btn w-100 b-primary btn-lg btn-block mt-5 text-white" style="background: #7e56da;border-style: none;font-size: 16px;"><i class="fa-solid fa-heart"></i>&nbsp;Like</button>
            <?php endif; ?>
         </form>
      </div>
      <?php endforeach; ?>
   </div>

<?= $this->include('layout/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/b632dc8495.js" crossorigin="anonymous"></script>
</body>
</html>