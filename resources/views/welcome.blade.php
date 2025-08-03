@extends('layouts.app')
@section('content')
<head>
<link href="/assets/css/main.css" rel="stylesheet">
</head>
<body class="antialiased">
    <main>
        <section class="hero">
            <div class="shape-bg">
                <div class="shape shape1"></div>
                <div class="shape shape2"></div>
                <div class="shape shape3"></div>
            </div>
            <div class="container">
                <h1>Welcome to <span>Skinzy Care</span> Panel</h1>
                <p>
                    The all-in-one solution for efficient system administration.
                    Access all your tools from a single, powerful dashboard.
                </p>
                <a href="{{ route('login') }}" class="btn btn-primary2">Access Your Dashboard</a>
            </div>
        </section>

        <section class="features">
            <div class="container">
                <h2 class="section-title">Key Features</h2>
                <p class="section-subtitle">Everything you need to manage your system effectively.</p>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="icon">📦</div>
                        <h3>Full Product & Stock Control</h3>
                     <p>Easily create, edit, and organize products and categories[cite: 71].The system automatically manages stock levels with every purchase.</p>
                    </div>
                    <div class="feature-card">
                        <div class="icon">🛒</div>
                        <h3>Order & Payment Tracking</h3>
                       <p>Monitor all orders, update their statuses from processing to completion, and securely review bank transfer payments with uploaded proof.</p>
                    </div>
                    <div class="feature-card">
                        <div class="icon">♻️</div>
                        <h3>Safe Content Management</h3>
                       <p>Work confidently with confirmation alerts for sensitive actions , and restore any item accidentally deleted from the Recycle Bin.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="container">
            © {{ date('Y') }} Skinzy Care. All Rights Reserved.
        </div>
    </footer>

</body>
</html>
@endsection
