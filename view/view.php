<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Once Time Message</title>

    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/style.css">

</head>

<body>

    <div class="container">
        <div class="header">
            <h1>
                LOGO
            </h1>
        </div>
        <div class="wrap">
            <div class="alert alert-danger" role="alert">
                This is a danger alert—check it out!
            </div>
            <?php if($isValid) echo ($body) ?>
            <?php if(!$isValid){ ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo($msg); ?>
                </div>
                <button class="btn btn-primary btn-home">Go To Home</button>
            <?php } ?>
        </div>
    </div>

    <script src="assets/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <script src="assets/crypt.min.js"></script>
    <script type="text/javascript" src="assets/utils.js"></script>
    <script type="text/javascript" src="assets/index.js"></script>
</body>

</html>