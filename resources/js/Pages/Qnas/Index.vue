<template>
    <div class="area-boards">
        <subgnbs name="1대1문의" />

        <div class="wrap-middle">
            <div class="m-empty type01" v-if="qnas.data.length === 0">
                문의내역이 없습니다.
            </div>
            <div class="m-boards type01">
                <qna :qna="qna" v-for="qna in qnas.data" :key="qna.id" />
            </div>

            <div class="m-box-total type01 mt-40">
                <Link href="/qnas/create" class="m-btn type04">문의하기</Link>
            </div>

            <div class="mt-10"></div>

            <pagination :meta="qnas.meta" @paginate="(page) => {form.page = page; filter()}" />
        </div>
    </div>
</template>
<script>
import Pagination from "../../Components/Pagination";
import {Link} from '@inertiajs/inertia-vue';
import Qna from "../../Components/Qna";
import Subgnbs from "../../Components/Subgnbs";
export default {
    components: {Subgnbs, Qna, Link, Pagination},

    data(){
        return {
            user: this.$page.props.user.data,
            qnas: this.$page.props.qnas,
            form: this.$inertia.form({
                page: 1,
                word: "",
            })
        }
    },

    methods: {
        filter(){
            this.form.get("/qnas", {
                preserveScroll: true,
                preserveState: true,
                replace: true,
                onSuccess: (page) => {
                    this.qnas = page.props.qnas;
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
