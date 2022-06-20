<template>
    <div class="container-fluid pl-0 pr-0">
        <div class="container-fluid pl-0 pr-0">
            <notifications group="notification" />
            <Header/>
            <br/>
            <div class="container cooking-container">
                <router-view/>
            </div>
            <Footer/>
        </div>
    </div>
</template>

<script>
import Header from "./components/layout/Header";
import Footer from "./components/layout/Footer";

export default {
    components: {
        Header,
        Footer
    }
}
</script>