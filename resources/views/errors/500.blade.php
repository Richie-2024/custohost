<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} - Error</title>
    
    <!-- Google Font & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f7fafc, #e2e8f0);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: fadeIn 1s ease-in-out;
        }

        .error-container {
            text-align: center;
            max-width: 500px;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            color: #333;
            animation: slideIn 0.8s ease-out;
            transition: transform 0.3s ease-in-out;
        }

        .error-container:hover {
            transform: scale(1.02);
        }

        .error-container h1 {
            font-size: 80px;
            font-weight: 700;
            color: #e53e3e;
            margin: 0;
            animation: bounceIn 1s ease-out;
        }

        .error-container h2 {
            font-size: 24px;
            margin: 15px 0;
            color: #2d3748;
        }

        .error-container p {
            font-size: 16px;
            color: #666;
            margin-bottom: 25px;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn {
            padding: 12px 25px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: #3182ce;
            color: white;
        }

        .btn-primary:hover {
            background: #2b6cb0;
        }

        .btn-secondary {
            background: #e53e3e;
            color: white;
        }

        .btn-secondary:hover {
            background: #c53030;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes bounceIn {
            0% { transform: scale(0.5); opacity: 0; }
            50% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>

<div class="error-container">
    {{-- <h1>Oops!</h1> --}}
    <h2>Something went wrong.</h2>
    <p>We couldn’t complete your request. Please try again or go back.</p>
    <div class="btn-group">
        <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>
        <a href="/" class="btn btn-warning">Home</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
