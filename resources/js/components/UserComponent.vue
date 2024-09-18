<template>
    <div class="min-h-screen bg-gray-900 text-white p-8">
      <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">User Management</h1>

        <!-- Add User Button -->
        <button @click="openAddModal" class="mb-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full flex items-center">
          <PlusIcon class="w-5 h-5 mr-2" />
          Add User
        </button>

        <!-- User Table -->
        <div class="overflow-x-auto bg-gray-800 rounded-lg shadow">
          <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Email</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Role</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
              <tr v-for="user in users" :key="user.id" class="hover:bg-gray-700">
                <td class="px-6 py-4 whitespace-nowrap">{{ user.name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ user.email }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ user.role }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <button @click="openEditModal(user)" class="text-blue-400 hover:text-blue-300 mr-4">
                    <PencilIcon class="w-5 h-5" />
                  </button>
                  <button @click="deleteUser(user.id)" class="text-red-400 hover:text-red-300">
                    <TrashIcon class="w-5 h-5" />
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Add/Edit User Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
          <div class="bg-gray-800 rounded-lg p-8 w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6">{{ isEditing ? 'Edit User' : 'Add User' }}</h2>
            <form @submit.prevent="isEditing ? updateUser() : addUser()">
              <div class="mb-4">
                <label for="name" class="block text-sm font-medium mb-2">Name</label>
                <input v-model="currentUser.name" id="name" type="text" required class="w-full px-3 py-2 bg-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
              <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2">Email</label>
                <input v-model="currentUser.email" id="email" type="email" required class="w-full px-3 py-2 bg-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
              <div class="mb-6">
                <label for="role" class="block text-sm font-medium mb-2">Role</label>
                <select v-model="currentUser.role" id="role" required class="w-full px-3 py-2 bg-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                  <option value="User">User</option>
                  <option value="Admin">Admin</option>
                  <option value="Manager">Manager</option>
                </select>
              </div>
              <div class="flex justify-end space-x-4">
                <button type="button" @click="closeModal" class="px-4 py-2 bg-gray-600 rounded-md hover:bg-gray-700">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 rounded-md hover:bg-blue-700">
                  {{ isEditing ? 'Update User' : 'Add User' }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </template>

    <script setup>
    import { ref, reactive } from 'vue'
    import { PlusIcon, PencilIcon, TrashIcon } from 'lucide-vue-next'

    const users = ref([
      { id: 1, name: 'John Doe', email: 'john@example.com', role: 'User' },
      { id: 2, name: 'Jane Smith', email: 'jane@example.com', role: 'Admin' },
      { id: 3, name: 'Bob Johnson', email: 'bob@example.com', role: 'Manager' },
    ])

    const showModal = ref(false)
    const isEditing = ref(false)
    const currentUser = reactive({ id: null, name: '', email: '', role: 'User' })

    const openAddModal = () => {
      isEditing.value = false
      currentUser.id = null
      currentUser.name = ''
      currentUser.email = ''
      currentUser.role = 'User'
      showModal.value = true
    }

    const openEditModal = (user) => {
      isEditing.value = true
      currentUser.id = user.id
      currentUser.name = user.name
      currentUser.email = user.email
      currentUser.role = user.role
      showModal.value = true
    }

    const closeModal = () => {
      showModal.value = false
    }

    const addUser = () => {
      const newUser = {
        id: Date.now(),
        name: currentUser.name,
        email: currentUser.email,
        role: currentUser.role
      }
      users.value.push(newUser)
      closeModal()
    }

    const updateUser = () => {
      const index = users.value.findIndex(user => user.id === currentUser.id)
      if (index !== -1) {
        users.value[index] = { ...currentUser }
      }
      closeModal()
    }

    const deleteUser = (id) => {
      if (confirm('Are you sure you want to delete this user?')) {
        users.value = users.value.filter(user => user.id !== id)
      }
    }
    </script>
