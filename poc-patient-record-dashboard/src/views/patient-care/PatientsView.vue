<template>
  <div class="patients-view">
    <PageHeader
      title="Patients"
      :subtitle="`${patients.length} registered patients`"
      icon="mdi-account-group"
    >
      <template #actions>
        <v-btn
          color="white"
          variant="flat"
          prepend-icon="mdi-plus"
          @click="showNewPatientDialog = true"
        >
          New Patient
        </v-btn>
      </template>
    </PageHeader>

    <div class="pa-6">
      <v-card flat>
        <div class="pa-4">
          <v-row align="center" dense>
            <v-col cols="12" md="4">
              <v-text-field
                v-model="searchQuery"
                placeholder="Search patients..."
                prepend-inner-icon="mdi-magnify"
                hide-details
                clearable
              ></v-text-field>
            </v-col>
          </v-row>
        </div>

        <v-divider></v-divider>

        <v-data-table
          :headers="tableHeaders"
          :items="filteredPatients"
          :loading="loading"
          class="elevation-0"
        >
          <template #item.name="{ item }">
            <div class="d-flex align-center">
              <v-avatar color="primary" size="32" class="mr-3">
                <span class="text-white text-caption">{{ getInitials(item.name) }}</span>
              </v-avatar>
              <div>
                <div class="font-weight-medium">{{ item.name }}</div>
                <div class="text-caption text-grey">{{ item.patientId }}</div>
              </div>
            </div>
          </template>

          <template #item.actions="{ item }">
            <v-btn icon variant="text" size="small" @click="viewPatient(item)">
              <v-icon size="small">mdi-eye-outline</v-icon>
            </v-btn>
            <v-btn icon variant="text" size="small" @click="editPatient(item)">
              <v-icon size="small">mdi-pencil-outline</v-icon>
            </v-btn>
          </template>
        </v-data-table>
      </v-card>
    </div>

    <!-- New Patient Dialog -->
    <v-dialog v-model="showNewPatientDialog" max-width="600">
      <v-card>
        <v-card-title>Register New Patient</v-card-title>
        <v-card-text>
          <v-form>
            <v-row>
              <v-col cols="6">
                <v-text-field v-model="newPatient.firstName" label="First Name"></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field v-model="newPatient.lastName" label="Last Name"></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field v-model="newPatient.birthDate" type="date" label="Birth Date"></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-select v-model="newPatient.gender" :items="['Male', 'Female']" label="Gender"></v-select>
              </v-col>
              <v-col cols="12">
                <v-text-field v-model="newPatient.contact" label="Contact Number"></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-textarea v-model="newPatient.address" label="Address" rows="2"></v-textarea>
              </v-col>
            </v-row>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn variant="text" @click="showNewPatientDialog = false">Cancel</v-btn>
          <v-btn color="primary" @click="savePatient">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import PageHeader from '@/components/common/PageHeader.vue'

const loading = ref(false)
const searchQuery = ref('')
const showNewPatientDialog = ref(false)

const newPatient = ref({
  firstName: '',
  lastName: '',
  birthDate: '',
  gender: '',
  contact: '',
  address: '',
})

const patients = ref([
  { id: 1, patientId: 'P2026-000001', name: 'Juan Dela Cruz', age: 35, gender: 'Male', contact: '+63 912 345 6789', lastVisit: 'Feb 21, 2026' },
  { id: 2, patientId: 'P2026-000002', name: 'Maria Santos', age: 28, gender: 'Female', contact: '+63 917 123 4567', lastVisit: 'Feb 20, 2026' },
  { id: 3, patientId: 'P2026-000003', name: 'Pedro Garcia', age: 42, gender: 'Male', contact: '+63 918 765 4321', lastVisit: 'Feb 19, 2026' },
])

const tableHeaders = [
  { title: 'NAME', key: 'name', sortable: true },
  { title: 'AGE', key: 'age', sortable: true },
  { title: 'GENDER', key: 'gender', sortable: true },
  { title: 'CONTACT', key: 'contact' },
  { title: 'LAST VISIT', key: 'lastVisit', sortable: true },
  { title: 'ACTIONS', key: 'actions', align: 'center', sortable: false },
]

const filteredPatients = computed(() => {
  if (!searchQuery.value) return patients.value
  const query = searchQuery.value.toLowerCase()
  return patients.value.filter(p => 
    p.name.toLowerCase().includes(query) || 
    p.patientId.toLowerCase().includes(query)
  )
})

function getInitials(name) {
  return name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2)
}

function viewPatient(patient) {
  console.log('View patient:', patient)
}

function editPatient(patient) {
  console.log('Edit patient:', patient)
}

function savePatient() {
  console.log('Save patient:', newPatient.value)
  showNewPatientDialog.value = false
}
</script>
