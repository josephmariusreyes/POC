<template>
  <div class="billing-view">
    <PageHeader
      title="Billing Management"
      :subtitle="`${totalBillings} billing records`"
      icon="mdi-receipt"
    >
      <template #actions>
        <v-btn
          color="white"
          variant="flat"
          prepend-icon="mdi-plus"
          @click="openNewBillingDialog"
        >
          New Billing
        </v-btn>
      </template>
    </PageHeader>

    <div class="pa-6">
      <DataTable
        :headers="tableHeaders"
        :items="billings"
        :loading="loading"
        :total-items="totalBillings"
        @search="handleSearch"
        @filter-status="handleStatusFilter"
        @view="viewBilling"
        @print="printBilling"
      />
    </div>

    <!-- New Billing Dialog -->
    <v-dialog v-model="showNewBillingDialog" max-width="600">
      <v-card>
        <v-card-title class="d-flex justify-space-between align-center">
          <span>Create New Billing</span>
          <v-btn icon variant="text" @click="showNewBillingDialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        
        <v-card-text>
          <v-form ref="billingForm">
            <v-row>
              <v-col cols="12">
                <v-autocomplete
                  v-model="newBilling.patientId"
                  :items="patients"
                  item-title="name"
                  item-value="id"
                  label="Select Patient"
                  prepend-inner-icon="mdi-account"
                  required
                ></v-autocomplete>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="newBilling.date"
                  type="date"
                  label="Billing Date"
                  prepend-inner-icon="mdi-calendar"
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-textarea
                  v-model="newBilling.notes"
                  label="Notes"
                  rows="3"
                ></v-textarea>
              </v-col>
            </v-row>
          </v-form>
        </v-card-text>
        
        <v-card-actions class="pa-4">
          <v-spacer></v-spacer>
          <v-btn variant="text" @click="showNewBillingDialog = false">
            Cancel
          </v-btn>
          <v-btn color="primary" @click="saveBilling">
            Create Billing
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- View Billing Dialog -->
    <v-dialog v-model="showViewDialog" max-width="800">
      <v-card v-if="selectedBilling">
        <v-card-title class="d-flex justify-space-between align-center bg-primary text-white">
          <span>Billing Details - {{ selectedBilling.billingNumber }}</span>
          <v-btn icon variant="text" color="white" @click="showViewDialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        
        <v-card-text class="pa-6">
          <v-row>
            <v-col cols="6">
              <div class="text-caption text-grey mb-1">Patient</div>
              <div class="font-weight-medium">{{ selectedBilling.patient.name }}</div>
              <div class="text-caption">{{ selectedBilling.patient.id }}</div>
            </v-col>
            <v-col cols="6">
              <div class="text-caption text-grey mb-1">Date</div>
              <div class="font-weight-medium">{{ selectedBilling.date }}</div>
            </v-col>
            <v-col cols="6">
              <div class="text-caption text-grey mb-1">Items</div>
              <div class="font-weight-medium">{{ selectedBilling.items }}</div>
            </v-col>
            <v-col cols="6">
              <div class="text-caption text-grey mb-1">Status</div>
              <v-chip :color="getStatusColor(selectedBilling.status)" size="small" label>
                {{ selectedBilling.status }}
              </v-chip>
            </v-col>
            <v-col cols="12">
              <div class="text-caption text-grey mb-1">Total Amount</div>
              <div class="text-h5 text-primary font-weight-bold">
                ₱{{ formatNumber(selectedBilling.total) }}
              </div>
            </v-col>
          </v-row>
        </v-card-text>
        
        <v-card-actions class="pa-4">
          <v-spacer></v-spacer>
          <v-btn variant="text" @click="showViewDialog = false">Close</v-btn>
          <v-btn color="primary" prepend-icon="mdi-printer" @click="printBilling(selectedBilling)">
            Print
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import PageHeader from '@/components/common/PageHeader.vue'
import DataTable from '@/components/common/DataTable.vue'

// State
const loading = ref(false)
const showNewBillingDialog = ref(false)
const showViewDialog = ref(false)
const selectedBilling = ref(null)
const searchQuery = ref('')
const statusFilter = ref(null)

const newBilling = ref({
  patientId: null,
  date: '',
  notes: '',
})

// Sample data
const billings = ref([
  {
    id: 1,
    billingNumber: 'BL-2026-000001',
    patient: { id: 'P2026-000001', name: 'juan dela cruz' },
    date: 'Feb 21, 2026',
    items: 4,
    total: 2550.00,
    status: 'Paid',
  },
  {
    id: 2,
    billingNumber: 'BL-2026-000002',
    patient: { id: 'P2026-000002', name: 'maria santos' },
    date: 'Feb 20, 2026',
    items: 2,
    total: 1200.00,
    status: 'Pending',
  },
  {
    id: 3,
    billingNumber: 'BL-2026-000003',
    patient: { id: 'P2026-000003', name: 'pedro garcia' },
    date: 'Feb 19, 2026',
    items: 6,
    total: 4800.00,
    status: 'Paid',
  },
])

const patients = ref([
  { id: 'P2026-000001', name: 'juan dela cruz' },
  { id: 'P2026-000002', name: 'maria santos' },
  { id: 'P2026-000003', name: 'pedro garcia' },
])

const tableHeaders = [
  { title: 'BILLING #', key: 'billingNumber', sortable: true },
  { title: 'PATIENT', key: 'patient', sortable: true },
  { title: 'DATE', key: 'date', sortable: true },
  { title: 'ITEMS', key: 'items', align: 'center' },
  { title: 'TOTAL', key: 'total', align: 'end' },
  { title: 'STATUS', key: 'status', align: 'center' },
  { title: 'ACTIONS', key: 'actions', align: 'center', sortable: false },
]

const totalBillings = computed(() => billings.value.length)

// Methods
function openNewBillingDialog() {
  newBilling.value = { patientId: null, date: '', notes: '' }
  showNewBillingDialog.value = true
}

function saveBilling() {
  // In a real app, this would make an API call
  console.log('Saving billing:', newBilling.value)
  showNewBillingDialog.value = false
}

function viewBilling(billing) {
  selectedBilling.value = billing
  showViewDialog.value = true
}

function printBilling(billing) {
  console.log('Printing billing:', billing.billingNumber)
  // Implement print functionality
}

function handleSearch(query) {
  searchQuery.value = query
  // Implement search logic
}

function handleStatusFilter(status) {
  statusFilter.value = status
  // Implement filter logic
}

function formatNumber(num) {
  return num.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
}

function getStatusColor(status) {
  const colors = {
    'Paid': 'success',
    'Pending': 'warning',
    'Cancelled': 'error',
  }
  return colors[status] || 'grey'
}
</script>

<style scoped>
.billing-view {
  height: 100%;
}
</style>
