<?php
include 'vendor/autoload.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>LikeIT install</title>
</head>
<body>
<?php
$DB = \Rzhanau\Main\DataManager\DB::getInstance('likeit');

if(\Rzhanau\Main\DataManager\DBInstall::install($DB)) {
    echo '<div class="text-bg-success p-3">DB INSTALLED</div>';
} else {
    echo '<div class="text-bg-danger  p-3">DB ERROR</div>';
}
?>
</body>
