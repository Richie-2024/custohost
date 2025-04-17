<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
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
        .search-container {
            margin-top: 20px;
        }
        .search-bar {
            padding: 10px 15px;
            font-size: 16px;
            width: 70%;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            margin-bottom: 10px;
        }
        .btn-search {
            padding: 10px 20px;
            background-color: #38b2ac;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
            border: none;
        }
        .btn-search:hover {
            background-color: #2c7a7b;
        }
        .error-img {
            margin-top: 20px;
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>
<div class="error-container">
    <h1>404</h1>
    <h2>Page Not Found</h2>
    <p>Sorry, the page you are looking for might have been moved or deleted, or you might have typed the URL incorrectly.</p>
    <p>Please check the URL or go back to the homepage.</p>
    <a href="{{ url('/') }}" class="btn">Go to Homepage</a>
    <div class="search-container">
        <input type="text" class="search-bar" placeholder="Search for something..." />
        <button class="btn-search" onclick="alert('Search functionality can be implemented here!')">Search</button>
    </div>
    <img src="https://via.placeholder.com/150" alt="Error Image" class="error-img">
</div>
</body>
</html>
