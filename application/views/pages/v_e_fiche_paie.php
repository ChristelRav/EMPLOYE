<?php if (!isset($total)) $total = array(); 
if (!isset($hn)) $hn = array();   if (!isset($hs30)) $hs30 = array();  if (!isset($hs50)) $hs50 = array();
if (!isset($hnuit)) $hnuit = array();   if (!isset($hdim)) $hdim = array();  if (!isset($hf)) $hf = array();   if (!isset($hfw)) $hfw = array();
if (!isset($emp)) $emp = array();  
?>   
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="fa fa-clock-o"></i>
                </span> Dashboard
              </h3>
            </div>
            <!-- content START-->
            <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Total des heures</h4>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Nom & Prénom  : <?php echo $emp->nom;?>  <?php echo $emp->prenom;?></td>
                            </tr>
                            <tr>
                                <td>Numéro : EMP<?php echo $emp->id_employe;?></td>
                            </tr>
                            <tr>
                                <td>Catégorie  : <?php echo $emp->categorie_nom;?></td>
                            </tr>
                        </tbody>
                      </table>
                    <div class="table-responsive">
                      
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th> Designation </th>
                            <th> Total heure (H)</th>
                            <th> Taux Horaire (Ar)</th>
                            <th> Montant </th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <th> Heure Normale </th>
                              <td><?php echo $hn->total_heure;?></td>
                              <td><?php echo number_format($hn->taux_horaire,2,',',' ') ;?></td>
                              <td><?php echo (number_format($hn->montant,2,',',' '));?></td>
                            </tr>
                            <tr>
                              <th> Heure Nuit </th>
                              <td><?php echo $hnuit->total_heure;?></td>
                              <td><?php echo number_format($hnuit->taux_horaire,2,',',' ') ;?></td>
                              <td><?php echo (number_format($hnuit->montant,2,',',' '));?></td>
                            </tr>
                            <tr>
                              <th> Heure Dimanche </th>
                              <td><?php echo $hdim->total_heure;?></td>
                              <td><?php echo number_format($hdim->taux_horaire,2,',',' ') ;?></td>
                              <td><?php echo (number_format($hdim->montant,2,',',' '));?></td>
                            </tr>
                            <tr>
                              <th> Heure Jour Férié+travail </th>
                              <td><?php echo $hfw->total_heure;?></td>
                              <td><?php echo number_format($hfw->taux_horaire,2,',',' ') ;?></td>
                              <td><?php echo (number_format($hfw->montant,2,',',' '));?></td>
                            </tr>
                            <tr>
                              <th> Heure Jour Férié </th>
                              <td><?php echo $hf->total_heure;?></td>
                              <td><?php echo number_format($hf->taux_horaire,2,',',' ') ;?></td>
                              <td><?php echo (number_format($hf->montant,2,',',' '));?></td>
                            </tr>
                            <tr>
                              <th> Heure Sup 30% </th>
                              <td><?php echo isset($hs30->total_heure) ? $hs30->total_heure : 0; ?></td>
                              <td><?php echo isset($hs30->taux_horaire)  ? number_format($hs30->taux_horaire,2,',',' ') : 0; ?></td>
                              <td><?php echo isset($hs30->montant) ? number_format($hs30->montant,2,',',' ') : 0; ?></td>
                            </tr>
                            <tr>
                              <th> Heure Sup 50% </th>
                              <td><?php echo isset($hs50->total_heure) ? $hs50->total_heure : 0; ?></td>
                              <td><?php echo isset($hs50->taux_horaire)  ? number_format($hs50->taux_horaire,2,',',' ') : 0; ?></td>
                              <td><?php echo isset($hs50->montant) ? number_format($hs50->montant,2,',',' ') : 0; ?></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <th> Total </th>
                              <td><?php echo isset($montant->montant_total) ?  number_format($montant->montant_total,2,',',' ') : 0; ?></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <th> Indemnite </th>
                              <td><?php echo isset($indemnite) ? number_format($indemnite,2,',',' ') : 0; ?></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <th> Total à payer  </th>
                              <td><?php echo isset($totalP) ?  number_format($totalP,2,',',' ') : 0; ?></td>
                            </tr>
                        </tbody>
                      </table>
                      <div class="card-body d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0"></h4>
                                <a class="btn btn-gradient-danger btn-fw" href="<?php echo site_url('CT_E_pointage/fiche_pdf')?>"   target='_blank' > <i class="fa fa-file-pdf-o"></i> export PDF</a>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- content END-->
</div>