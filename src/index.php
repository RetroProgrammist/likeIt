<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">

    <title>LikeIT tasks</title>
</head>
<body>
    <main class="d-flex align-items-center vh-100 p-5">
        <div class="d-flex align-items-start justify-content-center align-items-stretch w-100">
            <div class="nav flex-column nav-pills border rounded-2 bg-info-subtle me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="task-1-tab" data-bs-toggle="pill" data-bs-target="#task-1" type="button" role="tab" aria-controls="task-1" aria-selected="true">Task 1</button>
                <button class="nav-link" id="task-2-tab" data-bs-toggle="pill" data-bs-target="#task-2" type="button" role="tab" aria-controls="task-2" aria-selected="false">Task 2</button>
                <button class="nav-link" id="task-3-tab" data-bs-toggle="pill" data-bs-target="#task-3" type="button" role="tab" aria-controls="task-3" aria-selected="false">Task 3</button>
                <button class="nav-link" id="task-4-tab" data-bs-toggle="pill" data-bs-target="#task-4" type="button" role="tab" aria-controls="task-4" aria-selected="false">Task 4</button>
                <div><a class="nav-link-mock" href="./reviews/" target="_blank">Task 5</a></div>
            </div>
            <div class="tab-content w-50" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="task-1" role="tabpanel" aria-labelledby="task-1-tab" tabindex="0"><?php include(__DIR__ . '/tasks/1.html') ?></div>
                <div class="tab-pane fade" id="task-2" role="tabpanel" aria-labelledby="task-2-tab" tabindex="0"><?php include(__DIR__ . '/tasks/2.html') ?></div>
                <div class="tab-pane fade" id="task-3" role="tabpanel" aria-labelledby="task-3-tab" tabindex="0"><?php include(__DIR__ . '/tasks/3.html') ?></div>
                <div class="tab-pane fade" id="task-4" role="tabpanel" aria-labelledby="task-4-tab" tabindex="0"><?php include(__DIR__ . '/tasks/4.html') ?></div>
            </div>
        </div>
    </main>
    <div id="ambient" style="overflow:hidden; position:absolute; top:0; left: 0; width:100%; height:100vh; z-index: -1"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="./js/bvambient.js"></script>
    <script defer src="./js/script.js"></script>
</body>
</html>
