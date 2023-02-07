<template>
    <q-card>
        <div class="q-pa-md">
            <h5>{{ $t('register.title') }}</h5>
            <q-stepper v-model="step" vertical color="primary" animated>
                <q-step :name="1" :title="$t('register.welcome')" icon="alternate_email" :done="step > 1">
                  {{ $t('register.welcomeDesc') }}
<!--                    Мы рады, что вы решили присоединиться к нашей теплой компании путешественников!-->
                    <br>
                    <br>
                  {{ $t('register.welcomeAct') }}
<!--                    Давайте начнем регистрацию...-->

                    <q-stepper-navigation class="row justify-between">
                        <q-btn @click="step = 2" color="primary" :label="$t('register.next')" />
                        <div>
                            <span style="font-size: 12px;">{{ $t('register.loginText') }}</span>
                            <router-link :to="{name: 'login'}">
                                <q-btn class="q-ml-sm" color="primary">{{ $t('register.login') }}</q-btn>
                            </router-link>
                        </div>
                    </q-stepper-navigation>
                </q-step>

                <q-step :name="2" :title="$t('register.aboutMe')" :caption="$t('register.must')" icon="badge" :done="step > 2">
                    <q-input v-model="user.name" filled type="text" :label="$t('register.howName')">
                        <template v-slot:append>
                            <q-icon name="badge"/>
                        </template>
                    </q-input>

                    <q-stepper-navigation class="row justify-between">
                        <q-btn @click="step = 3" color="primary" :label="$t('register.next')" />
                        <q-btn flat @click="step = 1" color="primary" :label="$t('register.back')" class="q-ml-sm" />
                    </q-stepper-navigation>
                </q-step>

                <q-step :name="3" :title="$t('register.email')" :caption="$t('register.must')" icon="alternate_email" :done="step > 3">
                    <q-input v-model="user.email" filled type="email" label="E-mail">
                        <template v-slot:append>
                            <q-icon name="alternate_email"/>
                        </template>
                    </q-input>
                    <br>
<!--                    <span>На этот email придет письмо с подверждением регистрации.</span>-->
                    <span>{{ $t('register.emailDesk') }}</span>
                    <br>
<!--                    <span>Также он будет использоваться для входа на сайт.</span>-->
<!--                    <span>{{ $t('register.emailDesk') }}</span>-->

                    <q-stepper-navigation class="row justify-between">
                        <q-btn @click="step = 4" color="primary" :label="$t('register.next')" />
                        <q-btn flat @click="step = 2" color="primary" :label="$t('register.back')" class="q-ml-sm" />
                    </q-stepper-navigation>
                </q-step>

                <q-step :name="4" :title="$t('register.passTitle')" :caption="$t('register.must')" icon="key" :done="step > 4">
                    <q-input v-model="user.password" filled :type="isPwd ? 'password' : 'text'" :label="$t('register.pass')" hint="">
                        <template v-slot:append>
                            <q-icon
                                :name="isPwd ? 'visibility_off' : 'visibility'"
                                class="cursor-pointer"
                                @click="isPwd = !isPwd"
                            />
                        </template>
                    </q-input>
                    <q-input v-model="user.password_confirmation" filled :type="isPwdConf ? 'password' : 'text'" :label="$t('register.passConf')" hint="">
                        <template v-slot:append>
                            <q-icon
                                :name="isPwdConf ? 'visibility_off' : 'visibility'"
                                class="cursor-pointer"
                                @click="isPwdConf = !isPwdConf"
                            />
                        </template>
                    </q-input>
<!--                    <span>Этот пароль будет использоваться для входа на сайт</span>-->
                    <span>{{ $t('register.passDesc') }}</span>
                    <q-stepper-navigation class="row justify-between">
                        <q-btn @click="step = 5" color="primary" :label="$t('register.next')" />
                        <q-btn flat @click="step = 3" color="primary" :label="$t('register.back')" class="q-ml-sm" />
                    </q-stepper-navigation>
                </q-step>

                <q-step :name="5" :title="$t('register.allDone')" caption="" icon="done_all">
                    <span></span>
                    <q-checkbox
                        right-label
                        v-model="left2"
                        :label="$t('register.iAgree')"
                        checked-icon="task_alt"
                        unchecked-icon="highlight_off"
                    />
                    <q-btn style="margin-left: 10px; font-size: 12px; text-transform: full-size-kana;" flat padding="none" size="sm" color="primary" @click="rulesDialog = true">{{ $t('register.rules') }}</q-btn>
                    <br>
<!--                    <span>Необходимо принять для продолжения регистрации</span>-->
                    <span>{{ $t('register.allDoneDesc') }}</span>

                    <q-dialog v-model="rulesDialog">
                        <q-card>
                            <q-card-section>
                                <div class="text-h6">{{ $t('register.rulesReg') }}</div>
                            </q-card-section>
                            <q-separator />
                            <q-card-section style="max-height: 50vh" class="scroll">
                                <p v-for="n in 15" :key="n">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Rerum repellendus sit voluptate voluptas eveniet porro.
                                    Rerum blanditiis perferendis totam, ea at omnis vel numquam exercitationem aut,
                                    natus minima, porro labore.
                                </p>
                            </q-card-section>
                            <q-separator />
                            <q-card-actions align="right">
                                <q-btn flat :label="$t('register.cancel')" color="red" v-close-popup @click="left2 = false" />
                                <q-btn flat :label="$t('register.accept')" color="green" v-close-popup v-model="left2" @click="left2 = true" />
                            </q-card-actions>
                        </q-card>
                    </q-dialog>
                    <q-stepper-navigation class="row justify-between">
                        <q-btn @click.prevent="register" color="primary" :label="$t('register.register')" />
                        <q-btn flat @click="step = 4" color="primary" :label="$t('register.back')" class="q-ml-sm" />
                    </q-stepper-navigation>
                </q-step>
            </q-stepper>
        </div>
    </q-card>
</template>

<script>
import { ref } from 'vue'
export default {
    name: "Register",
    setup () {
        return {
            step: ref(1),
            // password: ref(''),
            isPwd: ref(true),
            isPwdConf: ref(true),
            left2: ref(false),
            rulesDialog: ref(false)
        }
    },
    data: () => ({
        user: {
            name:  '',
            email: '',
            password: ref(''),
            password_confirmation: ref(''),
        }
    }),
    computed: {

    },
    mounted() {
        this.title()
    },
    methods: {
        title() {
            document.title = "Регистрация"
        },
        register() {
            this.$store.dispatch('registerUser', this.user)
        }
    },
}
</script>

<style scoped lang="scss">
    .q-card{
        width: 500px;
    }
    span {
        font-size: 12px;
    }
    h5 {
        text-align: center;
        padding-bottom: 5px;
    }
</style>
