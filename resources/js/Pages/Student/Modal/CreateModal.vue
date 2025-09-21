<template>
    <div>
        <b-modal :visible="isVisible" title="Create Student Details" size="lg" @hide="closeModal" centered>
            <b-form>
                <h5 class="card-title">Personal Details</h5>

                <div class="row g-3 mt-1 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">First Name:</label>
                        <b-form-input type="text" v-model="form.first_name" :state="errors.first_name ? false : null">
                        </b-form-input>
                        <div class="invalid-feedback d-block">
                            {{ errors.first_name?.[0] }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Middle Name:</label>
                        <b-form-input type="text" v-model="form.middle_name" :state="errors.middle_name ? false : null">
                        </b-form-input>
                        <div class="invalid-feedback d-block">
                            {{ errors.middle_name?.[0] }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Last Name:</label>
                        <b-form-input type="text" v-model="form.last_name" :state="errors.last_name ? false : null">
                        </b-form-input>
                        <div class="invalid-feedback d-block">
                            {{ errors.last_name?.[0] }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email:</label>
                        <b-form-input type="text" v-model="form.email" placeholder="name@example.com"
                            :state="errors.email ? false : null">
                        </b-form-input>
                        <div class="invalid-feedback d-block">
                            {{ errors.email?.[0] }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact No.:</label>
                        <b-form-input type="text" v-model="form.contact_no" placeholder="09XXXXXXXX"
                            :state="errors.contact_no ? false : null">
                        </b-form-input>
                        <div class="invalid-feedback d-block">
                            {{ errors.contact_no?.[0] }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Membership ID Number:</label>
                        <b-form-input type="text" v-model="form.membership_id"
                            :state="errors.membership_id ? false : null">
                        </b-form-input>
                        <div class="invalid-feedback d-block">
                            {{ errors.membership_id?.[0] }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Program Name:</label>
                        <b-form-input type="text" v-model="form.program_name"
                            :state="errors.program_name ? false : null">
                        </b-form-input>
                        <div class="invalid-feedback d-block">
                            {{ errors.program_name?.[0] }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Training Status:</label>
                        <b-form-input type="text" v-model="form.training_status"
                            :state="errors.training_status ? false : null">
                        </b-form-input>
                        <div class="invalid-feedback d-block">
                            {{ errors.training_status?.[0] }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Start of Training:</label>
                        <b-form-input type="date" v-model="form.start_of_training"
                            :state="errors.start_of_training ? false : null">
                        </b-form-input>
                        <div class="invalid-feedback d-block">
                            {{ errors.start_of_training?.[0] }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date Completed:</label>
                        <b-form-input type="date" v-model="form.date_completed"
                            :state="errors.date_completed ? false : null">
                        </b-form-input>
                        <div class="invalid-feedback d-block">
                            {{ errors.date_completed?.[0] }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Training Expiration:</label>
                        <b-form-input type="date" v-model="form.training_expiration"
                            :state="errors.training_expiration ? false : null"></b-form-input>
                        <div class="invalid-feedback d-block">
                            {{ errors.training_expiration?.[0] }}
                        </div>
                    </div>
                </div>
                <!-- 
                <div class="fs-5 fw-bold">Company History</div>
                <div class="fs-5 fw-bold">List of Training Taken</div> -->

            </b-form>

            <template #footer>
                <div class="w-100">
                    <div class="float-end">
                        <b-button variant="secondary" size="sm" class="me-2" @click="closeModal" :disabled="isLoading">
                            <span v-if="isLoading" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span v-else>Close</span>
                        </b-button>
                        <b-button @click="createStudent" variant="primary" size="sm" :disabled="isLoading">
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
            },

            errors: {}
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

                if (response) {
                    this.clearInputField();
                    this.closeModal();
                    this.$emit('student-lists');
                    this.errors = {};
                }

            } catch (e) {
                if (e.response && e.response.status === 422) {
                    this.errors = e.response.data.errors;
                }

            } finally {
                this.isLoading = false;
            }
        },

        showModal() {
            this.$bvModal.show('my-centered-modal');
        }
    }
}
</script>

<style></style>