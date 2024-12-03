<div class="container mt-5">
    <h2>Thông tin chi tiết khách hàng</h2>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th scope="row">Họ tên</th>
                <td><?php echo $data['customerDetails']['hoten']; ?></td>
            </tr>
            <tr>
                <th scope="row">Email</th>
                <td><?php echo $data['customerDetails']['email']; ?></td>
            </tr>
            <tr>
                <th scope="row">Số điện thoại</th>
                <td><?php echo $data['customerDetails']['sodienthoai']; ?></td>
            </tr>
            <tr>
                <th scope="row">Địa chỉ</th>
                <td><?php echo $data['customerDetails']['diachi']; ?></td>
            </tr>
            <tr>
                <th scope="row">Tổng tiền đã tiêu dùng</th>
                <td><?php echo number_format($data['customerDetails']['total_spent']); ?> VND</td>
            </tr>
            <tr>
                <th scope="row">Lần tiêu dùng gần nhất</th>
                <td><?php echo $data['customerDetails']['last_purchase']; ?></td>
            </tr>
        </tbody>
    </table>
</div>