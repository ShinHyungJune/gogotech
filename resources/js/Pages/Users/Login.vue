<template>
    <div>
        <subgnbs name="로그인" />

        <div class="area-login">
            <div class="wrap">
                <div class="boxes">
                    <div class="left">
                        <img src="/img/img-login.jpg" alt="">
                    </div>
                    <div class="right">
                        <form @submit.prevent="login">
                            <div class="m-input-wrap type02">
                                <h3 class="title">아이디</h3>
                                <div class="m-input m-input-text type01">
                                    <input type="text" placeholder="" v-model="form.ids">
                                </div>
                            </div>
                            <div class="m-input-wrap type02">
                                <h3 class="title">비밀번호</h3>
                                <div class="m-input m-input-text type01">
                                    <input type="password" placeholder="" v-model="form.password">
                                </div>
                            </div>

                            <p class="m-input-error">{{form.errors.ids}}</p>
                            <p class="m-input-error">{{form.errors.password}}</p>

                            <button class="btn type02 width-100">로그인</button>

                            <div class="box-bottom">
                                <div class="links">
                                    <Link href="/findIds/create" class="link">아이디 찾기</Link>
                                    <span class="deco">/</span>
                                    <Link href="/passwordResets/create" class="link">비밀번호 찾기</Link>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>
<script>
import {Link} from "@inertiajs/inertia-vue";
import Subgnbs from "../../Components/Subgnbs";

export default {
    components: {Subgnbs, Link},
    data(){
        return {
            form: this.$inertia.form({
                ids:"",
                password: ""
            })
        }
    },

    methods: {
        login() {
            this.form.post("/login")
        },

        clearLetter(){
            this.form.contact = this.form.contact.replace(/-/g, '');
        }
    }
}
</script>
