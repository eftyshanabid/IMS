<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Square Payment Gateway</title>

    <!-- BOOTSTRAP -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            background: #f7f7f7;
        }

        .form-box {
            max-width: 500px;
            margin: auto;
            padding: 50px;
            background: #ffffff;
            border: 10px solid #f2f2f2;
            margin-top: 100px;
        }

        h1, p {
            text-align: center;
        }

        input, textarea {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="form-box">
    <h1>Pay with Square</h1>
    <form action="{{ route('checkout.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input class="form-control" id="product_name" type="text" name="product_name">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input class="form-control" id="quantity" type="number" name="quantity">
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input class="form-control" id="amount" type="number" name="amount">
        </div>
        <input class="btn btn-primary" type="submit" value="Submit" />
    </form>
</div>
</body>
</html>
