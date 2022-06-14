<template>
    <header class="main-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarExample01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li>
                        <li class="nav-item">
                            <router-link to="/add-recipe" class="nav-link">Add recipe</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="p-5 text-center main-header__sub-header">
            <h1 class="mb-3"><span class="font-weight-bold text-white">COOKING WITH</span> <span class="font-weight-bold">CHAMPS</span></h1>
            <h4 class="mb-3 text-white">Find or post recipes to share with friends!</h4>
            <button type="button" class="btn btn-outline-light">Sign Up to List a Recipe</button>
        </div>
    </header>
</template>

<script>
export default {
    name: "Header"
}
</script>

<style scoped>

</style>