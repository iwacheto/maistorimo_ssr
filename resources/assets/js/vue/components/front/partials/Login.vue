<template>
  <div v-if="popupShow">
    <div class="mfp-bg my-mfp-zoom-in mfp-ready"></div>
    <div
      class="mfp-wrap mfp-close-btn-in mfp-auto-cursor my-mfp-zoom-in mfp-ready"
      tabindex="-1"
      style="top: 0px; position: absolute; height: 946px;"
    >
      <div class="mfp-container mfp-inline-holder">
        <div class="mfp-content">
          <div id="sign-in-dialog" class="zoom-anim-dialog">
            <div class="small-dialog-header">
              <h3>Вход/Регистрация</h3>
            </div>

            <!--Tabs -->
            <div class="sign-in-form style-1">
              <ul class="tabs-nav">
                <li class>
                  <a @click="showTab('login')">Вход</a>
                </li>
                <li>
                  <a @click="showTab('register')">Регистрация</a>
                </li>
              </ul>
              <div class="tabs-container alt">
                <!-- Login -->
                <div class="tab-content" id="tab1" v-if="tab == 'login'">
                  <form class="login" data-vv-scope="login">
                    <span v-if="loginData.commonError" class="error">{{loginData.commonError}}</span>
                    <p class="form-row form-row-wide email_val">
                      <label for="email">
                        Поща:
                        <i class="im im-icon-Male"></i>
                        <input
                          type="email"
                          class="input-text"
                          v-model="loginData.email"
                          name="loginEmail"
                          id="loginEmail"
                          @focus="makeFocus('email')"
                          @keyup.enter="login"
                          value
                          v-validate="'required|email'"
                        />
                        <small
                          v-show="errors.has('login.loginEmail')"
                          class="error"
                        >{{ errors.first('login.loginEmail') }}</small>
                        <span
                          v-if="loginData.emailError"
                          class="error"
                        >Паролата не съвпада с вашата парола</span>
                      </label>
                    </p>

                    <p class="form-row form-row-wide">
                      <label for="password">
                        Парола:
                        <i class="im im-icon-Lock-2"></i>
                        <input
                          class="input-text"
                          type="password"
                          v-model="loginData.password"
                          name="loginPassword"
                          id="loginPassword"
                          @keyup.enter="login"
                          @focus="makeFocus('password')"
                          v-validate="'required'"
                        />
                        <small
                          v-if="errors.has('login.loginPassword')"
                          class="error"
                        >{{ errors.first('login.loginPassword') }}</small>
                        <span
                          v-if="loginData.passwordError"
                          class="error"
                        >{{loginData.passwordError[0]}}</span>
                      </label>
                    </p>

                    <div class="form-row">
                      <input
                        type="submit"
                        @click.prevent="login"
                        class="button border margin-top-5"
                        name="login"
                        value="Влез"
                      />
                      <div class="checkboxes margin-top-10">
                        <input id="remember-me" type="checkbox" name="check" />
                        <label for="remember-me">Запомни ме</label>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- Register -->
                <div class="tab-content" id="tab2" v-if="tab == 'register'">
                  <div class="error_message" v-if="error_message">
                    {{ message }} 
                    <span @click="error_message=false" class="error_message_close">x</span>
                  </div>
                  <form
                    method="post"
                    class="register"
                    data-vv-scope="register"
                    v-if="invite == '4fi9uFjPgkIyZDskeLzO'"
                  >
                    <span v-if="registerData.commonError" class="error">{{registerData.commonError}}</span>
                    <p class="form-row form-row-wide">
                      <label for="username">
                        Потребителско име:
                        <i class="im im-icon-Male"></i>
                        <input
                          type="text"
                          @keyup.enter="register"
                          @blur="checkUsername"
                          class="input-text"
                          v-model="registerData.username"
                          name="registerUsername"
                          key="registerUsername"
                          id="username"
                          value
                          @focus="makeFocus('registerUsername')"
                          v-validate="'required|alpha|min:5'"
                        />
                        <small
                          v-if="errors.has('register.registerUsername')"
                          class="error"
                        >{{ errors.first('register.registerUsername') }}</small>
                        <span
                          v-if="registerData.usernameError"
                          class="error"
                        >{{registerData.usernameError[0]}}</span>
                      </label>
                    </p>

                    <p class="form-row form-row-wide">
                      <label for="email">
                        Поща:
                        <i class="im im-icon-Mail"></i>
                        <input
                          type="email"
                          @keyup.enter="register"
                           @blur="checkEmail"
                          class="input-text"
                          v-model="registerData.email"
                          name="registerEmail"
                          id="email"
                          value
                          key="registerEmail"
                          @focus="makeFocus('registerEmail')"
                          v-validate="'required|email'"
                        />
                        <small
                          v-show="errors.has('register.registerEmail')"
                          class="error"
                        >{{ errors.first('register.registerEmail') }}</small>
                        <span
                          v-if="registerData.emailError"
                          class="error"
                        >{{registerData.emailError[0]}}</span>
                      </label>
                    </p>

                    <p class="form-row form-row-wide">
                      <label for="password">
                        Парола:
                        <i class="im im-icon-Lock-2"></i>
                        <input
                          class="input-text"
                          @keyup.enter="register"
                          type="password"
                          v-model="registerData.password"
                          name="registerPassword"
                          id="password"
                          key="registerPassword"
                          @focus="makeFocus('registerPassword')"
                          v-validate="'required'"
                        />
                        <small
                          v-if="errors.has('register.registerPassword')"
                          class="error"
                        >{{ errors.first('register.registerPassword') }}</small>
                        <span
                          v-if="registerData.passwordError"
                          class="error"
                        >{{registerData.passwordError[0]}}</span>
                      </label>
                    </p>

                    <p class="form-row form-row-wide">
                      <label for="confirmPassword">
                        Повтори Парола:
                        <i class="im im-icon-Lock-2"></i>
                        <input
                          @keyup.enter="register"
                          class="input-text"
                          type="password"
                          v-model="registerData.confirmPassword"
                          name="confirmPassword"
                          id="confirmPassword"
                          v-validate="'required'"
                          key="confirmPassword"
                          @focus="makeFocus('registerConfirmPassword')"
                        />
                        <small
                          v-if="errors.has('register.confirmPassword')"
                          class="error"
                        >{{ errors.first('register.confirmPassword') }}</small>
                        <span
                          v-if="registerData.confirmPasswordError"
                          class="error"
                        >{{registerData.confirmPasswordError[0]}}</span>
                      </label>
                      <div class="checkboxes margin-top-10">
                        <input id="remember-me" type="checkbox" name="check" @change="isDisabled=!isDisabled"/>
                        <label for="remember-me">Съгласявам се с <span class="confirm_terms" tag="a" to="" @click="goGeneral">общите условия</span></label>
                      </div>
                    </p>
                    <input
                      type="button"
                      @click="register"
                      class="button border fw margin-top-10"
                      :disabled='isDisabled'
                      :class="[isDisabled ? 'disabled_button' : '']"
                      name="register"
                      value="Регистрирай се"
                    />
                  </form>
                  <div v-else>
                    <div v-if="!inviteRequested" class="invite_check">
                      <form>
                        <h1>Само с покана</h1>
                        <p>
                          Вмомента системата е в затворена бета версия и регистрацията се случва посредством покана.
                          Моля попълнете долните полета и ще разгледаме Вашата заявка и ще се свържем с Вас
                        </p>Поща:
                        <input type="text" v-model="inviteEmail" />
                        Телефон:
                        <input type="text" v-model="invitePhone" />
                        Причина:
                        <textarea v-model="inviteReason"></textarea>
                        <input
                          type="button"
                          @click="requestInvite"
                          class="button border fw margin-top-10"
                          name="register"
                          value="Изпрати"
                        />
                      </form>
                    </div>
                    <div v-else class="invite_check">
                      <p>Заявката Ви е приета. Ще се свържем с Вас на посочените от Вас контакти. Благодарим за проявения интерес.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <button title="Close (Esc)" type="button" class="mfp-close" @click="closePopup"></button> -->
            <button title="Close (Esc)" type="button" class="mfp-close" @click="closePopup"></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ["popupShow"],
  data() {
    return {
      message:'',
      error_message:false,
      isDisabled:true,
      loginData: {
        email: "",
        password: "",
        emailError: false,
        passwordError: false,
        commonError: false
      },
      registerData: {
        username: "",
        email: "",
        password: "",
        confirmPassword: "",
        usernameError: false,
        emailError: false,
        passwordError: false,
        confirmPasswordError: false,
        commonError: false
      },
      inviteEmail: null,
      invitePhone: null,
      inviteReason: null,
      invite: null,
      inviteRequested: null,
      error: {
        type: String,
        default: null
      },
      showFlag: false,
      tab: "login"
    };
  },
  computed: {},

  methods: {
    goGeneral(event){
       this.$emit("closePopup");
      this.$router.push({path:'/general_terms'})
    },
    async requestInvite() {
      try {
        const res = await axios.post("/request-invite", {
          email: this.inviteEmail,
          phone: this.invitePhone,
          reason: this.inviteReason
        });
        this.inviteRequested = true;
      } catch (error) {
        this.inviteRequested = true;
      }
    },
    showTab(val) {
      this.invite = this.$route.query["invite"];
      this.tab = val;
    },
    async checkUsername(){
      try{
        const responce=await axios.post('check_username',{username:this.registerData.username});
        if(responce.data){
           this.error_message=true;
           this.message='Съжаляваме,но потребителското име вече е заето!';
        }
      } catch(error){
        console.log(error);
      }
    },
     async checkEmail(){
      try{
        const responce=await axios.post('check_email',{email:this.registerData.email});
        if(responce.data){
           this.error_message=true;
           this.message='Съжаляваме,но имейла вече е зает!';
        }
      } catch(error){
        console.log(error);
      }
    },
    async register() {
      if (
        this.errors.has(('register.registerUsername') || ('register.registerEmail')  || ('register.registerPassword') ||('register.confirmPassword'))
      ) {
        return;
      } else if(this.isDisabled){
        return
      }
      else{
      try {
        const res = await axios.post("/register", {
          name: this.registerData.username,
          email: this.registerData.email,
          password: this.registerData.password,
          password_confirmation: this.registerData.confirmPassword
        });
        window.location.href = "/admin";
      } catch (error) {
        if (error.response.data.errors.name) {
          this.registerData.usernameError = error.response.data.errors.name;
        }
        if (error.response.data.errors.email) {
          console.log(error.response.data.errors.email);
          this.registerData.emailError = "Имейлът трябва да е валиден!";
          //   this.registerData.emailError = error.response.data.errors.email;
        }
        if (error.response.data.errors.password) {
          console.log(error.response.data.errors.password);
          if (
            error.response.data.errors.password[0] ===
            "Потвърждаването на поролата е грешно!"
          ) {
            return (this.registerData.confirmPasswordError =
              error.response.data.errors.password);
          }
          this.registerData.passwordError = error.response.data.errors.password;
        }
        console.log(error.response.data.errors);
      }
      }
      // .then(({ data }) => {
      //   console.log(data);
      //   window.location = data;
      //   if (!data.valid) {
      //     // this.sendAlert("User email must be confirmed!");
      //     // this.$refs.updateProfileButton.click();
      //   }
      // });
    },
    async login() {
      if (!this.loginData.email || !this.loginData.password) {
        return (this.loginData.commonError =
          "Имейлът или паролата са задължителни!");
      }
      try {
        const res = await axios.post("/login", {
          email: this.loginData.email,
          password: this.loginData.password
        });
        window.location.href = "/admin";
        console.log(res.data);
      } catch (error) {
        if (error.response.data.errors.email) {
          this.loginData.emailError = error.response.data.errors.email;
        }
        if (error.response.data.errors.password) {
          this.loginData.passwordError = error.response.data.errors.password;
        }
        console.log(error.response.data.errors);
      }
    },
    makeFocus(name) {
      if (name === "email") {
        this.loginData.emailError = false;
      }
      if (name === "password") {
        this.loginData.passwordError = false;
      }
      if (name === "registerEmail") {
        this.registerData.emailError = false;
      }
      if (name === "registerUsername") {
        this.registerData.usernameError = false;
      }
      if (name === "registerPassword") {
        this.registerData.passwordError = false;
      }
      if (name === "registerConfirmPassword") {
        this.registerData.confirmPasswordError = false;
      }
      this.loginData.commonError = false;
      this.registerData.commonError = false;
    },

    closePopup(event) {
      this.$emit("closePopup");
    }
  }
};
</script>

<style scoped>
p.form-row-wide:first {
  height: 140px;
}
small {
  color: crimson;
  margin-left: 25px;
  display: block;
  font-family: "Raleway", "HelveticaNeue", "Helvetica Neue", Helvetica, Arial,
    sans-serif;
  text-transform: none;
  font-size: 14px;
}
.invite_check {
  color: #8d8c8c;
  font-size: 15px;
}
.invite_check h1 {
  text-align: center;
  color: #464444;
}
span {
  display: inline-block;
  margin-left: 25px;
  color: crimson;
}
</style>


