<link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css" />
<template>
    <Head title="Log in" />

    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <div v-if="status" class="bg-red-200 rounded py-16 px-12 m-16 flex flex-col items-center justify-center">
            {{ status }}
        </div>
        <br/>
        <div class="font-medium self-center text-xl sm:text-2xl uppercase text-pink-600 justify-center">Inicio de sesión</div>
        <div class="relative mt-10 h-px bg-pink-700">
            <div class="absolute left-0 top-0 flex justify-center w-full -mt-2">
                <span class="bg-white px-4 text-xs text-gray-500 uppercase"></span>
            </div>
        </div>
        <br/>        
        <form @submit.prevent="submit">
            <div class="flex flex-col mb-6">
                <label for="email" class="mb-1 text-xs sm:text-sm tracking-wide text-pink-600">Correo electrónico:</label>
                <div class="relative">
                    <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-pink-200">
                        <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input v-model="form.email" id="email" type="email" name="email" class="text-sm sm:text-base placeholder-gray-400 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-pink-600" placeholder="Correo electrónico" />
                </div>
            </div>
            <div class="flex flex-col mb-6">
                <label for="password" class="mb-1 text-xs sm:text-sm tracking-wide text-pink-600">Contraseña:</label>
                <div class="relative">
                    <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-pink-200">
                        <span>
                            <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
                    </div>
                    <input v-model="form.password" required autocomplete="current-password" id="password" type="password" name="password" class="text-sm sm:text-base placeholder-gray-400 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-pink-600" placeholder="Contraseña" />
                </div>
            </div>

            <div class="bmy-4 flex items-center sm:text-sm text-pink-600">
                <label class="flex items-center">
                    <jet-checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-pink-600">Recuérdame</span>
                </label>
            </div>

            <div class="flex items-center mb-6 -mt-4">
                <div class="flex ml-auto">
                    <a v-if="canResetPassword" :href="route('password.request')" class="inline-flex text-xs sm:text-sm text-pink-600 hover:text-pink-800">¿Olvidaste la contraseña?</a>
                </div>
            </div>

            <div class="flex w-full">
                <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="flex items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-pink-600 hover:bg-pink-700 rounded py-2 w-full transition duration-150 ease-in">
                    <span class="mr-2 uppercase">Ingresar</span>
                    <span>
                        <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </button>
            </div>

        </form>
        <div class="flex justify-center items-center mt-6">
            <a :href="route('register')" target="_blank" class="inline-flex items-center font-bold text-pink-600 hover:text-pink-800 text-xs text-center">
                <span>
                    <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </span>
                <span class="ml-2">¿No tienes una cuenta?</span>
            </a>
        </div>
        <br/>
    </jet-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
        },

        props: {
            canResetPassword: Boolean,
            canRegister: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    })
</script>
