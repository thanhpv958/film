<?php

use Illuminate\Database\Seeder;

class NewDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
            [
                'title' => 'ROBOT ĐẠI CHIẾN 5: CHIẾN BINH CUỐI CÙNG',
                'image' => 'transformers-poster.jpg',
                'body' => '"Chiến Binh Cuối Cùng" phá nát những huyền thoại cốt lõi của loạt phim Transformers, và tái định nghĩa thế nào là anh hùng. Con người và các Transformer đang có chiến tranh, Optimus Prime đã biến mất. Chìa khóa để cứu tương lai của chúng ta đang được chôn vùi trong những bí mật của quá khứ, trong lịch sử ẩn còn được giữ kín của các Transformer trên Trái Đất.

                Trách nhiệm cứu thế giới đè lên vai của một đồng minh đặc biệt: Cade Yeager, người máy Bumblebee, một quý tộc Anh, và một Giáo sư đại học Oxford Trong đời ai cũng có khoảnh khắc chúng ta được chọn để tạo nên sự khác biệt. Trong Transformer: Chiến Binh Cuối Cùng, kẻ ác trở thành anh hùng. Anh hùng sẽ trở thành kẻ thủ ác. Chỉ một thế giới được tồn tại: của họ, hoặc của chúng ta.',
                'type' => 1,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'title' => 'COUPON ƯU ĐÃI THÁNG 7 - 2018',
                'image' => 'Remind-Coupon-T7_350-X-495.jpg',
                'body' => 'Sử dụng ngay coupon đặc biệt được đính kèm ngay trong lịch của tháng Bảy dành riêng cho các khách hàng sở hữu bộ lịch độc quyền CGV 2018 nhé!

                - Tặng 30.000 VND áp dụng cho 01 phần Combo Phim Đặc Biệt khi mua vé bất kỳ

                Điều kiện và điều khoản:

                - Coupon có giá trị từ 01/07/2018 đến 31/07/2018.

                - Coupon không được quy đổi thành tiền mặt hoặc mua bán.

                - Mỗi coupon chỉ áp dụng cho 01 lần giao dịch.

                - Coupon được áp dụng tại tất cả các rạp CGV trên toàn quốc.

                - Không áp dụng đồng thời với các chương trình khuyến mãi khác tại CGV',
                'type' => 2,
                'status' => 1,
                'user_id' => 1,
            ],
        ]);
    }
}
