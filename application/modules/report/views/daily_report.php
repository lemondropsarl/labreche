<?php 
defined('BASEPATH') OR exit('No direct script access allowed')?>
<html>
    <head>
    <!--link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css') ?>"-->

    </head>
    <body>

        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>Numero Facture</th>
                    <th>Montant Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $item) {?>
                <tr>
                    <td><?php echo $item['invoice_id']?></td>
                    <td><?php echo $item['inv_total_amount']?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </body>
</html>
