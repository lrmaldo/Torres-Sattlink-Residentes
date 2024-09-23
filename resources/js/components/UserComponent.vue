<template>
    <div class="container bg-white">
        <h1 class="display-4 mb-4">Usuarios</h1>

        <!-- Botón para abrir modal de agregar usuario -->
        <button @click="openAddModal" class="btn btn-primary mb-4">
            Agregar Usuario
        </button>

        <!-- buscador  -->
        <div class="input-group mb-4 bg-white">
            <input
                type="text"
                class="form-control"
                placeholder="Buscar usuario"
                v-model="search"
                @keyup="searchUser"
            />
            <button
                class="btn btn-outline-secondary"
                type="button"
                @click="searchUser"
            >
                <i class="bi bi-search"></i>
            </button>
        </div>
        <!-- card donde va a ir la table -->
        <div class="card bg-white ">
            <div class="card-body">
                <!-- Tabla de usuarios -->
                <div class="table-responsive mb-4">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark" >
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Acciones</th>
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
            </div>
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
                            {{
                                isEditing ? "Editar Usuario" : "Agregar Usuario"
                            }}
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <form
                            @submit.prevent="
                                isEditing ? updateUser() : addUser()
                            "
                        >
                            <div class="mb-3">
                                <label for="name" class="form-label"
                                    >Nombre</label
                                >
                                <input
                                    v-model="currentUser.name"
                                    id="name"
                                    type="text"
                                    class="form-control"

                                />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label"
                                    >Email</label
                                >
                                <input
                                    v-model="currentUser.email"
                                    id="email"
                                    type="email"
                                    class="form-control"

                                />
                            </div>
                            <!-- contraseña -->
                            <div class="mb-3">
                                <label for="password" class="form-label"
                                    >Contraseña</label
                                >
                                <input
                                    v-model="currentUser.password"
                                    id="password"
                                    type="password"
                                    class="form-control"
                                />
                                <span
                                    v-if="
                                        currentUser.password !==
                                        currentUser.password_confirmation
                                    "
                                    class="text-danger"
                                    >Las contraseñas no coinciden</span
                                >
                            </div>
                            <!-- confirmar contraseña -->
                            <div class="mb-3">
                                <label
                                    for="password_confirmation"
                                    class="form-label"
                                    >Confirmar Contraseña</label
                                >
                                <input
                                    v-model="currentUser.password_confirmation"
                                    id="password_confirmation"
                                    type="password"
                                    class="form-control validate"
                                />
                                <span
                                    v-if="
                                        currentUser.password !==
                                        currentUser.password_confirmation
                                    "
                                    class="text-danger"
                                    >Las contraseñas no coinciden</span
                                >
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Rol</label>
                                <select
                                    v-model="currentUser.role"
                                    id="role"
                                    class="form-select"
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
                                    :disabled="isLoading"
                                >
                                    Cancelar
                                </button>
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    :disabled="isLoading"
                                >
                                    <span
                                        v-if="isLoading"
                                        class="spinner-border spinner-border-sm"
                                        role="status"
                                        aria-hidden="true"
                                    ></span>
                                    <span v-if="isLoading"> Enviando...</span>
                                    <span v-else>{{
                                        isEditing
                                            ? "Actualizar Usuario"
                                            : "Agregar Usuario"
                                    }}</span>
                                </button>
                            </div>

                            <!-- span de error  -->
                            <div class="mb-3">
                                <span class="text-danger" id="error"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Modal } from "bootstrap";
import Swal from "sweetalert2/dist/sweetalert2.js";

export default {
    data() {
        return {
            users: [],
            currentUser: { name: "", email: "", role: "User" },
            isEditing: false,
            isLoading: false,
        };
    },
    mounted() {
        this.getUsers();
    },
    methods: {
        getUsers() {
            axios
                .get("/api/getusers")
                .then((response) => {
                    this.users = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        openAddModal() {
            this.currentUser = { name: "", email: "", role: "User" };
            this.isEditing = false;
            document.getElementById("error").innerText = "";
            document.getElementById("email").classList.remove("is-invalid");
            document.getElementById("name").classList.remove("is-invalid");
            document.getElementById("password").classList.remove("is-invalid");
            document
                .getElementById("password_confirmation")
                .classList.remove("is-invalid");
            this.showModal();
        },
        openEditModal(user) {
            this.currentUser = { ...user };
            this.isEditing = true;
            this.showModal();
        },
        showModal() {
            const modal = new Modal(this.$refs.userModal);
            modal.show();
        },
        addUser() {
            // lógica para agregar usuario
            //console.log(this.currentUser);
            /* contraseña confirmar contraseña */
            if (
                this.currentUser.password !==
                this.currentUser.password_confirmation
            ) {
                /* class valite bootstrap error */
                document
                    .getElementById("password_confirmation")
                    .classList.add("is-invalid");
                document.getElementById("password").classList.add("is-invalid");
                return;
            }
            this.isLoading = true; // Mostrar spinner al iniciar la solicitud
            axios
                .post("/users", this.currentUser)
                .then((response) => {
                    this.getUsers();

                    this.resetForm();
                })
                .catch((error) => {
                    console.error(error);

                    if (error.response.data.errors) {
                        const errors = error.response.data.errors;
                        if (errors.email) {
                            document.getElementById("error").innerText =
                                errors.email[0];
                            document
                                .getElementById("email")
                                .classList.add("is-invalid");
                        }
                        if (errors.password) {
                            document.getElementById("error").innerText =
                                errors.password[0];
                            document
                                .getElementById("password")
                                .classList.add("is-invalid");
                        }
                        if (errors.name) {
                            document.getElementById("error").innerText =
                                errors.name[0];
                            document
                                .getElementById("name")
                                .classList.add("is-invalid");
                        }
                    }
                })
                .finally(() => {
                    this.isLoading = false; // Ocultar spinner al finalizar la solicitud
                    /* cerrar el modal */
                    /* actualizar la tabla de users */
                    this.getUsers();
                    Swal.fire({
                        icon: "success",
                        title: "Usuario agregado",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                });
        },
        updateUser() {
            // lógica para actualizar usuario
            this.isLoading = true; // Mostrar spinner al iniciar la solicitud
            axios
                .put(`/users/${this.currentUser.id}`, this.currentUser)
                .then(() => {
                    this.getUsers();
                    this.resetForm();
                    Swal.fire({
                        icon: "success",
                        title: "Usuario actualizado",
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                    });

                })
                .catch((error) => {
                    console.error(error);
                    /*
{message: "The given data was invalid.", errors: {email: ["The email has already been taken."]}}
errors
:
{email: ["The email has already been taken."]}
message
:
"The given data was invalid." */
                    if (error.response.data.errors) {
                        const errors = error.response.data.errors;
                        if (errors.email) {
                            document.getElementById("error").innerText =
                                errors.email[0];
                            document
                                .getElementById("email")
                                .classList.add("is-invalid");
                        }
                        if (errors.password) {
                            document.getElementById("error").innerText =
                                errors.password[0];
                            document
                                .getElementById("password")
                                .classList.add("is-invalid");
                        }
                        if (errors.name) {
                            document.getElementById("error").innerText =
                                errors.name[0];
                            document
                                .getElementById("name")
                                .classList.add("is-invalid");
                        }
                    }
                })
                .finally(() => {
                    this.isLoading = false; // Ocultar spinner al finalizar la solicitud

                });
        },
        deleteUser(id) {
            // lógica para eliminar usuario
            /* sweet alert */
            Swal.fire({
                title: "¿Estás seguro?",
                text: "No podrás revertir esto",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar",
                progressSteps: ["1", "2"],
                preConfirm: () => {
                    return axios
                        .delete(`/users/${id}`)
                        .then(() => {
                            this.getUsers();
                        })
                        .catch((error) => {
                            console.error(error);
                            document.getElementById("error").innerText =
                                "No se pudo eliminar el usuario";
                        });
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: "success",
                        title: "Usuario eliminado",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            });
        },
        resetForm() {
            this.currentUser = { name: "", email: "", role: "User" };
            this.isEditing = false;
            this.isLoading = false;
            document.getElementById("error").innerText = "";
            document.getElementById("email").classList.remove("is-invalid");
            document.getElementById("password").classList.remove("is-invalid");
            document.getElementById("name").classList.remove("is-invalid");

            const modal = Modal.getInstance(this.$refs.userModal);
            modal.hide();
        },
        searchUser() {
            /* buscar en el obtjeto de users sin hacer peticion a la bd */
            if (!this.search) {
                this.getUsers();
                return;
            }
            this.users = this.users.filter((user) => {
                return user.name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
    },
};
</script>
