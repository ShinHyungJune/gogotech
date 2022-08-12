<template>
    <div class="passwordReset-edit subContent">
        <subgnbs name="아이디 찾기" />

        <div class="wrap-auth">
            <h3 class="title">아이디 찾기 결과</h3>

            <div class="m-input-wrap type01">
                <h3 class="m-input-title">아이디</h3>

                <div class="m-input-text type01">
                    <input type="text" v-model="ids" disabled>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Subgnbs from "../../Components/Subgnbs";
export default {
    components: {Subgnbs},
    data() {
        return {
            ids: this.$page.props.ids
        }
    },

    methods: {

    }
}
</script>
