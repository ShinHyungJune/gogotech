<template>
    <div class="area-message-history">
        <div class="wrap-middle">
            <div class="m-detail type02 mt-40">
                <div class="head">
                    <div class="content">
                        <div class="top">
                            <h3 class="title">{{ notice.title }}</h3>
                        </div>

                        <div class="infos">
                            <div class="info">
                                <h3 class="title">등록일</h3>
                                <div class="body">
                                    {{ notice.created_at }}
                                </div>
                            </div>
                            <div class="info">
                                <h3 class="title">조회수</h3>
                                <div class="body">
                                    {{ notice.count_view }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-box type01">
                <h3 class="title">상세내용</h3>

                <div v-html="notice.description"></div>
            </div>
        </div>
    </div>
</template>
<script>
import Pagination from "../../Components/Pagination";
import {Link} from '@inertiajs/inertia-vue';
export default {
    components: {Link, Pagination},

    data(){
        return {
            notice: this.$page.props.notice.data
        }
    },

    methods: {
        filter(){

        },

        state(charge){

        }
    },

    computed: {

    },

    mounted() {

    }
}
</script>
