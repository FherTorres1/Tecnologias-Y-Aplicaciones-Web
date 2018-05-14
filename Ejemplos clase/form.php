<html>
<head>
    <title>Formulario en PHP7</title>
</head>

<body>
<?php


    require('programacion.php');
    $usuario = new Usuario("","","","","");
    if (isset($_POST['submit'])) 
    {
        $usuario -> name = $_POST['name'];
        $usuario -> email = $_POST['email'];
        $usuario -> website = $_POST['website'];
        $usuario -> comment = $_POST['comment'];
        if(isset($_POST['gender']))
        {
            $usuario -> gender = $_POST['gender'];   
        }
        
        $usuario->validate();
    }
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="name" value="<?php echo $usuario->name;?>">
    <span class="error">* <?php echo $usuario->nameErr;?></span>
    <br><br>
    E-mail: <input type="text" name="email" value="<?php echo $usuario->email;?>">
    <span class="error">* <?php echo $usuario->emailErr;?></span>
    <br><br>
    Website: <input type="text" name="website" value="<?php echo $usuario->website;?>">
    <span class="error"><?php echo $usuario->webSiteErr;?></span>
    <br><br>
    Comment: <textarea name="comment" rows="5" cols="40"><?php echo $usuario->comment;?></textarea>
    <br><br>
    Gender:
    <input type="radio" name="gender" <?php if (isset($gender) && $usuario->gender=="female") echo "checked";?> value="female">Female
    <input type="radio" name="gender" <?php if (isset($gender) && $usuario->gender=="male") echo "checked";?> value="male">Male
    <span class="error">* <?php echo $usuario->genderErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
    
    
        $usuario->showValues();
?>

<ul>
    <li><a href="#">Volver al Inicio</a></li>
</ul>
</body>
</html>