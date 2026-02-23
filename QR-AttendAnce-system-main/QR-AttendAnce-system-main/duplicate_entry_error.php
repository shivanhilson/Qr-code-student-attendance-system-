<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error: Duplicate Entry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #04AA6D;
        }

        .container {
            width: 50%;
            margin: 100px auto;
            text-align: center;
        }

        h1 {
            color: #ff0000;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Error: Duplicate Entry</h1>
        <p>The registration number you provided is already used by another student.</p>
        <p>Please go back and try again with a different registration number.</p>
        <a href="javascript:history.go(-1)" class="btn">OK</a>
    </div>
</body>
</html>
