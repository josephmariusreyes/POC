<template>
  <v-card flat class="data-table-card">
    <!-- Filters Section -->
    <div class="filters-section pa-4">
      <v-row align="center" dense>
        <v-col cols="12" md="4">
          <v-text-field
            v-model="searchQuery"
            placeholder="Search by billing # or patient..."
            prepend-inner-icon="mdi-magnify"
            hide-details
            clearable
            @update:model-value="$emit('search', searchQuery)"
          ></v-text-field>
        </v-col>
        
        <v-col cols="12" md="2">
          <v-select
            v-model="selectedStatus"
            :items="statusOptions"
            placeholder="All Status"
            hide-details
            clearable
            @update:model-value="$emit('filter-status', selectedStatus)"
          ></v-select>
        </v-col>
        
        <v-col cols="12" md="2">
          <v-text-field
            v-model="dateFrom"
            type="date"
            placeholder="mm/dd/yyyy"
            hide-details
            @update:model-value="$emit('filter-date-from', dateFrom)"
          ></v-text-field>
        </v-col>
        
        <v-col cols="12" md="2">
          <v-text-field
            v-model="dateTo"
            type="date"
            placeholder="mm/dd/yyyy"
            hide-details
            @update:model-value="$emit('filter-date-to', dateTo)"
          ></v-text-field>
        </v-col>
      </v-row>
    </div>

    <v-divider></v-divider>

    <!-- Data Table -->
    <v-data-table
      :headers="headers"
      :items="items"
      :loading="loading"
      :items-per-page="itemsPerPage"
      class="elevation-0"
    >
      <template #item.patient="{ item }">
        <div>
          <div class="font-weight-medium">{{ item.patient.name }}</div>
          <div class="text-caption text-grey">{{ item.patient.id }}</div>
        </div>
      </template>

      <template #item.total="{ item }">
        <span class="text-primary font-weight-medium">
          ₱{{ formatNumber(item.total) }}
        </span>
      </template>

      <template #item.status="{ item }">
        <v-chip
          :color="getStatusColor(item.status)"
          size="small"
          label
        >
          {{ item.status }}
        </v-chip>
      </template>

      <template #item.actions="{ item }">
        <v-btn
          icon
          variant="text"
          size="small"
          @click="$emit('view', item)"
        >
          <v-icon size="small">mdi-eye-outline</v-icon>
        </v-btn>
        <v-btn
          icon
          variant="text"
          size="small"
          @click="$emit('print', item)"
        >
          <v-icon size="small">mdi-printer-outline</v-icon>
        </v-btn>
      </template>

      <template #bottom>
        <div class="d-flex align-center justify-space-between pa-4">
          <div class="d-flex align-center">
            <v-select
              v-model="itemsPerPage"
              :items="[10, 15, 25, 50]"
              hide-details
              density="compact"
              style="max-width: 80px"
            ></v-select>
            <span class="text-body-2 text-grey ml-3">
              {{ paginationText }}
            </span>
          </div>
          
          <v-pagination
            v-model="currentPage"
            :length="totalPages"
            :total-visible="5"
            density="compact"
            rounded
          ></v-pagination>
        </div>
      </template>
    </v-data-table>
  </v-card>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  headers: {
    type: Array,
    required: true,
  },
  items: {
    type: Array,
    default: () => [],
  },
  loading: {
    type: Boolean,
    default: false,
  },
  totalItems: {
    type: Number,
    default: 0,
  },
  statusOptions: {
    type: Array,
    default: () => ['All Status', 'Paid', 'Pending', 'Cancelled'],
  },
})

defineEmits(['search', 'filter-status', 'filter-date-from', 'filter-date-to', 'view', 'print'])

const searchQuery = ref('')
const selectedStatus = ref(null)
const dateFrom = ref('')
const dateTo = ref('')
const itemsPerPage = ref(15)
const currentPage = ref(1)

const totalPages = computed(() => {
  return Math.ceil(props.totalItems / itemsPerPage.value) || 1
})

const paginationText = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value + 1
  const end = Math.min(currentPage.value * itemsPerPage.value, props.totalItems)
  return `${start}-${end} · ${props.totalItems} total`
})

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
.data-table-card {
  border-radius: 8px;
  overflow: hidden;
}

.filters-section {
  background-color: #FAFAFA;
}
</style>
