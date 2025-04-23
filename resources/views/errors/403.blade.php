<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .error-container {
            text-align: center;
            max-width: 600px;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            color: #333;
        }
        .error-container h1 {
            font-size: 120px;
            font-weight: 700;
            color: #e53e3e;
            margin: 0;
        }
        .error-container h2 {
            font-size: 24px;
            margin: 20px 0;
        }
        .error-container p {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #3182ce;
            color: #fff;
            font-size: 18px;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #2b6cb0;
        }
        .btn-secondary {
            background-color: #edf2f7;
            color: #2d3748;
            border: 1px solid #e2e8f0;
        }
        .btn-secondary:hover {
            background-color: #e2e8f0;
        }
        .logo-container {
            margin-bottom: 20px;
        }
        .logo-container img {
            height: 150px;
        }
        .innovation-text h3 {
            color: black;
            font-weight: bolder;
            margin-top: 0px;
        }
    </style>
</head>
<body>
<div class="error-container">
    <div class="logo-container">
        <img src="/images/innov_logo.png" alt="CustoHost Logo">
    </div>
    <div class="innovation-text">
        <h3>CustoHost</h3>
    </div>
    <h1>403</h1>
    <h2>Unauthorized Access</h2>
    <p style="color:#d91919"><b>You do not have permission to access this resource
            .</b></p>
    <p>If you believe this is an error, please contact support or return to the homepage.</p>
    <a href="{{ url('/') }}" class="btn">Go to Homepage</a>
    <a href="#" class="btn btn-secondary">Contact Support</a>
</div>
</body>
</html>
