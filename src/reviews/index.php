<?php

include '../vendor/autoload.php';

$isAdmin = isset($_GET['admin']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

    <title>LikeIT Reviews</title>
</head>
<body>
<main class="container p-5">
    <div class="row">
        <form id='review' class="needs-validation col-12" novalidate>
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="Aleksei" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="jobsprofileru@gmail.com"
                       required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="text" class="form-label">Text</label>
                <textarea class="form-control" id="text" name="text" placeholder="Required example textarea"
                          required></textarea>
            </div>
            <div class="col-12 mb-3">
                <label for="formFile" class="form-label">File input</label>
                <input class="form-control" type="file" name="images[]" multiple id="formFile">
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
    <div class="row">
        <select onchange="window.setSort(this.value); updateList()" id='sort' class="form-select m-5">
            <option value="DESC">Дата создания по убыванию</option>
            <option value="ASC">Дата создания по возрастанию</option>
        </select>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Текст</th>
                <th scope="col">Картинки</th>
                <?php if ($isAdmin): ?>
                    <th scope="col">Action</th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody id="result">

            </tbody>
        </table>

        <div id="result" class="col-12 p-5"></div>
    </div>
</main>

<div id="ambient" style="overflow:hidden; position:absolute; top:0; left: 0; width:100%; height:100vh; z-index: -1"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="../js/bvambient.js"></script>
<script defer src="../js/script.js"></script>
<script defer src="../js/reviews.js"></script>
</body>
</html>
