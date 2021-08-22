<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <p>

                    <a href="<?php echo base_url('backup/create_backup')?>" class="btn btn-success"> Créer une nouvelle sauvegarde</a>
                </p>
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h4 class="title">Liste des sauvegarde</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="thead-dark">
                                        <th class="center">Sauvegarde</th>
                                        <th class="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                    <?php foreach ($files as $item) {
                                        $time = strval((int)filter_var($item, FILTER_SANITIZE_NUMBER_INT));?>
                                        <tr>
                                            <td>
                                                Sauvegarde base de donnée du <?php
                                                echo date("d/m/Y H:i:s",$time);?>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('backup/restore_backup/'.$item)?>" class="btn btn-danger icon"> Restorer</a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
