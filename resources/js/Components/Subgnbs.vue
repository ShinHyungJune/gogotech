<template>
    <div class="sub-wrap-container">
        <div class="sub-wrap">
            <div class="wrap">
                <div class="left">
                    <Link href="/" class="btn-util">
                        <img src="/img/home.png" alt="">
                    </Link>
                    <div class="links">
                        <button type="button" class="link" @click="active = !active">
                            <p class="text">{{name}}</p>

                            <img src="/img/arrowBottom-gray.png" alt="">
                        </button>
                        <div :class="`${active ? 'subs active' : 'subs'}`">
                            <Link href="/letters/create" class="link">문자발송</Link>
                            <Link href="/books" class="link">주소록</Link>
                            <Link href="/letters" class="link">전송내역</Link>
                            <Link href="/users/edit" class="link">마이페이지</Link>
                            <Link href="/notices" class="link">공지사항</Link>
                            <Link href="/charges/create" class="link">충전하기</Link>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <a href="#" class="btn-util">
                        <img src="/img/external-link-gray.png" alt="">
                    </a>
                </div>
            </div>
        </div>

        <h3 class="title">{{ name }}</h3>
    </div>
</template>
<script>
    import {Link} from '@inertiajs/inertia-vue';
    export default {
        props: ["name"],
        components: {Link},
        data(){
            return {
                user: this.$page.props.user.data,
                active: false,
                activeGnb: {}
            }
        },
        methods: {
            setPageName(){
                if(!this.name){
                    let href;
                    let title;
                    let self = this;
                    let gnbs = $(".sub-wrap a");

                    gnbs.each(function(index, item){
                        href = $(item).attr("href");

                        if(self.pathname === href){
                            title = $(item).text();
                            $(".sub-wrap-container .title").text(title);
                            $(".sub-wrap-container .links > .link .text").text(title);
                        }
                    });
                }

            }
        },
        computed: {
            pathname(){
                return window.location.pathname;
            },


        },

        mounted() {
            let self = this;

            this.setPageName();

            this.$inertia.on("start", (event) => {
                self.setPageName();
            });
        }
    }
</script>
