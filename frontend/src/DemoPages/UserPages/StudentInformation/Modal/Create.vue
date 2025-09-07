<template>
    <div>
        <b-modal ref="modal1" id="modal1" title="BootstrapVueNext Modal" hide-footer :z-index="1055">
            <p class="my-4">Hello from BootstrapVueNext modalss!</p>
            <b-form>
                <div class="mb-3">
                    <label for="exampleEmail" class="form-label">Email</label>
                    <b-form-input id="exampleEmail" type="email" placeholder="with a placeholder"></b-form-input>
                </div>
            </b-form>
            <template #modal-footer>
                <div class="w-100">
                    <div class="float-end">
                        <b-button variant="secondary" size="sm" class="me-2" @click="$refs.modal1.hide()"> Close
                        </b-button>
                        <b-button variant="primary" size="sm">Save changes</b-button>
                    </div>
                </div>
            </template>
        </b-modal>
    </div>
</template>
<script>
export default {

}
</script>
<style></style>