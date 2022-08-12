<template>
    <div>
        <header-vue />

        <div class="main">
            <slot />
        </div>

        <flash />

        <footer-vue/>
    </div>

</template>
<script>
import HeaderVue from "../Components/Header";
import FooterVue from "../Components/Footer";
import Flash from "../Components/Flash";
export default {
    components: {HeaderVue, FooterVue, Flash}
}
</script>
