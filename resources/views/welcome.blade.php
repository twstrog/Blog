<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .loading {
            --uib-size: 40px;
            --uib-color: rgb(18, 92, 141);
            --uib-speed: 1.5s;
            --dot-size: calc(var(--uib-size) * 0.17);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            height: var(--uib-size);
            width: var(--uib-size);
            animation: smoothRotate calc(var(--uib-speed) * 1.8) linear infinite;
        }

        .dot {
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            height: 100%;
            width: 100%;
            animation: rotate var(--uib-speed) ease-in-out infinite;
        }

        .dot::before {
            content: '';
            height: var(--dot-size);
            width: var(--dot-size);
            border-radius: 50%;
            background-color: var(--uib-color);
            transition: background-color 0.3s ease;
        }

        .dot:nth-child(2),
        .dot:nth-child(2)::before {
            animation-delay: calc(var(--uib-speed) * -0.835 * 0.5);
        }

        .dot:nth-child(3),
        .dot:nth-child(3)::before {
            animation-delay: calc(var(--uib-speed) * -0.668 * 0.5);
        }

        .dot:nth-child(4),
        .dot:nth-child(4)::before {
            animation-delay: calc(var(--uib-speed) * -0.501 * 0.5);
        }

        .dot:nth-child(5),
        .dot:nth-child(5)::before {
            animation-delay: calc(var(--uib-speed) * -0.334 * 0.5);
        }

        .dot:nth-child(6),
        .dot:nth-child(6)::before {
            animation-delay: calc(var(--uib-speed) * -0.167 * 0.5);
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            65%,
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes smoothRotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>


</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="loading">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>
</body>

</html>
