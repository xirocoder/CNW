<?php include('flowers.php'); ?>
<?php include('header.php'); ?>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Flowers</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addFlowerModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Thêm hoa</span></a>
                    </div>
                </div>
            </div>
            <form id="flowerForm" method="POST">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
							<th>Tên</th>
							<th>Mô tả</th>
                            <th>Ảnh</th>
							<th>Sửa</th>
							<th>Xóa</th>
						</tr>
                    </thead>
                    <tbody>
                        <?php foreach ($flowers as $index => $flower): ?>
                            <tr>
                                <td><?= htmlspecialchars($flower['name']) ?></td>
                                <td><?= htmlspecialchars($flower['description']) ?></td>
                                <td> <img src="<?php echo $flower['img']?>" alt="" height = 100px width = 100px></td>
                                <td>
                                <a href="#editFlowerModal" class="edit" data-toggle="modal" 
                                    data-index="<?= $index ?>" 
                                    data-name="<?= htmlspecialchars($flower['name']) ?>" 
                                    data-description="<?= htmlspecialchars($flower['description']) ?>" 
                                    data-img="<?= htmlspecialchars($flower['img']) ?>">
                                    <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                </a>
                                </td>
                                <td>
                                <a href="#deleteFlowerModal" class="delete" data-toggle="modal" 
                                    data-index="<?= $index ?>">
                                    <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<!-- Thêm -->
<div id="addFlowerModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm hoa</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ảnh</label>
                        <input type="file" name="img" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="addFlower" class="btn btn-success" value="Add">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Sửa -->
<div id="editFlowerModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Sửa hoa</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="index" id="edit-index">
                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" id="edit-description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ảnh</label>
                        <input type="file" name="img" id="edit-img" class="form-control" accept="image/*">
                        <small class="text-muted">Để trống nếu không muốn thay đổi ảnh</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="editFlower" class="btn btn-info" value="Save Changes">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Xóa -->
<div id="deleteFlowerModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Xóa hoa</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="index" id="delete-index">
                    <p>Bạn có muốn xóa hoa này không?</p>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="deleteFlower" class="btn btn-danger" value="Delete">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    document.querySelectorAll('.edit').forEach(button => {
    button.addEventListener('click', function () {
        const index = this.dataset.index;
        const name = this.dataset.name;
        const description = this.dataset.description;
        const img = this.dataset.img;

        document.getElementById('edit-index').value = index;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-description').value = description;
        document.getElementById('current-img').src = img; // Hiển thị ảnh hiện tại
    });
});
    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('delete-index').value = this.dataset.index;
        });
    });
</script>