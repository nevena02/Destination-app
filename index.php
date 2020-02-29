<?php
    include "dbconfig/konekcija.php";

    $sql="SELECT * FROM vrsta";
    $rezultat=mysqli_query($con,$sql);

    $sql2="SELECT * FROM putovanje";
    $rezultat2=mysqli_query($con,$sql2);
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
<body >
 
    
    
    <div class="container">
        <div class="row sortiraj_putovanja">
			<div class="col-g-12">
				<div class="page-header">
					<h2>Pročitaj o svim putovanjima i pretraži</h2>
				</div>
			</div>
		</div>

        <div class="row">
            <div class="col-lg-3">
                <?php include "includes/navbar.php";?>
            </div>

            <div class="col-lg-6">
                <h2>Putovanja</h2>
                <div id="sva_putovanja">
                    <div class="row">

                        <div class="col-sm-12 col-md-12">
                                <div class="thumbnail">
                                    <img src="imgs/majorka.jpeg" alt="...">
                                    <div class="caption">
                                        <h3>Letuj u Španiji</h3>
                                            <p>Majorka je najveće ostrvo u Španiji. Nalazi se u Sredozemnom moru i deo je arhipelaga Balearska ostrva. 
                                            Kao i druga Balearska ostrva, Ibiza, Formentera i Menorka, ostrvo je popularna turistička destinacija.
                                            </p>
                                        <p><a href="https://www.kontiki.rs/sr/location/majorka/hotels" class="btn btn-primary" role="button">Saznaj više</a> </p>
                                    </div>
                                </div>
                        </div>
                         <hr>
                        <div class="col-sm-12 col-md-12">
                                <div class="thumbnail">
                                    <img src="imgs/egipatH.jpg" alt="...">
                                    <div class="caption">
                                        <h3>Uživaj u predivnoj Hurgadi</h3>
                                        <p>Hurgada predstavlja biser egipatske obale, zbog bogatstva biljnog i životinjskog sveta pa su turisti koji iz 
                                        godine u godinu u sve većem broju posećuju ovo prelepo letovalište na Crvenom moru sa razlogom nadenuli naziv “more sa sedam boja”
                                        </p>
                                        <p><a href="https://www.ponte.rs/putovanja/letovanje/egipat/hurgada?gclid=Cj0KCQiA9dDwBRC9ARIsABbedBNfB06Ie75t05Q4eqM8UdxVF1IuRw_148NRR3ywQwMxIqelsJ8PROQaAq9OEALw_wcB" class="btn btn-primary" role="button">Saznaj više</a> </p>
                                    </div>
                                </div>
                        </div>

                        <?php while($red2=$rezultat2->fetch_object()){ ?>
                            <div class="col-lg-12">
                                <h3><?php echo $red2->naslov ?></h3>
                                <p><h4><?php echo $red2->sadrzaj ?></h4></p>
                                <hr>
                             </div>
                        <?php } ?>
                
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <h2>Sortiraj</h2>
                <select name="vrsta" id="vrsta" class="form-control">
                        <option value="999">Izaberi vrstu..</option>
                        <?php
                        //na osnovu ovoga popunim padajuci meni u sortiraj podacima iz baze
                            while($red=$rezultat->fetch_object()){
                        ?>
                            <option value="<?php echo $red->id; ?>"><?php echo $red->naziv; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                <br>
                <p>Pretraži po naslovu: </p>
                <input type="text" id="pretraga" name="pretraga" class="form-control" placeholder="Unesi naslov">
                <br>
                <button onclick="sortiraj();" class="btn btn-primary btn-block">Sortiraj na sledeći način</button>
           </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <script>
		function sortiraj() {
			//pokupimo vrednosti iz polja pomocu jquery-a
			var vrsta=$("#vrsta").val();
			var pretraga=$("#pretraga").val();

            $.post( "pretraga.php", { vrstaP: vrsta, pretragaP: pretraga })
                .done(function( data ) {
			    $("#sva_putovanja").html(data);      //ono sto vrati ova petlja iz pretrage.php treba da upisemo na pocetnoj strani (index, putovanja - div-sve_vesti) i prikazemo putovanja
            });
		}
	</script>

</body>
</html>