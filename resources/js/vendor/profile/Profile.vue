<template>
    <div>
        <!-- Titlebar -->
        <div>
            <div id="titlebar">
                <div class="row">
                    <div class="col-md-12 heading_admin">
                        <h2>Моят Профил</h2>
                        <!-- Breadcrumbs -->

                        <a
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
                        </nav>
                    </div>
                </div>
            </div>

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
                                <label>Компания</label>
                                <input
                                    value
                                    v-model="user.vendor_details.company_name"
                                    type="text"
                                />

                                <label>Телефон</label>
                                <input
                                    value
                                    v-model="user.vendor_details.phone_number"
                                    type="text"
                                />

                                <label>Поща</label>
                                <input
                                    value
                                    v-model="user.vendor_details.email_address"
                                    type="text"
                                />
                                <label>Информация</label>
                                <!-- <textarea name id cols="30" rows="6" value v-model="user.vendor_details.information"></textarea> -->
                                <ckeditor
                                    :editor="editorConfig.editor"
                                    v-model="user.vendor_details.information"
                                    :config="editorConfig.editorConfig"
                                ></ckeditor>
                                <label>Уебсайт</label>
                                <input value v-model="user.vendor_details.website" type="text" />
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
                                <label>Лице за контакти</label>
                                <input
                                    value
                                    v-model="user.vendor_details.contact_person"
                                    type="text"
                                />
                                <label> <i class="fa fa-facebook-square"></i> Facebook </label>
                                <input
                                    placeholder="https://www.facebook.com/"
                                    v-model="user.vendor_details.facebook_link"
                                    type="text"
                                />
                            </div>

                            <button class="button margin-top-15" @click="saveProfile">
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
                                <label class="margin-top-0">Настояща парола</label>
                                <input type="password" />

                                <label>Нова парола</label>
                                <input
                                    type="password"
                                    v-model="new_password"
                                    name="password"
                                    v-validate="'required'"
                                />

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

                                <button class="button margin-top-15">Промени паролата</button>
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

