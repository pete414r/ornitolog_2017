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
                    <li class="nav-item  active ">
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

        <div class="row ornitologer">
        </div>

        <footer class="row">
            <div class="col-12">
                <p>&copy; Ornitologforeningen</p>
            </div>
        </footer>
    </main>

    <!-- TEMPLATE -->
    <template class="temp-ornitolog">
        <div class="col-12 col-md-6">
            <div class="card">
                <img class="card-img-top ornitolog_img" src="" alt="image cap">
                <div class="card-body">
                    <h4 class="ornitolog_navn card-title"></h4>
                    <p class="ornitolog_bio card-text"></p>
                    <a href="#" class="single_ornitolog btn btn-primary">Læs om ornitologen...</a>
                </div>
            </div>
        </div>
    </template>
    <!-- Ikke mere indhold efter denne linie -->

    <!-- jQuery og popper.js inkluderinger herunder - nødvendigt for Bootstrap  - slet dem ikke-->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="bs/js/bootstrap.min.js"></script>

    <script>
        let apiURL = "http://prfrankild.dk/sem3/wordpress/index.php/wp-json/wp/v2/users/";
        let posts = []; // tom liste

        getPosts();
        // hent JSON og put data ind i posts
        async function getPosts() {
            if (posts.length < 1) {
                let result = await fetch(apiURL, {
                    method: 'get'
                });
                posts = await result.json();
                showPosts();
            }
        }

        // fordel de forskellige typer content til templaten
        function showPosts() {
            let template = document.querySelector(".temp-ornitolog");
            let display = document.querySelector(".ornitologer");
            posts.forEach(function(post) {
                let clone = template.content.cloneNode(true);

                clone.querySelector(".ornitolog_img").src = post.acf.profilfoto;
                clone.querySelector(".ornitolog_navn").textContent = post.name;
                clone.querySelector(".single_ornitolog").href = "ornitolog.php?id=" + post.id;


                var textsummary = post.description;
                if (textsummary.length > 50) {
                    textsummary = textsummary.substring(0, 50)
                };
                clone.querySelector(".ornitolog_bio").innerHTML = textsummary + '...';

                display.appendChild(clone);
            })
        }

    </script>

    </body>

    </html>
