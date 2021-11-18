
<table border=0 width="100%" style='font:arial; font-size:16px;'>
    <tr>
        <td align="right" width="20%">
            
            <img src="<?= Yii::getAlias('@app/web')?>/images/logo1.png" alt="Image" height="50px">
            
        </td>
        <td align ="center">
            <p>REPUBLIC OF THE PHILIPPINES</p>
            <p><b>SECURITIES AND EXCHANGE COMMISSION</b></p>
            <p>Secretariat Building PICC Complex, Roxas Boulevard</p>
            <p>Pasay City, 1307</p>
        </td>
        <td width="20%"></td>
    </tr>
    <tr><td colspan='3'><br></td></tr>
    <tr><td align="center" colspan='3'><b>CORPORATE STATUS</b></td></tr><br>
</table>

<table border=0 width="100%" style='font:arial; font-size:14px;' >
    <tr>
        <td width="25%"> Date: </td>
        <td> <?= date('d F Y') ?></td>
    </tr>
    <tr>
        <td> SEC Registration No. : </td>
        <td> <?= $model->fld_sec_reg_no ?></td>
    </tr>
    <tr>
        <td> Company Name : </td>
        <td> <?= $model->fld_sec_reg_name ?></td>
    </tr>
    <tr>
        <td> Entity Type : </td>
        <td> <?= $model->getPrimaryLic($model->fld_primary_license) . '; ' . $model->getSecLicList($model->fld_secondary_license) ?></td>
    </tr>
    <tr>
        <td>Printed By: </td>
        <td><?= strtoupper(Yii::$app->user->identity->name) ?></td>
    </tr>
</table>
<br><br>
<?php 
if(date("w",(strtotime(date("Y-m-d"))-86400)) == 0 || date("w",(strtotime(date("Y-m-d"))-86400)) == 6){
	$dte = date("M j Y",(strtotime(date("Y-m-d"))-259200));
}else{
	$dte = date("M j Y",(strtotime(date("Y-m-d"))-86400));
}

?>
<?php 
    $crmd = ['0103010100'=>'CMD','0103010200'=>'CPRD','0103010500'=>'CFRD','0103010300'=>'FAAD','0103010400'=>'LU'];
    $so = ['0103010600'=>'SO-AMC','0103011000'=>'SO-MNP','0103011100'=>'SO-MOA','0103010800'=>'SO-RG','0103010700'=>'SO-SMM','0103010900'=>'SO-SMN'];
    $eo = ['0103110000'=>'BCEO','0103030000'=>'BEO','0103050000'=>'CDOEO','0103060000'=>'CEO','0103070000'=>'DEO','0103040000'=>'IEO','0103090000'=>'LEO','0103100000'=>'TEO','0103080000'=>'ZEO'];
    $dept = ['010501'=>'CGFD','010101'=>'MSRD','010201'=>'EIPD','010202'=>'OGC'];
?>
<table border=1 width="100%" style='font:arial; font-size:14px;' cellspacing="0" cellpadding="3">
    <tr>
        <td align="center" width="20%"><b>DEPARTMENT</b></td>
        <td align="center"><b>STATUS</b></td>
        <td align="center"><b>REMARKS</b></td>
        <td  align="center" width="12%"><b>DATE</b></td>
    </tr>
    <tr>
        <td colspan=4><b>HEAD OFFICE</b></td>
    </tr>
    <!-- CRMD-start -->
    <tr>
        <td colspan=4>
            &nbsp;&nbsp;&nbsp;CRMD
        </td>
    </tr>
    <?php 
    foreach ($crmd as $code => $office){
        $data = \app\models\TblNegativeList::getInfractions($code, $model->fld_sec_reg_no,1);
      
    ?>
        <?php if($data[0] == 'Cleared'){ ?>
                <tr>
                    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $office ?></td>
                    <td><?php echo $data[0]; ?></td>
                    <td></td>
                    <td><?= $dte?></td>
                </tr>
            <?php }else{
                $statData='';$remarksData='';
                $x = 0;
               
                
                    foreach($data as $row){
                        foreach($row as $stat=>$remarks){
                        
                        echo '<tr>';

                        if($x == 0){
                            echo '<td rowspan="'.count($data).'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$office.'</td>';
                        }
                        
                        echo '<td>'.$stat.'</td>';
                        echo '<td>'.$remarks.'</td>';
                        echo '<td>'.$dte.'</td>';
                        echo '</tr>';

                        }
                        $x++;
                    }
                // echo '<td>'.$statData.'</td>';
                // echo '<td>'.$remarksData.'</td>';
                // echo '<td>'.$dte.'</td>';

            } ?>
    <?php } ?>
    <!-- CRMD-end -->
    <!-- Dept-start -->
   
    <?php 
    foreach ($dept as $code => $office){
        $data = \app\models\TblNegativeList::getInfractions($code, $model->fld_sec_reg_no,2);
      
    ?>
        <?php if($data[0] == 'Cleared'){ ?>
                <tr>
                    <td >&nbsp;&nbsp;&nbsp; <?= $office ?></td>
                    <td><?php echo $data[0]; ?></td>
                    <td></td>
                    <td><?= $dte?></td>
                </tr>
            <?php }else{
                $statData='';$remarksData='';
                $x = 0;
               
                
                    foreach($data as $row){
                        foreach($row as $stat=>$remarks){
                        
                        echo '<tr>';

                        if($x == 0){
                            echo '<td rowspan="'.count($data).'">&nbsp;&nbsp;&nbsp; '.$office.'</td>';
                        }
                        
                        echo '<td>'.$stat.'</td>';
                        echo '<td>'.$remarks.'</td>';
                        echo '<td>'.$dte.'</td>';
                        echo '</tr>';

                        }
                        $x++;
                    }
                // echo '<td>'.$statData.'</td>';
                // echo '<td>'.$remarksData.'</td>';
                // echo '<td>'.$dte.'</td>';

            } ?>
    <?php } ?>


    <!-- Dept-end -->
    <!-- SO-start -->
    <tr>
        <td colspan=4><b>SOs</b></td>
    </tr>
    <?php 
    $soFlag=0;
    foreach ($so as $code => $office){
        $data = \app\models\TblNegativeList::getInfractions($code, $model->fld_sec_reg_no,1);
      
    ?>
        <?php if($data[0] == 'Cleared'){ ?>
                <!-- <tr>
                    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $office ?></td>
                    <td><?php echo $data[0]; ?></td>
                    <td></td>
                    <td><?= $dte?></td>
                </tr> -->
            <?php }else{
                $soFlag++;
                $statData='';$remarksData='';
                $x = 0;
               
                
                    foreach($data as $row){
                        foreach($row as $stat=>$remarks){
                        
                        echo '<tr>';

                        if($x == 0){
                            echo '<td rowspan="'.count($data).'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$office.'</td>';
                        }
                        
                        echo '<td>'.$stat.'</td>';
                        echo '<td>'.$remarks.'</td>';
                        echo '<td>'.$dte.'</td>';
                        echo '</tr>';

                        }
                        $x++;
                    }
                // echo '<td>'.$statData.'</td>';
                // echo '<td>'.$remarksData.'</td>';
                // echo '<td>'.$dte.'</td>';

            } ?>
    <?php }
        if($soFlag == 0)
        {
            echo '<tr>
                <td >&nbsp;&nbsp;&nbsp; SOs</td>
                <td>Cleared</td>
                <td></td>
                <td>'.$dte.'</td>
            </tr>';
        }
    ?>
    <!-- SO-end -->
    <!-- EO-start -->
    <tr>
        <td colspan=4><b>EOs</b></td>
    </tr>
    <?php
    $eoFlag=0;
    foreach ($eo as $code => $office){
        $data = \app\models\TblNegativeList::getInfractions($code, $model->fld_sec_reg_no,1);
      
    ?>
        <?php if($data[0] == 'Cleared'){ ?>
               
            <?php }else{
                $eoFlag++;
                $statData='';$remarksData='';
                $x = 0;
               
                
                    foreach($data as $row){
                        foreach($row as $stat=>$remarks){
                        
                        echo '<tr>';

                        if($x == 0){
                            echo '<td rowspan="'.count($data).'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$office.'</td>';
                        }
                        
                        echo '<td>'.$stat.'</td>';
                        echo '<td>'.$remarks.'</td>';
                        echo '<td>'.$dte.'</td>';
                        echo '</tr>';

                        }
                        $x++;
                    }
                // echo '<td>'.$statData.'</td>';
                // echo '<td>'.$remarksData.'</td>';
                // echo '<td>'.$dte.'</td>';

            } ?>
    <?php }
        if($eoFlag == 0)
        {
            echo '<tr>
                <td >&nbsp;&nbsp;&nbsp; EOs</td>
                <td>Cleared</td>
                <td></td>
                <td>'.$dte.'</td>
            </tr>';
        }
    ?>
    <!-- EO-end -->
</table>