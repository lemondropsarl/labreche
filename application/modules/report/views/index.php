<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-default">
                    <div class="card-header">
                        <h4 class="title">Rapports point de vente</h4>
                    </div>
                    <div class="card-body">
                        <div class="btn-group-md-justify">
                            <a href="<?php echo base_url('report/daily_report')?>" class="btn btn-default">Journalier</a>
                            <a href="" class="btn btn-default">Hebdomadaire</a>
                            <a href="" class="btn btn-default">Mensuel</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-default">
                    <div class="card-header">
                        <h4 class="title">Rapports de stock</h4>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
            <?php if ($this->ion_auth_acl->has_permission('A')) {?>
                <div class="col-md-6">
                    <div class="card card-outline card-default">
                        <div class="card-header">
                            <h4 class="title">Rapports administratifs</h4>
                        </div>
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="card card-outline card-default">
                    <div class="card-header">
                        <h4 class="title">Autres rapports</h4>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
