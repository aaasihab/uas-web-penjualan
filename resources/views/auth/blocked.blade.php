<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Diblokir Sementara</title>
    <script>
        function startCountdown(seconds) {
            let countdownElement = document.getElementById("countdown");
            let remainingTime = seconds;

            function updateCountdown() {
                countdownElement.textContent = remainingTime + " detik";
                if (remainingTime > 0) {
                    remainingTime--;
                    setTimeout(updateCountdown, 1000);
                } else {
                    window.location.href = "{{ route('login') }}"; // Redirect ke login saat habis
                }
            }

            updateCountdown();
        }
    </script>
</head>
<body onload="startCountdown({{ $remainingTime }})">
    <h2>Akun Anda Diblokir Sementara</h2>
    <p>Anda telah melebihi batas percobaan login. Silakan coba lagi dalam <span id="countdown"></span>.</p>
</body>
</html>
