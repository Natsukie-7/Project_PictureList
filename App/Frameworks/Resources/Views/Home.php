<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <h1>Home</h1>

    <p>Ola <?php echo $this->getUser()["name"]; ?> Você tem <?php echo $this->getUser()["age"]; ?> Anos</p>
</body>
</html>