<template>
    <div>
        <b-modal :visible="isVisible" title="Create Student Details" size="lg" @hide="closeModal">
            <b-form>
                <div class="fs-5 fw-bold">Personal Details</div>

                <b-button variant="primary" @click="makeToast('primary')" class="mb-2">Primary</b-button>


                <div class="row g-3 mt-1 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">First Name:</label>
                        <b-form-input type="text" v-model="form.first_name"></b-form-input>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Middle Name:</label>
                        <b-form-input type="text" v-model="form.middle_name"></b-form-input>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Last Name:</label>
                        <b-form-input type="text" v-model="form.last_name"></b-form-input>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email:</label>
                        <b-form-input type="text" v-model="form.email" placeholder="name@example.com"></b-form-input>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact No.:</label>
                        <b-form-input type="text" v-model="form.contact_no" placeholder="0900-0000-000"></b-form-input>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Membership ID Number:</label>
                        <b-form-input type="text" v-model="form.membership_id"></b-form-input>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Program Name:</label>
                        <b-form-input type="text" v-model="form.program_name"></b-form-input>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Training Status:</label>
                        <b-form-input type="text" v-model="form.training_status"></b-form-input>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Start of Training:</label>
                        <b-form-input type="date" v-model="form.start_of_training"></b-form-input>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date Completed:</label>
                        <b-form-input type="date" v-model="form.date_completed"></b-form-input>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Training Expiration:</label>
                        <b-form-input type="date" v-model="form.training_expiration"></b-form-input>
                    </div>
                </div>
                <!-- 
                <div class="fs-5 fw-bold">Company History</div>
                <div class="fs-5 fw-bold">List of Training Taken</div> -->

            </b-form>

            <template #footer>
                <div class="w-100">
                    <div class="float-end">
                        <b-button variant="secondary" size="sm" class="me-2" @click="closeModal">
                            <span v-if="isLoading" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span v-else>Close</span>
                        </b-button>
                        <b-button @click="createStudent" variant="primary" size="sm">
                            <span v-if="isLoading" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span v-else>Save changes</span>
                        </b-button>
                    </div>
                </div>
            </template>
        </b-modal>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    props: {
        isVisible: {
            type: Boolean,
            required: true
        }
    },

    data() {
        return {
            isLoading: false,

            form: {
                first_name: null,
                middle_name: null,
                last_name: null,
                email: null,
                contact_no: null,
                membership_id: null,
                program_name: null,
                training_status: null,
                start_of_training: null,
                date_completed: null,
                training_expiration: null
            }
        }
    },

    methods: {
        closeModal() {
            this.$emit('update:isVisible', false);
        },

        clearInputField() {
            this.form = {
                first_name: null,
                middle_name: null,
                last_name: null,
                email: null,
                contact_no: null,
                membership_id: null,
                program_name: null,
                training_status: null,
                start_of_training: null,
                date_completed: null,
                training_expiration: null
            }
        },

        async createStudent() {
            this.isLoading = true;

            try {
                const response = await axios.post('/api/student/create_student',
                    this.form
                )

                this.clearInputField;

            } catch (e) {

            } finally {
                this.isLoading = false;
            }
        }
    }
}
</script>
<style></style>