<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = md5($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email, $pass]);
    $rowCount = $stmt->rowCount();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($rowCount > 0) {

        if ($row['user_type'] == 'admin') {

            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
        } elseif ($row['user_type'] == 'user') {

            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
        } else {
            $message[] = 'no user found!';
        }
    } else {
        $message[] = 'incorrect email or password!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="css/lo.css">


</head>

<body>

    <?php

    if (isset($message)) {
        foreach ($message as $message) {
            echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
        }
    }

    ?>


    <html lang="en">

    <head>
        <title>Login 10</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style3.css">
        <script nonce="115d6d2e-ff46-4716-8e97-142aad8b05d9">
            (function(w, d) {
                ! function(f, g, h, i) {
                    f[h] = f[h] || {};
                    f[h].executed = [];
                    f.zaraz = {
                        deferred: [],
                        listeners: []
                    };
                    f.zaraz.q = [];
                    f.zaraz._f = function(j) {
                        return function() {
                            var k = Array.prototype.slice.call(arguments);
                            f.zaraz.q.push({
                                m: j,
                                a: k
                            })
                        }
                    };
                    for (const l of ["track", "set", "debug"]) f.zaraz[l] = f.zaraz._f(l);
                    f.zaraz.init = () => {
                        var m = g.getElementsByTagName(i)[0],
                            n = g.createElement(i),
                            o = g.getElementsByTagName("title")[0];
                        o && (f[h].t = g.getElementsByTagName("title")[0].text);
                        f[h].x = Math.random();
                        f[h].w = f.screen.width;
                        f[h].h = f.screen.height;
                        f[h].j = f.innerHeight;
                        f[h].e = f.innerWidth;
                        f[h].l = f.location.href;
                        f[h].r = g.referrer;
                        f[h].k = f.screen.colorDepth;
                        f[h].n = g.characterSet;
                        f[h].o = (new Date).getTimezoneOffset();
                        if (f.dataLayer)
                            for (const s of Object.entries(Object.entries(dataLayer).reduce(((t, u) => ({
                                    ...t[1],
                                    ...u[1]
                                }))))) zaraz.set(s[0], s[1], {
                                scope: "page"
                            });
                        f[h].q = [];
                        for (; f.zaraz.q.length;) {
                            const v = f.zaraz.q.shift();
                            f[h].q.push(v)
                        }
                        n.defer = !0;
                        for (const w of [localStorage, sessionStorage]) Object.keys(w || {}).filter((y => y.startsWith("_zaraz_"))).forEach((x => {
                            try {
                                f[h]["z_" + x.slice(7)] = JSON.parse(w.getItem(x))
                            } catch {
                                f[h]["z_" + x.slice(7)] = w.getItem(x)
                            }
                        }));
                        n.referrerPolicy = "origin";
                        n.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(f[h])));
                        m.parentNode.insertBefore(n, m)
                    };
                    ["complete", "interactive"].includes(g.readyState) ? zaraz.init() : f.addEventListener("DOMContentLoaded", zaraz.init)
                }(w, d, "zarazData", "script");
            })(window, document);
        </script>
    </head>

    <body class="img js-fullheight" style="background-image: url(images/bg4.jpg);">
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5">
                        <h2 class="heading-section">Login</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                            <h3 class="mb-4 text-center">Have an account?</h3>
                            <form action="#" class="signin-form" method="POST">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control box" placeholder="Enter Your Email" required>
                                </div>
                                <div class="form-group">
                                    <input id="password-field" name="pass" type="password" class="form-control" placeholder="Password" required>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="login Now" name="submit" class="form-control btn btn-primary submit px-3">
                                  
                                    <p class="mb-4 text-center w-100 ogin-wrap p-0">don't have an account? <a href="register.php">register now</a></p>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"793a4edb5a8431b1","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2022.11.3","si":100}' crossorigin="anonymous"></script>
    </body>

    </html>


</body>

</html>