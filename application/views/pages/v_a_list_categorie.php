
<?php if (!isset($list)) $list = array(); ?>   
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="fa fa-folder"></i>
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
                                <th> Horaire Normale(h) </th>
                                <th> Salaire Horaire </th>
                                <th> indemnite(%) </th>
                          </tr>
                        </thead>
                        <tbody>
                         <?php foreach ($list as $row) { ?>
                          <tr>
                                <td><?php  echo $row->nom; ?></td>
                                <td><?php  echo $row->horaire_semaine; ?></td>
                                <td><?php  echo $row->salaire_semaine; ?></td>
                                <td><?php  echo $row-> pourcentage_indemnite; ?></td>
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