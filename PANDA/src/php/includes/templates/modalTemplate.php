<template id="modalTemplate">
    <div class="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="w-100 d-flex flex-column text-center">
                        <h3 class="modal-title fw-bold"></h3>
                        <h5 class="modal-title text-secondary"></h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btnLink">Mais</button>
                </div>
            </div>
        </div>
    </div>
</template>