<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
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
                <h3 class="mb-4">Welcome, {{ $user->full_name }}!</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        We're excited to have you as part of our community. Your journey with us begins now, and we're here to provide you with an exceptional experience every step of the way.
                    </p>
                    <p class="card-text">
                        Should you have any questions, need assistance, or want to learn more about our offerings, please don't hesitate to reach out to our support team.
                    </p>
                    <p class="card-text">
                        Thank you for choosing us. We look forward to serving you and making your experience memorable.
                    </p>
                    <div class="text-center mt-4">
                        <p class="mb-0">Best regards,</p>
                        <p>Your Team</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
