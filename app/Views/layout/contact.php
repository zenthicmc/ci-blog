<?php if(session()->getFlashdata('msg')) : ?>
   <script>
   Swal.fire(
      'Success!',
      '<?= session()->getFlashdata('msg'); ?>',
      'success'
   )
   </script>
<?php endif; ?>
<div class="contact" style="display: flex;justify-content: center;margin-top: 10%;">
   <div class="col-4" data-aos="fade-right" data-aos-duration="900">
      <div class="title-contact">
         <h1 class="fw-bold t-primary">CONTACT US</h1>
         <p class="t-secondary">We are here for you!, How can we help you?</p>
      </div>
      <form method="post" action="/contact/save">
         <div class="mb-3">
            <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid': '';  ?>" style="color: #555555;font-size: 14px;height: 40px;" id="email" name="email" placeholder="Enter your email address" aria-describedby="emailHelp" autocomplete="off" value="<?= old('email') ?>" required>
            <div class="invalid-feedback">
               <?= $validation->getError('email') ?>
            </div>
         </div>
         <div class="mb-3">
            <textarea class="form-control form-control2 <?= ($validation->hasError('body')) ? 'is-invalid': '';  ?>" name="body" id="details" style="height:150px;color: #555555;font-size: 14px" placeholder="Go ahead we are listening..." autocomplete="off" value="<?= old('body') ?>" required></textarea>
            <div class="invalid-feedback">
               <?= $validation->getError('body') ?>
            </div>
         </div>
         <button type="submit" class="btn b-primary text-white">Send</button>
       </form>
   </div>
   <div class="col-5" data-aos="fade-left" data-aos-duration="900">
      <img src="/img/contact.svg" class="img-contact">
   </div>
</div>
   