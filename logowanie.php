<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum o psach</title>
    <link rel="stylesheet" href="styl4.css">
</head>
<body>
    <?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $login = $_POST['login'] ?? '';
        $haslo = $_POST['password'] ?? '';
        $haslo2 = $_POST['password-2'] ?? '';
        


        $pdo = new PDO('mysql:dbname=psy;host=localhost', 'root', '');
        $LoginCheck = $pdo -> query("SELECT * from uzytkownicy WHERE login = '$login'");
        $LoginCheckFetch = $LoginCheck -> fetch();        
        

        
        }
    ?>

    <section id="baner">
        <h1>Forum wielbicieli psów</h1>
    </section>
<section id="main">
    <section id="left-block">
        <img src="obraz.jpg" alt="foksterier">
    </section>
    <section id="right-blocks">
    <section id="right-block">
        <h2>Zapisz się</h2>
            <form action="logowanie.php" method="post" id="form">
                <label for="login-id">login: </label>
                <input type="text" name="login" id="login-id">
                <br>
                <label for="password-id">hasło: </label>
                <input type="password" name="password" id="password-id">
                <br>
                <label for="password-2-id">powtórz hasło: </label>
                <input type="password" name="password-2" id="password-2-id">
                <input type="submit" value="Zapisz">
            </form>
                
                <?php if($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                    <?php if($login == '' or $haslo == '' or $haslo2 == ''): ?>
                        <p>Wypełnij wszystkie pola</p>
                        <?php elseif($LoginCheckFetch): ?>
                            <p>login występuje w bazie danych, konto nie zostało dodane</p>
                    <?php elseif($haslo != $haslo2): ?>
                        <p>hasła nie są takie same, konto nie zostało dodane</p>
                    <?php else:
                        $sha1 = sha1($haslo);    
                        $query = $pdo -> query("INSERT INTO uzytkownicy(login, haslo) VALUES('$login', '$sha1')");
                        $query -> fetch();
                    ?>
                    <p>Konto zostało dodane</p>
                    <?php endif; ?>
                <?php endif; ?>
    </section>
    <section id="right-block-2">
        <h2>Zapraszamy wszystkich</h2>
        <ol>
            <li>właścicieli psów</li>
            <li>weterynarzy</li>
            <li>tych, co chcą kupić psa</li>
            <li>tych, co lubią psy</li>
            <a href="regulamin.html">Przeczytaj regulamin forum</a>
        </ol>
    </section>
    </section>
</section>

    <section id="footer">
        Stronę wykonał: 09220514492
    </section>
    <?php 
        $pdo = null;
    ?>
</body>
</html>