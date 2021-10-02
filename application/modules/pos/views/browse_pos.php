<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

global $pos_ws_id;

/* End of file filename.php */
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php if($this->ion_auth_acl->has_permission('A')){?>
            <div class="col-md-12 ">

                    <div class="form-group form-inline align-right">
                        <label>Point de vente</label>
                        <div class="col-4">
                            <select name="po_ws_id" id="pos_ws_id" class="form-control">
                                <?php foreach ($pos as $item) {?>
                                    # code...
                                    <option value="<?php echo $item['pos_ws_id'];?>"><?php echo $item['pos_name'];?></option>
                               <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php  }?>
        
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<div class="small-box  bg-gradient-navy">
					<div class="inner">
						<h3><?php echo number_format($value_stock_cdf['total'],2,',',' ');?></h3>
                        <p>Valeur du stock CDF</p>
					</div>
					<div class="icon">
						<i class="fas fa-dollar-sign"></i>
					</div>
					<a href="#" class="small-box-footer"></a>
						
				</div>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<div class="small-box bg-primary">
					<div class="inner">
						<h3><?php
                            echo number_format($value_stock_usd['total'],2,',',' ');	?>						
                        </h3>
						<p>Valeur du stock USD</p>
					</div>
					<div class="icon">
						<i class="fas fa-dollar-sign"></i>
					</div>
					<a href="#" class="small-box-footer"></a>
				</div>
			</div>
			<div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
				<div class="small-box  bg-success">
					<div class="inner">
						<h3><?php echo number_format($sales,2,',',' ')?></h3>
						<p>Total vente journalière</p>
					</div>
					<div class="icon">
						<i class="fas fa-dollar-sign"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo
                        $count_critical?></h3>
                       
						<p>Total stock en critique</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>
					<a href="<?php echo site_url('pos/critical_stock/ws_id');?>" class="small-box-footer"
						>plus d'infos <i class="fa fa-arrow-alt-circle-right"></i
					></a>
				</div>
			</div>
        </div>
        <div class="row">
        <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h4 class="card-title">List de stock depot</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Code article</th>
                                        <th>Nom article</th>
                                        <th>Unité</th>
                                        <th>Quantité en stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_stock as $item) {?>
                                        <tr>
                                            <td><?php echo $item['pcode'];?></td>
                                            <td><?php echo $item['pname'];?></td>
                                            <td><?php echo $item['uom'];?></td>
                                            <td class="text-bold"><?php echo $item['actual_qty'];?></td>
                                        </tr>
                                   <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
