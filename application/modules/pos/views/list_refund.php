<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="card card-outline card-info">
                    <div class="card-header">
                        <h4 class="title">Liste de remboursement</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th># Facture</th>
                                        <th>date opération</th>
                                        <th>PDV</th>
                                        <th>montant</th>
                                        <th>Devise</th>
                                        <th>type opération</th>
                                        <th>Remarque</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($invoices as $item) {?>
                                       <tr>
                                           <td><?php echo $item['inv_id']?></td>
                                           <td><?php echo $item['date'] ?></td>
                                           <td><?php echo $item['pos']?></td>
                                           <td><?php echo $item['amount']?></td>
                                           <td><?php echo $item['devise']?></td>
                                           <td><?php echo $item['type']?></td>
                                           <td>
                                               <?php if ($this->ion_auth_acl->has_permission('A')) {
                                                   if ($item['status']) {?>
                                                       
                                                       <a href="<?php echo site_url('pos/approve_refund/'.$item['inv_id'])?>" class="btn btn-success">Confimer</a>
                                                  <?php }else {?>
                                                     <text class="text-success">Approuvé</text>
                                                 <?php }
                                               }else {
                                                   if ($item['status']) {?>
                                                      <text class="text-warning">En cours</text>
                                                   <?php }else {?>
                                                       <text class="text-success">Approuvé</text>
                                                  <?php }
                                               }?>
                                               
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
