<template>
    <!-- 헤더 -->
    <header class="header">
        <div class="black"></div>

        <div class="wrap">
            <Link href="/" class="logo">
                <img src="/img/logo.png" alt="">
            </Link>

            <div class="right">
                <nav class="navs">
                    <div class="nav">
                        <Link href="/letters/create" class="text">문자발송</Link>
                    </div>

                    <div class="nav">
                        <Link href="/books" class="text">주소록</Link>
                    </div>

                    <div class="nav">
                        <Link href="/letters" class="text">전송내역</Link>
                    </div>

                    <div class="nav">
                        <Link href="/charges/create" class="text">충전하기</Link>
                    </div>

                    <div class="nav">
                        <Link href="/charges" class="text">충전내역</Link>
                    </div>

                    <div class="nav">
                        <Link href="/users/edit" class="text">마이페이지</Link>
                    </div>

                    <div class="nav">
                        <Link href="/notices" class="text">공지사항</Link>
                    </div>
                </nav>

                <!-- 로그인 전 -->
                <div class="utils" v-if="!user">
                    <a href="/certifications/create" class="util">
                        <img src="/img/user-plus.png" alt="">
                        회원가입
                    </a>
                    <Link href="/login" class="util point">
                        <img src="/img/user.png" alt="">
                        로그인
                    </Link>
                </div>

                <!-- 로그인 후 -->
                <div class="utils" v-else>
                    <button class="util" style="padding-right:0;">잔액 : {{user.point.toLocaleString()}}원</button>
                    <Link href="/logout" class="util point">
                        <img src="/img/user.png" alt="">
                        로그아웃
                    </Link>
                </div>
            </div>

            <button class="btn-menu"></button>
        </div>

    </header>

</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
export default {
    components: {Link},
    data(){
        return {
            user: this.$page.props.user.data,
            active: false,
        }
    },
    methods: {

    },

    mounted() {
        // AOS.init();
        AOS.init();

        this.$inertia.on("finish", (event) => {
            AOS.init();
        });
    },

    watch: {
        '$page.props.user': {
            deep:true,
            handler() {
                this.user = this.$page.props.user.data
            }
        },
    }

}
</script>
