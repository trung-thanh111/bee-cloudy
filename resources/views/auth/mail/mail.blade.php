<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đăng Ký</title>
    <style>
        .button {
            padding: 10px 20px;
            color: white !important;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }
        .button-confirm {
            background-color: #28a745;
        }
         
        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h2>Xác nhận đăng ký</h2>
    <p>Xin chào <strong>{{ $user->name }},</strong></p>
    <p>Vui lòng nhấn vào nút dưới đây để xác nhận đăng ký tài khoản bên <strong>BeeCloud</strong> của bạn:</p>

    <a href="{{ route('confirm.registration', ['token' => $token]) }}" class="button button-confirm">Xác Nhận</a>
    <p>Nếu bạn không đăng ký, hãy bỏ qua email này.</p>
</body>
</html>
