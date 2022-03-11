<?= $this->extend('dashboard/layout/templates.php') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h3 class="t-black mb-4">Profile</h3>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body text-center shadow">
                <form action="/dash/profile/imagesave" method="post" enctype="multipart/form-data">
                    <img class="rounded-circle mb-3 mt-4" id="imgPreview" src="/img/user-images/<?= $user['image'] ?>" width="160" height="160">
                    <div class="col-sm-8 m-auto mb-3">
                        <input type="hidden" name="imageLama" value="<?= $user['image'] ?>">
                        <input class="form-control <?= ($validation->hasError('profile')) ? 'is-invalid': '';  ?>" type="file" id="profile" name="profile" onchange="previewImg()" style="max-height: 40px;" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('profile') ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary btn-sm" type="submit" style="background: #7e56da;border-style: none;">Change Photo</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <?php if(session()->getFlashdata('msg')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('msg'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">User Settings</p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="/dash/profile/usersave">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="username"><strong>Username</strong></label>
                                            <input class="form-control <?= ($validation->hasError('username')) ? 'is-invalid': '';  ?>" type="text" id="username" value="<?= $user['username'] ?>" name="username" required>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('username') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="email"><strong>Email Address</strong></label>
                                            <input class="form-control <?= ($validation->hasError('email')) ? 'is-invalid': '';  ?>" type="email" id="email" value="<?= $user['email'] ?>" name="email" required>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('email') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="first_name"><strong>First Name</strong></label>
                                            <input class="form-control <?= ($validation->hasError('firstname')) ? 'is-invalid': '';  ?>" type="text" id="first_name" value="<?= $user['firstname'] ?>" name="firstname" required>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('firstname') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="last_name"><strong>Last Name</strong></label>
                                            <input class="form-control <?= ($validation->hasError('lastname')) ? 'is-invalid': '';  ?>" type="text" id="last_name" value="<?= $user['lastname'] ?>" name="lastname" required>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('lastname') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit" style="background: #7e56da;border-style: none;">Save Settings</button></div>
                            </form>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Password Settings</p>
                        </div>
                        <div class="card-body">
                            <form action="/dash/profile/passsave" method="post">
                                <div class="mb-3">
                                    <label class="form-label" for="address"><strong>Current Password</strong></label>
                                    <input class="form-control <?= ($validation->hasError('current_pwd')) ? 'is-invalid': '';  ?>" type="password" id="password" name="current_pwd" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('current_pwd') ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="city"><strong>New Password</strong></label>
                                            <input class="form-control <?= ($validation->hasError('pwd')) ? 'is-invalid': '';  ?>" type="password" id="password" name="pwd" autocomplete="off" required>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('pwd') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="country"><strong>Confirm New Password</strong></label>
                                            <input class="form-control <?= ($validation->hasError('confirm_pwd')) ? 'is-invalid': '';  ?>" type="password" id="password" name="confirm_pwd" autocomplete="off" required>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('confirm_pwd') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 message text-center text-danger"></div>
                                <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit" style="background: #7e56da;border-style: none;">Save&nbsp;Settings</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>