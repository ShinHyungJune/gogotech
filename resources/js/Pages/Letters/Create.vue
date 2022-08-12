<template>
    <div>
        <!--
        <agency-test v-if="activeTest" @close="() => {this.activeTest = false}"/>
        -->

        <subgnbs />

        <div class="area-send">
            <div class="wrap-middle">
                <div class="box-top">
                    <h3 class="title">잔여금액 : <span class="point">{{ user.point.toLocaleString() }}</span>원</h3>

                    <div class="boxes">
                        <div class="box-wrap">
                            <div class="box">
                                건당 {{user.price_sms}}원
                                <br/><span class="point">SMS: {{ countSms }}건</span>
                            </div>
                        </div>

                        <div class="box-wrap">
                            <div class="box">
                                건당 {{user.price_lms}}원
                                <br/><span class="point">MMS: {{ countLms }}건</span>
                            </div>
                        </div>

                        <!--
                        <div class="box-wrap">
                            <div class="box">
                                MMS: {{ countMms }}건(건당 100원)
                            </div>
                        </div>
                        -->
                    </div>

                    <p class="comment">
                        현재 보여지는 잔여건수는 SMS, LMS 를 전송할 수 있는 최대건수 입니다.
                        <br/>각각의 건수가 충전되어 있는 것이 아니며 충전된 금액은 건수로 환산해 놓은 것입니다.
                    </p>
                </div>

                <div class="box-send">
                    <div class="box-phone-wrap">
                        <div class="box-phone">
                            <div class="top">
                                <div class="left">
                                    <img src="/img/letter.png" alt="">
                                    SMS
                                </div>

                                <p class="right">
                                    {{ byte }}/{{ max }}Byte
                                </p>
                            </div>

                            <p class="category">({{form.category}}){{form.company}}</p>

                            <pre class="body">{{form.description}}</pre>

                            <pre class="body">
                            무료거부0808550688
                        </pre>
                        </div>
                    </div>

                    <table class="m-table type02 type-horizon">
                        <tbody>
                        <tr>
                            <th rowspan="2">01. 발송정보</th>
                            <td>
                                <div class="m-input-radios type01">
                                    <h3 class="title">발송유형</h3>

                                    <div class="m-input-radio type02">
                                        <input type="radio" id="SMS" value="SMS" v-model="form.type">
                                        <label for="SMS">SMS</label>
                                    </div>

                                    <div class="m-input-radio type02">
                                        <input type="radio" id="LMS" value="LMS" v-model="form.type">
                                        <label for="LMS">LMS</label>
                                    </div>

                                    <div class="m-input-error">
                                        {{form.errors.type}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="m-input-radios type01">
                                    <h3 class="title">메세지구분</h3>

                                    <div class="m-input-radio type02">
                                        <input type="radio" id="광고" value="광고" v-model="form.category">
                                        <label for="광고">광고</label>
                                    </div>

                                    <!--
                                    <div class="m-input-radio type02">
                                        <input type="radio" id="정보" value="정보" v-model="form.category">
                                        <label for="정보">정보</label>
                                    </div>

                                    <div class="m-input-radio type02">
                                        <input type="radio" id="선거" value="선거" v-model="form.category">
                                        <label for="선거">선거</label>
                                    </div>
                                    -->
                                </div>

                                <div class="m-input-error">
                                    {{form.errors.category}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                02. 업체명
                            </th>
                            <td>
                                <div class="m-input-text type01">
                                    <input type="text" v-model="form.company">
                                </div>

                                <div class="m-input-error">
                                    {{form.errors.company}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                03. 메세지 내용
                            </th>
                            <td>
                                <div class="m-input-text type01" v-if="form.type === 'LMS'">
                                    <input type="text" placeholder="제목을 입력해주세요." v-model="form.title" />
                                </div>

                                <div class="m-input-error" v-if="form.type === 'LMS'">
                                    {{form.errors.title}}
                                </div>

                                <div class="m-input-textarea type01">
                                    <textarea placeholder="내용을 입력해주세요." @keyup="smsByteChk"></textarea>
                                </div>

                                <div class="m-input-error">
                                    {{form.errors.description}}
                                </div>

                                <!--
                                <div class="btns flex-end mt-10">
                                    <button type="button" class="btn type02 type-gray">템플릿 불러오기</button>
                                </div>
                                -->
                            </td>
                        </tr>
                        <tr>
                            <th>
                                04. 수신자 선택
                            </th>
                            <td>
                                <div class="box-input-send">
                                    <div class="m-input-radios type01">
                                        <div class="m-input-radio type02">
                                            <input type="radio" id="직접입력" value="직접입력" name="contact_type" v-model="form.contact_type" @change="resetContacts">
                                            <label for="직접입력">직접입력</label>
                                        </div>

                                        <div class="m-input-radio type02">
                                            <input type="radio" id="주소록" value="주소록" name="contact_type" v-model="form.contact_type" @change="resetContacts">
                                            <label for="주소록">주소록</label>
                                        </div>

                                        <div class="m-input-radio type02">
                                            <input type="radio" id="복사/붙여넣기" value="복사/붙여넣기" name="contact_type" v-model="form.contact_type" @change="resetContacts">
                                            <label for="복사/붙여넣기">복사/붙여넣기</label>
                                        </div>

<!--                                        <div class="m-input-radio type02">
                                            <input type="radio" id="" value="" name="contact_type">
                                            <label for="" @click="() => {this.activeTest = true}">3사 테스트</label>
                                        </div>-->
                                    </div>

                                    <div class="m-input-withBtn type01 mt-20" v-if="form.contact_type === '직접입력'">
                                        <div class="m-input m-input-text type01">
                                            <input type="text" placeholder="번호를 입력하세요." v-model="contact">
                                        </div>

                                        <button type="button" class="m-input-btn type-gray" @click="addContact">번호추가</button>
                                    </div>

                                    <div class="mt-20" v-if="form.contact_type === '주소록'">
                                        <div class="m-input-withBtn type01">
                                            <Link href="/books" class="m-input-btn type-gray" style="margin-left:0;">주소록관리</Link>
                                        </div>

                                        <div class="m-input-radio type01" v-for="book in books.data" :key="book.id">
                                            <input type="radio" :id="book.id" :value="book.id" v-model="form.book_id">
                                            <label :for="book.id">{{ book.title }}</label>
                                        </div>
                                    </div>

                                    <div class="mt-20" v-if="form.contact_type === '복사/붙여넣기'">
                                        <div class="m-comment type01">
                                            <h3 class="title">아래 같은 형태로 입력해주세요.</h3>

                                            <p class="body">
                                                # 예시1
                                                <br/>010-1234-1234
                                                <br/>010-3333-1111
                                                <br/>10-1234-1234
                                                <br/>10-3333-1111
                                            </p>

                                            <p class="body">
                                                # 예시2
                                                <br/>01012341234
                                                <br/>01033221222
                                                <br/>1012341234
                                                <br/>1033221222
                                            </p>
                                        </div>

                                        <div class="m-input-textarea type01 mt-10">
                                            <textarea @keyup="formContacts" ref="contacts"></textarea>
                                        </div>
                                    </div>

                                    <p class="count">수신자: {{count}}명 (중복제외, 최대 {{this.maxContact}}명까지만 발송가능)</p>

                                    <div class="list" v-if="form.contact_type === '직접입력'">
                                        <p class="contact" v-for="(contact, index) in form.contacts" :key="index">
                                            {{ contact }}
                                        </p>
                                    </div>

                                    <div class="m-input-error">
                                        {{form.errors.contacts}}
                                    </div>

                                    <div class="btns flex-end mt-20">
                                        <button type="button" class="btn type02 type-gray" @click="removeAllContact">전체삭제</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                05. 발신자 선택
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
                            <th rowspan="2">
                                06. 발송옵션 선택
                            </th>
                            <td>
                                <div class="m-input-radios type01">
                                    <h3 class="title">발송옵션</h3>

                                    <div class="m-input-radio type02">
                                        <input type="radio" :value="0" name="reservation" id="unreservation" v-model="reservation">
                                        <label for="unreservation">즉시</label>
                                    </div>

                                    <div class="m-input-radio type02">
                                        <input type="radio" id="reservation" name="reservation" :value="1" v-model="reservation">
                                        <label for="reservation">예약</label>
                                    </div>
                                </div>

                                <div class="m-input-text type01 mt-10" v-if="reservation">
                                    <input type="datetime-local" v-model="form.pushed_at">
                                </div>

                                <div class="m-input-error">
                                    {{form.errors.pushed_at}}
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <div class="btns flex-end mt-20">
                    <button type="button" class="btn type02" v-if="loading">
                        <span class="text animated infinite flash" style="color:#fff;">발송중</span>
                    </button>

                    <button type="button" class="btn type02" @click="send" v-else>
                        <span class="text" style="color:#fff;">발송하기</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Pagination from "../../Components/Pagination";
import {Link} from '@inertiajs/inertia-vue';
import InputDate from "../../Components/Form/InputDate";
import InputNumber from "../../Components/Form/InputNumber";
import AgencyTest from "./AgencyTest";
import Subgnbs from "../../Components/Subgnbs";

export default {
    components: {Subgnbs, AgencyTest, InputNumber, Link, Pagination, InputDate},

    data() {
        return {
            form: this.$inertia.form({
                type: "SMS",
                company: "",
                contact_type: "직접입력",
                category: "광고",
                title: "", // 메세지 제목
                description: "", // 메세지 내용
                contacts: [], // 받을 사람
                sender: "", // 발신번호
                pushed_at: "", // 발송시간
                book_id: this.$page.props.book_id ? this.$page.props.book_id : "",
                test: 0,
            }),

            bookForm: this.$inertia.form({
                file: "",
                title: ""
            }),

            books: this.$page.props.books,

            user: this.$page.props.user.data,

            contact: "",
            reservation: 0,
            loading: false,
            activeTest: false,
            maxContact: 10000
        }
    },

    methods: {
        getByte(str) {
            var resultSize = 0;
            if (str == null) {
                return 0;
            }
            for (var i = 0; i < str.length; i++) {
                var c = escape(str.charAt(i));
                if (c.length == 1) {
                    resultSize++;
                } else if (c.indexOf("%u") != -1) {
                    resultSize += 2;
                } else {
                    resultSize++;
                }
            }
            return resultSize;
        },

        smsByteChk(e) {
            var temp_str = e.target.value;
            var remain = this.max - this.getByte(temp_str) - this.getByte(this.form.company);

            if (remain < 0) {
                alert(this.max + "Bytes를 초과할 수 없습니다.");
                while (remain < 0) {
                    temp_str = temp_str.substring(0, temp_str.length - 1);
                    e.target.value = temp_str;
                    this.form.description = temp_str;
                    remain = this.max - this.getByte(temp_str);
                }

                return e.target.focus();
            }

            this.form.description = temp_str;
        },

        changeDescription(e) {
            if (this.getByte(e.target.value) + this.getByte(form.company) > this.max) {
                return alert("최대 " + this.max + "byte까지만 입력할 수 있습니다.");
            }

            this.form.description = e.target.value;
        },

        removeAllContact(){
            this.form.contacts = [];
        },

        addContact(){
            if(this.contact === "")
                return alert("번호를 입력해주세요.");

            if(this.form.contacts.includes(this.contact))
                return alert("이미 추가된 번호입니다.");

            this.form.contacts.push(this.contact);
        },

        send(){
            if(this.form.contacts.length > this.maxContact)
                return alert(`최대 ${this.maxContact}천명까지만 발송 가능합니다.`);

            if(!this.reservation)
                this.form.pushed_at = "";

            if(this.form.contact_type === "직접입력")
                this.form.book_id = "";

            if(this.form.contact_type === "복사/붙여넣기")
                this.form.book_id = "";

            if(this.count === 0)
                return alert("최소 1명 이상의 수신인을 등록해주세요.");

            if(this.form.type === "SMS" && this.byte > 64)
                return alert("최대 64byte까지만 발송 가능합니다.");

            if(this.form.type === "LMS" && this.byte > 1964)
                return alert("최대 1964byte까지만 발송 가능합니다.");

            var regex = /[^0-9]/g;				// 숫자가 아닌 문자열을 선택하는 정규식

            this.form.contacts = this.form.contacts.map(contact => contact.replace(regex, ""));

            this.loading = true;

            this.form.post("/letters", {
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    this.loading = false;

                    this.form.contacts = [];

                    this.form.book_id = null;

                    if(this.$refs.contacts)
                        this.$refs.contacts.value = "";

                    this.user = page.props.user.data;
                },
                onError: (page) => {
                    this.loading = false;
                },
                onFailure: (page) => {
                    this.loading = false;
                }
            });
        },

        resetContacts(){
            this.form.contacts = [];
        },

        formContacts(e){
            const contacts = e.target.value.split("\n");

            let uniqueContacts = [];

            contacts.forEach((contact) => {
                if(contact.slice(0,2) == "10")
                    contact = "0" + contact;

                if (!uniqueContacts.includes(contact) && contact !== "") {
                    uniqueContacts.push(contact);
                }
            });

            this.form.contacts = uniqueContacts;
        }
    },
    computed: {
        countSms() {
            return Math.floor(this.user.point / this.user.price_sms);
        },

        countLms() {
            return Math.floor(this.user.point / this.user.price_lms);
        },

        byte() {
            var resultSize = 0;
            if (this.form.description == null) {
                return 0;
            }

            for (var i = 0; i < this.form.description.length + this.form.company.length; i++) {
                var c = escape((this.form.description + this.form.company).charAt(i) );
                if (c.length == 1) {
                    resultSize++;
                } else if (c.indexOf("%u") != -1) {
                    resultSize += 2;
                } else {
                    resultSize++;
                }
            }
            return resultSize;
        },
        max() {
            // return this.form.type === "SMS" ? 44 : 1956;
            return this.form.type === "SMS" ? 64 : 1964;
        },
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
    }
}
</script>
