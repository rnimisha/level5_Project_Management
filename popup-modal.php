<!-- Button trigger modal for quick view -->
<button type="button" id="quick-view" class="btn btn-primary d-none" data-toggle="modal"
    data-target="#popProductPreview">
    preview
</button>

<!-- Modal for quick view-->
<div class="modal fade" id="popProductPreview" tabindex="-1" role="dialog" aria-labelledby="popProductPreviewTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="quick-view-body">

            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>

<!-- Button trigger modal for cart success -->
<button type="button" id="item-added-modal" class="btn btn-primary d-none" data-toggle="modal"
    data-target="#popItemAdded">
    preview
</button>

<!-- Modal for cart success -->
<div class="modal fade" id="popItemAdded" tabindex="-1" role="dialog" aria-labelledby="popItemAdded"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content w-50 mx-auto">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row item-added-body d-flex justify-content-center align-items-center mb-4">
                <div class="col-12 text-center mt-n2">
                    <h3 style="color:#78967e; font-weight:bolder;">Item Added To Cart Successfully</h3>
                </div>
                <div class="col-12 text-center mt-n2">
                    <img src="image/cart-add-success.gif" alt="cart-add-success" class="product-pic" />
                </div>
                <div class="col-4 text-center py-3 btn">
                    Continue Shopping
                </div>
                <div class="col-4 text-center ml-1 py-3 btn">
                    Go To Cart
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal for cart success -->
<button type="button" id="item-saved-modal" class="btn btn-primary d-none" data-toggle="modal"
    data-target="#popItemSaved">
    preview
</button>

<!-- Modal for cart success -->
<div class="modal fade" id="popItemSaved" tabindex="-1" role="dialog" aria-labelledby="popItemSaved"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content w-50 mx-auto">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row item-added-body d-flex justify-content-center align-items-center mb-4">
                <div class="col-12 text-center mt-n2">
                    <h3 style="color:#78967e; font-weight:bolder;">Item Saved To Wishlist Successfully</h3>
                </div>
                <div class="col-12 text-center mt-n2">
                    <img src="image/wishlist-icon.gif" alt="wishlist-add-success" class="product-pic" />
                </div>
                <div class="col-4 text-center py-3 btn">
                    Continue Shopping
                </div>
                <div class="col-4 text-center ml-1 py-3 btn">
                    View Wishlist
                </div>
            </div>
        </div>
    </div>
</div>