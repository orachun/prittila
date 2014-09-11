<div class="guest-contents">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#signup" data-toggle="tab">สมัครสมาชิก</a></li>
        <li><a href="#signin" data-toggle="tab">ลงชื่อเข้าใช้</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="signup">

            <div class="register-form">
                <br/>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="input-email" class="col-sm-3 control-label">อีเมล์</label>
                        <div class="col-sm-9">
                            <input name="email" type="email" class="form-control" id="input-email" placeholder="อีเมล์" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-pass" class="col-sm-3 control-label">รหัสผ่าน</label>
                        <div class="col-sm-9">
                            <input name="pass" type="password" class="form-control" id="input-pass" placeholder="รหัสผ่าน" required minlength="6">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input-fullname" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
                        <div class="col-sm-9">
                            <input name="fullname" type="text" class="form-control" id="input-fullname" placeholder="ชื่อ-นามสกุล" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input-addr" class="col-sm-3 control-label">ที่อยู่ในการจัดส่งสินค้า</label>
                        <div class="col-sm-9">
                            <textarea name="addr" type="text" class="form-control" id="input-addr" placeholder="ที่อยู่ในการจัดส่งสินค้า" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input-tel" class="col-sm-3 control-label">โทรศัพท์</label>
                        <div class="col-sm-9">
                            <input name="tel" type="text" class="form-control" id="input-tel" placeholder="โทรศัพท์" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-primary signup-btn">สมัครสมาชิก</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="tab-pane" id="signin">
            <div class="login-form">
                <br/>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="input-email" class="col-sm-2 control-label">อีเมล์</label>
                        <div class="col-sm-10">
                            <input name="email" type="email" required class="form-control" id="input-email" placeholder="อีเมล์">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-pass" class="col-sm-2 control-label">รหัสผ่าน</label>
                        <div class="col-sm-10">
                            <input name="pass" type="password" class="form-control" id="input-pass" placeholder="รหัสผ่าน" minlength="6" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox"> จำฉันไว้
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary signin-btn">ลงชื่อเข้าใช้</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
