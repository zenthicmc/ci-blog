<?= $this->extend('dashboard/layout/templates.php') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3 d-lg-flex">
        <div class="col-lg-12">
            <h3 class="mb-4 t-black">Edit Existing Category</h3>
        </div>
    </div>
     <div class="row mb-3">
        <div class="col-lg-7">
           <div class="card shadow mb-4 border-left-primary">
              <div class="card-body p-4">
                 <form method="post" action="/dash/admin/category/edit/save/<?= $category['id']; ?>" enctype="multipart/form-data">
                 <?= csrf_field() ?>
                     <div class="col-lg-12 d-flex mb-3 justify-content-between">
                        <div class="col-12">
                           <label for="name" class="form-label">Name</label>
                           <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid': '';  ?>" id="name" name="name" value="<?= (old('name')) ? old('name') : $category['name']; ?>" autocomplete="off" required>
                           <div class="invalid-feedback">
                              <?= $validation->getError('name') ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12 d-flex mb-3 justify-content-between">
                        <div class="col-12">
                           <label for="class" class="form-label">Style Class</label>
                           <input type="text" class="form-control <?= ($validation->hasError('class')) ? 'is-invalid': '';  ?>" id="class" name="class" value="<?= (old('class')) ? old('class') : $category['class']; ?>" autocomplete="off" required>
                           <div class="invalid-feedback">
                              <?= $validation->getError('class') ?>
                           </div>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-primary">Edit Category</button>
                  </form>
              </div>
           </div>
        </div>
     </div>
</div>
<?= $this->endSection() ?>