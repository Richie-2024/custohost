<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>405 - Method Not Allowed</title>
    <style>

        * {
            margiortortn: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f9fafb;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .error-container {
            background-color: white;
            padding: 40px 60px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        .error-container h1 {
            font-size: 6rem;
            font-weight: 700;
            color: #e53e3e;
        }

        .error-container h2 {
            font-size: 1.75rem;
            margin: 20px 0;
            color: #4a5568;
        }

        .error-container p {
            font-size: 1.1rem;
            color: #718096;
            margin-bottom: 30px;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .actions .btn-home,
        .actions .btn-back {
            padding: 12px 20px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 5px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .actions .btn-home {
            background-color: #3182ce;
            color: white;
        }

        .actions .btn-home:hover {
            background-color: #2b6cb0;
        }

        .actions .btn-back {
            background-color: #edf2f7;
            color: #4a5568;
        }

        .actions .btn-back:hover {
            background-color: #e2e8f0;
        }


    </style>
</head>
<body>
<div class="error-container">
    <div class="error-message">
        <h1>405</h1>
        <h2>Method Not Allowed</h2>
        <p>The method you used is not allowed for this URL. Please check the request and try again.</p>
    </div>
    <div class="actions">
        <a href="/" class="btn-home">Go to Homepage</a>
        <a href="javascript:history.back()" class="btn-back">Go Back</a>
    </div>
</div>
</body>
</html>
