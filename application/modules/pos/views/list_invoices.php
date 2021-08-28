<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h4 class="title">Liste des factures</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>PDV</th>
                                        <th>type opération</th>
                                        <th>montant</th>
                                        <th>date opération</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($invoices as $item) {?>
                                       <tr>
                                           <td><?php echo $item['inv_id']?></td>
                                           <td><?php echo $item['pos']?></td>
                                           <td><?php echo $item['type']?></td>
                                           <td><?php echo $item['amount']?></td>
                                           <td><?php echo date("d/m/Y",$item['date'])?></td>
                                            <td>
                                                <a href="<?php echo site_url('pos/detail_invoice/'.$item['inv_id'])?>">voir détails</a>
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
