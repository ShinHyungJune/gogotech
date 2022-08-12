<template>
    <div class="area-boards">
        <subgnbs name="FAQ" />

        <div class="wrap-middle">
<!--            <div class="btns">
                <div class="left">
                    <img src="/img/circleList.png" alt="" class="circle">

                    <h3 class="title">TOTAL <span class="blue">{{items.data.length}}</span></h3>
                </div>

                <div class="right">
                    <div class="m-input-withBtn type01">
                        <div class="m-input m-input-text type01">
                            <input type="text" v-model="form.word">
                        </div>

                        <button class="m-input-btn type-gray" @click="filter">조회</button>
                    </div>
                </div>
            </div>-->

            <div class="m-empty type01 mt-20" v-if="items.data.length === 0">
                데이터가 없습니다.
            </div>

            <div class="m-boards type01">
                <faq :faq="item" v-for="item in items.data" :key="item.id" />
            </div>

            <pagination :meta="items.meta" @paginate="(page) => {form.page = page; filter()}" />

        </div>
    </div>
</template>
<script>
import Pagination from "../../Components/Pagination";
import {Link} from '@inertiajs/inertia-vue';
import Faq from "../../Components/Faq";
import Subgnbs from "../../Components/Subgnbs";
export default {
    components: {Subgnbs, Faq, Link, Pagination},

    data(){
        return {
            user: this.$page.props.user.data,
            items: this.$page.props.faqs,
            form: this.$inertia.form({
                page: 1,
                word: "",
            })
        }
    },

    methods: {
        filter(){
            this.form.get("/faqs", {
                preserveScroll: true,
                preserveState: true,
                replace: true,
                onSuccess: (page) => {
                    this.items = page.props.faqs;
                }
            });
        },
    },

    computed: {

    },

    mounted() {

    }
}
</script>
