<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check Out</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="m-5 bg-dark">
    <div class="row m-5">
        <div class="col-6 offset-3">
            <div class="card">
                <div class="card-header" align="center">
                    <h3 class="text-info">Please Select Your CheckOut TIme</h3>
                    <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                </div>
                <div class="card-body" align="center">
                    <div class="row">
                        <div class="col-12">
                            @if (session('error'))
                                <div class="alert alert-{{ Session::get('class') }} p-3">

                                    {{ Session::get('error') }}
                                </div>
                            @endif

                            @if (count($errors) > 0)

                                <div>
                                    <div class="alert alert-danger pt-3 pl-0   border-3">
                                        <p class="font-weight-bold"> There were some problems with your input.</p>
                                        <ul>

                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                            @endif
                            <canvas id="canvas" width="400" height="400" style="background-color:#333">
                            </canvas>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4 offset-4">
                            <form action="{{ url('saveCheckOut') }}" method="POST">
                                @csrf
                                <label class="mb-2" for=""><strong>Choose CheckOut Time</strong></label>
                                <input type="time" name="checkOutTime" class="form-control"
                                    value="{{ Carbon\Carbon::now('Asia/Dubai')->format('H:i') }}" id=""
                                    max="{{ Carbon\Carbon::now('Asia/Dubai')->format('H:i') }}">
                                <div class="d-flex justify-content-end mt-2">
                                    <button type="submit" class="btn btn-primary">Check OUT & Logout</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");
        let radius = canvas.height / 2;
        ctx.translate(radius, radius);
        radius = radius * 0.90
        setInterval(drawClock, 1000);

        function drawClock() {
            drawFace(ctx, radius);
            drawNumbers(ctx, radius);
            drawTime(ctx, radius);
        }

        function drawFace(ctx, radius) {
            const grad = ctx.createRadialGradient(0, 0, radius * 0.95, 0, 0, radius * 1.05);
            grad.addColorStop(0, '#333');
            grad.addColorStop(0.5, 'white');
            grad.addColorStop(1, '#333');
            ctx.beginPath();
            ctx.arc(0, 0, radius, 0, 2 * Math.PI);
            ctx.fillStyle = 'white';
            ctx.fill();
            ctx.strokeStyle = grad;
            ctx.lineWidth = radius * 0.1;
            ctx.stroke();
            ctx.beginPath();
            ctx.arc(0, 0, radius * 0.1, 0, 2 * Math.PI);
            ctx.fillStyle = '#333';
            ctx.fill();
        }

        function drawNumbers(ctx, radius) {
            ctx.font = radius * 0.15 + "px arial";
            ctx.textBaseline = "middle";
            ctx.textAlign = "center";
            for (let num = 1; num < 13; num++) {
                let ang = num * Math.PI / 6;
                ctx.rotate(ang);
                ctx.translate(0, -radius * 0.85);
                ctx.rotate(-ang);
                ctx.fillText(num.toString(), 0, 0);
                ctx.rotate(ang);
                ctx.translate(0, radius * 0.85);
                ctx.rotate(-ang);
            }
        }

        function drawTime(ctx, radius) {
            const now = new Date();
            let hour = now.getHours() - 1;
            let minute = now.getMinutes();
            let second = now.getSeconds();
            //hour
            hour = hour % 12;
            hour = (hour * Math.PI / 6) +
                (minute * Math.PI / (6 * 60)) +
                (second * Math.PI / (360 * 60));
            drawHand(ctx, hour, radius * 0.5, radius * 0.07);
            //minute
            minute = (minute * Math.PI / 30) + (second * Math.PI / (30 * 60));
            drawHand(ctx, minute, radius * 0.8, radius * 0.07);
            // second
            second = (second * Math.PI / 30);
            drawHand(ctx, second, radius * 0.9, radius * 0.02);
        }

        function drawHand(ctx, pos, length, width) {
            ctx.beginPath();
            ctx.lineWidth = width;
            ctx.lineCap = "round";
            ctx.moveTo(0, 0);
            ctx.rotate(pos);
            ctx.lineTo(0, -length);
            ctx.stroke();
            ctx.rotate(-pos);
        }
    </script>

</body>

</html>
