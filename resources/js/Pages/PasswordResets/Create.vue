<template>
    <div class="passwordReset-create subContent">
        <subgnbs name="비밀번호 찾기" />

        <form @submit.prevent="submit" @keyup="form.clearErrors()">
            <div class="wrap-auth">
                <div class="m-input-wrap type01">
                    <h3 class="m-input-title">아이디</h3>

                    <div class="m-input-text type01">
                        <input type="text" v-model="form.ids">
                    </div>

                    <div class="m-input-error">{{ form.errors.ids }}</div>
                </div>


                <div class="btns mt-40">
                    <button class="m-btn type04">비밀번호 초기화 문자발송</button>
                </div>
            </div>
        </form>

    </div>
</template>
<script>
import {Link} from "@inertiajs/inertia-vue";
import Subgnbs from "../../Components/Subgnbs";
export default {
    components: {Subgnbs, Link},
    data() {
        return {
            form: this.$inertia.form({
                ids: "",
            })
        }
    },

    methods: {
        submit() {
            this.form.post("/passwordResets");
        },
        clearLetter(){

        }
    }
}
</script>
