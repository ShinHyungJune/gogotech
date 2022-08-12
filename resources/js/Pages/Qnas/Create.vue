<template>
    <div class="area-boards">
        <div class="wrap-middle mt-40">
            <form @submit.prevent="store">
                <table class="m-table type02 type-horizon">
                    <tbody>
                    <tr>
                        <th>문의내용</th>
                        <td>
                            <div class="m-input-textarea type01 small center">
                                <textarea v-model="form.question"></textarea>
                            </div>

                            <p class="m-input-error">{{form.errors.question}}</p>

                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="m-box-total type01 mt-40">
                    <button class="m-btn type04">저장하기</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import Pagination from "../../Components/Pagination";
import {Link} from '@inertiajs/inertia-vue';
import Qna from "../../Components/Qna";
export default {
    components: {Qna, Link, Pagination},

    data(){
        return {
            form: this.$inertia.form({
                question:""
            }),
        }
    },

    methods: {
        store(){
            this.form.post("/qnas");
        },
    },

    computed:{

    }
}
</script>
