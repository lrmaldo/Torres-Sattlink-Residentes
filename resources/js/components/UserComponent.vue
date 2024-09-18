<template>
    <div>
        <h1>User Management</h1>
        <form @submit.prevent="saveUser">
            <div>
                <label for="name">Name:</label>
                <input type="text" v-model="user.name" required />
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" v-model="user.email" required />
            </div>
            <button type="submit">Save</button>
        </form>

        <h2>Users List</h2>
        <ul>
            <li v-for="user in users" :key="user.id">
                {{ user.name }} - {{ user.email }}
                <button @click="editUser(user)">Edit</button>
                <button @click="deleteUser(user.id)">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                id: null,
                name: '',
                email: ''
            },
            users: []
        };
    },
    methods: {
        fetchUsers() {
            // Fetch users from API or other data source
            // This is just a placeholder
            this.users = [
                { id: 1, name: 'John Doe', email: 'john@example.com' },
                { id: 2, name: 'Jane Doe', email: 'jane@example.com' }
            ];
        },
        saveUser() {
            if (this.user.id) {
                // Update existing user
                const index = this.users.findIndex(u => u.id === this.user.id);
                if (index !== -1) {
                    this.users.splice(index, 1, { ...this.user });
                }
            } else {
                // Create new user
                this.user.id = Date.now();
                this.users.push({ ...this.user });
            }
            this.resetForm();
        },
        editUser(user) {
            this.user = { ...user };
        },
        deleteUser(id) {
            this.users = this.users.filter(user => user.id !== id);
        },
        resetForm() {
            this.user = { id: null, name: '', email: '' };
        }
    },
    mounted() {
        this.fetchUsers();
    }
};
</script>

<style scoped>
/* Add your styles here */
</style>
