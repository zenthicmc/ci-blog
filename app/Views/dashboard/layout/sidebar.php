<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #7e56da;">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fa-solid fa-scroll"></i>
    </div>
    <div class="sidebar-brand-text mx-3"><?= $appName ?></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link <?php if($title=="Dashboard") {echo "active";}  ?>" href="/dash">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Articles
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link <?php if($title=="Articles") {echo "active";}  ?>" href="/dash/articles">
        <i class="fa-solid fa-copy"></i>
        <span>Your Articles</span>
    </a>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link <?php if($title=="New Articles") {echo "active";}  ?>" href="/dash/articles/new">
        <i class="fa-solid fa-square-plus"></i>
        <span>Create Article</span>
    </a>
</li>

<?php if(session()->get('role') == 'admin') : ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Administration
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link <?php if($title=="Admin | Users") {echo "active";}  ?>" href="/dash/admin/users">
            <i class="fa-solid fa-users"></i>
            <span>Users</span>
        </a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link <?php if($title=="Admin | Articles") {echo "active";}  ?>" href="/dash/admin/articles">
            <i class="fa-solid fa-copy"></i>
            <span>Articles</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link <?php if($title=="Admin | Categories") {echo "active";}  ?>" href="/dash/admin/category">
            <i class="fa-solid fa-clipboard-list"></i>
            <span>Categories</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?php if($title=="Admin | Contacts") {echo "active";}  ?>" href="/dash/admin/contact">
            <i class="fa-solid fa-envelope"></i>
            <span>Contacts</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
<?php endif; ?>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->
