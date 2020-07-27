@extends("mail.layout")

@section("body")
    <table role="presentation" class="main">
        <tr>
            <td class="wrapper">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <p style="text-align:center !important; padding-bottom: 10px !important;font-weight: bold !important; color: black !important; font-size: 22px !important;">THÔNG TIN THAY ĐỔI MẬT KHẨU</p>
                            <p>Kính gửi Quý Khách hàng:</p>
                            <p style="font-weight: bold !important; color: red !important; font-size: 16px !important;"> {{ $full_name ?? '' }}</p>
                            <p>Tài khoản Quý Khách đã thay đổi mật khẩu thành công.</p>
                            <p>Thông tin thay đổi mật khẩu của Quý Khách như sau:</p>
                            <p style="font-weight: bold !important;">Mật Khẩu: <span style="font-weight: 100;">{{$password}}</span></p>
                            <p>Nhấn nút <span>
                                <a class="btn-primary" href="{{ url('/login') }}" target="_blank">Đăng Nhập</a> để sử dụng dịch vụ.</span>
                            </p>
                            <p>Cảm ơn Quý Khách đã quan tâm và sử dụng dịch vụ của chúng tôi. Nếu cần hổ trợ vui lòng liên hệ trực tiếp với chúng tôi theo số điện thoại
                                <span><a href="tel:0987654321">0987654321</a></span></p>
                            <p>Trân trọng!</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection
