<template>
    <div class="m-pop type01 agency-text" style="display: block;">
        <div class="m-pop-header">
            <h3 class="title">3사 발송테스트</h3>

            <button class="m-pop-close" @click="close">
                <img src="/img/x.png" alt="">
            </button>
        </div>
        <div class="m-pop-content">
            <div class="box-send">
                <table class="m-table type02 type-horizon">
                    <tbody>
                    <tr>
                        <th>
                            수신자
                        </th>
                        <td>
                            <div class="box-input-send">
                                <div class="list" v-if="form.contact_type === '직접입력'">
                                    <p class="contact" v-for="(contact, index) in form.contacts" :key="index">
                                        {{ contact }}
                                    </p>
                                </div>

                                <div class="m-input-error">
                                    {{form.errors.contacts}}
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            발신자
                        </th>
                        <td>
                            <div class="m-input-radios type01">
                                <h3 class="title">발신번호</h3>

                                <div class="m-input-text type01">
                                    <input type="text" v-model="user.contact" disabled>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            최근 테스트 일자
                        </th>
                        <td>
                            <div v-if="testLetter">{{testLetter.created_at}}</div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            업체명
                        </th>
                        <td>
                            <div class="m-input-text type01">
                                <input type="text" v-model="form.company" placeholder="업체명을 입력해주세요.">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            발송내용
                        </th>
                        <td>
                            <div class="m-input-textarea type01">
                                <textarea v-model="form.description" placeholder="내용을 입력해주세요." style="min-height:100px;"></textarea>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="box-result mt-20" v-if="testLetter">
                <table class="m-table type02">
                    <thead>
                    <tr>
                        <th>
                            통신사
                        </th>
                        <th>
                            수신번호
                        </th>
                        <th>
                            결과상세
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-if="testLetter.logs.length !== 3">
                        <td colspan="3">발송이 진행중입니다.</td>
                    </tr>
                    <tr v-for="(log, index) in testLetter.logs" :key="index">
                        <td >{{log.agency ? log.agency : agency(log.receiver)}}</td>
                        <td >{{log.receiver}}</td>
                        <td >{{log.resultCode}} ({{log.resultMessage}})</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <p class="m-comment type01 mt-20" style="text-align: center;" v-if="timer">
                * 발송상태가 {{countdown}}초 뒤 자동갱신되어 보여집니다.
            </p>

            <div class="btns center mt-20">
                <button type="button" class="btn type02" v-if="loading">
                    <span class="text animated infinite flash" style="color:#fff;">발송중</span>
                </button>

                <button type="button" class="btn type02" @click="send" v-else>
                    <span class="text" style="color:#fff;">발송하기</span>
                </button>
            </div>
        </div>

    </div>
</template>
<script>
import Pagination from "../../Components/Pagination";
import {Link} from '@inertiajs/inertia-vue';
import InputDate from "../../Components/Form/InputDate";
import InputNumber from "../../Components/Form/InputNumber";

export default {
    components: {InputNumber, Link, Pagination, InputDate},

    data() {
        return {
            testLetter: this.$page.props.testLetter.data,
            form: this.$inertia.form({
                letterLogs: [],
                type: "SMS",
                company: "",
                contact_type: "직접입력",
                category: "광고",
                title: "3사 발송테스트", // 메세지 제목
                description: "", // 메세지 내용
                contacts: [
                    "01021870367",
                    "01059503063",
                    "01023030990",
                ], // 받을 사람
                sender: "", // 발신번호
                pushed_at: "", // 발송시간
                book_id: "",
                test: 1,
            }),

            user: this.$page.props.user.data,

            contact: "",
            reservation: 0,
            loading: false,
            letter: "",
            timer: null,
            countdown: 5,
            countdownUnit: 5,
        }
    },

    methods: {
        send(){
            this.loading = true;

            if(!this.reservation)
                this.form.pushed_at = "";

            if(this.form.contact_type === "직접입력")
                this.form.book_id = "";

            if(this.form.contact_type === "복사/붙여넣기")
                this.form.book_id = "";

            if(this.count === 0)
                return alert("최소 1명 이상의 수신인을 등록해주세요.");

            var regex = /[^0-9]/g;				// 숫자가 아닌 문자열을 선택하는 정규식

            this.form.contacts = this.form.contacts.map(contact => contact.replace(regex, ""));

            if(this.timer){
                clearTimeout(this.timer);
                this.timer = null;
            }

            this.form.post("/letters", {
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    this.loading = false;

                    this.user = page.props.user.data;

                    this.testLetter = page.props.testLetter.data;

                    this.tiktok();
                },
                onError: (page) => {
                    this.loading = false;
                },
                onFailure: (page) => {
                    this.loading = false;
                }
            });
        },

        close(){
            /*
            if(this.timer)
                clearTimeout(this.timer);
            */

            this.$emit("close");
        },

        checkLetter(){
            this.form.get("/letters/" + this.testLetter.id, {
                onSuccess:(page) => {
                    this.testLetter = page.props.testLetter.data;

                    if(this.testLetter.logs.length === 3) {
                        clearTimeout(this.timer);

                        this.timer = null;
                    }
                },
                preserveScroll: true,
                preserveState: true
            });
        },

        tiktok(){
            let self = this;
            if(this.testLetter && this.testLetter.logs.length !== 3)
                this.timer = setInterval(() => {
                    self.countdown -= 1;

                    if(self.countdown === 0) {
                        self.checkLetter();
                        self.countdown = self.countdownUnit;
                    }
                }, 1000);

        },

        agency(receiver){
            if(receiver === "01021870367")
                return "KT";

            if(receiver === "01059503063")
                return "SK";

            if(receiver === "01023030990")
                return "U+";

            return "";
        }
    },
    computed: {
        count(){
            if(this.form.contact_type === "직접입력")
                return this.form.contacts.length;

            if(this.form.contact_type === "복사/붙여넣기")
                return this.form.contacts.length;

            if(this.form.contact_type === "주소록") {
                let book = this.books.data.find(book => book.id == this.form.book_id);

                return book ? book.count : 0;
            }

            return 0;
        },
    },

    mounted() {

        this.tiktok();
    }
}
</script>
