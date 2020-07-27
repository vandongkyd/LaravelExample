@extends("mail.layout")

@section("body")
    <table role="presentation" class="main">
        <tr>
            <td class="wrapper">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <p style="text-align:center !important;padding-bottom: 10px !important;font-weight: bold !important; color: black !important; font-size: 22px !important;">THÔNG TIN CẤP LẠI MẬT KHẨU</p>
                            <p>Kính gửi Quý Khách</p>

                            <p>Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu của bạn. Nếu bạn không thực hiện yêu cầu chỉ cần bỏ qua email này.</p>

                            <p>Nếu không bạn có thể đặt lại mật khẩu của mình bằng liên kết dưới</p>

                            <p>Nhấn nút <span>
                                <a class="btn-primary" href="{{ route('change.password.id',["id" => $id]) }}" target="_blank">Đặt Lại Mật Khẩu</a> để thay đổi lại mật khẩu.</span>
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
