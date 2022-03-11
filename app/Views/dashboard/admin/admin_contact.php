<?= $this->extend('dashboard/layout/templates.php') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-lg-10">
            <h3 class="mb-4 t-black">List of Contacts</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-2">
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
        </div>
    </div>
    <div class="row mb-3 d-flex justify-content-around">
        <?php if(!empty($contacts)): ?>
            <?php foreach($contacts as $contact): ?>
                <div class="col-lg-3">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                        <div class="card-header">
                            <strong>From:</strong> <?= $contact['email']; ?>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= substr($contact['content'], 0, 90) . '...'; ?></p>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <form action="/dash/admin/contact/view/<?= $contact['id'] ?>" method="post">
                            <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="PUT" />
                                <button type="submit" class="btn btn-primary btn-circle">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </form>
                            &nbsp;
                            <form action="/dash/admin/contact/delete/<?= $contact['id'] ?>" method="post">
                            <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE" />
                                <button class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-lg-12 m-auto text-center">
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title t-black">No contact messages found!</h5>
                                <p class="card-text t-black">Any contact messages will be showed here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>