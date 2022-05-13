<?= $this->extend('dashboard/layout/templates.php') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3 d-lg-flex">
        <div class="col-lg-12">
            <h3 class="mb-4 t-black">Edit Existing User</h3>
        </div>
    </div>
     <div class="row mb-3">
        <div class="col-lg-7">
           <div class="card shadow mb-4 border-left-primary">
              <div class="card-body p-4">
                 <form method="post" action="/dash/admin/users/edit/save/<?= $user['id'] ?>" enctype="multipart/form-data">
                 <?= csrf_field() ?>
                 <input type="hidden" name="passwordLama" value="<?= $user['password'] ?>">
                     <div class="col-lg-12 d-flex mb-3 justify-content-between">
                        <div class="col-6" style="max-width: 49%;">
                           <label for="firstname" class="form-label">Firstname</label>
                           <input type="text" class="form-control <?= ($validation->hasError('firstname')) ? 'is-invalid': '';  ?>" id="firstname" name="firstname" value="<?= (old('firstname')) ? old('firstname') : $user['firstname']; ?>" autocomplete="off" required>
                           <div class="invalid-feedback">
                              <?= $validation->getError('firstname') ?>
                           </div>
                        </div>
                        <div class="col-6" style="max-width: 49%;">
                           <label for="lastname" class="form-label">Lastname</label>
                           <input type="text" class="form-control <?= ($validation->hasError('lastname')) ? 'is-invalid': '';  ?>" id="lastname" name="lastname" value="<?= (old('lastname')) ? old('lastname') : $user['lastname']; ?>" autocomplete="off" required>
                           <div class="invalid-feedback">
                              <?= $validation->getError('lastname') ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12 d-flex mb-3 justify-content-between">
                        <div class="col-12">
                           <label for="username" class="form-label">Username</label>
                           <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid': '';  ?>" id="username" name="username" value="<?= (old('username')) ? old('username') : $user['username']; ?>" autocomplete="off" required>
                           <div class="invalid-feedback">
                              <?= $validation->getError('username') ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12 d-flex mb-3 justify-content-between">
                        <div class="col-12">
                           <label for="email" class="form-label">Email</label>
                           <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid': '';  ?>" id="email" name="email" value="<?= (old('email')) ? old('email') : $user['email']; ?>" autocomplete="off" required>
                           <div class="invalid-feedback">
                              <?= $validation->getError('email') ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12 d-flex mb-3 justify-content-between">
                        <div class="col-6" style="max-width: 49%;">
                           <label for="password" class="form-label">Password</label>
                           <input type="password" id="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid': '';  ?>" id="password" name="password" value="<?= old('password') ?>" autocomplete="off">
                           <div class="invalid-feedback">
                              <?= $validation->getError('password') ?>
                           </div>
                        </div>
                        <div class="col-6" style="max-width: 49%;">
                           <label for="pass_confirm" class="form-label">Confirm Password</label>
                           <input type="password" class="form-control <?= ($validation->hasError('pass_confirm')) ? 'is-invalid': '';  ?>" id="pass_confirm" name="pass_confirm" value="<?= old('pass_confirm') ?>" autocomplete="off">
                           <div class="invalid-feedback">
                              <?= $validation->getError('pass_confirm') ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12 mb-2">
                           <label for="role" class="form-label">Role</label>
                           <select class="form-select" name="role" value="<?= (old('role')) ? old('role') : $user['role']; ?>">
                              <?php foreach($roles as $role): ?>
                                 <!-- make default value of option to current role -->
                                 <?php if(old('role') == $role['name']) : ?>
                                    <option value="<?= $role['name'] ?>" selected><?= ucfirst($role['name']); ?></option>
                                 <?php elseif($user['role'] == $role['name']) : ?>
                                    <option value="<?= $role['name'] ?>" selected><?= ucfirst($role['name']); ?></option>
                                 <?php else: ?>
                                    <option value="<?= $role['name'] ?>"><?= ucfirst($role['name']); ?></option>
                                 <?php endif; ?>
                              <?php endforeach; ?>
                           </select>
                     </div>
                     <div class="col-12 message text-center mb-4 text-danger"></div>
                     <button type="submit" class="btn btn-primary">Edit User</button>
                  </form>
              </div>
           </div>
        </div>
     </div>
</div>
<?= $this->endSection() ?>