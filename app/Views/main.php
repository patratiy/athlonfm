<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ATHLON FM DEMO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="/assets/dropzone.min.css" rel="stylesheet">
    <link href="/assets/style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="/assets/dropzone.min.js"></script>
    <script src="/assets/script.js"></script>
</head>
<body>
    <div class="container">
        <form action="/file" class="dropzone">
            <div class="fallback">
                <input name="images" type="file" multiple />
            </div>
        </form>

        <div id="carouselExampleControls" class="carousel slide mt-3">
            <div class="carousel-inner">
                {slides_entries}
                <div class="carousel-item {active}">
                    <img class="d-block w-100" src="{url}" alt="{name}">
                </div>
                {/slides_entries}
            </div>
            <a class="carousel-control-prev" href="javascript:;" role="button">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
            </a>
            <a class="carousel-control-next" href="javascript:;" role="button">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>