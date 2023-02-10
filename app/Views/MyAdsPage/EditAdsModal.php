<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">Edit Your Ad</h5>
                <button id="buttonCloseEditModal" type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="edit-form">
                    <div class="modal-body">
                        <input type="number" id="hiddenAdIdEditAdModal" hidden>
                        <div class="form-group">
                            <img class="img-fluid rounded" id="AdEditImageURI">
                            <label for="image"><strong>Change Image</strong> </label><br>
                            <input type="file" class="form-control-file" id="AdEditImageInput" name="image" accept="image/png, image/jpeg,image/jpg" onchange="previewImage(this)">
                        </div>
                        <div class="form-group">
                            <label for="productName"> <strong>Product Name</strong></label>
                            <input type="text" class="form-control" id="AdEditProductName" name="productName">
                        </div>
                        <div class="form-group">
                            <label for="price"><strong>Price</strong></label>
                            <input type="number" class="form-control" id="AdEditPrice" name="price">
                        </div>
                        <div class="form-group">
                            <label for="description"><strong>Description</strong></label>
                            <textarea class="form-control" id="AdEditDescription" name="description" rows="7"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="reset" class="btn btn-secondary" data-bs-dismiss="modal" value="cancel">
                <button type="submit" class="btn btn-primary" onclick="editAdModalSaveChangeButtonClicked()">Save Changes</button>
            </div>
        </div>
    </div>
</div>