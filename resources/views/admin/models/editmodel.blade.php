<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="companydata">
                    @csrf
                    <input type="hidden" id="gouvernement_id" name="gouvernement_id" value="">
                    <input type="text" id="gouvernement" name="gouvernement" value="">
                    </label><br>
                    <input type="submit" value="Submit" id="submit" class="btn btn-sm btn-outline-danger py-0 submitedit" style="font-size: 0.8em;">
                </form>
            </div>
        </div>
    </div>
</div> 