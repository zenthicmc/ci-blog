<?= $this->extend('dashboard/layout/templates.php') ?>

<?= $this->section('content') ?>
<?php 
use \App\Models\ArticleModel;
$this->articleModel = new ArticleModel();
?>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-lg-10">
            <h3 class="mb-4 t-black">Your Articles</h3>
        </div>
        <?php if(!empty($articles)): ?>
            <div class="col-lg-4">
                <a href="/dash/articles/new" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Create Article</span>
                </a>
            </div>
        <?php endif; ?>
    </div>
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
    <div class="row mb-3">
        <?php if(!empty($articles)): ?>
            <?php foreach($articles as $article): ?>
            <div class="col-lg-6">
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/img/article-images/<?= $article->cover ?>" style="height: 200px;width: 300px;" class="img-fluid rounded-start" alt="<?= $article->cover ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title t-black"><?= strip_tags(substr($article->title, 0, 49) . '...'); ?></h5>
                                <div class="col-lg-12 mb-2">
                                    <p class="card-text t-black"><?= strip_tags(substr($article->content, 5, 90)) . '...'; ?></p>
                                </div>
                                <div class="col-lg-12 d-flex vertical-middle">
                                    <div class="col-3 text-white vertical-middle">
                                        <p class="<?= $article->class ?>" style="border-radius: 5px;font-size: 14px;max-height: 30px;"><?= strtoupper($article->category); ?></p>
                                    </div>
                                    <span class="card-dot t-secondary vertical-middle">&nbsp;&nbsp;&#9679;</span>
                                    <div class="col-6 vertical-middle">
                                        <p class="card-text"><small class="text-muted t-black">&nbsp;&nbsp;<?= $this->articleModel->time_elapsed_string($article->updated_at) ?></small></p>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-between">
                                    <form action="/dash/articles/edit/<?= $article->id ?>" method="post">
                                    <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="PUT" />
                                        <button type="submit" class="btn btn-primary btn-circle">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </form>
                                    <form action="/dash/articles/delete/<?= $article->id ?>" method="post">
                                    <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button class="btn btn-danger btn-circle">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="/view/<?= $article->slug ?>" class="btn btn-success text-white btn-circle" onclick="copyLink()">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
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
                                <h5 class="card-title t-black">You don't have any articles yet.</h5>
                                <p class="card-text t-black">Create your first article by clicking the button below.</p>
                                <a href="/dash/articles/new" class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text text-white">Create Article</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>