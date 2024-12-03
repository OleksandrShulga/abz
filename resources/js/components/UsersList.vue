<template>
    <div>
        <div class="users-container">
            <div v-for="user in users.data" :key="user.id" class="user-item">
                <div>USER #{{ user.id }}</div>
                <div>Name: {{ user.name }}</div>
                <div>Email: {{ user.email }}</div>
                <div>Phone: {{ user.phone }}</div>
                <div>Position ID: {{ user.position_id }}</div>
                <div>
                    <img
                        :src="getUserPhoto(user.photo)"
                        alt="User Photo"
                        style="width: 70px; height: 70px; object-fit: cover;"
                        loading="lazy"
                        :placeholder="'/storage/lezy.png'"
                    />
                </div>
            </div>
        </div>

        <!-- Кнопка "Show More" для завантаження наступної сторінки -->
        <button v-if="users.current_page < users.last_page" @click="loadMore">
            Show More
        </button>
    </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
    name: 'UsersList',
    data() {
        return {
            users: {
                data: [],
                current_page: 1,
                last_page: 1,
            },
        };
    },
    methods: {
        // Функція для отримання шляху до фото
        getUserPhoto(photo) {
            if (photo.startsWith('http://') || photo.startsWith('https://')) {
                return photo;
            }
            return `${window.location.origin}/${photo}`;
        },

        // Завантаження користувачів
        async loadUsers() {
            try {
                const response = await axios.get('/api/users_6', {
                    params: {
                        page: this.users.current_page,
                    },
                });

                this.users.data = [...this.users.data, ...response.data.data];
                this.users.current_page = response.data.current_page;
                this.users.last_page = response.data.last_page;
            } catch (error) {
                console.error("Error loading users:", error);
            }
        },

        // Завантаження наступної сторінки
        async loadMore() {
            if (this.users.current_page < this.users.last_page) {
                this.users.current_page++;
                await this.loadUsers();
            }
        },
    },
    mounted() {
        // Завантажуємо користувачів при монтуванні компонента
        this.loadUsers();
    },
};

</script>
