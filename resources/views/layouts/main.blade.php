<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Wash</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: auto;
        }
        nav {
            background-image: url('');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            width: 100%;

        }

        footer {
            background-image: url('https://as1.ftcdn.net/v2/jpg/06/20/45/56/1000_F_620455663_LNZDty26BhDMVMNJTPXqfS7rDg6fIl0L.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin-top: auto;
        }
    </style>
<body>
<header>
    @include('layouts.header')
</header>
<main>
    @yield('content')
</main>
<footer>
    @include('layouts.footer')
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById('reserve-type').addEventListener('change', function () {
        var reserveType = this.value;
        var dayTimeFields = document.getElementById('day-time-fields');
        var reserveTimeFields = document.getElementById('reserve-time-fields');

        if (reserveType === 'fastest') {
            dayTimeFields.style.display = 'none';
            reserveTimeFields.style.display = 'none';
        } else {
            dayTimeFields.style.display = 'block';
            reserveTimeFields.style.display = 'block';
        }
    });
    document.getElementById('service_type').addEventListener('change', function () {
        var serviceType = this.value;
        var reserveTimeSelect = document.getElementById('reserve-time');
        reserveTimeSelect.innerHTML = '';

        var startTime = 9;
        var endTime = 21;
        var interval = 15;

        if (serviceType === 'interior-cleaning') {
            interval = 20;
        } else if (serviceType === 'zero-washing') {
            interval = 60;
        }
        for (var hour = startTime; hour < endTime; hour++) {
            for (var minute = 0; minute < 60; minute += interval) {
                var time = hour + ':' + (minute === 0 ? '00' : minute);
                var option = document.createElement('option');
                option.value = time;
                option.textContent = time;
                reserveTimeSelect.appendChild(option);
            }
        }
    });

</script>
</body>
</html>
