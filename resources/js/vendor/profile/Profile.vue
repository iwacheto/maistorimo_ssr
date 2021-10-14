<template>
    <div>
        <!-- Titlebar -->
        <div class="desctop-part">
            <div id="titlebar">
                <div class="row">
                    <div class="col-md-12 heading_admin">
                        <h2>Моят Профил</h2>
                    </div>
                </div>
            </div>

            <MobileGreenMenuSmall/>
    
            <div class="row">
                <!-- Profile -->
                <div class="col-lg-6 col-md-12">
                    <div class="dashboard-list-box margin-top-0">
                        <h4 class="gray">Детайли за профила</h4>
                        <div class="dashboard-list-box-static">
                            <div>
                                <label>Основна снимка</label>
                                <img
                                    v-if="user.vendor_details.main_image != ''"
                                    :src="user.vendor_details.main_image"
                                />
                                <image-uploader
                                    :preview="true"
                                    :className="['fileinput', { 'fileinput--loaded': hasMainImage }]"
                                    capture="environment"
                                    :debug="2"
                                    :id="'fileInput2'"
                                    refs="mainImage"
                                    doNotResize="gif"
                                    :autoRotate="true"
                                    outputFormat="verbose"
                                    @input="uploadMainImage"
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
                                                user.vendor_details.main_image
                                                    ? 'Replace'
                                                    : 'Click to upload'
                                            }}
                                        </span>
                                    </label>
                                </image-uploader>
                            </div>
                            <label>Профилна снимкa</label>
                            <img
                                v-if="user.vendor_details.profile_image != ''"
                                :src="user.vendor_details.profile_image"
                            />
                            <image-uploader
                                :preview="true"
                                :className="['fileinput', { 'fileinput--loaded': hasImage }]"
                                capture="environment"
                                :debug="2"
                                :id="'fileInput'"
                                refs="profile"
                                doNotResize="gif"
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
                                        {{ hasImage ? 'Replace' : 'Click to upload' }}
                                    </span>
                                </label>
                            </image-uploader>

                            <!-- Details -->
                            <div class="my-profile">
                                <div class="item-group">
                                    <div class="item">
                                        <label>Компания</label>
                                        <input
                                            value
                                            v-model="user.vendor_details.company_name"
                                            type="text"
                                        />
                                    </div>

                                    <div class="item">
                                        <label>Телефон</label>
                                        <input
                                            value
                                            v-model="user.vendor_details.phone_number"
                                            type="text"
                                        />
                                    </div>
                                </div>

                                <div class="item-group">
                                    <div class="item">
                                        <label>Поща</label>
                                        <input
                                            value
                                            v-model="user.vendor_details.email_address"
                                            type="text"
                                        />
                                    </div>
                                    <div class="item">
                                        <label>Уебсайт</label>
                                        <input value v-model="user.vendor_details.website" type="text" />
                                    </div>
                                </div>

                                <div class="item-group">
                                    <div class="item">
                                        <label>Информация</label>
                                        <!-- <textarea name id cols="30" rows="6" value v-model="user.vendor_details.information"></textarea> -->
                                        <ckeditor
                                            :editor="editorConfig.editor"
                                            v-model="user.vendor_details.information"
                                            :config="editorConfig.editorConfig"
                                        ></ckeditor>
                                    </div>
                                </div>
                                
                                <div class="item-group">
                                    <div class="item">
                                        <label>Град</label>
                                        <input value v-model="city" @input="onChange" type="text" />
                                        <ul v-show="isOpen" class="autocomplete-results">
                                            <li
                                                v-for="(result, i) in results"
                                                :key="i"
                                                @click="setResult(result)"
                                                class="autocomplete-result profile_auto"
                                            >
                                                {{ result.city }}
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="item">
                                        <label>Лице за контакти</label>
                                        <input
                                            value
                                            v-model="user.vendor_details.contact_person"
                                            type="text"
                                        />
                                    </div>

                                    <div class="item">
                                        <label> <i class="fa fa-facebook-square"></i> Facebook </label>
                                        <input
                                            placeholder="https://www.facebook.com/"
                                            v-model="user.vendor_details.facebook_link"
                                            type="text"
                                        />
                                    </div>
                                </div>
                            </div>

                            <button class="button" @click="saveProfile">
                                Запази промените
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="col-lg-6 col-md-12">
                    <div class="dashboard-list-box margin-top-0">
                        <h4 class="gray">Промени паролата</h4>
                        <div class="dashboard-list-box-static">
                            <!-- Change Password -->
                            <div class="my-profile">

                                <div class="item">
                                    <label class="margin-top-0">Настояща парола</label>
                                    <input type="password" />
                                </div>

                                <div class="item">
                                    <label>Нова парола</label>
                                    <input
                                        type="password"
                                        v-model="new_password"
                                        name="password"
                                        v-validate="'required'"
                                    />
                                </div>

                                <div class="item">
                                    <label>Потвърди новата парола</label>
                                    <input
                                        type="password"
                                        v-validate="'required|confirmed:password'"
                                        name="password_confirmation"
                                        v-model="new_password_repeat"
                                    />
                                    <span
                                        v-show="errors.has('password_confirmation')"
                                        class="help is-danger"
                                        >{{ errors.first('password_confirmation') }}</span
                                    >
                                </div>

                                <button class="button">Промени паролата</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Copyrights -->
                <div class="col-md-12">
                    <div class="copyrights">© 2019 Maistorimo All Rights Reserved.</div>
                </div>
            </div>
        </div>

        <div class="mobile-part">
            <div id="titlebar">
                <div class="row">
                    <div class="col-md-12 heading_admin">
                        <h2>Моят Профил</h2>
                        <!-- Breadcrumbs -->

                        <!-- <a
                            target="_blank"
                            :href="'/profile/' + user.id"
                            class="button preview project_link"
                        >
                            Виж своя Профил
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                        <nav id="breadcrumbs">
                            <ul>
                                <li>
                                    <a href="#">Начало</a>
                                </li>
                                <li>
                                    <a href="#">Табло</a>
                                </li>
                                <li>Моят профил</li>
                            </ul>
                        </nav> -->
                    </div>
                </div>
            </div>

            <MobileGreenMenuSmall/>
    
            <div class="row">
                <!-- Profile -->
                <div class="col-lg-6 col-md-12">
                    <div class="dashboard-list-box margin-top-0">
                        <h4 class="gray">Детайли за профила</h4>
                        <div class="dashboard-list-box-static">
                            <div>
                                <label>Основна снимка</label>
                                <img
                                    v-if="user.vendor_details.main_image != ''"
                                    :src="user.vendor_details.main_image"
                                />
                                <image-uploader
                                    :preview="true"
                                    :className="['fileinput', { 'fileinput--loaded': hasMainImage }]"
                                    capture="environment"
                                    :debug="2"
                                    :id="'fileInput2'"
                                    refs="mainImage"
                                    doNotResize="gif"
                                    :autoRotate="true"
                                    outputFormat="verbose"
                                    @input="uploadMainImage"
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
                                                user.vendor_details.main_image
                                                    ? 'Replace'
                                                    : 'Click to upload'
                                            }}
                                        </span>
                                    </label>
                                </image-uploader>
                            </div>
                            <label>Профилна снимкa</label>
                            <img
                                v-if="user.vendor_details.profile_image != ''"
                                :src="user.vendor_details.profile_image"
                            />
                            <image-uploader
                                :preview="true"
                                :className="['fileinput', { 'fileinput--loaded': hasImage }]"
                                capture="environment"
                                :debug="2"
                                :id="'fileInput'"
                                refs="profile"
                                doNotResize="gif"
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
                                        {{ hasImage ? 'Replace' : 'Click to upload' }}
                                    </span>
                                </label>
                            </image-uploader>

                            <!-- Details -->
                            <div class="my-profile">
                                <div class="item">
                                    <label>Компания</label>
                                    <input
                                        value
                                        v-model="user.vendor_details.company_name"
                                        type="text"
                                    />
                                </div>

                                <div class="item">
                                    <label>Телефон</label>
                                    <input
                                        value
                                        v-model="user.vendor_details.phone_number"
                                        type="text"
                                    />
                                </div>

                                <div class="item">
                                    <label>Поща</label>
                                    <input
                                        value
                                        v-model="user.vendor_details.email_address"
                                        type="text"
                                    />
                                </div>

                                <div class="item">
                                    <label>Информация</label>
                                    <!-- <textarea name id cols="30" rows="6" value v-model="user.vendor_details.information"></textarea> -->
                                    <ckeditor
                                        :editor="editorConfig.editor"
                                        v-model="user.vendor_details.information"
                                        :config="editorConfig.editorConfig"
                                    ></ckeditor>
                                </div>

                                <div class="item">
                                    <label>Уебсайт</label>
                                    <input value v-model="user.vendor_details.website" type="text" />
                                </div>

                                <div class="item">
                                    <label>Град</label>
                                    <input value v-model="city" @input="onChange" type="text" />
                                    <ul v-show="isOpen" class="autocomplete-results">
                                        <li
                                            v-for="(result, i) in results"
                                            :key="i"
                                            @click="setResult(result)"
                                            class="autocomplete-result profile_auto"
                                        >
                                            {{ result.city }}
                                        </li>
                                    </ul>
                                </div>

                                <div class="item">
                                    <label>Лице за контакти</label>
                                    <input
                                        value
                                        v-model="user.vendor_details.contact_person"
                                        type="text"
                                    />
                                </div>

                                <div class="item">
                                    <label> <i class="fa fa-facebook-square"></i> Facebook </label>
                                    <input
                                        placeholder="https://www.facebook.com/"
                                        v-model="user.vendor_details.facebook_link"
                                        type="text"
                                    />
                                </div>
                            </div>

                            <button class="button" @click="saveProfile">
                                Запази промените
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="col-lg-6 col-md-12">
                    <div class="dashboard-list-box margin-top-0">
                        <h4 class="gray">Промени паролата</h4>
                        <div class="dashboard-list-box-static">
                            <!-- Change Password -->
                            <div class="my-profile">

                                <div class="item">
                                    <label class="margin-top-0">Настояща парола</label>
                                    <input type="password" />
                                </div>

                                <div class="item">
                                    <label>Нова парола</label>
                                    <input
                                        type="password"
                                        v-model="new_password"
                                        name="password"
                                        v-validate="'required'"
                                    />
                                </div>

                                <div class="item">
                                    <label>Потвърди новата парола</label>
                                    <input
                                        type="password"
                                        v-validate="'required|confirmed:password'"
                                        name="password_confirmation"
                                        v-model="new_password_repeat"
                                    />
                                    <span
                                        v-show="errors.has('password_confirmation')"
                                        class="help is-danger"
                                        >{{ errors.first('password_confirmation') }}</span
                                    >
                                </div>

                                <button class="button">Промени паролата</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Copyrights -->
                <div class="col-md-12">
                    <div class="copyrights">© 2019 Maistorimo All Rights Reserved.</div>
                </div>
            </div>
        </div>

        <vue-toastr ref="mytoast"></vue-toastr>
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import MobileGreenMenuSmall from '../partials/MobileGreenMenuSmall.vue';

export default {
    data() {
        return {
            editorConfig: {
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                },
            },
            msg: 'Vue Image Upload and Resize Demo',
            // user: laravel.user,
            items: [],
            city: '',
            hasImage: false,
            hasMainImage: false,
            mainImage: null,
            image: null,
            new_password: '',
            new_password_repeat: '',
            isOpen: false,
            results: '',
            user: laravel.user,
        };
    },
    components: {
        MobileGreenMenuSmall,
    },
    mounted() {
        this.hasImage = this.user.vendor_details.profile_image != '' ? true : false;
        this.$refs.mytoast.defaultPosition = 'toast-top-center';
        this.$refs.mytoast.defaultStyle = { top: '80px' };
        this.checkCity();
    },
    watch: {
        user() {
            //  console.log(this.user.vendor_details.profile_image+'Image');
        },
    },
    methods: {
        uploadMainImage: function (output) {
            console.log(output);
            this.hasMainImage = true;
            this.mainImage = output;
            let self = this;
            window.axios.post('/vendor/profile/uploadMainImage', output).then(({ data }) => {
                self.user.vendor_details.main_image = data.url;
            });
        },
        uploadImage: function (output) {
            this.hasImage = true;
            this.image = output;
            let self = this;
            console.log('uploadProfilePhoto');
            window.axios.post('/vendor/profile/uploadImage', output).then(({ data }) => {
                self.user.vendor_details.profile_image = data.url;
            });
        },
        saveProfile() {
            let self = this;
            // console.log(this.user);
            window.axios.post('/vendor/profile/save', this.user).then(({ data }) => {
                self.user.vendor_details.profile_image = data.url;
                this.$refs.mytoast.s('Успешно редактирахте своя Профил!');
            });
        },
        changePassword() {
            window.axios
                .post('/vendor/profile/changePassword', {
                    password: this.new_password,
                })
                .then(({ data }) => {});
        },
        async onChange() {
            this.isOpen = true;
            try {
                const res = await axios.get('autocomplete/search', {
                    params: { searchQuery: this.city },
                });

                this.items = res.data;
            } catch (error) {
                console.log(error.response.data);
            }
            this.filterResults();
        },
        filterResults() {
            this.results = this.items.filter(
                (item) => item.city.toLowerCase().indexOf(this.city.toLowerCase()) > -1
            );
        },
        setResult(result) {
            this.user.vendor_details.city_id = result.id;
            // this.user.vendor_details.city.city=result.city;
            this.city = result.city;
            this.isOpen = false;
        },
        checkCity() {
            if (this.user.vendor_details.city) {
                this.city = this.user.vendor_details.city.city;
            }
        },
    },
};
</script>

<style >

@media only screen and (min-width: 991px) {
    .mobile-part {
        display: none;
    }

    #titlebar {
        padding-top: 0px;
        margin-bottom: 0px;
    }

    .row {
        background-color: #f8f8f8;
        margin-right: 0px;
        margin-left: 0px;
    }

    .row .col-lg-6.col-md-12:nth-child(1) {
        width: 62%;
        padding: 0px;
        margin: 0px 31px 0px 27px;
    }

    .row .col-lg-6.col-md-12:nth-child(2) {
        width: 32%;
    }
    
    .heading_admin h2 {
        font-style: normal;
        font-weight: 500;
        font-size: 25px;
        line-height: 29px;
        color: #276955;
        padding-left: 12px;
    }

    .dashboard-list-box.margin-top-0 {
        margin: 0px;
        background: #FFFFFF;
        border: 0.25px solid #9EA3BD;
        box-sizing: border-box;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
        border-radius: 7px;
    }

    .dashboard-list-box h4 {
        border-bottom: unset;
        border-radius: unset;
        background-color: #ffffff;
    }

    .dashboard-list-box h4.gray {
        font-style: normal;
        font-weight: 500;
        font-size: 20px;
        line-height: 23px;
        color: #276955;
        text-align: center;
        background-color: #ffffff;
        border-radius: 7px;
    }

    .dashboard-list-box-static {
        border-radius: 7px;
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        align-content: center;
        align-items: center;
        padding: 0px;
    }

    .dashboard-list-box-static img {
        margin: 0px 30px;
        padding: 0px 15px;
    }

    .dashboard-list-box-static div:nth-child(1) label, .dashboard-list-box-static label {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .my-profile {
        display: flex;
        flex-direction: row;
        justify-content: center;
        flex-wrap: wrap;
        width: 100%;
    }

    .my-profile .item input {
        width: 347px;
        background: #FFFFFF;
        border: 0.25px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
    }

    /* .item-group {
       margin-right: 120px;
    } */

    .item-group .item {
        margin: 0px 18px;
    }

    .item-group .item label {
        margin: 15px 0px 8px 0px;
    }

    .item-group:nth-child(4) .item:nth-child(3) label {
        display: flex;
        flex-direction: row;
    }

    .ck.ck-label.ck-voice-label {
        display: none;
    }

    .ck.ck-toolbar {
        width: 347px;
    }

    .ck-blurred.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline {
        height: 180px;
        width: 347px;
    }

    .dashboard-list-box-static .button {
        padding: 7px 0px;
        font-size: 14px;
        margin: 12px 0px 35px 0px;
        width: 165px;
    }
}

@media only screen and (max-width: 1500px) {
     .item-group .item {
        margin: 0px 5px;
    }

    .my-profile .item input {
        width: 320px;
    }

    .ck.ck-toolbar {
        width: 320px;
    }

    .ck-blurred.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline {
        width: 320px;
    }
}

@media only screen and (max-width: 1440px) {
    .col-lg-6.col-md-12 {
        margin-right: 20px;
    }

    .row .col-lg-6.col-md-12:nth-child(1) {
        width: 64%;
    }

    .row .col-lg-6.col-md-12:nth-child(2) {
        width: 29%;
        padding-left: 0px;
        padding-right: 0px;
    }

    .row .col-lg-6.col-md-12:nth-child(2) .dashboard-list-box .dashboard-list-box-static input {
        width: 288px;
    }
    
    .item-group .item {
        margin: 0px 5px;
    }

    .ck.ck-toolbar {
        width: 320px;
    }

    .ck-blurred.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline {
        width: 320px;
    }
}

@media only screen and (max-width: 1373px) {
    .row .col-lg-6.col-md-12:nth-child(1) {
        width: 62%;
    }

    .row .col-lg-6.col-md-12:nth-child(2) {
        width: 29%;
    }
}

@media only screen and (max-width: 1366px) {
    

    .my-profile .item input {
        width: 290px;
    }

    .ck.ck-toolbar {
        width: 290px;
    }

    .ck-blurred.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline {
        width: 290px;
    }
}

@media only screen and (max-width: 1280px) {
    .row .col-lg-6.col-md-12:nth-child(1) {
        width: 62%;
    }

    .row .col-lg-6.col-md-12:nth-child(2) {
        width: 29%;
    }

    .row .col-lg-6.col-md-12:nth-child(2) .dashboard-list-box .dashboard-list-box-static input {
        width: 250px;
    }
}

@media only screen and (max-width: 1232px) {
    .my-profile .item input {
        width: 260px;
    }

    .ck.ck-toolbar {
        width: 260px;
    }

    .ck-blurred.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline {
        width: 260px;
        height: 143px;
    }
}

@media only screen and (max-width: 1150px) {

    .row .col-lg-6.col-md-12:nth-child(1) {
        width: 60%;
    }

    .row .col-lg-6.col-md-12:nth-child(2) {
        width: 29%;
    }

    .row .col-lg-6.col-md-12:nth-child(2) .dashboard-list-box .dashboard-list-box-static input {
        width: 210px;
    }

    .my-profile .item input {
        width: 230px;
    }

    .ck.ck-toolbar {
        width: 230px;
    }

    .ck-blurred.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline {
        width: 230px;
    }
}

@media only screen and (max-width: 1063px) {

    .my-profile .item input {
        width: 200px;
    }

    .ck.ck-toolbar {
        width: 200px;
    }

    .ck-blurred.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline {
        width: 200px;
    }
}

@media screen and (max-width: 990px) {

    .mobile-part {
        display: unset;
    }

    .desctop-part {
        display: none;
    }

    #titlebar {
        display: none;
    }

    .row {
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
        background-color: #F7F7F7;
        margin-left: 0px;
        margin-right: 0px;
    }

    .row .col-lg-6.col-md-12 {
        margin: 0px;
    }

    .row .col-lg-6.col-md-12:nth-child(1) {
        width: 100%;
    }

    .row .col-lg-6.col-md-12:nth-child(2) {
        width: 100%;
    }

    .dashboard-list-box {
        box-shadow: none;
    }

    .dashboard-list-box h4.gray {
        background-color: #F7F7F7;
    }

    h4.gray {
        text-align: center;
        color: #276955;
        font-size: 20px;
        border-bottom: unset;
    }

    /* .dashboard-list-box-static div:nth-child(1), .dashboard-list-box-static div:nth-child(1) label, .dashboard-list-box-static label {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    } */

    .my-profile label {
        font-style: normal;
        font-weight: bold;
        font-size: 17px;
        line-height: 20px;
        color: #276955;
    }

    .my-profile .item input {
        background: #FFFFFF;
        border: 0.75px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        height: 49px !important;
        width: 324px;
    }

    .dashboard-list-box-static {
        display: flex;
        flex-direction: column;
        align-content: center;
        justify-content: center;
        align-items: center;
        background-color: #F7F7F7;
    }

    .row .col-lg-6.col-md-12:nth-child(2) .dashboard-list-box .dashboard-list-box-static input {
        width: 324px;
    }

    .my-profile {
        display: flex;
        flex-direction: column;
        align-content: center;
        justify-content: center;
        align-items: center;
    }

    .dashboard-list-box-static .button {
        margin: 0px;
        margin-top: 35px;
    }

    .ck.ck-reset.ck-editor.ck-rounded-corners {
        width: 100%;
        background: #FFFFFF;
        border: 0.75px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
    }

    .ck-rounded-corners .ck.ck-editor__top .ck-sticky-panel .ck-toolbar, .ck.ck-editor__top .ck-sticky-panel .ck-toolbar.ck-rounded-corners {
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
        border: 0.50px solid #6BBF3F;
    }

    .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable, .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
        border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;
        border: 0.50px solid #6BBF3F;
    }

    .ck.ck-toolbar {
        width: 324px;
    }

    .ck-blurred.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline {
        width: 324px;
    }

    /* .dashboard-list-box-static img {
        border-radius: 10px;
    } */
}

.autocomplete {
    position: relative;
    width: 130px;
}

ul.autocomplete-results {
    padding: 0;
    margin: 0;
    border: 1px solid #eeeeee;
    height: 160px;
    overflow: auto;
    background: #fff;
    flex-direction: row;
    width: 60%;
    margin-top: -16px;
}

li.autocomplete-result.profile_auto {
    list-style: none;
    text-align: left;
    padding: 4px 2px !important;
    flex: 1 1 100% !important;
    cursor: pointer;
    border-bottom: none;
}

li.autocomplete-result.profile_auto:hover {
    background-color: #4aae9b;
    color: white;
}
input#autocomplete-input {
    background-image: url(/images/marker-24.png);
    display: inline-block;
    height: 44px;
    background-repeat: no-repeat;
    background-position: 210px 8px;
    vertical-align: middle;
}

#fileInput2,
#fileInput {
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
</style>

