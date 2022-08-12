<template>
    <div>
        <!-- 푸터 -->
        <footer class="footer">
            <div class="wrap">
                <div class="box-infos">
                    <div class="links">
                        <Link href="/" class="link">홈으로</Link>
                        <Link href="/privacyPolicy" class="link">개인정보취급방침</Link>
                        <Link href="/servicePolicy" class="link">서비스 이용약관</Link>
                        <Link href="/spamPolicy" class="link">스팸처리안내</Link>
                    </div>

                    <div class="infos">
                        <p class="info">
                            (주) 하이앤드 대표이사 서경수  / 사업자등록번호: 881-87-02316  / 통신판매업신고번호: 제2022-경남김해-0575호
                            <br/>경남김해서 삼정동38-4번지 / 전화:070-7893-3469 / 이메일 hiand33@naver.com
                        </p>
                    </div>

                    <p class="copyright">© 2022 문자아울렛 All rights reserved. Made with of JaehyeonIT.</p>
                </div>

                <div class="utils">
                    <a href="tel:07078933469" target="_blank" class="util">
                        <img src="/img/contact.png" alt="" class="deco">
                        <img src="/img/circlePhone.png" alt="" class="img">
                    </a>
                    <a href="http://pf.kakao.com/_GxoFfb" target="_blank" class="util">
                        <img src="/img/circleKakao.png" alt="" class="img">
                    </a>
                </div>
            </div>

        </footer>
    </div>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
export default {
    components: {Link},
    data(){
        return {
            information : this.$page.props.information.data
        }
    },
}
</script>
