@extends('layouts.user_side_master')

@section('content')

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title><i class="fas fa-cookie-bite"></i> Payment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Libraries -->
    <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            font-family: 'Cairo', sans-serif;
            color: #000000;
        }

        .payment-container {
            width: 100%;
            height: 80vh;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color: #ffffff;
        }

        .payment-box {
            padding: 50px;
            max-width: 500px;
            width: 100%;
            /* border: #000000 1px solid; */
            text-align: center;
        }

        .payment-box h2 {
            font-size: 24px;
            color: #000000;
            margin-bottom: 15px;
        }

        .payment-box p {
            color: #333333;
            font-size: 16px;
            margin-bottom: 25px;
        }

        .user-info {
            margin-bottom: 10px;
            font-size: 16px;
            color: #555555;
        }

        .user-info i {
            margin-right: 6px;
            color: #000000;
        }

        #card-container {
            margin-bottom: 20px;
            border: 2px dashed #cccccc;
            border-radius: 14px;
            background-color: #ffffff;
            padding: 15px;
            max-width: 100%;
        }

        #card-button {
            background: #ffffff;
            color: rgb(0, 0, 0);
            font-size: 17px;
            border: none;
            border-radius: 10px;
            padding: 14px 30px;
            cursor: pointer;
            border: #000000 1px solid;
            transition: background 0.3s ease;
            width: 100%;
        }

        #card-button i {
            margin-right: 8px;
        }

        .payment-image {
            flex: 1;
            background-image: url('/images/card.png');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            height: 300px;
            max-width: 300px;
            border-radius: 10px;
            object-fit: contain; 
        }

        .footer-note {
            margin-top: 20px;
            font-size: 13px;
            color: #777777;
        }

        .footer-note i {
            margin-right: 6px;
            color: #000000;
        }

    </style>
</head>
<body>

    <!-- Success Sound -->
    <audio id="successSound" src="https://cdn.pixabay.com/download/audio/2022/03/26/audio_4d99c2c71c.mp3?filename=correct-2-46134.mp3" preload="auto"></audio>

    <div class="payment-container">
        <div class="payment-box">

        <!-- Image Section -->
        <div class="payment-image"></div>

        </div>

        <div class="payment-box">
            <!-- User Name -->
            <div class="user-info">
                <i class="fas fa-user"></i> {{ auth()->user()->Fname ?? 'Guest' }}
            </div>

            <h2><i class="fas fa-credit-card"></i> Pay for Your Order</h2>
            <p>Amount Due: <strong>{{ number_format($order_id->total_price, 2) }} $</strong></p>

            <form id="payment-form" method="POST" action="{{ route('process.payment') }}">
                @csrf
                <div id="card-container"></div>
                <input type="hidden" name="order_id" value="{{ $order_id->id }}">
                <input type="hidden" name="amount" value="{{ $order_id->total_price }}">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="nonce" id="card-nonce">
                <button type="submit" id="card-button">
                    <i class="fas fa-credit-card"></i> Pay Now
                </button>
            </form>

            <div class="footer-note">
                <i class="fas fa-lock"></i> Your information is safe and securely processed via Square
            </div>
        </div>
    </div>

    <script>
        async function main() {
            const appId = "{{ $square_app_id }}";
            const locationId = "{{ $square_location_id }}";

            if (!window.Square) {
                alert("Failed to load Square library.");
                return;
            }

            const payments = Square.payments(appId, locationId);
            const card = await payments.card();
            await card.attach('#card-container');

            const form = document.getElementById('payment-form');
            const sound = document.getElementById('successSound');

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                const result = await card.tokenize();

                if (result.status === 'OK') {
                    document.getElementById('card-nonce').value = result.token;

                    try {
                        await sound.play();
                    } catch (err) {
                        console.warn("Sound couldn't play:", err);
                    }

                    form.submit();
                } else {
                    form.submit();
                }
            });
        }

        main();
    </script>
    <!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "{{ session('error') }}",
    });
</script>
@endif

</body>
</html>

@endsection
