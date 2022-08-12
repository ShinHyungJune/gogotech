<template>
    <div class="users-edit subContent">
        <subgnbs />
<!--        <div class="sub-wrap">
            <div class="wrap-middle">
                <h3 class="title"><img src="/img/message.png" alt="">회원관리</h3>

                <div class="tabs">
                    <Link href="/users/edit" class="tab active">
                    <span class="text">
                        내정보변경
                        <img src="/img/triangle.png" alt="">
                    </span>
                    </Link>
                    <Link href="/users/remove" class="tab">
                    <span class="text">
                        회원탈퇴
                        <img src="/img/triangle.png" alt="">
                    </span>
                    </Link>
                </div>
            </div>
        </div>-->

        <div class="wrap-middle">

            <div class="m-dashboard type01">
                <div class="m-dashboard-container" >
                    <form @submit.prevent="update">
                        <table class="m-table type02 type-horizon">
                            <tbody>
                            <tr>
                                <th>이름</th>
                                <td>
                                    <div class="m-input-text type01">
                                        <input type="text" v-model="form.name">
                                    </div>

                                    <p class="m-input-error">{{form.errors.name}}</p>
                                </td>
                            </tr>
                            <tr>
                                <th>연락처</th>
                                <td>
                                    <div class="m-input-text type01">
                                        <input type="text" v-model="form.contact" disabled>
                                    </div>

                                    <p class="m-input-error">{{form.errors.contact}}</p>
                                </td>
                            </tr>
                            <tr>
                                <th>이메일</th>
                                <td>
                                    <div class="m-input-text type01">
                                        <input type="text" v-model="form.email">
                                    </div>

                                    <p class="m-input-error">{{form.errors.email}}</p>
                                </td>
                            </tr>
                            <tr>
                                <th>비밀번호</th>
                                <td>
                                    <button class="m-btn type05" @click="activePassword = true" v-if="!activePassword">비밀번호 변경</button>
                                    <div class="m-input-text type01" v-else>
                                        <input type="password" placeholder="비밀번호" v-model="form.password">
                                        <input type="password" placeholder="비밀번호 확인" style="margin-top:10px;" v-model="form.password_confirmation">
                                    </div>
                                    <div class="m-input-error">{{ form.errors.password }}</div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="m-box-total type01 mt-40">
                            <button class="m-btn type04">저장하기</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../../Components/Sidebar";
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";
import InputVerifyNumber from "../../Components/Form/InputVerifyNumber";
import Subgnbs from "../../Components/Subgnbs";
export default {
    components: {Subgnbs, Sidebar, Link, Pagination, InputVerifyNumber},
    data(){
        return {
            form: this.$inertia.form({
                password: "",
                password_confirmation: "",
                /*contact:this.$page.props.user.data.contact,
                contact_change : "",*/
                name: this.$page.props.user.data.name,
            }),
            activePassword: false
        }
    },
    methods:{
        update(){
            this.form.post("/users/update", {
                preserveScroll: true
            });
        }
    }
}
</script>
