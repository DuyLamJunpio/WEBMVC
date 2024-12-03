
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <h3 class="col">Hồ Sơ Của Tôi</h3>
            <div class="col d-flex flex-row-reverse mb-2">
                <button id="editButton" type="button" style="border: none"><i class='bx bx-edit'></i></button>
            </div>
        </div>
        <hr>
        <form action="" method="POST">
            <div class="row">
                <div class="col-sm-3 d-flex align-items-center">
                    <p class="mb-0">Full Name</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0 content"><?php echo $data['user']['hoten'] ?></p>
                    <input type="text" name="fullname" class="form-control text-muted mb-0 edit"
                        value="<?php echo $data['user']['hoten'] ?>" style="display: none;">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3 d-flex align-items-center">
                    <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0 content"><?php echo $data['user']['email'] ?></p>
                    <input type="email" name="email" class="form-control text-muted mb-0 edit"
                        value="<?php echo $data['user']['email'] ?>" style="display: none;">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3 d-flex align-items-center">
                    <p class="mb-0">Username</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0 content"><?php echo $data['user']['tendangnhap'] ?></p>
                    <input type="text" name="age" class="form-control text-muted mb-0 edit"
                        value="<?php echo $data['user']['tendangnhap'] ?>" style="display: none;">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3 d-flex align-items-center">
                    <p class="mb-0">Phone</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0 content"><?php echo $data['user']['sodienthoai'] ?></p>
                    <input type="text" name="phone" class="form-control text-muted mb-0 edit"
                        value="<?php echo $data['user']['sodienthoai'] ?>" style="display: none;">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3 d-flex align-items-center">
                    <p class="mb-0">Sex</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0 content">
                        <?php
                        if ($data['user']['gioitinh'] == 0) {
                            echo 'Nam';
                        } elseif ($data['user']['gioitinh'] == 1) {
                            echo 'Nữ';
                        } else {
                            echo 'Khác';
                        }
                        ?>
                    </p>
                    <input type="text" name="phone" class="form-control text-muted mb-0 edit"
                        value="<?php echo $data['user']['gioitinh'] == 0 ? 'Nam' : ($data['user']['gioitinh'] == 1 ? 'Nữ' : 'Khác'); ?>"
                        style="display: none;">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3 d-flex align-items-center">
                    <p class="mb-0">Address</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0 content"><?php echo $data['user']['diachi'] ?></p>
                    <input type="text" name="address" class="form-control text-muted mb-0 edit"
                        value="<?php echo $data['user']['diachi'] ?>" style="display: none;">
                </div>
            </div>
            <div class="d-flex flex-row-reverse mt-2">
                <button type='submit' id="save" class='btn btn-success ms-2' style="display: none;">Save</button>
                <button type="button" id="cancel" class='btn btn-secondary' style="display: none;">Cancel</button>
            </div>
        </form>
    </div>
</div>