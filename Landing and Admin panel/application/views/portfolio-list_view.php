<!doctype html>
<head xmlns="http://www.w3.org/1999/html">
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
        <div class="span10">

            <div id="result" class="success"></div>
            <div class="error"> <?php echo validation_errors(); ?><?php echo @$error; ?></div>
            <?= form_open('admin/deleteSelectedPortfolio') ?>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Radio</th>
                    <th>#</th>
                    <th>Name</th>
                    <th>Discription</th>
                    <th>Image</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                </tr>
                </thead>


                <tbody>
                <?php $i = 0;
                foreach ($portfolios as $portfolio) : ?>
                    <?php $entityId = $portfolios[$i]['entity_id']; ?>
                    <tr id="<?php echo $entityId ?>">
                        <?php $flag = 0;
                        foreach ($portfolio as $key => $value) : ?>
                            <?php if (!$flag): ?>
                                <?php $flag++; ?>

                                <td><input name="radio" type="radio"
                                           value="<? echo $entityId; ?>"/>
                                </td>
                                <?php ++$i ?>
                            <?php endif ?>
                            <?php $id = sprintf("%s_%d", $key, $entityId); ?>
                            <?php if ($key == "file_path"): ?>
                                <td id="<?php echo $id ?>" class="<?php echo $key ?>"><img
                                    src="<?php echo base_url($value); ?>"/>
                            <?php else: ?>
                                <td id="<?php echo $id ?>" class="<?php echo $key ?>"><?php echo $value ?>
                            <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
            <button class="btn btn-danger" type="submit">Delete Selected Portfolio</button>
            </form>
            <?= form_open_multipart('admin/addNewPortfolio'); ?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Discription</th>
                    <th>Image</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input type="text" name="name"></td>
                    <td><textarea id="discription_pf" name="discription" cols="3" rows="3"
                                  style="resize: none"></textarea></td>
                    <td><input type="file" name="userfile"></td>
                </tr>
                </tbody>
            </table>
            <button class="btn btn-primary" type="submit">Add New Portfolio</button>
            </form>

        </div>
    </div>
        </div>
    </div>
</body>
</html>
<script>
    function $$(query) {
        return document.querySelectorAll(query);
    }

    window.onload = function () {
        uc = new updateCells({name: "name", type: "text"});
        uc1 = new updateCells({name: "discription", type: "text"});
        uc2 = new updateCells({name: "file_path", type: "file_img"});

    };

    var updateCells = function (cellOptions) {
        this.cellName = cellOptions.name;
        this.cellType = cellOptions.type;
        this.FILE_IMG_TYPE = "file_img";

        this.addInCallback();
        this.addOutCallback();
    };

    updateCells.prototype.getInEvent = function () {
        return "click";
    };

    updateCells.prototype.getOutEvent = function () {
        return "change";
    };

    updateCells.prototype.getInCallback = function (_elem) {
        builder = {};
        return function () {

            switch (this.cellType) {
                case this.FILE_IMG_TYPE:
                    builder = {_tag: "input", _inner: "", _type: "file", value: _elem.value};

                    break;
                default:
                    builder = {_tag: "textarea", _inner: _elem.innerHTML, _type: "text", _value: _elem.value}

            }

            if (_elem.hasChildNodes() && _elem.childNodes[0].tagName != builder._tag.toUpperCase()) {
                _elem.innerHTML = '<' + builder._tag + ' type="' + builder._type + '" value="' + builder._value + '">' + builder._inner + '</' + builder._tag + '>';
                _elem.childNodes[0].focus();
                currentElement = _elem;
                /* console.log(currentElement)*/
            }
        }.bind(this);
    };

    updateCells.prototype.getOutCallback = function (_elem, index) {
        return function () {
            (function () {
                var result = JSON.parse(updateData(_elem, "updatePortfolio", _elem.childNodes[0].value));

                for (var key in result) {
                    var name = $$('.' + key);
                    if (key != "file_path") {
                        name[index].innerHTML = result[key];
                    } else {
                        name[index].innerHTML = '<img  src="/' + result.file_path + '" />';
                        rememberImg = undefined;
                        rememberContainer = undefined;
                    }
                }
                /*                if(typeof(result.file_path) != "undefined") {
                 _elem.innerHTML = '<img src="/' + result.file_path + '" />';
                 } else {

                 }*/

            })();
        }
    };

    updateCells.prototype.getElements = function () {
        return $$("." + this.cellName);
    };

    updateCells.prototype.addInCallback = function () {
        _elements = this.getElements();
        self = this;
        for (i = 0; i < _elements.length; i++) {
            (function (index) {
                _elements[index].addEventListener(self.getInEvent(), self.getInCallback(_elements[index]));

            })(i);
        }
    };

    updateCells.prototype.addOutCallback = function () {
        _elements = this.getElements();
        self = this;
        for (i = 0; i < _elements.length; i++) {
            (function (index) {
                _elements[index].addEventListener(self.getOutEvent(), self.getOutCallback(_elements[index], index));

            })(i);
        }
    };
    var rememberImg, rememberContainer;

    document.body.onclick = function (e) {

        (function checkPortfolioImage(e) {
            var e = e || window.event;
            if (e.path[0].localName == 'img' && rememberImg == undefined) {
                rememberImg = e.path[0];
                rememberContainer = e.path[1];
            } else {
                if (!rememberContainer) {
                    return;
                } else {
                    if (e.target.tagName !== 'INPUT' && e.path[0].className !== 'file_path' && rememberImg !== undefined) {
                        rememberContainer.replaceChild(rememberImg, rememberContainer.childNodes[0]);
                        if (e.path[0].localName == 'img') {
                            rememberImg = e.path[0];
                            rememberContainer = e.path[1];
                        }
                        else {
                            rememberImg = undefined;
                            rememberContainer = undefined;
                        }
                    }

                }
            }
        })();
    }
    ;
    /*event.path[0].tagName != 'INPUT'*/

</script>