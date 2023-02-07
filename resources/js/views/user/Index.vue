<template>
    <section class="py-2 mt-2 text-center container">
        <div class="row py-lg-2">
          <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Dream company</h1>
            <p class="lead text-muted">
                Register and join the dream team. After registration, your profile will be placed at the top of the list.
            </p>
          </div>
        </div>
      </section>
    <div class="album bg-light">
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
            <div v-if="showLoadMore" class="d-flex justify-content-center p-4">
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
            showLoadMore: false,
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
                this.showLoadMore = response.data.meta.current_page !== response.data.meta.last_page;
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
