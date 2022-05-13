<nav class="navbar navbar-light b2-primary navbar-expand-lg p-3" id="mainNav">
   <div class="container">
      <a class="navbar-brand brand text-light" href="/"><h4><?= env('APP_NAME') ?></h4></a>
      <button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler border-0 text-white navbar-toggler-right text-uppercase rounded" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
         <div class="col-9">
            <ul class="navbar-nav ms-auto">
               <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded text-light" href="/">Home</a></li>
               <li class="nav-item dropdown mx-0 mx-lg-1">
                  <a class="nav-link dropdown-toggle py-3 px-0 px-lg-3 rounded text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Blog</a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <li><a class="dropdown-item" href="/dash/articles/new">Create article</a></li>
                     <li><a class="dropdown-item" href="/search">See all articles</a></li>
                  </ul>
               </li>
               <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded text-light" href="/#contact">Contact</a></li>
               <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded text-light" href="/#about">About</a></li>
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
   