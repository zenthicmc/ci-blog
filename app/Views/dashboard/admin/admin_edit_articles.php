<?= $this->extend('dashboard/layout/templates.php') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3 d-lg-flex">
        <div class="col-lg-12">
            <h3 class="mb-4 t-black">Edit Existing Article</h3>
        </div>
    </div>
     <div class="row mb-3">
        <div class="col-lg-7">
           <div class="card shadow mb-4 border-left-primary">
              <div class="card-body p-4">
                 <form method="post" action="/dash/admin/articles/edit/save/<?= $article['id'] ?>" enctype="multipart/form-data">
                 <?= csrf_field() ?>
                 <input type="hidden" name="coverLama" value="<?= $article['cover']; ?>">
                     <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid': '';  ?>" id="title" name="title" value="<?= (old('title')) ? old('title') : $article['title']; ?>"  autocomplete="off" required>
                        <div class="invalid-feedback">
                           <?= $validation->getError('title') ?>
                        </div>
                     </div>
                     <div class="mb-3">
                           <label for="category" class="form-label">Category</label>
                           <select class="form-select" name="category" value="<?= old('category') ?>">
                              <?php foreach($categories as $category): ?>
                                 <?php if(old('category') == $category['name']) : ?>
                                    <option value="<?= $category['name'] ?>" selected><?= ucfirst($category['name']); ?></option>
                                 <?php else: ?>
                                    <option value="<?= $category['name'] ?>"><?= ucfirst($category['name']); ?></option>
                                 <?php endif; ?>
                              <?php endforeach; ?>
                           </select>
                     </div>
                     <div class="mb-3">
                           <label for="author" class="form-label">Author</label>
                           <select class="form-select" name="author" value="<?= old('author') ?>">
                              <?php foreach($users as $user): ?>
                                 <?php if(old('author') == $user['username']) : ?>
                                    <option value="<?= $user['username'] ?>" selected><?= ucfirst($user['username']); ?></option>
                                 <?php else: ?>
                                    <option value="<?= $user['username'] ?>"><?= ucfirst($user['username']); ?></option>
                                 <?php endif; ?>
                              <?php endforeach; ?>
                           </select>
                     </div>
                     <div class="mb-4">
                        <label for="category" class="form-label">Cover Image</label>
                        <div class="input-group mb-3">
                           <input class="form-control <?= ($validation->hasError('cover')) ? 'is-invalid': '';  ?>" type="file" id="cover" name="cover" value="<?= old('cover') ?>">
                           <div class="invalid-feedback">
                              <?= $validation->getError('cover') ?>
                           </div>
                        </div>
                     </div>
                     <div class="mb-3">
                        <input id="body" type="hidden" name="body" value="<?= (old('body')) ? old('body') : $article['content']; ?>">
                        <trix-editor input="body"></trix-editor>
                        <p class="text-danger"><?= $validation->getError('body') ?></p>
                     </div>
                     <button type="submit" class="btn btn-primary">Edit Article</button>
                  </form>
              </div>
           </div>
        </div>
     </div>
</div>
<?= $this->endSection() ?>