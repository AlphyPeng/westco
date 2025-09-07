<template>
    <div>
        <page-title :heading="heading" :subheading="subheading" :icon="icon" action-type="dashboard"
            @create-new-click="openModal"></page-title>

        <!-- Modal -->
        <b-modal ref="modal1" id="modal1" title="Create New Item" hide-footer :z-index="1055">
            <b-form>
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <b-form-input type="text"></b-form-input>
                </div>
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <b-form-input type="text"></b-form-input>
                </div>
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <b-form-input type="text"></b-form-input>
                </div>
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <b-form-input type="text"></b-form-input>
                </div>

            </b-form>
            <template #modal-footer>
                <div class="w-100">
                    <div class="float-end">
                        <b-button variant="secondary" size="sm" class="me-2" @click="closeModal">Close</b-button>
                        <b-button variant="primary" size="sm" @click="saveItem">Save changes</b-button>
                    </div>
                </div>
            </template>
        </b-modal>

        <b-card title="Interactive Data Table" class="main-card mb-4">
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

            <b-table :items="paginatedItems" :fields="tableFields" :striped="striped" :bordered="bordered"
                :hover="hover" :small="small" :dark="dark" :responsive="responsive" :show-empty="showEmpty"
                empty-text="No data available" class="mb-0">
                <!-- Custom slot for status column -->
                <template #cell(status)="data">
                    <span :class="getStatusClass(data.value)" class="badge">
                        {{ data.value }}
                    </span>
                </template>

                <!-- Custom slot for actions column -->
                <template #cell(actions)="data">
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary btn-sm" @click="editItem(data.item)">
                            <font-awesome-icon icon="edit" />
                        </button>
                        <button class="btn btn-outline-danger btn-sm" @click="deleteItem(data.item)">
                            <font-awesome-icon icon="trash" />
                        </button>
                    </div>
                </template>
            </b-table>

            <!-- Pagination -->
            <div v-if="totalRows > perPage" class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Showing {{ (currentPage - 1) * perPage + 1 }} to {{ Math.min(currentPage * perPage, totalRows) }} of
                    {{ totalRows }} entries
                </div>
                <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" size="sm" class="mb-0"
                    aria-label="Table pagination"></b-pagination>
            </div>
        </b-card>
    </div>
</template>

<script>
import PageTitle from '../../../Layout/Components/PageTitle.vue'

export default {
    name: 'RegularTables',
    components: {
        PageTitle
    },
    data() {
        return {
            heading: 'Student',
            subheading: 'Tables are the backbone of almost all web applications.',
            icon: 'pe-7s-drawer icon-gradient bg-happy-itmeo',

            actionType: '',

            // Table styling options
            striped: true,
            bordered: false,
            hover: true,
            small: false,
            dark: false,
            responsive: true,
            showEmpty: true,
            sortable: true,

            // Pagination and filtering
            currentPage: 1,
            perPage: 10,
            filter: '',
            sortBy: 'name',
            sortDesc: false,

            // Table fields
            tableFields: [
                { key: 'id', label: 'ID', sortable: true, class: 'text-center' },
                { key: 'first_name', label: 'Full Name', sortable: true },
                { key: 'email', label: 'Email', sortable: true },
                { key: 'department', label: 'Department', sortable: true },
                { key: 'role', label: 'Role', sortable: true },
                { key: 'status', label: 'Status', sortable: true, class: 'text-center' },
                { key: 'joinDate', label: 'Join Date', sortable: true, class: 'text-center' },
                { key: 'actions', label: 'Actions', class: 'text-center' }
            ],
            tableData: []
        }
    },
    computed: {
        filteredItems() {
            if (!this.filter || !Array.isArray(this.items)) {
                return this.items || []
            }
            const filterLower = this.filter.toLowerCase()
            return this.items.filter(item => {
                if (!item || typeof item !== 'object') return false
                return Object.values(item).some(value => {
                    if (value === null || value === undefined) return false
                    return String(value).toLowerCase().includes(filterLower)
                })
            })
        },
        paginatedItems() {
            const filtered = this.filteredItems
            if (!Array.isArray(filtered)) return []

            const start = (this.currentPage - 1) * this.perPage
            const end = start + this.perPage
            return filtered.slice(start, end)
        },
        totalRows() {
            return Array.isArray(this.filteredItems) ? this.filteredItems.length : 0
        }
    },
    mounted() {
        // Ensure data is properly initialized
        if (!Array.isArray(this.items)) {
            this.items = []
        }
    },
    methods: {
        openModal(actionType) {
            this.actionType = actionType
            console.log('Button clicked, actionType:', this.actionType)
            this.$refs.modal1.show()
        },

        getStatusClass(status) {
            const statusClasses = {
                Active: 'bg-success',
                Inactive: 'bg-danger',
                Pending: 'bg-warning text-dark'
            }
            return statusClasses[status] || 'bg-secondary'
        },
        editItem(item) {
            // Handle edit action
            alert(`Edit item: ${item.name}`)
        },
        deleteItem(item) {
            // Handle delete action
            if (confirm(`Are you sure you want to delete ${item.name}?`)) {
                const index = this.items.findIndex(i => i.id === item.id)
                if (index > -1) {
                    this.items.splice(index, 1)
                    // Reset to first page if current page is now empty
                    if (this.paginatedItems.length === 0 && this.currentPage > 1) {
                        this.currentPage = 1
                    }
                }
            }
        }
    }
}
</script>

<style></style>