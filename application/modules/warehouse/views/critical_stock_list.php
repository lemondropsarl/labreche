<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h4>Liste de stock en critique</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                    <?php 
                                    if ($critical_stock != null) {?>
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="center">Code article</th>
                                        <th class="center">Nom article</th>
                                        <th class="center">Unité</th>
                                        <th class="center">Min. Qté</th>
                                        <th class="center">Actuel Qté</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        # code...
                                        foreach ($critical_stock as $item) {?>
                                            <tr>
                                                <td><?php echo $item['pcode'];?></td>
                                                <td><?php echo $item['pname'];?></td>
                                                <td><?php echo $item['uom'];?></td>
                                                <td><?php echo $item['min_qty'];?></td>
                                                <td><?php echo $item['actual_qty'];?></td>
                                            </tr>

                                </tbody>
                                       <?php }
                                    }else {?>
                                            
                                                <h4 class=" text-center">Pas de stock en souffrance</h4>
                                            
                                   <?php }?>
                                    
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

