
<?php if (!isset($list)) $list = array(); ?>   
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="fa fa-user"></i>
                </span> Employés
              </h3>
            </div>
            <!-- content START-->
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Liste des employés </h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                                <th> Nom </th>
                                <th> Prénom </th>
                                <th> Date Naissance </th>
                                <th> Embauche </th>
                                <th> Fin contrat </th>  
                          </tr>
                        </thead>
                        <tbody>
                         <?php foreach ($list as $row) { ?>
                          <tr>
                                <td><?php  echo $row->nom; ?></td>
                                <td><?php  echo $row->prenom; ?></td>
                                <td><?php  echo $row->date_naissance; ?></td>
                                <td><?php  echo $row->date_embauche; ?></td>
                                <td><?php  echo $row->date_fin_contrat; ?></td>
                          </tr>
                         <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- content END-->
</div>