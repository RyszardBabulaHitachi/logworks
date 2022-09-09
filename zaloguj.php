<?php

	session_start();
	
	if ((!isset($_POST['uzytkownik'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$uzytkownik = $_POST['uzytkownik'];
		$haslo = $_POST['haslo'];
		
		$uzytkownik = htmlentities($uzytkownik, ENT_QUOTES, "UTF-8");
		//$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		//sprintf("SELECT * FROM uzytkownicy WHERE uzytkownik='$uzytkownik' AND haslo='$haslo'",
        sprintf("SELECT * FROM uzytkownicy WHERE uzytkownik='$uzytkownik'"),
		//mysqli_real_escape_string($polaczenie,$uzytkownik),
		//mysqli_real_escape_string($polaczenie,$haslo))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
                $wiersz = $rezultat->fetch_assoc();
                
                if (password_verify($haslo, $wiersz['haslo']))
                {
                    $_SESSION['zalogowany'] = true;
                    $_SESSION['id'] = $wiersz['id'];
                    $_SESSION['data_sys'] = $wiersz['data_sys'];
                    $_SESSION['uzytkownik'] = $wiersz['uzytkownik'];
                    $_SESSION['imie'] = $wiersz['imie'];
                    $_SESSION['nazwisko'] = $wiersz['nazwisko'];
                    unset($_SESSION['blad']);
                    $rezultat->free_result();
                    header('Location: glowna.php');
                }
                else
                {
                    $_SESSION['blad'] = '<span style="color:red" text-align:center>Nieprawidłowy użytkownik lub hasło!</span>';
                    header('Location: index.php');
                }
			} else 
                {
                    $_SESSION['blad'] = '<span style="color:red text-align:center">Nieprawidłowy użytkownik lub hasło!</span>';
                    header('Location: index.php');
			     }
			
		}
		
		$polaczenie->close();
	}
	
?>