<template>
    <div class="passwordReset-create subContent">
        <subgnbs name="아이디 찾기" />

        <form @submit.prevent="submit" @keyup="form.clearErrors()">
            <div class="wrap-auth">
                <div class="m-input-wrap type01">
                    <h3 class="m-input-title">가입 시 등록한 연락처</h3>

                    <div class="m-input-text type01">
                        <input type="text" v-model="form.contact">
                    </div>

                    <div class="m-input-error">{{ form.errors.contact }}</div>
                </div>


                <div class="btns mt-40">
                    <button class="m-btn type04">아이디 찾기</button>
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
                contact: "",
            })
        }
    },

    methods: {
        submit() {
            this.form.post("/findIds");
        },

        clearLetter(){

        }
    }
}
</script>
