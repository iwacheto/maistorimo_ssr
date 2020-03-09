<template>
    <div>
        <!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Моят Профил</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>
                                <a href="/admin">Табло</a>
                            </li>
                            <li>Настройки на сайта</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Profile -->
            <div class="loading_website" v-if="!user">Зареждане...</div>
            <div class="col-lg-12 col-md-12" v-else>
                <div class="dashboard-list-box margin-top-0">
                    <h4 class="gray">
                        Настройки на сайта
                        <span
                            class="missingContent"
                            v-if="hideWebsite"
                        >За да бъде създаден успешно Вашият уебсайт, трябва да попълните всички настройки от секциите!</span>
                        <button
                            v-else
                            class="button margin-top-15 margin-left-50"
                            @click="openWebsite"
                        >
                            <i class="sl sl-icon-globe"></i> Уебсайт
                        </button>
                    </h4>
                    <div class="dashboard-list-box-static">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    @click.prevent="setActive('home')"
                                    :class="{ active: isActive('home') }"
                                    href="#home"
                                >Стилове</a>
                                <span v-if="error.showStyleError" class="error_data">!</span>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    @click.prevent="setActive('profile')"
                                    :class="{ active: isActive('profile') }"
                                    href="#profile"
                                >Начална страница</a>
                                <span v-if="error.showHomeError" class="error_data">!</span>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    @click.prevent="setActive('about')"
                                    :class="{ active: isActive('about') }"
                                    href="#about"
                                >За нас</a>
                                <span v-if="error.showAboutUsError" class="error_data">!</span>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    @click.prevent="setActive('contact')"
                                    :class="{ active: isActive('contact') }"
                                    href="#contact"
                                >Контакти</a>
                                <span v-if="error.showContactsError" class="error_data">!</span>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    @click.prevent="setActive('seo')"
                                    :class="{ active: isActive('seo') }"
                                    href="#seo"
                                >SEO</a>
                                <span v-if="error.showSEOError" class="error_data">!</span>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    @click.prevent="setActive('terms')"
                                    :class="{ active: isActive('terms') }"
                                    href="#terms"
                                >Общи условия</a>
                                <span v-if="error.showGeneralError" class="error_data">!</span>
                            </li>
                        </ul>

                        <div class="tab-pan" :class="{ 'active show': isActive('home') }">
                            <label>Цвят на сайта</label>
                            <select v-model="user.website_settings.color">
                                <option
                                    v-for="(color) in colors"
                                    :key="color.value"
                                    :value="color.value"
                                >{{ color.name }}</option>
                            </select>
                            <!-- Logo -->
                            <label>Лого на сайта</label>
                            <img
                                v-if="user.website_settings.logo"
                                :src="user.website_settings.logo"
                            />
                            <image-uploader
                                :preview="true"
                                :className="['fileinput', { 'fileinput--loaded': hasLogo }]"
                                capture="environment"
                                :debug="1"
                                :id="'fileInput2'"
                                doNotResize="gif"
                                refs="logo"
                                :autoRotate="true"
                                outputFormat="verbose"
                                @input="uploadLogo"
                            >
                                <label for="fileInput2" slot="upload-label">
                                    <figure>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="32"
                                            height="32"
                                            viewBox="0 0 32 32"
                                        >
                                            <path
                                                class="path1"
                                                d="M9.5 19c0 3.59 2.91 6.5 6.5 6.5s6.5-2.91 6.5-6.5-2.91-6.5-6.5-6.5-6.5 2.91-6.5 6.5zM30 8h-7c-0.5-2-1-4-3-4h-8c-2 0-2.5 2-3 4h-7c-1.1 0-2 0.9-2 2v18c0 1.1 0.9 2 2 2h28c1.1 0 2-0.9 2-2v-18c0-1.1-0.9-2-2-2zM16 27.875c-4.902 0-8.875-3.973-8.875-8.875s3.973-8.875 8.875-8.875c4.902 0 8.875 3.973 8.875 8.875s-3.973 8.875-8.875 8.875zM30 14h-4v-2h4v2z"
                                            />
                                        </svg>
                                    </figure>
                                    <span class="upload-caption">
                                        {{
                                        hasLogo ? "Replace" : "Click to upload"
                                        }}
                                    </span>
                                </label>
                            </image-uploader>
                        </div>

                        <div class="tab-pan" :class="{ 'active show': isActive('profile') }">
                            <!-- Zaglavna snimka -->
                            <label>Заглавна снимка на сайта</label>
                            <img
                                v-if="user.website_settings.main_image != ''"
                                :src="user.website_settings.main_image"
                            />

                            <image-uploader
                                :preview="true"
                                :className="['fileinput', { 'fileinput--loaded': hasMainImage }]"
                                capture="environment"
                                :id="'fileInput'"
                                :debug="1"
                                doNotResize="gif"
                                refs="mainImage"
                                :autoRotate="true"
                                outputFormat="verbose"
                                @input="uploadImage"
                            >
                                <label for="fileInput" slot="upload-label">
                                    <figure>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="32"
                                            height="32"
                                            viewBox="0 0 32 32"
                                        >
                                            <path
                                                class="path1"
                                                d="M9.5 19c0 3.59 2.91 6.5 6.5 6.5s6.5-2.91 6.5-6.5-2.91-6.5-6.5-6.5-6.5 2.91-6.5 6.5zM30 8h-7c-0.5-2-1-4-3-4h-8c-2 0-2.5 2-3 4h-7c-1.1 0-2 0.9-2 2v18c0 1.1 0.9 2 2 2h28c1.1 0 2-0.9 2-2v-18c0-1.1-0.9-2-2-2zM16 27.875c-4.902 0-8.875-3.973-8.875-8.875s3.973-8.875 8.875-8.875c4.902 0 8.875 3.973 8.875 8.875s-3.973 8.875-8.875 8.875zM30 14h-4v-2h4v2z"
                                            />
                                        </svg>
                                    </figure>
                                    <span class="upload-caption">
                                        {{
                                        hasMainImage ? "Replace" : "Click to upload"
                                        }}
                                    </span>
                                </label>
                            </image-uploader>

                            <!-- Details -->
                            <div class="my-profile">
                                <label>
                                    Заглавие начална страница
                                    <span
                                        class="website_error"
                                        v-if="homepage.headingError"
                                    >Текстът не трябва да е по дълъг от 250 символа</span>
                                </label>
                                <input
                                    value
                                    v-model="user.website_settings.home_heading"
                                    type="text"
                                />

                                <label>
                                    Текст начална страница
                                    <span
                                        class="website_error"
                                        v-if="homepage.textError"
                                    >Текстът не трябва да е по дълъг от 1000 символа</span>
                                </label>
                                <input value v-model="user.website_settings.home_text" type="text" />

                                <label>
                                    Опорна точка 1 заглавие
                                    <span
                                        class="website_error"
                                        v-if="homepage.bullet1HeadError"
                                    >Текстът не трябва да е по дълъг от 255 символа</span>
                                </label>
                                <input
                                    value
                                    v-model="user.website_settings.bullet_1_heading"
                                    type="text"
                                />
                                <label>
                                    Опорна точка 1 текст
                                    <span
                                        class="website_error"
                                        v-if="homepage.bullet1ContError"
                                    >Текстът не трябва да е по дълъг от 255 символа</span>
                                </label>
                                <input
                                    value
                                    v-model="user.website_settings.bullet_1_content"
                                    type="text"
                                />

                                <label>
                                    Опорна точка 2 заглавие
                                    <span
                                        class="website_error"
                                        v-if="homepage.bullet2HeadError"
                                    >Текстът не трябва да е по дълъг от 255 символа</span>
                                </label>
                                <input
                                    value
                                    v-model="user.website_settings.bullet_2_heading"
                                    type="text"
                                />
                                <label>
                                    Опорна точка 2 текст
                                    <span
                                        class="website_error"
                                        v-if="homepage.bullet2ContError"
                                    >Текстът не трябва да е по дълъг от 255 символа</span>
                                </label>
                                <input
                                    value
                                    v-model="user.website_settings.bullet_2_content"
                                    type="text"
                                />

                                <label>
                                    Опорна точка 3 заглавие
                                    <span
                                        class="website_error"
                                        v-if="homepage.bullet3HeadError"
                                    >Текстът не трябва да е по дълъг от 255 символа</span>
                                </label>
                                <input
                                    value
                                    v-model="user.website_settings.bullet_3_heading"
                                    type="text"
                                />
                                <label>
                                    Опорна точка 3 текст
                                    <span
                                        class="website_error"
                                        v-if="homepage.bullet3ContError"
                                    >Текстът не трябва да е по дълъг от 255 символа</span>
                                </label>
                                <input
                                    value
                                    v-model="user.website_settings.bullet_3_content"
                                    type="text"
                                />
                            </div>
                        </div>

                        <div class="tab-pan" :class="{ 'active show': isActive('about') }">
                            <!-- About Us -->
                            <label>Текст за Нас - Компания</label>
                            <ckeditor
                                :editor="editorConfig.editor"
                                v-model="user.website_settings.about_us"
                                :config="editorConfig.editorConfig"
                            ></ckeditor>
                            <label>Текст за Нас - Мисия</label>
                            <ckeditor
                                :editor="editorConfig2.editor"
                                v-model="user.website_settings.about_us_2"
                                :config="editorConfig2.editorConfig"
                            ></ckeditor>
                        </div>

                        <div class="tab-pan" :class="{ 'active show': isActive('contact') }">
                            <google-map
                                v-if="user.website_settings.lat && user.website_settings.lng && user.website_settings.formatted_address && user.website_settings.raw_data"
                                :lat="user.website_settings.lat"
                                :lng="user.website_settings.lng"
                                :formatted_address="user.website_settings.formatted_address"
                                :placeObj="user.website_settings.raw_data"
                            />
                            <google-map v-else />
                        </div>

                        <div class="tab-pan" :class="{ 'active show': isActive('seo') }">
                            <div class="my-profile">
                                <label>
                                    Заглавие на сайта
                                    <span
                                        class="website_error"
                                        v-if="homepage.seoHeading"
                                    >Текстът не трябва да е по дълъг от 255 символа</span>
                                </label>
                                <input value v-model="user.website_settings.seo_title" type="text" />
                                <label>
                                    Описание на сайта
                                    <span
                                        class="website_error"
                                        v-if="homepage.seoDesc"
                                    >Текстът не трябва да е по дълъг от 255 символа</span>
                                </label>
                                <input
                                    value
                                    v-model="user.website_settings.seo_description"
                                    type="text"
                                />
                            </div>
                        </div>

                        <div class="tab-pan" :class="{ 'active show': isActive('terms') }">
                            <div class="my-profile">
                                <label>
                                    Официално фирмено наименование в търговския регистър
                                    <span
                                        class="website_error"
                                        v-if="homepage.termsName"
                                    >Името не трябва да е по дълго от 255 символа</span>
                                </label>
                                <input value v-model="user.terms.name" type="text" />
                                <label>
                                    ЕИК
                                    <span
                                        class="website_error"
                                        v-if="homepage.termsEik"
                                    >ЕИК трябва да е точно 9 цифри символа</span>
                                </label>
                                <input value v-model="user.terms.eik" type="text" />
                                <label>
                                    Адрес на управление в търговския регистър
                                    <span
                                        class="website_error"
                                        v-if="homepage.termsAddressReg"
                                    >Адресът не трябва да е по дълъг от 255 символа</span>
                                </label>
                                <input value v-model="user.terms.address_reg" type="text" />
                                <label>
                                    Управител, управители
                                    <span
                                        class="website_error"
                                        v-if="homepage.termsManager"
                                    >Текстът не трябва да е по дълъг от 255 символа</span>
                                </label>
                                <input value v-model="user.terms.manager" type="text" />
                                <label>
                                    Телефон
                                    <span
                                        class="website_error"
                                        v-if="homepage.termsPhoneMin"
                                    >Телефонът трябва да е по дълъг от 8 символа</span>
                                    <span
                                        class="website_error"
                                        v-if="homepage.termsPhoneNumber"
                                    >Телефонът трябва да е с цифри</span>
                                </label>
                                <input value v-model="user.terms.phone" type="text" />
                                <label>
                                    Имейл
                                    <span
                                        class="website_error"
                                        v-if="homepage.termsEmail"
                                    >Имейлът не трябва да е по дълъг от 255 символа</span>
                                    <span
                                        class="website_error"
                                        v-if="homepage.termsEmail2"
                                    >Имейлът трябва да е валиден Имейл адрес</span>
                                </label>
                                <input value v-model="user.terms.email" type="text" />
                                <label>
                                    Действителен адрес, на който се осъществява дейността
                                    <span
                                        class="website_error"
                                        v-if="homepage.termsAddress"
                                    >Адресът не трябва да е по дълъг от 255 символа</span>
                                </label>
                                <input value v-model="user.terms.address" type="text" />
                                <label>
                                    Опишете подробно какъв вид услуги ще извършвате
                                    <span
                                        class="website_error"
                                        v-if="homepage.termsDesc"
                                    >Описанието не трябва да е по дълго от 255 символа</span>
                                </label>
                                <input value v-model="user.terms.description" type="text" />
                            </div>
                        </div>
                        <button class="button margin-top-15" @click="saveWebsite">Запази</button>
                    </div>
                </div>
            </div>

            <!-- Copyrights -->
            <div class="col-md-12">
                <div class="copyrights">© 2019 Maistorimo LTD. All Rights Reserved.</div>
            </div>
        </div>
        <vue-toastr ref="mytoast"></vue-toastr>
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import axios from 'axios';
import GoogleMap from '../googleMap/Map';

export default {
    data() {
        return {
            errorTexts: [
                {
                    text: 'The website settings.home text may not be greater than 1000 characters.',
                    err: 'textError',
                },
                {
                    text: 'The website settings.home heading may not be greater than 2 characters.',
                    err: 'headingError',
                },
                {
                    text:
                        'The website settings.bullet 1 heading may not be greater than 255 characters.',
                    err: 'bullet1HeadError',
                },
                {
                    text:
                        'The website settings.bullet 1 content may not be greater than 255 characters.',
                    err: 'bullet1ContError',
                },
                {
                    text:
                        'The website settings.bullet 2 heading may not be greater than 255 characters.',
                    err: 'bullet2HeadError',
                },
                {
                    text:
                        'The website settings.bullet 2 content may not be greater than 255 characters.',
                    err: 'bullet2ContError',
                },
                {
                    text:
                        'The website settings.bullet 3 heading may not be greater than 255 characters.',
                    err: 'bullet3HeadError',
                },
                {
                    text:
                        'The website settings.bullet 3 content may not be greater than 255 characters.',
                    err: 'bullet3ContError',
                },
                {
                    text: 'The website settings.seo title may not be greater than 100 characters',
                    err: 'seoHeading',
                },
                {
                    text:
                        'The website settings.seo description may not be greater than 255 characters.',
                    err: 'seoDesc',
                },
                {
                    text: 'The terms.name may not be greater than 255 characters.',
                    err: 'termsName',
                },
                {
                    text: 'The terms.eik may not be greater than 9 characters.',
                    err: 'termsEik',
                },
                {
                    text: 'The terms.eik must be at least 9 characters.',
                    err: 'termsEik',
                },
                {
                    text: 'The terms.address reg may not be greater than 255 characters.',
                    err: 'termsAddressReg',
                },
                {
                    text: 'The terms.manager may not be greater than 255 characters.',
                    err: 'termsManager',
                },
                {
                    text: 'The terms.phone must be at least 8.',
                    err: 'termsPhoneMin',
                },
                {
                    text: 'The terms.phone must be a number.',
                    err: 'termsPhoneNumber',
                },
                {
                    text: 'The terms.email may not be greater than 255 characters.',
                    err: 'termsEmail',
                },
                {
                    text: 'The terms.email may not be greater than 255 characters.',
                    err: 'termsEmail2',
                },
                {
                    text: 'The terms.address may not be greater than 255 characters.',
                    err: 'termsAddress',
                },
                {
                    text: 'The terms.description may not be greater than 255 characters.',
                    err: 'termsDesc',
                },
            ],
            msg: 'Vue Image Upload and Resize Demo',
            hideWebsite: true,
            error: {
                showStyleError: true,
                showHomeError: true,
                showAboutUsError: true,
                showContactsError: true,
                showSEOError: true,
                showGeneralError: true,
            },
            homepage: {
                headingError: false,
                textError: false,
                bullet1HeadError: false,
                bullet1ContError: false,
                bullet2HeadError: false,
                bullet2ContError: false,
                bullet3HeadError: false,
                bullet3ContError: false,
                seoHeading: false,
                seoDesc: false,
                termsName: false,
                termsEik: false,
                termsAddressReg: false,
                termsManager: false,
                termsPhoneMin: false,
                termsPhoneNumber: false,
                termsEmail: false,
                termsEmail2: false,
                termsAddress: false,
                termsDesc: false,
            },
            activeItem: 'home',
            isActiveContent: true,
            hasMainImage: false,
            hasLogo: false,
            image: null,
            new_password: '',
            new_password_repeat: '',
            // terms: {
            //   name: null,
            //   eik: null,
            //   address_reg: null,
            //   manager: null,
            //   phone: null,
            //   email: null,
            //   address: null,
            //   description: null
            // },
            editorConfig: {
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {},
            },
            colors: [
                {
                    name: 'син',
                    value: 'blue',
                },
                {
                    name: 'Кафяв',
                    value: 'brown',
                },
                {
                    name: 'Шоколад',
                    value: 'chocolate',
                },
                {
                    name: 'Златен',
                    value: 'gold',
                },
                {
                    name: 'Зелен',
                    value: 'green',
                },
                {
                    name: 'Маслина',
                    value: 'olive',
                },
                {
                    name: 'Оранжав',
                    value: 'orange',
                },
                {
                    name: 'Червен',
                    value: 'red',
                },
                {
                    name: 'Морско синьо',
                    value: 'sea',
                },
                {
                    name: 'Виолетов',
                    value: 'violet',
                },
                {
                    name: 'Жълт',
                    value: 'yellow',
                },
            ],
            editorConfig2: {
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                },
            },
        };
    },
    
    mounted() {
        this.hasMainImage = this.user.website_settings.main_image ? true : false;
        this.hasLogo = this.user.website_settings.logo ? true : false;
        this.$refs.mytoast.defaultPosition = 'toast-top-center';
        this.$refs.mytoast.defaultStyle = { top: '80px' };
        this.showErrors();
    },
    watch: {},
    methods: {
        showErrors() {
            if (this.hasLogo) {
                this.error.showStyleError = false;
            } else {
                this.error.showStyleError = true;
            }
            if (
                this.hasMainImage &&
                this.user.website_settings.home_heading &&
                this.user.website_settings.home_text &&
                this.user.website_settings.bullet_1_heading &&
                this.user.website_settings.bullet_1_content &&
                this.user.website_settings.bullet_2_heading &&
                this.user.website_settings.bullet_2_content &&
                this.user.website_settings.bullet_3_heading &&
                this.user.website_settings.bullet_3_content
            ) {
                this.error.showHomeError = false;
            } else {
                this.error.showHomeError = true;
            }
            if (this.user.website_settings.about_us && this.user.website_settings.about_us_2) {
                this.error.showAboutUsError = false;
            } else {
                this.error.showAboutUsError = true;
            }
            // if (typeof this.user.website_settings.raw_data==='string') {
            if (this.user.website_settings.formatted_address) {
                this.error.showContactsError = false;
            } else {
                this.error.showContactsError = true;
            }
            if (
                this.user.website_settings.seo_title &&
                this.user.website_settings.seo_description
            ) {
                this.error.showSEOError = false;
            } else {
                this.error.showSEOError = true;
            }
            if (
                this.user.terms.phone &&
                this.user.terms.name &&
                this.user.terms.eik &&
                this.user.terms.address_reg &&
                this.user.terms.manager &&
                this.user.terms.email &&
                this.user.terms.address &&
                this.user.terms.description
            ) {
                this.error.showGeneralError = false;
            } else {
                this.error.showGeneralError = true;
            }
            this.showWebsite();
        },
        showWebsite() {
            if (
                this.error.showStyleError === false &&
                this.error.showHomeError === false &&
                this.error.showAboutUsError === false &&
                this.error.showContactsError === false &&
                this.error.showSEOError === false &&
                this.error.showGeneralError === false
            ) {
                this.hideWebsite = false;
            } else {
                this.hideWebsite = true;
            }
        },
        openWebsite() {
            window.open('//' + this.user.name + '.maistorimo.bg');
            // window.open = '/website/' + this.user.name + '/home';
        },
        uploadLogo: function(output) {
            this.hasLogo = true;
            this.logo = output;
            let self = this;
            window.axios.post('/vendor/profile/uploadImage', output).then(({ data }) => {
                self.user.website_settings.logo = data.url;
                // console.log(data.url)
            });
        },
        uploadImage: function(output) {
            this.hasMainImage = true;
            this.mainImage = output;
            let self = this;
            window.axios.post('/vendor/profile/uploadImage', output).then(({ data }) => {
                self.user.website_settings.main_image = data.url;
                // console.log(data.url)
            });
        },
        saveWebsite() {
            this.showErrors();
            let self = this;
            let position = this.$store.getters.position;
            this.user.website_settings.lat = position.lat;
            this.user.website_settings.lng = position.lng;
            this.user.website_settings.formatted_address = position.formatted_address;
            this.user.website_settings.raw_data = position.raw_data;
            // console.log(this.user.website_settings);
            window.axios
                .post('/vendor/website/save', this.user)
                .then(({ data }) => {
                    self.user.vendor_details.profile_image = data.url;
                    // this.showErrors();
                    this.$refs.mytoast.s('Успешно променихте настройките на Уебсайта Ви!');
                })
                .catch(error => {
                    let err = error.response.data.errors;
                    for (const elem in err) {
                        let allErrors;

                        allErrors = err[elem][0];
                        console.log(allErrors);
                        this.errorTexts.forEach(err => {
                            if (err.text === allErrors) {
                                this.homepage[err.err] = true;
                                this.scrollToError();
                            }
                        });
                    }
                });
        },
        scrollToError() {
            setTimeout(function() {
                let elem = document.querySelector('.website_error');
                // const y = elem.getBoundingClientRect();
                elem.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 500);
        },
        changePassword() {
            window.axios
                .post('/vendor/profile/changePassword', {
                    password: this.new_password,
                })
                .then(({ data }) => {});
        },
        isActive(menuItem) {
            return this.activeItem === menuItem;
        },
        setActive(menuItem) {
            this.activeItem = menuItem;
        },
    },
    computed: {
        user() {
            return this.$store.state.user;
        },
    },
    components: {
        GoogleMap,
    },
};

// Script for tabs
</script>

<style scoped>
#fileInput,
#fileInput2 {
    display: none;
}
h1,
h2 {
    font-weight: normal;
}
ul {
    list-style-type: none;
    padding: 0;
}
li {
    display: inline-block;
    margin: 0 10px;
}
a {
    color: #42b983;
}
.my-8 {
    margin-top: 4rem;
    margin-bottom: 4rem;
}
/* Styles for tabs */
div.tab-pan {
    display: none;
}

div.tab-pan.active {
    display: block;
}
.nav-item a {
    color: rgb(77, 76, 76);
    padding: 23px 30px;
}
.nav-item a:hover,
.nav-item a.active {
    color: #42b983;
}

.nav-item a.active {
    background: rgb(250, 243, 249);
    border-bottom: 1px solid #eaeaea;
}

.dashboard-list-box ul li.nav-item {
    border-bottom: 1px solid transparent;
    margin: 0px;
    padding: 23px 0px;
}

.error_data {
    color: crimson;
    font-weight: 900;
}
@media (max-width: 550px) {
    .dashboard-list-box ul li {
        flex: 1 1 40%;
    }
}
@media (max-width: 400px) {
    .nav-item a[data-v-4de32784] {
        display: inline-block;
        min-width: 100px;
        max-width: 120px;
    }
    .dashboard-list-box ul li.nav-item {
        padding: 10px 0;
    }
    .nav-item a {
        padding: 10px 5px !important;
    }
}
</style>

