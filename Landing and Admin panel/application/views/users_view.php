<!doctype html>
<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-responsive.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin-page.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery-2.1.1.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/ajax.js'); ?>"></script>

    <meta charset="utf-8">
<body>
<div class="container-fluid span10">
    <div class="span10">
        <?php $this->load->view('menu') ?>
        <div class="span10" >
            <!--Delete user;-->
            <div class="error"> <?php echo validation_errors(); ?></div>
            <div id="result" class="success"></div>
            <?= form_open('admin/deleteSelectedUser'); ?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Radio</th>
                    <th>#</th>
                    <th>Name</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>DateCreated</th>
                    <th>DateUpdated</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0;
                foreach ($users as $user) : ?>
                    <tr>
                        <?php $flag = 0;
                        foreach ($user as $key => $someValue) : ?>
                            <?php if (!$flag): ?>
                                <?php $flag++; ?>
                                <?php $entityId = $users[$i]['entity_id']; ?>
                                <td><input name="radio" type="radio" value="<? echo $entityId ?>"/></td>
                                <?php ++$i ?>
                            <?php endif ?>
                            <td id="<?php echo sprintf("%s_%d", $key, $entityId); ?>"
                                class="<?php echo $key ?>"><?php echo $someValue ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <button class="btn btn-danger" type="submit">Delete Selected User</button>
            </form>
            <!--Add user;-->
            <form method="post" action="<? echo base_url('index.php/admin/addNewUser'); ?>">
                <table class="table ">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Login</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="text" name="name"></td>
                        <td><input type="text" name="login"></td>
                        <td><input type="text" name="email"></td>
                        <td><input type="text" name="password"></td>
                    </tr>
                    </tbody>
                </table>
                <button class="btn btn-primary" type="submit">Add New User</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<script>
    window.onload = function () {
        function $$(query) {
            return document.querySelectorAll(query);
        }


        function resave(name) {
            var name = $$('.' + name);
            for (i = 0; i < name.length; i++) {
                (function (index) {
                    _name = name[index];
                    _name.onclick = function () {
                        if (this.hasChildNodes() && this.childNodes[0].tagName != "TEXTAREA") {
                            this.innerHTML = '<textarea name="' + this.className + '" value="' + this.innerHTML + '">' + this.innerHTML + '</textarea>';
                            this.childNodes[0].focus();
                        }
                    }

                    _name.addEventListener('focusout', function () {
                        addNewValue(this);
                        updateData(this);
                    });
                })(i);
            }
        }


        function addNewValue(elem) {
            if (elem.childNodes[0].value == "") {
                _inner = '<p></p>';
            } else {
                _inner = elem.childNodes[0].value;
            }
            elem.innerHTML = _inner;
        }

        resave("name");
        resave("login");
        resave("email");

    }

</script>