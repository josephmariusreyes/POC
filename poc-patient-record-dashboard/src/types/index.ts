// User and Authentication Types
export interface Clinic {
  id: string
  name: string
  version: string
}

export interface User {
  id: string
  firstName: string
  lastName: string
  email: string
  role: string
  avatar: string | null
  clinic: Clinic
  permissions: string[]
  isLoggedIn: boolean
}

// Patient Types
export interface Patient {
  id: number
  patientId: string
  name: string
  age: number
  gender: 'Male' | 'Female'
  contact: string
  lastVisit: string
}

export interface NewPatient {
  firstName: string
  lastName: string
  birthDate: string
  gender: string
  contact: string
  address: string
}

// Billing Types
export type BillingStatus = 'Paid' | 'Pending' | 'Cancelled'

export interface BillingPatient {
  id: string
  name: string
}

export interface Billing {
  id: number
  billingNumber: string
  patient: BillingPatient
  date: string
  items: number
  total: number
  status: BillingStatus
}

export interface NewBilling {
  patientId: string | null
  date: string
  notes: string
}

// Table Types
export interface TableHeader {
  title: string
  key: string
  sortable?: boolean
  align?: 'start' | 'center' | 'end'
}

// Navigation Types
export interface NavigationItem {
  title: string
  path: string
  icon: string
  external?: boolean
}

export interface NavigationSection {
  title: string
  items: NavigationItem[]
}

// Route Meta Types
export interface RouteMeta {
  section?: string
  icon?: string
  external?: boolean
}
