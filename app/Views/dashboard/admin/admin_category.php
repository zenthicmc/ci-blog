<?= $this->extend('dashboard/layout/templates.php') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h3 class="t-black mb-4">All Categories</h3>
    <div class="col-lg-4">
        <a href="/dash/admin/category/new" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Add Category</span>
        </a>
    </div>
    <?php if(session()->getFlashdata('msg')) : ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <?= session()->getFlashdata('msg'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="card shadow mt-3">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">All Categories Info</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-nowrap">
                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                <option value="10" selected="">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>&nbsp;</label></div>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                </div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Style Class</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categories as $category) : ?>
                        <tr>
                            <td><?= $category['id'] ?></td>
                            <td><?= ucfirst($category['name']) ?></td>
                            <td><?= $category['class'] ?></td>
                            <td class="text-center d-flex justify-content-center">
                                <form method="post" action="/dash/admin/category/edit/<?= $category['id'] ?>">
                                <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <button type="submit" class="btn btn-warning text-white">Edit</button>
                                </form>
                                &nbsp;
                                <form method="post" action="/dash/admin/category/delete/<?= $category['id'] ?>">
                                <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" onclick="return confirm('Are you sure want to Delete this Category?')" class="btn btn-danger text-white" href="">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>ID</strong></td>
                            <td><strong>Name</strong></td>
                            <td><strong>Style Class</strong></td>
                            <td class="text-center"><strong>Actions</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of <?= count($categories); ?></p>
                </div>
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <?= $pager->links('category', 'bootstrap_5_full'); ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
