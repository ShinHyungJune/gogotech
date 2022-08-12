<template>
    <div class="area-message-history">
        <subgnbs />

        <div class="wrap-middle">
            <!--
            <div class="btns flex-end mt-20">
                <a href="#" class="btn type02 type-yellow">내역삭제</a>
            </div>
            -->

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

            <div class="m-empty type01 mt-20" v-if="letters.data.length === 0">
                데이터가 없습니다.
            </div>

            <div class="m-table-wrap mt-20" v-else>
                <table class="m-table type02">
                    <thead>
                    <tr>
                        <th>제목</th>
                        <th>작성내용</th>
                        <th>문자유형</th>
                        <th>총건수</th>
                        <th>성공</th>
                        <th>실패</th>
                        <th>대기</th>
                        <th>환불예정금액</th>
                        <th>수신거부</th>
                        <th>등록일시</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="letter in letters.data" :key="letter.id">
                        <td>{{letter.title}}</td>
                        <td v-html="letter.description" style="white-space: pre-line; text-align: left;"></td>
                        <td>{{letter.type}}</td>
                        <td>{{letter.count}}</td>
                        <td>{{letter.count_success}}</td>
                        <td>{{letter.count_fail}}</td>
                        <td>{{countWait(letter)}}</td>
                        <td>{{letter.refunded == 1 ? 0 : (letter.count_fail * letter.price).toLocaleString()}}</td>
                        <td>{{letter.count_reject}}</td>
                        <td>{{letter.created_at}}</td>
<!--                        <td>
                            <button class="m-btn type01 bg-red" v-if="countWait(letter) === 0 && letter.count_fail > 0 && letter.refunded == 0" @click="refund(letter)">환불하기</button>
                        </td>-->
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-10"></div>

            <pagination :meta="letters.meta" @paginate="(page) => {form.page = page; filter()}" />

            <div class="m-box-comment type01 mt-40">
                <h3 class="title">
                    <img src="/img/alert.png" alt="">
                    참고해주세요!
                </h3>

                <div class="mt-10"></div>

                <div class="m-before-square">전송실패건 환불은 전송시도가 완료된날 자정에 처리됩니다.</div>
                <div class="m-before-square">전송결과는 6개월간 보관되며, 기간이 경과한 데이터는 정기적으로 삭제됩니다.</div>
                <div class="m-before-square" style="display:flex;">
                    전송결과는 성공이지만 문자를 수신하지 못하는 경우

                    <button class="btn type01 type-small m-script-toggle" data-target="#pop">통신사별 스팸차단안내</button>
                </div>
            </div>

            <div class="m-pop m-pop-spam type01" id="pop">
                <div class="m-pop-header">
                    <h3 class="m-pop-header-title">
                        <img src="/img/message.png" alt="">
                        통신사별 고객센터
                    </h3>

                    <button class="m-pop-btn-close m-script-toggle" data-target="#pop">
                        <img src="/img/x.png" alt="">
                    </button>
                </div>

                <div class="m-pop-content">
                    <div class="fragment01">
                        <img src="/img/phone-alert.png" alt="">

                        <div class="box-body">
                            <p class="body">
                                전송결과가 성공적으로 확인되었지만 문자를 수신하지 못하는 경우
                                아래의 사항을 확인부탁드립니다.
                            </p>
                            <p class="body red">
                                현재 한국 인터넷진흥원 불법스팸대응센터에서 스팸종합 대책을
                                마련함에 따라 각 통신사별로 <span class="bg-green">“지능형 스팸차단 서비스”</span>를 진행하고 있기 때문에
                                지능형 스팸차단 서비스를 해지하시면 문자 수신이 가능합니다.
                            </p>
                        </div>
                    </div>

                    <div class="fragment02">
                        <h3 class="fragment-title">
                            <img src="/img/message.png" alt="">

                            <span class="bg-green">“지능형 스팸차단 서비스”</span> 란?
                        </h3>

                        <div class="boxes">
                            <div class="box">
                                문자 전송
                            </div>

                            <img src="/img/arrowRight-green.png" alt="" class="deco">

                            <div class="box">
                                각 통신사에서
                                <br/>문자문구 확인
                            </div>

                            <img src="/img/arrowRight-green.png" alt="" class="deco">

                            <div class="box">
                                스팸으로 판단시
                                <br/>스팸보관함으로 전송
                            </div>

                            <img src="/img/arrowRight-green.png" alt="" class="deco">

                            <div class="box">
                                전송완료
                                <br/>(전송성공/정상과금처리)
                            </div>
                        </div>

                        <p class="comment">
                            스팸문자 및 스팸문자 차단 확인은 개인정보 보호정책에 따라 본인만 확인 가능합니다.
                        </p>
                    </div>

                    <div class="fragment03">
                        <h3 class="fragment-title">
                            <img src="/img/message.png" alt="">

                            통신사별 차단된 스팸문자 확인방법
                        </h3>

                        <div class="box">
                            <img src="/img/t.png" alt="">

                            <div class="contents">
                                <div class="content">
                                    <p class="category">PC</p>
                                    <p class="body">
                                        SK T World 로그인 > my T > 기본정보 > 사용중인 상품 > 탭(부가서비스) > 모바일 >
                                        스팸필터링 (설정/변경) > 스팸내역 조회
                                    </p>
                                </div>
                                <div class="content">
                                    <p class="category bg-blue">APP</p>
                                    <p class="body">
                                        T 스팸필터링 App 실행 > 스팸리스트
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="box">
                            <img src="/img/kt.png" alt="">

                            <div class="contents">
                                <div class="content">
                                    <p class="category">PC</p>
                                    <p class="body">KT 올레 로그인 > 서비스 > 스팸차단서비스 > 스팸메시지함</p>
                                </div>
                                <div class="content">
                                    <p class="category bg-blue">APP</p>
                                    <p class="body">KT 스팸차단 App 실행 > 스팸메세지</p>
                                </div>
                            </div>
                        </div>

                        <div class="box">
                            <img src="/img/u.png" alt="">

                            <div class="contents">
                                <div class="content">
                                    <p class="category">PC</p>
                                    <p class="body">
                                        U+ 로그인 > 상품소개 > 휴대폰 상품보기 > 휴대폰 부가서비스 > 통화/문자 >
                                        스팸차단서비스 > 스팸내역조회
                                    </p>
                                </div>
                                <div class="content">
                                    <p class="category bg-blue">APP</p>
                                    <p class="body">
                                        U+ 스팸차단 App 실행 > 스팸메세지 함
                                    </p>
                                </div>
                            </div>
                        </div>
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
    components: {Subgnbs, Link, Pagination},

    data(){
        return {
            user: this.$page.props.user.data,
            letters: this.$page.props.letters,
            form: this.$inertia.form({
                page: 1,
                started_at: this.$page.props.started_at,
                finished_at:  this.$page.props.finished_at
            }),
            refundForm: this.$inertia.form({
                letter_id: ""
            })
        }
    },

    methods: {
        filter(){
            this.form.get("/letters", {
                preserveScroll: true,
                preserveState: true,
                replace: true,
                onSuccess: (page) => {
                    this.letters = page.props.letters;
                }
            });
        },

        countWait(letter){
            return letter.count - letter.count_success - letter.count_fail;
        },

        refund(letter){
            this.refundForm.letter_id = letter.id;

            this.refundForm.post("/refunds", {
                preserveScroll: true,
                preserveState : false
            })
        }
    },

    computed: {

    },

    mounted() {

    }
}
</script>
