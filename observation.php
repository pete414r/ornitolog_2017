<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- Tilføj dit indhold under denne linie -->

    <header class="container">
        <section class="logosektion row">
            <div class="logo col-2 col-md-1">
                <a href="index.php"><img src="imgs/kea.png" alt="kea fugl" class="img-fluid"></a>
            </div>
            <div class="tagline col-10 col-md-5">
                <h1>Ornitologforeningen</h1>
            </div>
            <div class="col-12 col-md-6">
                <form class="form-inline justify-content-end" name="loginform" id="loginform" action="http://prfrankild.dk/sem3/ornitolog/wp-login.php" method="post">

                    <div class="form-group">
                        <label for="brugernavn" class="sr-only">Brugernavn</label>
                        <input type="text" class="input form-control" id="brugernavn" placeholder="Brugernavn" name="log" id="user_login" aria-describedby="login_error">
                    </div>

                    <div class="form-group mx-sm-3">
                        <label for="psw" class="sr-only">Password</label>
                        <input type="password" class="input form-control" id="psw" placeholder="Password" name="pwd" id="user_pass" aria-describedby="login_error">
                    </div>

                    <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary" value="Log ind" />
                    <input type="hidden" name="redirect_to" value="http://prfrankild.dk/sem3/ornitolog/wp-admin/" />
                    <input type="hidden" name="testcookie" value="1" />

                </form>
            </div>
        </section>
        <nav class="navbar navbar-expand-lg sticky-top navbar-light justify-content-end bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="index.php">home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="observationer.php">observationer</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="ornitologer.php">ornitologer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="omos.php">om os</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontakt.php">kontakt</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <main class="container">

        <div class="row observation">
            <!-- dynmaisk data vis template -->
        </div>

        <footer class="row">
            <div class="col-12">
                <p>&copy; Ornitologforeningen</p>
            </div>
        </footer>
    </main>

    <!-- Ikke mere indhold efter denne linie -->

    <!-- TEMPLATE -->
    <template class="temp-observation">
        <div class="col-12">
            <h2 class="observationtitle"></h2>
        </div>
        <div class="col-12 col-md-6">
            <img class="observationimg img-fluid" src="" alt="">
        </div>
        <div class="col-12 col-md-6">
            <dl class="row">
                <dt class="col-sm-3">Ornitolog: </dt>
                <dd class="col-sm-9 observator"></dd>
                <dt class="col-sm-3">Lokalitet: </dt>
                <dd class="col-sm-9 lokalitet"></dd>
                <dt class="col-sm-3">Fuglenavn: </dt>
                <dd class="col-sm-9 fuglenavn"></dd>
                <dt class="col-sm-3">Dato:</dt>
                <dd class="col-sm-9 observationdate"></dd>
                <dt class="col-sm-3">Beskrivelse:</dt>
                <dd class="col-sm-9 observationcontent"></dd>
            </dl>
            <div class="observationcontent"></div>
        </div>
    </template>

    <!-- jQuery og popper.js inkluderinger herunder - nødvendigt for Bootstrap  - slet dem ikke-->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="bs/js/bootstrap.min.js"></script>

    <script>
        let url = new URL(window.location.href);
        let searchParams = new URLSearchParams(url.search);
        let id = searchParams.get("id");
        let apiURL = "http://prfrankild.dk/sem3/wordpress/wp-json/wp/v2/observationer/" + id;
        let post; // tom var

        getPost();
        async function getPost() {
            let result = await fetch(apiURL);
            post = await result.json();
            showPost();
        }

        function showPost() {
            let template = document.querySelector(".temp-observation");
            let display = document.querySelector(".observation");
            let clone = template.content.cloneNode(true);

            clone.querySelector(".observationimg").src = post.acf.foto;
            clone.querySelector(".observationtitle").textContent = post.title.rendered;
            clone.querySelector(".observator").textContent = post.acf.ornitolog;
            clone.querySelector(".lokalitet").textContent = post.acf.lokation;
            clone.querySelector(".fuglenavn").textContent = post.acf.fuglenavn;
            clone.querySelector(".observationdate").textContent = post.acf.dato;
            clone.querySelector(".observationcontent").innerHTML = post.acf.beskrivelse;

            display.appendChild(clone);
        }

    </script>

    </body>

    </html>
