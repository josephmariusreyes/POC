import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router'

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    redirect: '/appointments',
  },
  // Clinic Operations
  {
    path: '/appointments',
    name: 'Appointments',
    component: () => import('@/views/clinic-operations/AppointmentsView.vue'),
    meta: { section: 'Clinic Operations', icon: 'mdi-calendar-check' },
  },
  {
    path: '/reception-queue',
    name: 'Reception Queue',
    component: () => import('@/views/clinic-operations/ReceptionQueueView.vue'),
    meta: { section: 'Clinic Operations', icon: 'mdi-account-clock' },
  },
  // Patient Care
  {
    path: '/patients',
    name: 'Patients',
    component: () => import('@/views/patient-care/PatientsView.vue'),
    meta: { section: 'Patient Care', icon: 'mdi-account-group' },
  },
  {
    path: '/billing',
    name: 'Billing',
    component: () => import('@/views/patient-care/BillingView.vue'),
    meta: { section: 'Finance', icon: 'mdi-receipt' },
  },
  {
    path: '/laboratory',
    name: 'Laboratory',
    component: () => import('@/views/patient-care/LaboratoryView.vue'),
    meta: { section: 'Patient Care', icon: 'mdi-flask' },
  },
  // Medical Records
  {
    path: '/consultations',
    name: 'Consultations',
    component: () => import('@/views/medical-records/ConsultationsView.vue'),
    meta: { section: 'Medical Records', icon: 'mdi-stethoscope' },
  },
  {
    path: '/medical-certificates',
    name: 'Medical Certificates',
    component: () => import('@/views/medical-records/MedicalCertificatesView.vue'),
    meta: { section: 'Medical Records', icon: 'mdi-file-document' },
  },
  // Clinic Setup
  {
    path: '/doctors',
    name: 'Doctors',
    component: () => import('@/views/clinic-setup/DoctorsView.vue'),
    meta: { section: 'Clinic Setup', icon: 'mdi-doctor' },
  },
  {
    path: '/services',
    name: 'Services',
    component: () => import('@/views/clinic-setup/ServicesView.vue'),
    meta: { section: 'Clinic Setup', icon: 'mdi-medical-bag' },
  },
  {
    path: '/inventory',
    name: 'Inventory',
    component: () => import('@/views/clinic-setup/InventoryView.vue'),
    meta: { section: 'Clinic Setup', icon: 'mdi-package-variant' },
  },
  // Account Settings
  {
    path: '/user-management',
    name: 'User Management',
    component: () => import('@/views/account-settings/UserManagementView.vue'),
    meta: { section: 'Account settings', icon: 'mdi-account-cog' },
  },
  {
    path: '/queue-display',
    name: 'Queue Display',
    component: () => import('@/views/account-settings/QueueDisplayView.vue'),
    meta: { section: 'Account settings', icon: 'mdi-monitor', external: true },
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
