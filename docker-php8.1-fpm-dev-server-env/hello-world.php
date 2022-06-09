<?php

echo <<<"HTML"
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello World - by TF</title>
    <style>
        body {
            height: 100vh;
            background: #6e28d9;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .row.d-flex.justify-content-center {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        a {
            color: #fff;
        }

        a:hover {
            color: #fff;
            text-shadow: #000 1px 0px;
        }
    </style>
</head>

<body>

    <div class="row d-flex justify-content-center">
        <div>
            <h1>Hello World!</h1>
            <h2>I am <a href="https://tiagofranca.com" target="_blank">Tiago França</a></h2>
        </div>
        <div>
            <div>
                <a href="//www.linkedin.com/in/tiago-frança/" target="_blank" title="Linkedin">
                    Linkedin
                </a>
            </div>

            <div>
                <a href="//t.me/tiagofrancafernandes" title="Telegram">
                    Telegram
                </a>
            </div>

            <div>
                <a href="//github.com/tiagofrancafernandes" target="_blank" title="GitHub">
                    GitHub
                </a>
            </div>

            <div>
                <a href="//twitter.com/TiagoFOficial" target="_blank" title="Twitter">
                    Twitter
                </a>
            </div>

            <div>
                <a href="//www.facebook.com/Tiago.Franca.Fernandes" target="_blank" title="Facebook">
                    Facebook
                </a>
            </div>
        </div>
    </div>
</body>

</html>
HTML;
