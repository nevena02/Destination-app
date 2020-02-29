<?php
    include "dbconfig/konekcija.php";
    //$sql="SELECT * FROM vrsta";
    //$rezultat=mysqli_query($con,$sql);
    $sve_vrste=Vrsta::vratiVrstu();

        //popunim formu podacima , kliknuto dugme dodaj putovanje (name=submit)
    if (isset($_POST['submit'])) {
    $vrsta_id=$_POST['vrsta'];
    $naslov = $_POST['naslov'];
    $sadrzaj = $_POST['sadrzaj'];
    

    $sql2 = "INSERT INTO putovanje (naslov, sadrzaj, vrsta_id) VALUES ('" . $naslov . "','" . $sadrzaj . "','" . $vrsta_id . "')";
    if(mysqli_query($con,$sql2)){
        $msg = "Uspešno dodata putovanje.";
      } else {
        $msg = "Greška prilikom dodavanja.";
      }
    }  
?>

<?php
class Vrsta{
    public static function vratiVrstu(){
        global $con;
        $sql = "SELECT * FROM vrsta";
        $rezultat=mysqli_query($con,$sql);
        $niz=[];
            while($red=$rezultat->fetch_object()){
                $niz[] =$red;
            }
            return $niz;
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
					<center><h2>Dodaj putovanje</h2></center>
				</div>
			</div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?php
                    include "includes/navbar.php";
                 ?>
            </div>

        <div class="row dodaj_putovanje">
            <div class="col-lg-8 "></div>
            <div class="col-lg-8 ">
            <?php if (isset($msg)) { ?>
                            <div class="alert alert-info">
                            <?php echo $msg;  ?>
                            </div>
                        <?php } ?>
                        
                <form action="" method="POST">
                    <select name="vrsta" id="vrsta_id" class="form-control">
                        <option value="">Izaberi vrstu..</option>
                        <?php
                            for($i=0; $i<count($sve_vrste); $i++){
                        ?>
                            <option value="<?php echo $sve_vrste[$i]->id; ?>"><?php echo $sve_vrste[$i]->naziv; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <input type="text" id="naslov" name="naslov" class="form-control" placeholder="Unesi naslov">
                    <textarea name="sadrzaj" id="sadrzaj" cols="30" rows="10" class="form-control" placeholder="Unesi sadrzaj"></textarea>
                    <br>
                    <input type="submit" id="submit" name="submit" value="Dodaj putovanje" class="btn btn-success">
                </form>
            </div>
            <div class="col-lg-8"></div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>