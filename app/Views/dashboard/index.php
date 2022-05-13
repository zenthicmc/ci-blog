<?= $this->extend('dashboard/layout/templates') ?>

<?= $this->section('content') ?>
<?php 
    use App\Models\ArticleModel;
    use App\Models\UserModel;
    $this->articleModel = new ArticleModel();
    $this->userModel = new UserModel();

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
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
    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Your Articles</span></div>
                            <div class="t-black fw-bold h5 mb-0"><span><?= count($articles); ?></span></div>
                        </div>
                        <div class="col-auto"><i class="fa-solid fa-newspaper fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Your Articles</span></div>
                            <div class="t-black fw-bold h5 mb-0"><span><?= count($articles); ?></span></div>
                        </div>
                        <div class="col-auto"><i class="fa-solid fa-newspaper fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Your Followers</span></div>
                            <div class="t-black fw-bold h5 mb-0"><span><?= count($followers) ?></span></div>
                        </div>
                        <div class="col-auto"><i class="fa-solid fa-people-group fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Your Likes</span></div>
                            <div class="t-black fw-bold h5 mb-0"><span><?= $count_likes ?></span></div>
                        </div>
                        <div class="col-auto"><i class="fa-solid fa-heart fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary fw-bold m-0">Your Recent Articles</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <?php if(!empty($recent_articles)) : ?>
                        <?php foreach($recent_articles as $article) : ?>
                        <li class="list-group-item">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <h6 class="mb-0 t-black"><strong><?= strip_tags(substr($article->title, 0, 49) . '...'); ?></strong></h6><span class="text-xs"><?= $this->articleModel->time_elapsed_string($article->updated_at) ?></span>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li class="list-group-item">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <h6 class="mb-0 t-black"><strong>No Recent Articles</strong></h6>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary fw-bold m-0">Your Recent Followers</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <?php if(!empty($followers)) : ?>
                        <?php foreach($followers as $follower) : ?>
                        <li class="list-group-item">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <h6 class="mb-0 t-black"><strong><?= strip_tags(ucwords($this->userModel->getUsernameById($follower['id_user']))); ?></strong></h6><span class="text-xs"><?= $this->articleModel->time_elapsed_string($follower['created_at']) ?></span>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li class="list-group-item">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <h6 class="mb-0 t-black"><strong>No Recent Followers</strong></h6>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

                    