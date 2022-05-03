<!-- Button trigger modal -->
<button type="button" id="confirm-log-out" class="btn btn-primary d-none" data-toggle="modal" data-target="#logoutConfirm">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="logoutConfirm" tabindex="-1" role="dialog" aria-labelledby="logoutConfirmTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered w-50" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="logoutConfirmTitle">Are you sure you want to sign out?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body d-flex justify-content-center align-item-center preview-sign-out">
            <img src="../image/signout.gif" class="preview-sign-out">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="sign-out-yes">Sign Out</button>
            </div>
        </div>
    </div>
</div>