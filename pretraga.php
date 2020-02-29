<?php
    include "dbconfig/konekcija.php";
    
    if(isset($_POST['pretragaP']) && isset($_POST['vrstaP']) ){         //ako su popunjena ova dva polja, onda dodeli vrednosti iz polja pomocu POST
    $pretraga=$_POST['pretragaP'];                                     //superglobalne promenljive - POST I GET
    $vrsta = $_POST['vrstaP'];
   
    $pretraga=trim($pretraga);        

    if($vrsta = 999 && empty($pretraga)){      
        $sql="SELECT * FROM putovanje";
    } else if($vrsta != 999 && empty($pretraga)){
        //SORTIRAJ PO vrsti putovanja
        $sql = "SELECT * FROM putovanje WHERE vrsta_id='$vrsta'";
    } else if($vrsta = 999 && !empty($pretraga)){
        //SORTIRAJ PO NASLOVU %STRING%
        $sql = "SELECT * FROM putovanje WHERE naslov LIKE '%$pretraga%' ORDER BY id DESC";
    } else{
        $sql = "SELECT * FROM putovanje WHERE vrsta_id='$vrsta' AND naslov LIKE '%$pretraga%' ORDER BY id DESC";
    }

   $rezultat = mysqli_query($con,$sql);
?>

    <div class="row">
    <!--pretraga po naslovu-->
        <?php while($red=$rezultat->fetch_object()){ ?>
            <div class="col-lg-12">
                <h3><?php echo $red->naslov ?></h3>
                <p><h4><?php echo $red->sadrzaj ?></h4></p>
                <hr>
            </div>
        <?php } ?>
    </div>  
    <?php 
}
?>