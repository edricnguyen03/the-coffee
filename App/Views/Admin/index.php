<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ WEBSITE</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/1c4a893c55.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../resources/css/admin.css">
    <link href="../resources/main.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <?php
        require_once('./App/Views/Admin/layouts/header.php');
        ?>
        <div class="main">
            <?php
            require_once('./App/Views/Admin/pages/home.php');
            require_once('./App/Views/Admin/layouts/footer.php');
            ?>
        </div>
    </div>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../resources/js/script.js"></script>
</body>

</html>