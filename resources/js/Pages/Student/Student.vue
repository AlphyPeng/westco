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

            <b-table :items="users" :fields="fields" :striped="true" :bordered="true" :hover="true" :responsive="true"
                show-empty>
                <template #empty>
                    <div class="text-center my-2">
                        <p class="lead">No data to display.</p>
                    </div>
                </template>
            </b-table>
        </b-card>

        <!-- Modal -->
        <CreateModal v-model:isVisible="isCreateModal"></CreateModal>
    </div>
</template>

<script>
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

            isCreateModal: false,

            fields: [
                { key: 'name', label: 'Name' },
                { key: 'program_name', label: 'Program' },
                { key: 'start_of_training', label: 'Start of Training' },
                { key: 'date_completed', label: 'Date Completed' },
                { key: 'training_status', label: 'Training Status' },
                { key: 'trainig_expiration', label: 'Training Expiration' },
                { key: 'action', label: 'Action' },
            ],
            // Define the data to be displayed in the table
            users: [
                { id: 1, name: 'John Doe' },
                { id: 2, name: 'Jane Smith' },
                { id: 3, name: 'Peter Jones' },
                { id: 4, name: 'Alice Brown' },
                { id: 4, name: 'Alice Brown' },
                { id: 4, name: 'Alice Brown' },
                { id: 4, name: 'Alice Brown' },
                { id: 4, name: 'Alice Brown' },
            ],
        }
    },

    methods: {
        openModal() {
            this.isCreateModal = true;
        },
    }
}
</script>
<style></style>