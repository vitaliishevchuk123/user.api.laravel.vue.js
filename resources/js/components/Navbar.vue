<template>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href=""><i class="fa-solid fa-users"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <RouterLink class="nav-link active" to="/">Home</RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink class="nav-link" to="/create-user">Join the team</RouterLink>
                    </li>
                </ul>
                <div class="d-flex">
                    <p class="nav-item text-white mt-2">© 2023 Laravel v9.46.0 (PHP v8.0.27)</p>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>

</script>
