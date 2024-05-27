<?php if (!isset($total)) $total = array(); 
if (!isset($hn)) $hn = array();   if (!isset($hs30)) $hs30 = array();  if (!isset($hs50)) $hs50 = array();
if (!isset($hnuit)) $hnuit = array();   if (!isset($hdim)) $hdim = array();  if (!isset($hf)) $hf = array();   if (!isset($hfw)) $hfw = array();
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
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th> Designation </th>
                            <th> Total heure (H)</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <th> Heure Normale </th>
                              <td><?php echo $total->total_heure;?></td>
                            </tr>
                            <tr>
                              <th> Heure Jour </th>
                              <td><?php echo $total->sj;?></td>
                            </tr>
                            <tr>
                              <th> Heure Nuit </th>
                              <td><?php echo $hnuit->total_heure;?></td>
                            </tr>
                            <tr>
                              <th> Heure Dimanche </th>
                              <td><?php echo $hdim->total_heure;?></td>
                            </tr>
                            <tr>
                              <th> Heure Jour Férié+travail </th>
                              <td><?php echo $hfw->total_heure;?></td>
                            </tr>
                            <tr>
                              <th> Heure Jour Férié </th>
                              <td><?php echo $total->sf;?></td>
                            </tr>
                            <tr>
                              <th> Heure Sup 30% </th>
                              <td><?php echo isset($hs30->total_heure) ? $hs30->total_heure : 0; ?></td>
                            </tr>
                            <tr>
                              <th> Heure Sup 50% </th>
                              <td><?php echo isset($hs50->total_heure) ? $hs50->total_heure : 0; ?></td>
                            </tr>
                        </tbody>
                      </table>
                      <div class="card-body d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0"></h4>
                                <a class="btn btn-gradient-success btn-fw"  href="<?php echo site_url('CT_E_pointage/fiche_paie')?>">Fiche Paie</a>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- content END-->
</div>