<!DOCTYPE html>
<html>

<head>
    <title>Birthday for you - CyberFilm</title>
</head>

<body>
    <p>Hi <b>{{ $user->name }}</b>, chúc mừng sinh nhật bạn.</p>
    <br>
    <p>CyberFilm gửi đến bạn mã coupon
        <b>{{ $user->coupon_code }}</b> giảm giá vé 30%</p>
    <p>Vui lòng truy cập vào <a href="http://cyberfilm.tk">Cyberfilm</a> và thực hiện các bước</p>
    <ul>
        <li><b>1. </b>Đăng nhập tài khoản</li>
        <li><b>2. </b>Truy cập vào trang thông tin cá nhân</li>
        <li><b>3. </b>Vào mục "Khuyến mãi của bạn"</li>
        <li><b>4. </b>Nhập mã kích hoạt</li>
    </ul>
    <p>Cyberfilm cảm ơn bạn.</p>
</body>

</html>
