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
   <link rel="stylesheet" href="<?= base_url(); ?>/css/auth.css">
   <title>MY BLOG | Login</title>
</head>
<body>
   <div class="d-flex">
      <div class="box1">
         <div class="container">
            <h2 class="fw-bold t-primary">Login</h2>
            <form class="mt-5" action="/auth/login/check" method="post">
               <?= csrf_field() ?>
               <?php if(session()->getFlashdata('msg')) : ?>
                  <div class="alert alert-success mt-2" role="alert">
                     <?= session()->getFlashdata('msg'); ?>
                  </div>
               <?php endif; ?>
               <?php if(session()->getFlashdata('error')) : ?>
                  <div class="alert alert-danger mt-2" role="alert">
                     <?= session()->getFlashdata('error'); ?>
                  </div>
               <?php endif; ?>
               <div class="col-12 mb-3">
                  <input type="text" class="form-control text-secondary" id="username" name="username" placeholder="Username" style="height: 50px;" required autocomplete="off" value="<?= old('username') ?>">
               </div>
               <div class="col-12 mb-2">
                  <input type="password" class="form-control text-secondary" id="password" name="password" placeholder="Password" style="height: 50px;" required autocomplete="off" value="<?= old('password') ?>">
               </div>
               <div class="col-12 message text-center mb-3 text-danger"></div>
               <div class="col-12 mb-2">
                  <button type="submit" class="btn b-primary text-white btn-block" style="width: 100%;height: 40px;">Login</button>
               </div>
               <div class="col-12 mt-2 d-flex justify-content-center">
                  <p class="text-secondary">Not yet registered?</p><a class="t-primary text-decoration-none" href="/auth/register">&nbsp;Sign up</a></p>
               </div>
            </form>
         </div>
      </div>
      <div class="box2 b-primary">
         <div class="container d-flex justify-content-between p-5">
            <div class="col-7 p-5">
               <h3 class="text-light fw-bold">Please login using your account credentials</h3>
               <p class="text-light mt-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
            </div>
            <div class="col-5">
               <img src="/img/auth.png" class="bg-ilus">
            </div>
         </div>
      </div>
   </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/b632dc8495.js" crossorigin="anonymous"></script>
</body>
<script>
   const password = document.querySelector('#password');
   const message = document.querySelector('.message');

   password.addEventListener('keyup', function (e) {
      if (e.getModifierState('CapsLock')) {
         message.textContent = 'Caps lock is on';
      } else {
         message.textContent = '';
      }
   });

</script>
</html>