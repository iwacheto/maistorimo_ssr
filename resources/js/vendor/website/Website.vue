<template>
    <div>
        
        <MobileGreenMenuSmall/>

        <!-- MOBILE PART -->
        <div class="row mobile">
            <!-- Profile -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4 class="gray">
                        Настройки на сайта
                        <span class="missingContent" v-if="hideWebsite"
                            >За да бъде създаден успешно Вашият уебсайт, трябва да попълните всички
                            настройки от секциите!</span
                        >
                    </h4>
                    <div class="dashboard-list-box-static">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item" @click.prevent="setActive('home')" :class="{ active: isActive('home') }">
                                <img src="/images/style-icon.svg" alt="style icon">
                                <a
                                    class="nav-link"
                                    :class="{ active: isActive('home') }"
                                    href="#home"
                                    >Стилове</a
                                >
                                <span v-if="error.showStyleError" class="error_data">!</span>
                            </li>
                            <li class="nav-item" @click.prevent="setActive('about')" :class="{ active: isActive('about') }">
                                <img src="/images/about-icon.svg" alt="about icon">
                                <a
                                    class="nav-link"
                                    :class="{ active: isActive('about') }"
                                    href="#about"
                                    >За нас</a
                                >
                                <span v-if="error.showAboutUsError" class="error_data">!</span>
                            </li>
                            <li class="nav-item" @click.prevent="setActive('profile')" :class="{ active: isActive('profile') }">
                                <img src="/images/profile-icon.svg" alt="profile icon">
                                <a
                                    class="nav-link"
                                    :class="{ active: isActive('profile') }"
                                    href="#profile"
                                    >Начална страница</a
                                >
                                <span v-if="error.showHomeError" class="error_data">!</span>
                            </li>
                        </ul>
                    </div>
                    <div class="dashboard-list-box-static second-box">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item" @click.prevent="setActive('contact')" :class="{ active: isActive('contact') }">
                                <img src="/images/contact-icon.svg" alt="contact icon">
                                <a
                                    class="nav-link"
                                    :class="{ active: isActive('contact') }"
                                    href="#contact"
                                    >Контакти</a
                                >
                                <span v-if="error.showContactsError" class="error_data">!</span>
                            </li>
                            <li class="nav-item" @click.prevent="setActive('seo')" :class="{ active: isActive('seo') }">
                                <img src="/images/seo-icon.svg" alt="seo icon">
                                <a
                                    class="nav-link"
                                    :class="{ active: isActive('seo') }"
                                    href="#seo"
                                    >SEO</a
                                >
                                <span v-if="error.showSEOError" class="error_data">!</span>
                            </li>
                            <li class="nav-item" @click.prevent="setActive('terms')" :class="{ active: isActive('terms') }">
                                <img src="/images/terms-icon.svg" alt="terms icon">
                                <a
                                    class="nav-link"
                                    :class="{ active: isActive('terms') }"
                                    href="#terms"
                                    >Общи условия</a
                                >
                                <span v-if="error.showGeneralError" class="error_data">!</span>
                            </li>
                        </ul>
                    </div>

                    <button
                            v-if="!hideWebsite"
                            class="button"
                            @click="openWebsite"
                        >Линк за сайт</button>

                    <div class="tab-pan" :class="{ 'active show': isActive('home') }">
                        <label>Цвят на сайта</label>
                        <p>
                            * Изберете сами цвят на вашия сайт, натискайки върху него и след
                            това бутона ‘’запази’’, за да изберете или коригирате.
                        </p>
                        <select v-model="user.website_settings.color">
                            <option
                                v-for="color in colors"
                                :key="color.value"
                                :value="color.value"
                            >
                                {{ color.name }}
                            </option>
                        </select>
                        <!-- Logo -->
                        <label class="label-no-mb-0">Лого на сайта</label>
                        <p>* Поставете вашето лого и то ще бъде видяно от всеки посетител.
                            След това натиснете бутонът - ‘’ Запази’’</p>
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
                            <label for="fileInput2" class="upload-label" slot="upload-label">
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
                                    {{ hasLogo ? 'Replace' : 'Click to upload' }}
                                </span>
                            </label>
                        </image-uploader>
                    </div>

                    <div class="tab-pan" :class="{ 'active show': isActive('profile') }">
                        <!-- Zaglavna snimka -->
                        <label>Заглавна снимка на сайта</label>
                        <p>* Изберете най-подходяща заглавна снимка за вашия сайт- винаги след
                            промени трябва да натиснете бутона ‘’ запази’’</p>
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
                            style="margin: 0px 18px"
                        >
                        <!-- margin-top: -62px; -->
                            <label class="upload-label" for="fileInput" slot="upload-label">
                                <span class="upload-caption">
                                    {{ hasMainImage ? 'Замени снимката' : 'Натисни за да качиш снимка' }}
                                </span>
                                <figure>
                                    <!-- <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="32"
                                        height="32"
                                        viewBox="0 0 32 32"
                                    >
                                        <path
                                            class="path1"
                                            d="M9.5 19c0 3.59 2.91 6.5 6.5 6.5s6.5-2.91 6.5-6.5-2.91-6.5-6.5-6.5-6.5 2.91-6.5 6.5zM30 8h-7c-0.5-2-1-4-3-4h-8c-2 0-2.5 2-3 4h-7c-1.1 0-2 0.9-2 2v18c0 1.1 0.9 2 2 2h28c1.1 0 2-0.9 2-2v-18c0-1.1-0.9-2-2-2zM16 27.875c-4.902 0-8.875-3.973-8.875-8.875s3.973-8.875 8.875-8.875c4.902 0 8.875 3.973 8.875 8.875s-3.973 8.875-8.875 8.875zM30 14h-4v-2h4v2z"
                                        />
                                    </svg> -->
                                    <img class="photo-icon" src="/images/photo-icon.svg" style="width: 16px;" alt="photo icon">
                                </figure>
                            </label>
                        </image-uploader>

                        <!-- Details -->
                        <div class="my-profile">
                            <label>
                                Заглавие na начална страница
                                <span class="website_error" v-if="homepage.headingError"
                                    >Текстът не трябва да е по дълъг от 250 символа</span
                                >
                            </label>
                            <p>* Точна, конкретна дейност, с която се занимавате.</p>
                            <input
                                value
                                v-model="user.website_settings.home_heading"
                                type="text"
                            />

                            <label>
                                Текст на начална страница
                                <span class="website_error" v-if="homepage.textError"
                                    >Текстът не трябва да е по дълъг от 1000 символа</span
                                >
                            </label>
                            <p>* Кратък текст, който описва вашата дейност. </p>
                            <input
                                value
                                v-model="user.website_settings.home_text"
                                type="text"
                            />

                            <div class="horizontal-line"></div>

                            <label>
                                Опорна точка 1 заглавие
                                <span class="website_error" v-if="homepage.bullet1HeadError"
                                    >Текстът не трябва да е по дълъг от 255 символа</span
                                >
                            </label>
                            <p>* Извършвани от вас дейности или услуги</p>
                            <input
                                value
                                v-model="user.website_settings.bullet_1_heading"
                                type="text"
                            />
                            <label>
                                Опорна точка 1 текст
                                <span class="website_error" v-if="homepage.bullet1ContError"
                                    >Текстът не трябва да е по дълъг от 255 символа</span
                                >
                            </label>
                            <p>* Oписание на дейност или услугата посочена от Вас</p>
                            <input
                                value
                                v-model="user.website_settings.bullet_1_content"
                                type="text"
                            />

                            <div class="horizontal-line"></div>

                            <label>
                                Опорна точка 2 заглавие
                                <span class="website_error" v-if="homepage.bullet2HeadError"
                                    >Текстът не трябва да е по дълъг от 255 символа</span
                                >
                            </label>
                            <p>* Извършвани от вас дейности или услуги</p>
                            <input
                                value
                                v-model="user.website_settings.bullet_2_heading"
                                type="text"
                            />
                            <label>
                                Опорна точка 2 текст
                                <span class="website_error" v-if="homepage.bullet2ContError"
                                    >Текстът не трябва да е по дълъг от 255 символа</span
                                >
                            </label>
                            <p>* Описание на дейност или услугата посочена от Вас</p>
                            <input
                                value
                                v-model="user.website_settings.bullet_2_content"
                                type="text"
                            />

                            <div class="horizontal-line"></div>

                            <label>
                                Опорна точка 3 заглавие
                                <span class="website_error" v-if="homepage.bullet3HeadError"
                                    >Текстът не трябва да е по дълъг от 255 символа</span
                                >
                            </label>
                            <p>* Извършвани от вас дейности или услуги</p>
                            <input
                                value
                                v-model="user.website_settings.bullet_3_heading"
                                type="text"
                            />
                            <label>
                                Опорна точка 3 текст
                                <span class="website_error" v-if="homepage.bullet3ContError"
                                    >Текстът не трябва да е по дълъг от 255 символа</span
                                >
                            </label>
                            <p>* Описание на дейност или услугата посочена от Вас след всяка
                                направена промяна, натиснете бутона ‘’ Запази’’</p>
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
                        <p>* Опишете подробно вашата дейност, услуги, цели и задачи. Създайте
                            представа на клиента за Вас!</p>
                        <div>
                            <ckeditor
                                :editor="editorConfig.editor"
                                v-model="user.website_settings.about_us"
                                :config="editorConfig.editorConfig"
                            ></ckeditor>
                        </div>
                        <label>Текст за Нас - Мисия</label>
                        <p>* Опишете подробно вашата мисия на дейността си. След всяка
                            направена промяна, натиснете бутона ‘’ Запази’’</p>
                        <div>
                            <ckeditor
                                :editor="editorConfig2.editor"
                                v-model="user.website_settings.about_us_2"
                                :config="editorConfig2.editorConfig"
                            ></ckeditor>
                        </div>
                    </div>

                    <div class="tab-pan cont-unset" :class="{ 'active show': isActive('contact') }">
                        <google-map
                            v-if="
                                user.website_settings.lat &&
                                user.website_settings.lng &&
                                user.website_settings.formatted_address &&
                                user.website_settings.raw_data
                            "
                            :lat="user.website_settings.lat"
                            :lng="user.website_settings.lng"
                            :formatted_address="user.website_settings.formatted_address"
                            :placeObj="user.website_settings.raw_data"
                        />
                        <google-map v-else />
                    </div>

                    <div class="tab-pan" :class="{ 'active show': isActive('seo') }">
                        <div class="my-profile">
                            <label class="label-no-mb-0">
                                Заглавие на сайта
                                <span class="website_error" v-if="homepage.seoHeading"
                                    >Текстът не трябва да е по дълъг от 255 символа</span
                                >
                            </label>
                            <input
                                value
                                v-model="user.website_settings.seo_title"
                                type="text"
                            />
                            <label class="label-no-mb-0">
                                Описание на сайта
                                <span class="website_error" v-if="homepage.seoDesc"
                                    >Текстът не трябва да е по дълъг от 255 символа</span
                                >
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
                            <label class="label-no-mb-0">
                                Официално фирмено наименование в търговския регистър
                                <span class="website_error" v-if="homepage.termsName"
                                    >Името не трябва да е по дълго от 255 символа</span
                                >
                            </label>
                            <input value v-model="user.terms.name" type="text" />
                            <label class="label-no-mb-0">
                                ЕИК
                                <span class="website_error" v-if="homepage.termsEik"
                                    >ЕИК трябва да е точно 9 цифри символа</span
                                >
                            </label>
                            <input value v-model="user.terms.eik" type="text" />
                            <label class="label-no-mb-0">
                                Адрес на управление в търговския регистър
                                <span class="website_error" v-if="homepage.termsAddressReg"
                                    >Адресът не трябва да е по дълъг от 255 символа</span
                                >
                            </label>
                            <input value v-model="user.terms.address_reg" type="text" />
                            <label class="label-no-mb-0">
                                Управител, управители
                                <span class="website_error" v-if="homepage.termsManager"
                                    >Текстът не трябва да е по дълъг от 255 символа</span
                                >
                            </label>
                            <input value v-model="user.terms.manager" type="text" />
                            <label class="label-no-mb-0">
                                Телефон
                                <span class="website_error" v-if="homepage.termsPhoneMin"
                                    >Телефонът трябва да е по дълъг от 8 символа</span
                                >
                                <span class="website_error" v-if="homepage.termsPhoneNumber"
                                    >Телефонът трябва да е с цифри</span
                                >
                            </label>
                            <input value v-model="user.terms.phone" type="text" />
                            <label class="label-no-mb-0">
                                Имейл
                                <span class="website_error" v-if="homepage.termsEmail"
                                    >Имейлът не трябва да е по дълъг от 255 символа</span
                                >
                                <span class="website_error" v-if="homepage.termsEmail2"
                                    >Имейлът трябва да е валиден Имейл адрес</span
                                >
                            </label>
                            <input value v-model="user.terms.email" type="text" />
                            <label class="label-no-mb-0">
                                Действителен адрес, на който се осъществява дейността
                                <span class="website_error" v-if="homepage.termsAddress"
                                    >Адресът не трябва да е по дълъг от 255 символа</span
                                >
                            </label>
                            <input value v-model="user.terms.address" type="text" />
                            <label class="label-no-mb-0">
                                Опишете подробно какъв вид услуги ще извършвате
                                <span class="website_error" v-if="homepage.termsDesc"
                                    >Описанието не трябва да е по дълго от 255 символа</span
                                >
                            </label>
                            <input value v-model="user.terms.description" type="text" />
                        </div>
                    </div>
                    <button class="button" @click="saveWebsite">Запази</button>
                    
                </div>
            </div>

            <!-- Copyrights -->
            <div class="col-md-12">
                <div class="copyrights">© 2019 Maistorimo LTD. All Rights Reserved.</div>
            </div>
        </div>



        <!-- DESKTOP PART -->
        <div class="row desktop">
            <!-- Profile -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4 class="gray">
                        Настройки на сайта
                        <span class="missingContent" v-if="hideWebsite"
                            >За да бъде създаден успешно Вашият уебсайт, трябва да попълните всички
                            настройки от секциите!</span
                        >
                    </h4>
                    <div class="dashboard-list-box-static">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item" @click.prevent="setActive('home')" :class="{ active: isActive('home') }">
                                <img src="/images/style-icon.svg" alt="style icon">
                                <a
                                    class="nav-link"
                                    :class="{ active: isActive('home') }"
                                    href="#home"
                                    >Стилове</a
                                >
                                <span v-if="error.showStyleError" class="error_data">!</span>
                            </li>
                            <li class="nav-item" @click.prevent="setActive('about')" :class="{ active: isActive('about') }">
                                <img src="/images/about-icon.svg" alt="about icon">
                                <a
                                    class="nav-link"
                                    :class="{ active: isActive('about') }"
                                    href="#about"
                                    >За нас</a
                                >
                                <span v-if="error.showAboutUsError" class="error_data">!</span>
                            </li>
                            <li class="nav-item" @click.prevent="setActive('profile')" :class="{ active: isActive('profile') }">
                                <img src="/images/profile-icon.svg" alt="profile icon">
                                <a
                                    class="nav-link"
                                    :class="{ active: isActive('profile') }"
                                    href="#profile"
                                    >Начална страница</a
                                >
                                <span v-if="error.showHomeError" class="error_data">!</span>
                            </li>
                        </ul>
                    </div>
                    <div class="dashboard-list-box-static second-box">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item" @click.prevent="setActive('contact')" :class="{ active: isActive('contact') }">
                                <img src="/images/contact-icon.svg" alt="contact icon">
                                <a
                                    class="nav-link"
                                    :class="{ active: isActive('contact') }"
                                    href="#contact"
                                    >Контакти</a
                                >
                                <span v-if="error.showContactsError" class="error_data">!</span>
                            </li>
                            <li class="nav-item" @click.prevent="setActive('seo')" :class="{ active: isActive('seo') }">
                                <img src="/images/seo-icon.svg" alt="seo icon">
                                <a
                                    class="nav-link"
                                    :class="{ active: isActive('seo') }"
                                    href="#seo"
                                    >SEO</a
                                >
                                <span v-if="error.showSEOError" class="error_data">!</span>
                            </li>
                            <li class="nav-item" @click.prevent="setActive('terms')" :class="{ active: isActive('terms') }">
                                <img src="/images/terms-icon.svg" alt="terms icon">
                                <a
                                    class="nav-link"
                                    :class="{ active: isActive('terms') }"
                                    href="#terms"
                                    >Общи условия</a
                                >
                                <span v-if="error.showGeneralError" class="error_data">!</span>
                            </li>
                        </ul>
                    </div>

                    <button
                            v-if="!hideWebsite"
                            class="button"
                            @click="openWebsite"
                        >Линк за сайт</button>
                </div>

                <div class="dashboard-options-box" v-if="activeItem != 'close' ">
                    <div class="tab-pan" :class="{ 'active': isActive('home') }">
                        
                        <div class="tab-pan-item">
                            <label>Цвят на сайта</label>
                            <p>
                                * Изберете сами цвят на вашия сайт, натискайки върху него и след
                                това бутона ‘’запази’’, за да изберете или коригирате.
                            </p>
                            <select v-model="user.website_settings.color">
                                <option
                                    v-for="color in colors"
                                    :key="color.value"
                                    :value="color.value"
                                >
                                    {{ color.name }}
                                </option>
                            </select>
                        </div>
                        
                        <div class="tab-pan-item">
                            <!-- Logo -->
                            <label class="label-no-mb-0">Лого на сайта</label>
                            <p>* Поставете вашето лого и то ще бъде видяно от всеки посетител.
                                След това натиснете бутонът - ‘’ Запази’’</p>
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
                                <label class="upload-label" for="fileInput2" slot="upload-label">
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
                                        {{ hasLogo ? 'Replace' : 'Click to upload' }}
                                    </span>
                                </label>
                            </image-uploader>
                        </div>
                    </div>

                    <div class="tab-pan" :class="{ 'active show': isActive('profile') }">
                        <!-- Zaglavna snimka -->
                        <div class="main-heading">
                            <div class="heading-part-1">
                                <label>Заглавна снимка на сайта</label>
                                <p>* Изберете най-подходяща заглавна снимка за вашия сайт- винаги след
                                    промени трябва да натиснете бутона ‘’ запази’’</p>
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
                                    style="margin: 0px 18px"
                                >
                                <!-- margin-top: -62px; -->
                                    <label class="upload-label" for="fileInput" slot="upload-label">
                                        <span class="upload-caption">
                                            {{ hasMainImage ? 'Замени снимката' : 'Натисни за да качиш снимка' }}
                                        </span>
                                        <figure>
                                            <!-- <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="32"
                                                height="32"
                                                viewBox="0 0 32 32"
                                            >
                                                <path
                                                    class="path1"
                                                    d="M9.5 19c0 3.59 2.91 6.5 6.5 6.5s6.5-2.91 6.5-6.5-2.91-6.5-6.5-6.5-6.5 2.91-6.5 6.5zM30 8h-7c-0.5-2-1-4-3-4h-8c-2 0-2.5 2-3 4h-7c-1.1 0-2 0.9-2 2v18c0 1.1 0.9 2 2 2h28c1.1 0 2-0.9 2-2v-18c0-1.1-0.9-2-2-2zM16 27.875c-4.902 0-8.875-3.973-8.875-8.875s3.973-8.875 8.875-8.875c4.902 0 8.875 3.973 8.875 8.875s-3.973 8.875-8.875 8.875zM30 14h-4v-2h4v2z"
                                                />
                                            </svg> -->
                                            <img class="photo-icon" src="/images/photo-icon.svg" style="width: 16px;" alt="photo icon">
                                        </figure>
                                    </label>
                                </image-uploader>
                            </div>
                            <div class="heading-part-2">
                                <label>
                                    Заглавие на начална страница
                                    <span class="website_error" v-if="homepage.headingError"
                                        >Текстът не трябва да е по дълъг от 250 символа</span
                                    >
                                </label>
                                <p>* Точна, конкретна дейност, с която се занимавате.</p>
                                <input
                                    value
                                    v-model="user.website_settings.home_heading"
                                    type="text"
                                />

                                <label>
                                    Текст на начална страница
                                    <span class="website_error" v-if="homepage.textError"
                                        >Текстът не трябва да е по дълъг от 1000 символа</span
                                    >
                                </label>
                                <p>* Кратък текст, който описва вашата дейност. </p>
                                <input
                                    value
                                    v-model="user.website_settings.home_text"
                                    type="text"
                                />
                            </div>
                        </div>
                        <!-- Details -->
                        <div class="my-profile">
                            
                            <div class="my-profile-part-1">
                                <label>
                                    Опорна точка 1 заглавие
                                    <span class="website_error" v-if="homepage.bullet1HeadError"
                                        >Текстът не трябва да е по дълъг от 255 символа</span
                                    >
                                </label>
                                <p>* Извършвани от вас дейности или услуги</p>
                                <input
                                    value
                                    v-model="user.website_settings.bullet_1_heading"
                                    type="text"
                                />
                            
                                <label>
                                    Опорна точка 1 текст
                                    <span class="website_error" v-if="homepage.bullet1ContError"
                                        >Текстът не трябва да е по дълъг от 255 символа</span
                                    >
                                </label>
                                <p>* Oписание на дейност или услугата посочена от Вас</p>
                                <input
                                    value
                                    v-model="user.website_settings.bullet_1_content"
                                    type="text"
                                />
                            </div>

                            <div class="vertical-line"></div>

                            <div class="my-profile-part-2">
                                <label>
                                    Опорна точка 2 заглавие
                                    <span class="website_error" v-if="homepage.bullet2HeadError"
                                        >Текстът не трябва да е по дълъг от 255 символа</span
                                    >
                                </label>
                                <p>* Извършвани от вас дейности или услуги</p>
                                <input
                                    value
                                    v-model="user.website_settings.bullet_2_heading"
                                    type="text"
                                />
                                <label>
                                    Опорна точка 2 текст
                                    <span class="website_error" v-if="homepage.bullet2ContError"
                                        >Текстът не трябва да е по дълъг от 255 символа</span
                                    >
                                </label>
                                <p>* Описание на дейност или услугата посочена от Вас</p>
                                <input
                                    value
                                    v-model="user.website_settings.bullet_2_content"
                                    type="text"
                                />
                            </div>

                            <div class="vertical-line"></div>

                            <div class="my-profile-part-3">
                                <label>
                                    Опорна точка 3 заглавие
                                    <span class="website_error" v-if="homepage.bullet3HeadError"
                                        >Текстът не трябва да е по дълъг от 255 символа</span
                                    >
                                </label>
                                <p>* Извършвани от вас дейности или услуги</p>
                                <input
                                    value
                                    v-model="user.website_settings.bullet_3_heading"
                                    type="text"
                                />
                                <label>
                                    Опорна точка 3 текст
                                    <span class="website_error" v-if="homepage.bullet3ContError"
                                        >Текстът не трябва да е по дълъг от 255 символа</span
                                    >
                                </label>
                                <p>* Описание на дейност или услугата посочена от Вас</p>
                                <input
                                    value
                                    v-model="user.website_settings.bullet_3_content"
                                    type="text"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="tab-pan " :class="{ 'active': isActive('about') }">
                        <!-- About Us -->
                        <div class="about-item">
                            <label>Текст за Нас - Мисия</label>
                            <p>* Опишете подробно вашата мисия на дейността си. След всяка
                                направена промяна, натиснете бутона ‘’ Запази’’</p>
                            <div>
                                <ckeditor
                                    :editor="editorConfig2.editor"
                                    v-model="user.website_settings.about_us_2"
                                    :config="editorConfig2.editorConfig"
                                ></ckeditor>
                            </div>
                        </div>

                        <div class="about-item">
                            <label>Текст за Нас - Компания</label>
                            <p>* Опишете подробно вашата дейност, услуги, цели и задачи. Създайте
                                представа на клиента за Вас!</p>
                            <div>
                                <ckeditor
                                    :editor="editorConfig.editor"
                                    v-model="user.website_settings.about_us"
                                    :config="editorConfig.editorConfig"
                                ></ckeditor>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pan cont-unset" :class="{ 'active show': isActive('contact') }">
                        <google-map
                            v-if="
                                user.website_settings.lat &&
                                user.website_settings.lng &&
                                user.website_settings.formatted_address &&
                                user.website_settings.raw_data
                            "
                            :lat="user.website_settings.lat"
                            :lng="user.website_settings.lng"
                            :formatted_address="user.website_settings.formatted_address"
                            :placeObj="user.website_settings.raw_data"
                        />
                        <google-map v-else />
                    </div>

                    <div class="tab-pan" :class="{ 'active show': isActive('seo') }">
                        <div class="my-profile-seo">

                            <div class="seo-part-1">
                                <label>
                                    Заглавие на сайта
                                    <span class="website_error" v-if="homepage.seoHeading"
                                        >Текстът не трябва да е по дълъг от 255 символа</span
                                    >
                                </label>
                                <input
                                    value
                                    v-model="user.website_settings.seo_title"
                                    type="text"
                                />
                            </div>

                            <div class="seo-part-2">
                                <label>
                                    Описание на сайта
                                    <span class="website_error" v-if="homepage.seoDesc"
                                        >Текстът не трябва да е по дълъг от 255 символа</span
                                    >
                                </label>
                                <input
                                    value
                                    v-model="user.website_settings.seo_description"
                                    type="text"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="tab-pan" :class="{ 'active show': isActive('terms') }">
                        <div class="my-profile-terms">

                            <div class="terms-part">
                                <label class="label-no-mb-0">
                                    Официално фирмено наименование в търговския регистър
                                    <span class="website_error" v-if="homepage.termsName"
                                        >Името не трябва да е по дълго от 255 символа</span
                                    >
                                </label>
                                <input value v-model="user.terms.name" type="text" />
                                <label class="label-no-mb-0">
                                    ЕИК
                                    <span class="website_error" v-if="homepage.termsEik"
                                        >ЕИК трябва да е точно 9 цифри символа</span
                                    >
                                </label>
                                <input value v-model="user.terms.eik" type="text" />
                                <label class="label-no-mb-0">
                                    Адрес на управление в търговския регистър
                                    <span class="website_error" v-if="homepage.termsAddressReg"
                                        >Адресът не трябва да е по дълъг от 255 символа</span
                                    >
                                </label>
                                <input value v-model="user.terms.address_reg" type="text" />
                            </div>

                            <div class="terms-part">
                                <label class="label-no-mb-0">
                                    Управител, управители
                                    <span class="website_error" v-if="homepage.termsManager"
                                        >Текстът не трябва да е по дълъг от 255 символа</span
                                    >
                                </label>
                                <input value v-model="user.terms.manager" type="text" />
                                <label class="label-no-mb-0">
                                    Телефон
                                    <span class="website_error" v-if="homepage.termsPhoneMin"
                                        >Телефонът трябва да е по дълъг от 8 символа</span
                                    >
                                    <span class="website_error" v-if="homepage.termsPhoneNumber"
                                        >Телефонът трябва да е с цифри</span
                                    >
                                </label>
                                <input value v-model="user.terms.phone" type="text" />
                                <label class="label-no-mb-0">
                                    Имейл
                                    <span class="website_error" v-if="homepage.termsEmail"
                                        >Имейлът не трябва да е по дълъг от 255 символа</span
                                    >
                                    <span class="website_error" v-if="homepage.termsEmail2"
                                        >Имейлът трябва да е валиден Имейл адрес</span
                                    >
                                </label>
                                <input value v-model="user.terms.email" type="text" />
                            </div>

                            <div class="terms-part">
                                <label class="label-no-mb-0">
                                    Действителен адрес, на който се осъществява дейността
                                    <span class="website_error" v-if="homepage.termsAddress"
                                        >Адресът не трябва да е по дълъг от 255 символа</span
                                    >
                                </label>
                                <input value v-model="user.terms.address" type="text" />
                                <label class="label-no-mb-0">
                                    Опишете подробно какъв вид услуги ще извършвате
                                    <span class="website_error" v-if="homepage.termsDesc"
                                        >Описанието не трябва да е по дълго от 255 символа</span
                                    >
                                </label>
                                <input value v-model="user.terms.description" type="text" />
                            </div>
                        </div>
                    </div>

                    <button class="button save-button" @click="saveWebsite">Запази</button>
                    
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
import MobileGreenMenuSmall from '../partials/MobileGreenMenuSmall.vue';
import GoogleMap from '../../components/googleMap/GoogleMap';

export default {
    data() {
        return {
            user: laravel.user,
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
            activeItem: 'close',
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
    created() {
        // this.getUser();
    },
    mounted() {
        this.hasMainImage = this.user.website_settings.main_image ? true : false;
        this.hasLogo = this.user.website_settings.logo ? true : false;
        this.$refs.mytoast.defaultPosition = 'toast-top-center';
        this.$refs.mytoast.defaultStyle = { top: '80px' };
        this.showErrors();
        console.log(this.user.website_settings.formatted_address);
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
            // window.open('https://' + this.user.name + '.maistorimo.bg');
            // window.open = '/website/' + this.user.name + '/home';
        },
        uploadLogo: function (output) {
            this.hasLogo = true;
            this.logo = output;
            let self = this;
            window.axios.post('/vendor/profile/uploadImage', output).then(({ data }) => {
                self.user.website_settings.logo = data.url;
                // console.log(data.url)
            });
        },
        uploadImage: function (output) {
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
                .catch((error) => {
                    let err = error.response.data.errors;
                    for (const elem in err) {
                        let allErrors;

                        allErrors = err[elem][0];
                        console.log(allErrors);
                        this.errorTexts.forEach((err) => {
                            if (err.text === allErrors) {
                                this.homepage[err.err] = true;
                                this.scrollToError();
                            }
                        });
                    }
                });
        },
        scrollToError() {
            setTimeout(function () {
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
    components: {
        GoogleMap,
        MobileGreenMenuSmall,
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

@media only screen and (min-width: 991px) {
    .desktop {
        display: flex;
        flex-direction: column;
        /* background-color: #E7E7E7; */
    }

    .mobile {
        display: none;
    }

    .row {
        margin-left: 0px;
        margin-right: 0px;
    }

    .col-lg-12.col-md-12 {
        padding-top: 100px;
        background-color: #F7F7F7;
    }

    .dashboard-list-box {
        background: #FFFFFF;
        border: 0.25px solid #9EA3BD;
        box-sizing: border-box;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
        border-radius: 7px;
        display: flex;
        flex-direction: column;
    }

    .dashboard-list-box h4 {
        font-style: normal;
        font-weight: 500;
        font-size: 25px;
        line-height: 29px;
        color: #276955;
        border-bottom: unset;
        border-radius: unset;
        background-color: #FFFFFF;
        border-radius: 7px;
    }

    /* button.button:before {
        position: unset;
        display: flex;
        content: unset;
    } */

    .dashboard-list-box ul {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-around;
    }

    .dashboard-list-box ul li.nav-item {
        padding: 0px;
        max-width: 311px;
        height: 85px;
        background-color: #276955;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .dashboard-list-box ul li.nav-item.active {
        background-color: #419D81;
        box-shadow: inset 0px 2px 10px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        transition: color 0.2s;
    }

    .dashboard-list-box ul li.nav-item img {
        margin: 21px;
    }

    a.nav-link {
        font-style: normal;
        font-weight: 600;
        font-size: 30px;
        line-height: 35px;
        color: #FFFFFF;
        padding: 0px 30px;
    }

    .nav-item a.active {
        color: #FFFFFF;
        background-color: #419D81;
        border-bottom: unset;
        transition: color 0.2s;
    }

    a.nav-link:hover {
        color: #FFFFFF;
    }

    button.button {
        width: 245px;
        height: 40px;
        background-color: #6BBF3F;
        border-radius: 20px;
        margin: 0px auto;
        font-style: normal;
        font-weight: normal;
        font-size: 14px;
        line-height: 16px;
        color: #FFFFFF;
        margin-bottom: 65px;
        margin-top: 14px;
    }

    .dashboard-options-box {
        background: #FFFFFF;
        border: 0.25px solid #9EA3BD;
        box-sizing: border-box;
        box-shadow: 0px 2px 10px rgb(0 0 0 / 25%);
        border-radius: 7px;
        margin-top: 17px;
    }

    div.tab-pan.active {
        display: flex;
    }

    .tab-pan-item {
        width: 30%;
        margin-left: 38px;
    }

    .tab-pan-item label {
        font-style: normal;
        font-weight: bold;
        font-size: 17px;
        line-height: 20px;
        color: #276955;
    }

    .tab-pan-item label:nth-child(1) {
        margin: 34px 0px 14px 21px;
    }

    label.upload-label {
        display: none;
    }

    .tab-pan.active div div {
        background: #FFFFFF;
        border: 0.25px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        height: 53px;
    }

    .tab-pan-item p {
        margin: 0 0 17px 21px;
        font-style: normal;
        font-weight: 300;
        font-size: 14px;
        line-height: 16px;
        color: #787878;
    }

    .tab-pan-item select {
        max-width: 340px;
        background-color: #FFFFFF;
        border: 0.25px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
    }

    .tab-pan-item img {
        background-color: #FFFFFF;
        border: 0.25px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        margin-bottom: 10px;
    }

    button.save-button {
        margin-top: 24px;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
        font-style: normal;
        font-weight: normal;
        font-size: 14px;
        line-height: 16px;
        color: #FFFFFF;
    }

    .about-item {
        display: flex;
        flex-direction: column;
        min-height: 350px;
        margin: 29px;
    }

    .tab-pan .about-item label {
        font-style: normal;
        font-weight: bold;
        font-size: 17px;
        line-height: 20px;
        color: #276955;
        margin: 28px 0px 28px 49px;
    }

    .tab-pan .about-item p {
        margin: 0px 0px 20px 49px;
        font-style: normal;
        font-weight: 300;
        font-size: 14px;
        line-height: 16px;
        color: #818181;
    }

    .tab-pan.active .about-item div div {
        background: #FFFFFF;
        border: 0.25px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
    }

    .tab-pan.active div.about-item div {
        height: 192px;
    }

    .main-heading {
        display: flex;
        flex-direction: row;
        min-height: 420px;
    }

    .tab-pan.active .main-heading .heading-part-1 {
        display: flex;
        flex-direction: column;
        border: unset;
        box-shadow: unset;
        width: 33%;
    }

    .main-heading .heading-part-1 img {
        width: 20%;
        margin: 6px auto;
    }

    .tab-pan.active .main-heading .heading-part-2 {
        display: flex;
        flex-direction: column;
        border: unset;
        box-shadow: unset;
        width: 33%;
    }

    .heading-part-2 input {
        max-width: 340px;
        height: 40px;
        background: #FFFFFF;
        border: 0.25px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;

    }

    .main-heading div label {
        font-style: normal;
        font-weight: bold;
        font-size: 17px;
        line-height: 20px;
        color: #276955;
        margin: 24px 0px 27px 47px;
    }

    .main-heading div p {
        font-style: normal;
        font-weight: 300;
        font-size: 14px;
        line-height: 16px;
        color: #616161;
        margin: 0px 10px 10px 51px;
        max-width: 260px;
    }

    .my-profile {
        display: flex;
        flex-direction: row;
        min-height: 350px;
        border-top: 1px solid #CACACA;
        padding: 0px 35px;
    }

    .tab-pan.active .my-profile .my-profile-part-1, .tab-pan.active .my-profile .my-profile-part-2, .tab-pan.active .my-profile .my-profile-part-3 {
        display: flex;
        flex-direction: column;
        box-shadow: unset;
        border: unset;
        width: 33%;
    }

    .my-profile label {
        font-style: normal;
        font-weight: bold;
        font-size: 17px;
        line-height: 20px;
        color: #276955;
        margin: 33px 0px 15px 58px;
    }

    .my-profile p {
        margin-left: 51px;
        font-style: normal;
        font-weight: 300;
        font-size: 14px;
        line-height: 16px;
        color: #616161;
        max-width: 280px;
        margin-bottom: 5px;
    }

    .my-profile input {
        margin: 0px;
        max-width: 504px;
        background: #FFFFFF;
        border: 0.25px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        max-height: 40px;
    }

    .tab-pan.active .my-profile .vertical-line {
        box-shadow: unset;
        border: 1px solid #CACACA;
        height: 326px;
        margin: 13px 11px 0px 11px;
    }

    .my-profile-seo {
        width: 80%;
        display: flex;
        flex-direction: row;
    }

    .tab-pan.active .my-profile-seo .seo-part-1, .tab-pan.active .my-profile-seo .seo-part-2 {
        display: flex;
        flex-direction: column;
        box-shadow: unset;
        border: unset;
        width: 45%;
        height: 103px;
    }

    .tab-pan.active .my-profile-seo div label {
        font-style: normal;
        font-weight: bold;
        font-size: 17px;
        line-height: 20px;
        color: #276955;
        margin: 22px 0px 8px 54px;
    }

    .tab-pan.active .my-profile-seo div input {
        margin-left: 38px;
        max-width: 85%;
        max-height: 40px;
        background: #FFFFFF;
        border: 0.25px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
    }

    .my-profile-terms {
        display: flex;
        flex-direction: row;
        height: 400px;
    }

    .tab-pan.active div div.terms-part {
        border: unset;
        box-shadow: unset;
        display: flex;
        flex-direction: column;
        width: 30%;
        margin: 25px auto;
    }

    .tab-pan.active div div.terms-part:nth-child(2) {
        margin-top: 46px;
    }

    .terms-part label {
        font-style: normal;
        font-weight: bold;
        font-size: 17px;
        line-height: 20px;
        color: #276955;
        margin-top: 25px;
        max-width: 318px;       
    }

    .terms-part input {
        max-width: 330px;
        height: 40px;
        background: #FFFFFF;
        border: 0.25px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        margin-bottom: 13px;
    }
    

    @media screen and (max-width: 1563px) {
        .about-item {
            margin: 46px;
            width: 542px;
        }

        .tab-pan.active div.about-item div {
            height: 230px;
        }
    }

    @media screen and (max-width: 1366px) {
        .about-item {
            margin: 23px;
            width: 502px;
        }

        .tab-pan .about-item p {
            height: 50px;
        }

        .dashboard-list-box ul li.nav-item {
            max-width: 280px;
            height: 85px;
        }

        a.nav-link {
            font-size: 27px;
        }
    }

    @media screen and (max-width: 1206px) {
        body p {
            font-size: 14px;
        }
        .about-item {
            margin: 10px auto;
            width: 430px;
        }

        .dashboard-list-box ul li.nav-item {
            max-width: 250px;
            height: 85px;
        }

        a.nav-link {
            font-size: 25px;
            padding: 0px 20px;
        }
    }

    @media screen and (max-width: 1160px) {

        .about-item {
            margin: 10px auto;
            width: 410px;
        }

        button.save-button {
            margin-top: 70px;
        }

        .dashboard-list-box ul li.nav-item {
            max-width: 220px;
            height: 85px;
        }

        a.nav-link {
            font-size: 21px;
            padding: 0px 10px;
        }

        .tab-pan.active .my-profile-seo .seo-part-1, .tab-pan.active .my-profile-seo .seo-part-2 {
            height: 58px;
        }
    }

    @media screen and (max-width: 1110px) {
        .tab-pan.active div.about-item:nth-child(2) div {
            height: 259px;
        }
    }

    @media screen and (max-width: 1080px) {
        button.save-button {
            margin-top: 120px;
        }

        .tab-pan.active div.about-item:nth-child(2) div {
            height: 317px;
        }

        .dashboard-list-box ul li.nav-item {
            max-width: 200px;
            height: 85px;
        }

        a.nav-link {
            font-size: 19px;
            padding: 0px 8px;
        }

        .tab-pan.active .my-profile-seo .seo-part-1, .tab-pan.active .my-profile-seo .seo-part-2 {
            height: 0px;
        }
    }
}

@media (max-width: 990px) {
    .desktop {
        display: none;
    }

    .mobile {
        display: flex;
        flex-direction: column;
    }

    .row {
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
        background-color: #F7F7F7;
        margin-left: 0px;
        margin-right: 0px;
    }

    .col-lg-12.col-md-12 {
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
        background-color: #F7F7F7;
        padding-left: 10px;
        padding-right: 10px;
    }

    .dashboard-list-box {
        background-color: #F7F7F7;
        box-shadow: none;
        display: flex;
        flex-direction: column;
    }

    .dashboard-list-box h4.gray {
        background-color: #F7F7F7;
        border-bottom: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        font-size: 20px;
        font-weight: 500;
    }

    .dashboard-list-box .dashboard-list-box-static {
        background-color: #F7F7F7;
        padding: 0px;
        margin-bottom: 27px;
    }

    .dashboard-list-box .dashboard-list-box-static.second-box {
        margin-bottom: 0px;
    }

    .dashboard-list-box .dashboard-list-box-static ul {
        width: 36%;
        margin: 0px auto;
        background-color: #F7F7F7;
        display: flex;
        flex-direction: row;
        flex-wrap: unset;
    }

    .dashboard-list-box ul li.nav-item {
        border-bottom: 1px solid transparent;
        margin: 2px;
        padding: 23px 0px;
        background-color: #276955;
        border-radius: 25px;
        min-width: 105px;
        max-width: 105px;
        height: 115px;
        display: flex;
        flex-direction: column;
        cursor: pointer;
    }

    .dashboard-list-box ul li.nav-item:nth-child(2) {
        margin: 0px 11px;
    }

    .dashboard-list-box ul li.nav-item a {
        background-color: #276955;
        padding: 0px;
        text-align: center;
        border-radius: 25px;
        color: #fff;
        line-height: 15px;
        margin: 10px 2px 0px 2px;
        font-size: 17px;
        transition: 0.3s;
    }

    .dashboard-list-box ul li.nav-item.active {
        background-color: #419D81;
        box-shadow: inset 0px 2px 10px rgba(0, 0, 0, 0.25);
    }

    .dashboard-list-box ul li.nav-item a.active {
        background-color: #419D81;
        border-bottom: none;
    }
    .tab-pan.active.show label {
        color: #276955;
        margin-left: 42px;
        font-size: 17px;
        margin-bottom: 17px;
        margin-top: 31px;
        font-weight: bold;
    }

    .tab-pan.active.show label.label-no-mb-0 {
        margin-bottom: 0px;
    }

    .tab-pan.active.show p {
        color: #565656;
        margin-left: 42px;
        font-weight: 300;
        font-size: 14px;
        line-height: 16px;
        width: 79%;
    }

    .tab-pan.active.show select {
        background: #FFFFFF;
        border: 0.75px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        margin-bottom: 0px;
        margin-top: 10px;
        margin-left: 22px;
        width: 87%;
    }

    .tab-pan.active.show div {
        background: #FFFFFF;
        border: 0.75px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        width: 89%;
    }

    .tab-pan.active.show div.my-profile input {
        background: #FFFFFF;
        border: 0.75px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        margin-left: 22px;
        width: 88.5%;
    }

    .tab-pan.active.show div.my-profile {
        border: unset;
        box-sizing: unset;
        box-shadow: unset;
        border-radius: unset;
        background: #F7F7F7;
    }

    .tab-pan.active.show.cont-unset div {
        border: unset;
        box-sizing: unset;
        box-shadow: unset;
        border-radius: unset;
        background: #F7F7F7;
    }

    .tab-pan.active.show img {
        background: #FFFFFF;
        border: 0.75px solid #6BBF3F;
        box-sizing: border-box;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        margin: 10px 22px;
        padding: 0px;
        width: 88%;
    }

    div.horizontal-line {
        border: unset !important;
        box-sizing: unset !important;
        box-shadow: unset !important;
        border-radius: unset !important;
        border: 0.5px solid rgba(0, 0, 0, 0.09) !important;
        margin: 39px auto 0px auto;
        width: 90%;
    }

    .button {
        background: #6BBF3F;
        border-radius: 20px;
        min-width: 155px;
        min-height: 40px;
        font-size: 14px;
        color: #fff;
        line-height: 16px;
        margin: 22px auto 0px auto;
        width: 155px;
    }

    div.tab-pan ckeditor {
        margin: 10px;
    }

    img.photo-icon {
        border: unset !important;
        border-radius: unset !important;
        box-shadow: unset !important;
    }

    .upload-label {
        margin: 0px auto !important;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
    }
}

@media (max-width: 720px) {
    .dashboard-list-box .dashboard-list-box-static ul {
        width: 50%;
    }
}

@media (max-width: 540px) {
    .dashboard-list-box .dashboard-list-box-static ul {
        width: 68%;
    }
}

@media (max-width: 460px) {
    .dashboard-list-box .dashboard-list-box-static ul {
        width: 80%;
    }
}

@media (max-width: 414px) {
    .dashboard-list-box .dashboard-list-box-static ul {
        width: 90%;
    }

    .tab-pan.active.show div {
        width: 90%;
        margin: 0px 18px;
    }
}

@media (max-width: 380px) {
    .dashboard-list-box .dashboard-list-box-static ul {
        width: 100%;
    }
}

@media (max-width: 360px) {
    .dashboard-list-box ul li.nav-item {
        min-width: 100px;
        min-width: 86px;
    }

    .button {
        margin: 22px 90px 0px 90px;
    }

    .tab-pan.active.show div {
        width: 90%;
        margin: 0px auto;
    }
}

</style>

