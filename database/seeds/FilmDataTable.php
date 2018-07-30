<?php

use Illuminate\Database\Seeder;

class FilmDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('films')->insert([
            [
                'name' => 'Tranformer 2',
                'image' => 'transformers-poster.jpg',
                'description' => 'Trong thế giới của Transformers, từ xa xưa tồn tại một thực thể giống như đấng tạo hóa, gọi là The One, vị thần này đã tạo ra 3 thực thể bao gồm Quintessa cùng với 2 song sinh là Unicron và Primus. Unicron và Primus, Quintessa còn được gọi là "the Creator" (Đấng Tạo Hóa) – người tạo ra các Transformers.

                Trong đó Primus là người tạo ra 13 vị Prime (Hiệp sĩ Cybertron), những vị tổ tiên xa xưa của robot biến hình Transformers, mà Optimus Prime là một trong những hậu duệ và cũng là vị Prime cuối cùng còn sống sót.

                The Fallen là một trong 13 vị Prime xa xưa, người mạnh hơn 12 anh em của mình. Cuối cùng để tránh The Fallen hủy diệt trái đất, 12 vị Prime thua trận đã chọn cách hy sinh để phong ấn The Matrix. (phần 2, Revenge of The Fallen)

                Optimus Prime còn có tên gọi khác là Nemesis Prime. Nemesis Prime được biết đến như một nhân vật độc lập và đóng vai trò là bản sao độc ác của Optimus. Optimus Prime biến thành Nemesis Prime bởi thuật thôi miên “ác hóa” của Quintessa.

                Ngược lại với Primus, vốn là vị thần lương thiện, thì người anh em song sinh Unicron lại là bản thể hung ác, đại diện cho hỗn mang trong vũ trụ. Unicron có kích thước vô cùng khổng lồ và có thể biến hình thành một hành tinh, chuyên đi tiêu diệt và ăn những hành tinh khác, hắn từng ăn hết hơn 20% số hành tinh tồn tại trong vũ trụ.',
                'description' => 'Rap chieu xin, dep, tien nghi',
                'open_date' => '12/08/2018',
                'duration' => '90',
                'trailer_url' => 'https://www.youtube.com/watch?v=AntcyqJ6brc',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Xác Sống Phần 2',
                'image' => 'Fear-the-Walking-Dead-Season-4-Hackstore.Net_-1.jpg',
                'description' => 'Phim lấy bối cảnh lấy tại thành phố LA - Hoa Kỳ, phim kể về một thầy giáo nam đã ly hôn với cô vợ, là một hướng dẫn viên du lịch, và 2 đứa con của mình, ngoài ra còn một người cháu gái. Sự lây nhiễm thây ma bắt nguồn từ gia đình anh này, và mở ra 1 tương lai đầy u ám đối với nền văn minh nhân loại...',
                'open_date' => '20/07/2018',
                'duration' => '120',
                'trailer_url' => 'https://youtu.be/tXSOuPOBGMM',
                'type' => 2,
                'status' => 1,
            ],
        ]);
    }
}
