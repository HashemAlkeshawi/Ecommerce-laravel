<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .mt-4 {
            margin-top: 2rem;
        }

        .card {
            border: none;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        .text-center {
            text-align: center;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="col-12">
            <div class="text-center">
                <h3 class="mb-4">Dear {{ $user->full_name }},</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    {!! $content !!}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
