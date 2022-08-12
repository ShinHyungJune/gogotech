<template>
    <div class="passwordReset-edit subContent mt-40">
        <form @submit.prevent="submit" @keyup="form.clearErrors()">
            <div class="wrap-auth">
                <h3 class="title">비밀번호 초기화</h3>

                <div class="m-input-wrap type01">
                    <h3 class="m-input-title">아이디</h3>

                    <div class="m-input-text type01">
                        <input type="text" v-model="form.ids">
                    </div>

                    <div class="m-input-error">{{ form.errors.ids }}</div>
                </div>

                <div class="m-input-wrap type01">
                    <h3 class="m-input-title">비밀번호</h3>

                    <div class="m-input-text type01">
                        <input type="password" v-model="form.password">
                    </div>

                    <div class="m-input-error">{{ form.errors.password }}</div>
                </div>

                <div class="m-input-wrap type01">
                    <h3 class="m-input-title">비밀번호 확인</h3>

                    <div class="m-input-text type01">
                        <input type="password" v-model="form.password_confirmation">
                    </div>

                    <div class="m-input-error">{{ form.errors.password_confirmation }}</div>
                </div>

                <div class="btns mt-40">
                    <button class="m-btn type04">비밀번호 초기화</button>
                </div>
            </div>
        </form>

    </div>
</template>
<script>
export default {
    data() {
        return {
            form: this.$inertia.form({
                ids: "",
                password: "",
                password_confirmation: "",
                token: location.pathname.split("/")[2]
            })
        }
    },

    methods: {
        submit() {
            this.form.patch("/passwordResets/" + this.form.token);
        },
    }
}
</script>
