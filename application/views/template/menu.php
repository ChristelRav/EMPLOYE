<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="<?php echo base_url("assets/images/faces/face1.jpg"); ?>" alt="profile" />
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">USER</span>
                  <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <?php if($_SESSION['user'][0]['type'] == 1){ ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('CT_A_Employe')?>">
                  <span class="menu-title">Tableau de bord</span>
                  <i class="mdi mdi-home menu-icon"></i>
                </a>
              </li>
              <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                  <span class="menu-title">Eléments Société</span>
                  <i class="mdi mdi-contacts menu-icon"></i>
                </a>
                <div class="collapse" id="ui-basic">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo site_url('CT_A_Employe/simple')?>">Employés</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo site_url('CT_A_Categorie')?>">Catégorie</a>
                    </li>
                  </ul>
                </div>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <span class="menu-title">Pointage</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
              <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('CT_E_Pointage')?>">Saisie</a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>

              <!-- partial -->
              <div class="main-panel">