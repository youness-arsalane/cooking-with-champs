<template>
    <div class="container-fluid pl-0 pr-0">
        <div class="container-fluid pl-0 pr-0">
            <notifications group="notification" />
            <Header/>
            <br/>
            <div class="container">
                <router-view/>
            </div>
        </div>
    </div>
</template>

<script>
import Header from "./components/layout/Header";

export default {
    components: {
        Header
    }
}
</script>