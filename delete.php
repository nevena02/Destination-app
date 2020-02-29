<?php
include "dbconfig/konekcija.php";
$sql2="SELECT * FROM putovanje";
$rezultat2=mysqli_query($con,$sql2);

//da li postoji
    //vadimo parametar vrsta_id pomocu get metode
    if(isset($_GET['vrsta_id'])){
        $vrsta_id=$_GET['vrsta_id'];
        $sql="DELETE FROM putovanje WHERE id= '$vrsta_id'";
        if(mysqli_query($con,$sql)){
            echo "Ušpesno obrisano!";
        }else{
            echo "Došlo je do greške prilikom brisanja.";
        }
    }

?> 




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      <!--responzivnost-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Koferče</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">
        <div class="row">
			<div class="col-g-12">
				<div class="page-header">
					<center><h2>Obriši putovanje</h2></center>
				</div>
			</div>
		</div>

        <div class="row">
            <div class="col-lg-3">
                <?php
                    include "includes/navbar.php";
                 ?>
            </div>

        <div class="row izmeni_putovanje">
            <div class="col-lg-8 "></div>
            <div class="col-lg-8 ">
                <form action="" method="POST">
                <select name="putovanje" id="putovanje" class="form-control">
                        <option value="">Izaberi putovanje..</option>
                        <?php
                             //prikazi sve nase vesti iz baze u padajucem meniju , koristeci na pocetku navedeni upit
                            while($red2=$rezultat2->fetch_object()){
                        ?>
                            <option value="<?php echo $red2->id; ?>"><?php echo $red2->naslov ; ?></option>
                        <?php
                            }
                        ?>                           
                       
                    </select>
                    <br>
                    <button type="button"  onclick="obrisi();" class="btn btn-danger btn-block" >Obriši</button>
                </form>
            </div>
            <div class="col-lg-8 "></div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    
    <script>
        //funkcija se poziva klikom na dugme obrisi 
        function obrisi() {
            //kad se prikaze padajuci meni sa izborom, izvucem id pomocu JQUERY-ja
           var vrsta_id=$("#putovanje").val();
           $.get( "delete.php?vrsta_id="+vrsta_id, function( data ) {
                alert( data );
            });

        }
    </script>
</body>
</html>