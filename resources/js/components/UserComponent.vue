<template>
    <div class="container">
      <h1 class="display-4 mb-4">Usuarios</h1>

      <!-- Botón para abrir modal de agregar usuario -->
      <button @click="openAddModal" class="btn btn-primary mb-4">
        Agregar Usuario
      </button>

      <!-- Tabla de usuarios -->
      <div class="table-responsive mb-4">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.id">
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>
                <button
                  @click="openEditModal(user)"
                  class="btn btn-sm btn-outline-primary me-2"
                >
                  <i class="bi bi-pencil"></i>
                </button>
                <button
                  @click="deleteUser(user.id)"
                  class="btn btn-sm btn-outline-danger"
                >
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Modal para agregar/editar usuario -->
      <div
        class="modal fade"
        id="userModal"
        tabindex="-1"
        aria-labelledby="userModalLabel"
        aria-hidden="true"
        ref="userModal"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="userModalLabel">
                {{ isEditing ? "Editar Usuario" : "Agregar Usuario" }}
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <form @submit.prevent="isEditing ? updateUser() : addUser()">
                <div class="mb-3">
                  <label for="name" class="form-label">Nombre</label>
                  <input
                    v-model="currentUser.name"
                    id="name"
                    type="text"
                    class="form-control"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    v-model="currentUser.email"
                    id="email"
                    type="email"
                    class="form-control"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="role" class="form-label">Rol</label>
                  <select
                    v-model="currentUser.role"
                    id="role"
                    class="form-select"
                    required
                  >
                    <option value="User">Usuario</option>
                    <option value="Admin">Administrador</option>
                    <option value="Manager">Gerente</option>
                  </select>
                </div>
                <div class="text-end">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Cancelar
                  </button>
                  <button type="submit" class="btn btn-primary">
                    {{ isEditing ? "Actualizar Usuario" : "Agregar Usuario" }}
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>

<script>
import { Modal } from 'bootstrap';
export default {
  data() {
    return {
      users: [
        { id: 1, name: "John Doe", email: "john@example.com", role: "User" },
        // más usuarios aquí
      ],
      currentUser: { name: "", email: "", role: "User" },
      isEditing: false,
    };
  },
  methods: {
    openAddModal() {
      this.currentUser = { name: "", email: "", role: "User" };
      this.isEditing = false;
      this.showModal();
    },
    openEditModal(user) {
      this.currentUser = { ...user };
      this.isEditing = true;
      this.showModal();
    },
    showModal() {
      const modal = new bootstrap.Modal(this.$refs.userModal);
      modal.show();
    },
    addUser() {
      // lógica para agregar usuario
    },
    updateUser() {
      // lógica para actualizar usuario
    },
    deleteUser(id) {
      // lógica para eliminar usuario
    },
  },
};
</script>
