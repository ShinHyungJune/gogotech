<template>
    <div class="area-message-history">
        <subgnbs name="충전요청내역" />

        <div class="wrap-middle">
            <div class="btns flex-end">
                <div class="m-input-withBtn type01">
                    <div class="m-input m-input-dates">
                        <div class="m-input-date type01">
                            <input type="date" v-model="form.started_at">
                        </div>

                        <span class="wave">~</span>

                        <div class="m-input-date type01">
                            <input type="date" v-model="form.finished_at">
                        </div>
                    </div>

                    <button class="m-input-btn type-gray" @click="filter">조회</button>
                </div>
            </div>

            <div class="m-empty type01 mt-20" v-if="charges.data.length === 0">
                데이터가 없습니다.
            </div>

            <div class="m-table-wrap mt-20" v-else>
                <table class="m-table type02">
                    <thead>
                    <tr>
                        <th>날짜</th>
                        <th>금액</th>
                        <th>결제방식</th>
                        <th>승인여부</th>
                        <th>비고</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="charge in charges.data" :key="charge.id">
                        <td>{{charge.created_at}}</td>
                        <td>{{parseInt(charge.price).toLocaleString()}}</td>
                        <td>계좌이체</td>
                        <td>{{state(charge)}}</td>
                        <td>{{charge.reason}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-10"></div>

            <pagination :meta="charges.meta" @paginate="(page) => {form.page = page; filter()}" />

            <div class="m-box-comment type01 mt-40">
                <h3 class="title">
                    <img src="/img/alert.png" alt="">
                    참고해주세요!
                </h3>

                <div class="mt-10"></div>

                <div class="m-before-square">
                    세금계산서는 월 결제금액을 합산하여 매월 말일자로 익월초 발행됩니다.
                </div>
                <div class="m-before-square">
                    분기 마감된 세금계산서는 발행이 불가능합니다.
                </div>
                <div class="m-before-square">
                    세금계산서 발급은 신청한 회원님에 대해서만 발행되며, 신용카드 결제금액은 제외됩니다.
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import Pagination from "../../Components/Pagination";
import {Link} from '@inertiajs/inertia-vue';
import Subgnbs from "../../Components/Subgnbs";
export default {
    components: {Subgnbs, Link, Pagination},

    data(){
        return {
            user: this.$page.props.user.data,
            charges: this.$page.props.charges,
            form: this.$inertia.form({
                page: 1,
                started_at: "",
                finished_at: ""
            })
        }
    },

    methods: {
        filter(){
            this.form.get("/charges", {
                preserveScroll: true,
                preserveState: true,
                replace: true,
                onSuccess: (page) => {
                    this.charges = page.props.charges;
                }
            });
        },

        state(charge){
            if(charge.state === "FAIL")
                return "반려";

            if(charge.state === "SUCCESS")
                return "성공";

            if(charge.state === "WAIT")
                return "대기";
        }
    },

    computed: {

    },

    mounted() {

    }
}
</script>
