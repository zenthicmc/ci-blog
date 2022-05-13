<div class="header-img">
   <nav class="navbar navbar-light navbar-expand-lg p-3" id="mainNav">
      <div class="container">
         <a class="navbar-brand brand text-light" href="/"><h4><?= env('APP_NAME') ?></h4></a>
         <button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler border-0 text-white navbar-toggler-right text-uppercase rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>

         <div class="collapse navbar-collapse" id="navbarResponsive">
            <div class="col-9">
               <ul class="navbar-nav ms-auto">
                  <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded text-light" href="">Home</a></li>
                  <li class="nav-item dropdown mx-0 mx-lg-1">
                     <a class="nav-link dropdown-toggle py-3 px-0 px-lg-3 rounded text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Blog</a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/dash/articles/new">Create article</a></li>
                        <li><a class="dropdown-item" href="/search">See all articles</a></li>
                     </ul>
                  </li>
                  <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded text-light" href="#contact">Contact</a></li>
                  <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded text-light" href="#about">About</a></li>
               </ul>
            </div>
            <div class="col-3">
               <div class="text-end">
                  <?php if(!session()->has('id')) : ?>
                     <a href="/auth/login" class="btn btn-light text-default">Login</a>
                     <a href="/auth/register" class="btn button text-light">Sign up</a>
                  <?php else: ?>
                     <a href="/dash/" class="btn btn-light text-default">Dash</a>
                     <a href="/auth/logout" class="btn button text-light">Logout</a>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </nav>

   <div class="header-content">
      <div class="col-12 d-flex justify-content-center p-5">
         <div class="col-4">
            <h1 class="text-white fw-bold header-text" id="banner-title">Create your article now!</h1>
            <p class="text-white header-text-secondary mt-3" id="banner-desc">Start earning readers at anytime</p>
            <a class="btn btn-light bg-light button mt-3" id="banner-button" style="color: #7E56DA;" href="/dash">Start Now</a>
         </div>
         <div class="col-3 investment">
            <img src="/img/invesment.png" class="img-invesment animate__animated animate__fadeInRight">
         </div>
      </div>
   </div>

   <div class="header-search animate__animated animate__fadeInUp">
      <div class="search-form col-12">
         <form class="form d-flex" action="<?= base_url(); ?>/search" method="GET">
            <div class="col-11 form-group">
               <input type="text" class="form-control form-input" id="search" name="keyword" placeholder="Search for articles title..." style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;" required>
            </div>
            <button type="submit" class="btn text-light button" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;width: 50px;">
               <i class="fa fa-search"></i>
            </button>
         </form>
      </div>
   </div>
</div>