<?php
    use \App\Models\AuthModel;
    $this->authModel = new AuthModel();
    $this->session = \Config\Services::session();
    $this->session->start();

    $data = $this->authModel->where('id', $this->session->get('id'))->first();
?>

<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
  <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
      <ul class="navbar-nav flex-nowrap ms-auto">
          <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
              <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                  <form class="me-auto navbar-search w-100">
                      <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                          <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                      </div>
                  </form>
              </div>
          </li>
          <li class="nav-item dropdown no-arrow">
              <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?= $data['username'] ?></span><img class="border rounded-circle img-profile" src="/img/user-images/<?= $data['image'] ?>"></a>
                  <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="/dash/profile"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                      <div class="dropdown-divider"></div><a class="dropdown-item" href="/dash/logout"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                  </div>
              </div>
          </li>
      </ul>
  </div>
</nav>
                  