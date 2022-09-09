<?php
    session_start();

    if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
    {
        header('Location: glowna.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pl">

	<head>
		<meta charset="utf-8">
		<title>Logistics Workspace</title>
		<meta name="author" content="Ryszard Babula">
		<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="shortcut icon" href="img/logistic.png">
	</head>

	<body>
        
        <div id="glowny">

            <div id="logo">
                <img src="img/HitachiLogo.jpg" class="center">
            </div>
            <div style="clear:both;"></div>

            <br><br><br>
            
            <div class="glowneokno">
    	        <div id="container" >
            	    <form action="zaloguj.php" method="post">
                	    <input type="text" name="uzytkownik" placeholder="użytkownik" onfocus="this.placeholder=''" onblur="this.placeholder='użytkownik'" class="center">
    	                <br>
    	                <input type="password" name="haslo" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'" class="center">
    		            <br><br>
    		            <input type="submit" value="Zaloguj się" class="center">
    		        </form>
	
                    <?php
                        if(isset($_SESSION['blad']))
                            echo $_SESSION['blad'];
                    ?>

                    <div style="clear:both;"></div>
                    
                </div>
            </div>
        </div>
    </body>
	
</html>

