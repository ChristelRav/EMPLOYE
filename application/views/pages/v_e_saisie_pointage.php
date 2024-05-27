<?php if (!isset($jour)) $jour = array("LUNDI", "MARDI", "MERCREDI", "JEUDI", "VENDREDI", "SAMEDI", "DIMANCHE"); ?>

<style>
    .input-fixed-width {    width: 77px; 
                            border-color:black;
                            max-width: 80px;
                        }
</style>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="fa fa-address-book"></i>
            </span> Dashboard
        </h3>
    </div>
    <!-- content START-->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card" >
                <form action="<?php echo site_url('CT_E_pointage/inserer_pointage')?>" method="POST">
                    <div class="card-body" >
                        <h4 class="card-title">Tableau de pointage</h4>
                        <p class="card-description"> Saisie <code>.pointage</code>
                        </p>
                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th> -- # -- </th>
                                    <?php foreach($jour as $j) { ?>
                                        <th> <?php echo $j; ?> </th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> JOUR </td>
                                    <?php foreach($jour as $j) { ?>
                                        <td>
                                            <div class="form-group">
                                                <input type="number"  name="jour<?php echo $j; ?>" min="0" class="form-control input-fixed-width" id="jour<?php echo $j; ?>">
                                            </div>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td> NUIT </td>
                                    <?php foreach($jour as $j) { ?>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" name="nuit<?php echo $j; ?>" min="0" class="form-control input-fixed-width" id="nuit<?php echo $j; ?>">
                                            </div>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td> FERIE </td>
                                    <?php foreach($jour as $j) { ?>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" name="ferie<?php echo $j; ?>"  min="0" class="form-control input-fixed-width" id="ferie<?php echo $j; ?>">
                                            </div>
                                        </td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                        <div class="card-body d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0"></h4>
                                <button type="submit" class="btn btn-gradient-success btn-fw">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- content END-->
</div>
