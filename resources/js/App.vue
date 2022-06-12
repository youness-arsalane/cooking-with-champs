<template>
    <div class="container-fluid pl-0 pr-0">
        <notifications group="notification" />
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">Dashboard</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <div class="container">
            <router-view/>
        </div>
    </div>
</template>

<script>
export default {}
</script>