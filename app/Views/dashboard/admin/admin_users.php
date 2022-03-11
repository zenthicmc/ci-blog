<?= $this->extend('dashboard/layout/templates.php') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h3 class="t-black mb-4">All Users</h3>
    <div class="col-lg-4">
        <a href="/dash/admin/users/new" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Add User</span>
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
            <p class="text-primary m-0 fw-bold">All Users Info</p>
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
                            <th>Username</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user) : ?>
                        <tr>
                            <td><img class="rounded-circle me-2" width="30" height="30" src="/img/user-images/<?= $user['image'] ?>"><?= $user['username'] ?></td>
                            <td><?= $user['firstname'] ?></td>
                            <td><?= $user['lastname'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= ucfirst($user['role']); ?></td>
                            <td class="text-center d-flex justify-content-center">
                                <form method="post" action="/dash/admin/users/edit/<?= $user['id'] ?>">
                                <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <button type="submit" class="btn btn-warning text-white">Edit</button>
                                </form>
                                &nbsp;
                                <form method="post" action="/dash/admin/users/delete/<?= $user['id'] ?>">
                                <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" onclick="return confirm('Are you sure want to Delete this User?')" class="btn btn-danger text-white" href="">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Username</strong></td>
                            <td><strong>Firstname</strong></td>
                            <td><strong>Lastname</strong></td>
                            <td><strong>Email</strong></td>
                            <td><strong>Role</strong></td>
                            <td class="text-center"><strong>Actions</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of <?= count($users); ?></p>
                </div>
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <?= $pager->links('user', 'bootstrap_5_full'); ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
