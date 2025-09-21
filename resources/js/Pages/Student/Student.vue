<template>
    <div>
        <page-title :heading="heading" :icon="icon" action-label="Create" @create-new-click="openModal"></page-title>

        <b-card title="Student Lists" class="main-card mb-4">
            <div class="table-controls mb-3">
                <b-row class="align-items-center">
                    <b-col md="6">
                        <div class="d-flex align-items-center">
                            <label class="form-label me-2 mb-0">Show:</label>
                            <b-form-select v-model="perPage" :options="[
                                { value: 5, text: '5' },
                                { value: 10, text: '10' },
                                { value: 25, text: '25' },
                                { value: 50, text: '50' }
                            ]" size="sm" style="width: auto"></b-form-select>
                            <span class="ms-2 text-muted">entries</span>
                        </div>
                    </b-col>
                    <b-col md="6">
                        <div class="d-flex justify-content-end">
                            <b-form-input v-model="filter" type="text" size="sm" placeholder="Search..."
                                style="width: 200px"></b-form-input>
                        </div>
                    </b-col>
                </b-row>
            </div>

            <div v-if="isLoading" class="text-center my-3">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <b-table v-else class="text-center" :items="data" :fields="fields" :striped="true" :bordered="true"
                :hover="true" :responsive="true" show-empty>

                <!-- Custom slot for actions column -->
                <template #cell(actions)="data">
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary btn-sm" @click="editItem(data.item)">
                            <font-awesome-icon icon="edit" />
                        </button>
                        <button class="btn btn-outline-info btn-sm" @click="editItem(data.item)">
                            <font-awesome-icon icon="eye" />
                        </button>
                        <button class="btn btn-outline-danger btn-sm" @click="deleteItem(data.item)">
                            <font-awesome-icon icon="trash" />
                        </button>
                    </div>
                </template>

                <!-- No data -->
                <template #empty>
                    <div class="text-center my-2">
                        <p class="lead">No data to display.</p>
                    </div>
                </template>
            </b-table>
        </b-card>

        <!-- Modal -->
        <CreateModal v-model:isVisible="isCreateModal" @student-lists="getStudentLists"></CreateModal>
    </div>
</template>

<script>
import axios from 'axios';
import PageTitle from '../../Layout/Components/PageTitle.vue';

import CreateModal from './Modal/CreateModal.vue';

export default {
    components: {
        PageTitle,
        CreateModal
    },

    data() {
        return {
            heading: 'Student',
            icon: 'pe-7s-study icon-gradient bg-premium-dark',

            isLoading: false,
            isCreateModal: false,

            fields: [
                { key: 'full_name', label: 'Name' },
                { key: 'program_name', label: 'Program' },
                { key: 'start_of_training', label: 'Start of Training' },
                { key: 'date_completed', label: 'Date Completed' },
                { key: 'training_status', label: 'Training Status' },
                { key: 'training_expiration', label: 'Training Expiration' },
                { key: 'actions', label: 'Action' },
            ],
            data: [],
        }
    },

    mounted() {
        this.getStudentLists();
    },

    methods: {
        openModal() {
            this.isCreateModal = true;
        },

        async getStudentLists() {
            this.isLoading = true;

            try {
                const response = await axios.get('/api/student/get_student_lists')

                this.data = response.data.data;

            } catch (e) {

            } finally {
                this.isLoading = false;
            }
        }
    }
}
</script>
<style></style>