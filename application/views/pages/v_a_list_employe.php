
<?php if (!isset($list)) $list = array(); ?>   
<?php if (!isset($stat)) $stat = array(); ?>  
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
            <div class="col-5 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Liste des Horaires </h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                                <th> Désignation </th>
                                <th>  Heure </th>
                                <th>  Montant </th>
                          </tr>
                        </thead>
                        <tbody>
                         <?php foreach ($stat as $row) { ?>
                          <tr>
                                <td><?php  echo $row->designation; ?>  </td>
                                <td><?php  echo $row->th; ?></td>
                                <td><?php  echo $row->montant; ?></td>
                          </tr>
                         <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-7 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Liste des employés </h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                                <th> Nom & prénom </th>
                                <th> Catégorie </th>
                                <th> Embauche </th>
                                <th> Fin contrat </th>
                                <th>A payer</th>
                                <th>dernier_pointage</th>
                          </tr>
                        </thead>
                        <tbody>
                         <?php foreach ($list as $row) { ?>
                          <tr>
                                <td><?php  echo $row->nom; ?>    <?php  echo $row->prenom; ?></td>
                                <td><?php  echo $row->categorie_nom; ?></td>
                                <td><?php  echo $row->date_embauche; ?></td>
                                <td><?php  echo $row->date_fin_contrat; ?></td>
                                <td><?php  echo $row->total_montant; ?></td>
                                <td><?php  echo $row->date_fiche_paie; ?></td>
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