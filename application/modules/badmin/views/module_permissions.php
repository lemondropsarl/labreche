<?php 
defined('BASEPATH') OR exit('No direct script access allowed');



/* End of file filename.php */
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php if ($this->ion_auth_acl->has_permission('A')) {?>
            <div class="col-md-12">
                <div class="card card-outiline card-danger">
                    <div class="card-header">
                        <h4 class="title">Access modules</h4>
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>MODULES</th>
                                            <?php 
                                                $group = array();
                                                $mg = array();
                                                foreach ($groups as $v) {
                                                    $id = $v['id'];
                                                    $name = $v['name'];
                                                    $group[$id] = $name;
                                                }
                                                foreach ($modules as $v) {
                                                    $name = $v['module_name'];
                                                    $mg[$name] = $name;
                                                }
                                                foreach (array_keys(current($matrix)) as $group_id){?>
                                                    <th><?php echo $group[$group_id]?></th>
                                               <?php }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo form_open('url');
                                                foreach (array_keys($matrix) as $module_name) {?>
                                                    <tr>
                                                    <td><?php echo $mg[$module_name]?></td>
                                                    <?php foreach (array_keys($matrix[$module_name]) as $group_id) {
                                                        if ($matrix[$module_name][$group_id] == '1') {?>
                                                           <td>
                                                               <input type="checkbox" 
                                                                   name="<?php echo $group_id?>_<?php echo $module_name?>" value="1" checked/>
                                                           </td>
                                                       <?php }else{?>
                                                        <td>
                                                               <input type="checkbox" 
                                                                   name="<?php echo $group_id?>_<?php echo $module_name?>" value="0" />
                                                           </td>
                                                      <?php }
                                                       
                                                    }?>
                                                    </tr>
                                              <?php  }?>

                                              
                                            </tbody>
                                        </table>
                                        <p>
                                           <button type="submit" class="btn btn-danger"> mise à jour acces</button> 
                                            </p>
                                            <?php echo form_close();?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
            <?php }?>
    </div>
</div>