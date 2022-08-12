<template>
    <div>
        <subgnbs name="주소록" />

        <div class="area-address">
            <div class="wrap-middle">
                <div class="m-comment type01 mt-20">
                    <h3 class="title" style="text-align: center;">엑셀 업로드 시 1열은 이름, 2열은 연락처를 입력한 파일형태로 업로드 부탁드립니다.</h3>
                </div>

                <div class="btns flex-end mt-20">
                    <div class="m-input-withBtn type01">
                        <div class="m-input m-input-text type01">
                            <input type="text" placeholder="이름을 입력해주세요" v-model="form.name">
                        </div>

                        <div class="m-input m-input-text type01" style="margin-left:10px;">
                            <input type="text" placeholder="연락처를 입력해주세요" v-model="form.contact">
                        </div>


                        <button type="button" class="m-input-btn type-yellow" @click="add">연락처추가</button>
                        <input type="file" @change="changeFile" style="display:none;" id="file">
                        <label type="button" for="file" class="m-input-btn type-yellow" style="cursor:pointer;">
                            <span class="text animated flash infinite" v-if="loading">업로드 진행중</span>
                            <span class="text" v-else>엑셀업로드</span>
                        </label>
                    </div>

                    <p class="m-input-error">{{form.errors.name}}</p>
                    <p class="m-input-error">{{form.errors.contact}}</p>

                </div>

                <div class="m-empty type01 mt-20" v-if="contacts.data.length === 0">
                    데이터가 없습니다.
                </div>

                <div class="m-table-wrap mt-20" v-else>
                    <table class="m-table type02">
                        <colgroup>
                            <col style="width:40%">
                            <col style="width:40%">
                            <col style="width:20%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>이름</th>
                            <th>연락처</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="contact in contacts.data" :key="contact.id">
                            <td>{{contact.name ? contact.name : "-"}}</td>
                            <td>{{contact.contact}}</td>
                            <td>
                                <div class="btns flex center">
                                    <button class="btn type02 bg-red" @click="remove(contact)">삭제</button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-10"></div>

                <pagination :meta="contacts.meta" @paginate="(page) => {form.page = page; filter()}" />

                <div class="m-box-comment type01 mt-40">
                    <h3 class="title">
                        <img src="/img/alert.png" alt="">
                        참고해주세요!
                    </h3>

                    <div class="mt-10"></div>

                    <div class="m-before-square">
                        한 그룹에 최대 50,000개의 연락처를 등록하실 수 있습니다.
                    </div>
                    <div class="m-before-square">
                        그룹명을 클릭하시면 개별주소 리스트를 확인하실 수 있습니다.
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
            contacts: this.$page.props.contacts,
            book: this.$page.props.book.data,
            form: this.$inertia.form({
                page: 1,
                name: "",
                contact:"",
                file: "",
                book_id: this.$page.props.book.data.id,
            }),
            loading: false
        }
    },

    methods: {
        filter(){
            this.form.get("/contacts", {
                preserveScroll: true,
                preserveState: false,
                replace: true
            });
        },

        remove(contact){
            this.form.delete("/contacts/" + contact.id,{
                preserveScroll: true,
                preserveState:false
            });
        },

        add(){
            this.form.post("/contacts", {
                preserveScroll: true,
                preserveState:false
            });
        },

        changeFile(event) {
            this.loading = true;

            this.form.file = event.target.files[0];

            this.form.post("/contacts/upload", {
                onSuccess: (page) => {
                    this.loading = false;
                },
                preserveScroll: true,
                preserveState:false
            });
        },
    },

    mounted() {

    }
}
</script>
