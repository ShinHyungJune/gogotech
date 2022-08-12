<template>
    <div class="area-boards">
        <subgnbs name="공지사항" />

        <div class="wrap-middle">
            <div class="btns">
                <div class="left">
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
            </div>

            <div class="m-empty type01 mt-20" v-if="items.data.length === 0">
                데이터가 없습니다.
            </div>

            <div class="m-table-wrap mt-20" v-else>
                <div class="m-table-wrap">
                    <table class="m-table type03">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>제목</th>
                            <th>등록일</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in items.data" :key="item.id">
                            <td>{{item.id}}</td>
                            <td>
                                <Link :href="`/notices/${item.id}`">{{ item.title }}</Link>
                            </td>
                            <td>{{item.created_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <pagination :meta="items.meta" @paginate="(page) => {form.page = page; filter()}" />

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
            items: this.$page.props.notices,
            form: this.$inertia.form({
                page: 1,
                word: "",
            })
        }
    },

    methods: {
        filter(){
            this.form.get("/notices", {
                preserveScroll: true,
                preserveState: true,
                replace: true,
                onSuccess: (page) => {
                    this.items = page.props.notices;
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
