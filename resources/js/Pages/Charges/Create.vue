<template>

    <div class="area-price">
        <subgnbs />

        <div class="wrap">
            <div class="boxes">
                <div class="box left">
                    <div class="box-price">
                        <h3 class="title">내 잔여 금액</h3>

                        <p class="body">8,000원</p>
                    </div>

                    <div class="prices">
                        <div class="price-wrap">
                            <div class="price">
                                <span class="title">SMS</span>
                                <span class="body primary">{{user.price_sms}}원</span>
                            </div>
                        </div>

                        <div class="price-wrap">
                            <div class="price">
                                <span class="title">LMS</span>
                                <span class="body primary">{{user.price_lms}}원</span>
                            </div>
                        </div>
                    </div>

                    <div class="fragment">
                        <h3 class="title">
                            계좌이체 정보
                        </h3>

                        <div class="m-input-wrap type01">
                            <div class="m-input-text type01">
                                <input type="text" value="농협: 301-0307-0766-71" disabled>
                            </div>
                        </div>

                        <div class="m-input-text type01">
                            <input type="text" value="예금주: (주)하이앤드" disabled>
                        </div>
                    </div>

                    <div class="fragment">
                        <h3 class="title">
                            결제내용 입력
                        </h3>

                        <div class="m-input-wrap type01">
                            <div class="m-input-text type01">
                                <input type="number" placeholder="결제금액 (최소금액은 10,000원입니다.)" v-model="form.price">
                            </div>

                            <p class="m-input-error">{{form.errors.price}}</p>
                        </div>

                        <div class="m-input-wrap type01">
                            <div class="m-input-text type01">
                                <input type="text" placeholder="입금자명" v-model="form.name">
                            </div>

                            <p class="m-input-error">{{form.errors.name}}</p>
                        </div>
                    </div>
                </div>

                <div class="box right">
                    <div class="box-total">
                        <h3 class="title">결제내용</h3>

                        <div class="infos">
                            <div class="info">
                                <h3 class="title">결제요청금액</h3>
                                <p class="body">{{ parseInt(form.price).toLocaleString() }}원</p>
                            </div>

                            <div class="info">
                                <h3 class="title">입금자명</h3>
                                <p class="body">{{ form.name }}</p>
                            </div>

                            <div class="info">
                                <h3 class="title">결제수단</h3>
                                <p class="body">계좌이체</p>
                            </div>
                        </div>

                        <p class="comment">계좌이체 후 충전요청을 진행해주시면, 관리자 확인 후 충전이 진행됩니다.</p>

                        <button class="btn type02 width-100" @click="store">충전요청하기</button>
                    </div>

                    <div class="box-bottom">
                        <h3 class="title">규정안내</h3>

                        <p class="body">입금자명에 아이디를 적으시면 충전과정이 빠르게
                            진행됩니다.</p>
                        <p class="body">세금계산서는 월 결제금액을 합산하여 매월 말일자로
                            익월초 발행됩니다.</p>
                        <p class="body">분기 마감된 세금계산서는 발행이 불가능합니다.</p>
                        <p class="body">세금계산서 발급은 신청한 회원님에 대해서만
                            발행됩니다.</p>
                        <p class="body">충전요청이 지연된다면 고객센터로 전화문의
                            부탁드립니다.</p>
                    </div>
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
    components: {Subgnbs, Link, Pagination,},

    data(){
        return {
            user: this.$page.props.user.data,

            sectionForm: this.$inertia.form({

            }),

            form: this.$inertia.form({
                price: 0,
                name: ""
            }),
        }
    },

    methods: {
        store(){
            this.form.post("/charges", {
                preserveScroll: true
            });
        }
    },
    computed: {

    },
    mounted() {

    }
}
</script>
