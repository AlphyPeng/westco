<template>
    <div>
        <b-modal :visible="isVisible" title="Create Student Details" size="lg" @hide="closeModal">
            <b-form>
                <div class="fs-5 fw-bold">Personal Details</div>

                <div class="row g-3 mt-1 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">First Name</label>
                        <b-form-input type="text"></b-form-input>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Middle Name</label>
                        <b-form-input type="text"></b-form-input>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Last Name</label>
                        <b-form-input type="text"></b-form-input>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <b-form-input type="text" placeholder="name@example.com"></b-form-input>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact</label>
                        <b-form-input type="text" placeholder="0900-0000-000"></b-form-input>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Membership ID Number</label>
                        <b-form-input type="text"></b-form-input>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Program Name</label>
                        <b-form-input type="text"></b-form-input>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Training Status</label>
                        <b-form-input type="text"></b-form-input>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Start of Training</label>
                        <b-form-input type="date"></b-form-input>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date Completed</label>
                        <b-form-input type="date"></b-form-input>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Training Expiration</label>
                        <b-form-input type="date"></b-form-input>
                    </div>
                </div>
                <!-- 
                <div class="fs-5 fw-bold">Company History</div>
                <div class="fs-5 fw-bold">List of Training Taken</div> -->

            </b-form>

            <template #footer>
                <div class="w-100">
                    <div class="float-end">
                        <b-button variant="secondary" size="sm" class="me-2" @click="closeModal"> Close
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
    props: {
        isVisible: {
            type: Boolean,
            required: true
        }
    },

    methods: {
        closeModal() {
            this.$emit('update:isVisible', false) // also reset if closed by backdrop/esc
        },


    }
}
</script>
<style></style>