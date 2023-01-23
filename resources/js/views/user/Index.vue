<template>
    <div class="album py-4 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div class="col" v-for="user in users">
                    <div class="card shadow-sm">
                        <div class="card-header py-3 text-white bg-secondary border-secondary">
                            <h5 class="my-0 fw-normal">{{ user.name }}</h5>
                        </div>
                        <div class="d-flex justify-content-center mt-4 w-100">
                            <img :src="user.image" alt="user image">
                        </div>

                        <div class="card-body">
                            <ul class="nav nav-pills flex-column mb-2">
                                <li class="nav-item">
                                    <i class="fa-solid fa-phone"></i> {{ user.phone }}
                                </li>
                                <li class="nav-item">
                                    <i class="fa-solid fa-envelope"></i> {{ user.email }}
                                </li>
                                <li class="nav-item"><b>Position</b>: {{ user.position }}</li>
                                <li class="nav-item"><b>Registered</b>: {{ user.created_at }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center p-4">
                <button class="btn btn-lg btn-dark" @click="loadUsers">Load more</button>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            params: {
                categoryId: '',
                perPage: 5,
                sortField: 'created_at',
                sortDirection: 'desc',
            },
            page: 1,
            search: '',
            loading: true,
            errored: false,
        }
    },
    methods: {
        loadUsers: async function () {
            try {
                let response = await axios.get('/api/v1/users/?page=' + this.page, {
                    params: {
                        search: this.search.length >= 2 ? this.search : '',
                        ...this.params,
                    },
                });
                response.data.data.forEach((item) => {
                    this.users.push(item);
                })
                this.page++;
                this.loading = false;
            } catch (error) {
                console.log(error);
                this.errored = true;
            }
        },
    },
    async mounted() {
        await this.loadUsers();
    }
}
</script>
