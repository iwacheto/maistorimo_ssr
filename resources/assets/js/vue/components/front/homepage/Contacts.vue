<template>
  <div>
    <!-- Map Container -->
    <div class="contact-map margin-bottom-60">
      <!-- Google Maps -->
      <div id="singleListingMap-container" class="contact_map">
      <gmap-map :center="center" :zoom="16" style="width:100%;  height: 400px;">
      <gmap-marker
        :key="index"
        v-for="(m, index) in markers"
        :position="m.position"
        @click="center=m.position"
      ></gmap-marker>
    </gmap-map>
    </div>
      <!-- Google Maps / End -->
    </div>
    <div class="clearfix"></div>
    <!-- Map Container / End -->

    <!-- Container / Start -->
    <div class="container">
      <div class="row">
        <!-- Contact Details -->
        <div class="col-md-4">
          <h4 class="headline margin-bottom-30">Намери ни тук</h4>

          <!-- Contact Details -->
          <div class="sidebar-textbox">
            <p>За справки и информация използвайте следните данни за контакт.</p>

            <ul class="contact-details">
              <li>
                <i class="im im-icon-Phone-2"></i>
                <strong>Телефон:</strong>
                <span>+359878735795</span>
              </li>
              <li>
                <i class="im im-icon-Fax"></i>
                <strong>Адрес:</strong>
                <span>Плевен, Булевард Русе 19</span>
              </li>
              <li>
                <i class="im im-icon-Envelope"></i>
                <strong>Имейл:</strong>
                <span>
                  <a href="#">office@maistorimo.bg</a>
                </span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="col-md-8">
          <section id="contact">
            <h4 class="headline margin-bottom-35">Контактна форма</h4>

            <div id="contact-message"></div>

            <form
              name="contactform"
              id="contactform"
              autocomplete="on"
              @submit.prevent="submitData"
            >
              <div class="row">
                <div class="col-md-6">
                  <div>
                    <div v-if="contactData.commonError" class="contact_error">
                      {{responce}}
                      <button @click="hideErrors" class="error_button">x</button>
                    </div>
                    <input
                      type="text"
                      v-model="contactData.name"
                      v-validate="'required'"
                      id="name"
                      name="name"
                      class="form-control"
                      :class="{ 'is-invalid': errors.has('name') }"
                      placeholder="Your Name"
                    />
                    <small
                      v-if="errors.has('name')"
                      class="invalid-feedback"
                    >{{ errors.first('name') }}</small>
                    <span
                      v-if="contactData.nameError"
                      class="error"
                    >Паролата не съвпада с вашата парола</span>
                  </div>
                </div>

                <div class="col-md-6">
                  <div>
                    <input
                      type="text"
                      v-model="contactData.email"
                      v-validate="'required'"
                      id="email"
                      name="email"
                      class="form-control"
                      :class="{ 'is-invalid': errors.has('email') }"
                      placeholder="Email Address"
                      pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$"
                    />

                    <small
                      v-if="errors.has('email')"
                      class="invalid-feedback"
                    >{{ errors.first('email') }}</small>
                    <span
                      v-if="contactData.emailError"
                      class="error"
                    >Паролата не съвпада с вашата парола</span>
                  </div>
                </div>
              </div>

              <div>
                <input
                  type="text"
                  v-model="contactData.subject"
                  v-validate="'required'"
                  id="subject"
                  name="subject"
                  class="form-control"
                  :class="{ 'is-invalid': errors.has('subject') }"
                  placeholder="Subject"
                />

                <small
                  v-if="errors.has('subject')"
                  class="invalid-feedback"
                >{{ errors.first('subject') }}</small>
                <span
                  v-if="contactData.subjectError"
                  class="error"
                >Паролата не съвпада с вашата парола</span>
              </div>

              <div>
                <textarea
                  v-model="contactData.msg"
                  v-validate="'required'"
                  name="msg"
                  class="form-control"
                  :class="{ 'is-invalid': errors.has('msg') }"
                  cols="40"
                  rows="3"
                  id="body"
                  placeholder="Message"
                ></textarea>

                <small v-if="errors.has('msg')" class="invalid-feedback">{{ errors.first('msg') }}</small>
                <span v-if="contactData.msgError" class="error">Паролата не съвпада с вашата парола</span>
              </div>
              <div class="captcha_content">
                <div
                  class="g-recaptcha"
                  id="recaptcha"
                  data-sitekey="6Lc9f8kUAAAAAOTS7GfEFiNj30U5mGbIGQsjKMsT"
                ></div>
              </div>

              <input type="submit" class="submit button" id="submit" value="Submit Message" />
            </form>
          </section>
        </div>
        <!-- Contact Form / End -->
      </div>
    </div>
    <!-- Container / End -->
  </div>
</template>

<script>
import GoogleMap from "../../components/googleMap/GoogleMap";
import axios from "axios";

export default {
  data() {
    return {
       center: { lat: 43.411995, lng: 24.624296 },
      markers: [
        {
          position: {
            lat: 43.411995,
            lng: 24.624296
          }
        }
      ],
      places: [],
      currentPlace: null,
      email: "",
      responce: "",
      contactData: {
        name: "",
        email: "",
        subject: "",
        msg: "",
        nameError: false,
        emailError: false,
        subjectError: false,
        msgError: false,
        commonError: false
      },
      error: {
        type: String,
        default: null
      },
      showFlag: false,
      tab: "login"
    };
  },
  mounted() {
    this.geolocate();
  },
  methods: {
    submitData(event) {
      this.$validator.validate().then(valid => {
        if (valid) {
          this.setData(event);
        }
      });
    },
    async setData(event) {
      try {
        let recaptcha_response_value =
          event.target["g-recaptcha-response"].value;
        let res = await axios.post("/contacts", {
          name: this.contactData.name,
          email: this.contactData.email,
          subject: this.contactData.subject,
          msg: this.contactData.msg,
          token: recaptcha_response_value
        });
        console.log(res.data);
        this.contactData.commonError = true;
        this.contactData.name = "";
        this.contactData.email = "";
        this.contactData.subject = "";
        this.contactData.msg = "";
        this.$validator.reset();
        this.errors.clear();
        this.responce = res.data;
        grecaptcha.reset();
        // console.log(res.data);
      } catch (error) {
        this.responce = error.data;
      }
    },
    hideErrors() {
      this.contactData.commonError = false;
    },
    onCaptchaExpired: function() {
      this.$refs.recaptcha.reset();
    },
    createCaptcha() {
      setTimeout(function() {
        grecaptcha.render("recaptcha", {
          sitekey: "6Lc9f8kUAAAAAOTS7GfEFiNj30U5mGbIGQsjKMsT",
          callback: function() {}
        });
      }, 1600);
    },
    // receives a place object via the autocomplete component
    setPlace(place) {
      this.currentPlace = place;
    },
    addMarker() {
      if (this.currentPlace) {
        const marker = {
          lat: this.currentPlace.geometry.location.lat(),
          lng: this.currentPlace.geometry.location.lng()
        };
        this.markers.push({ position: marker });
        this.places.push(this.currentPlace);
        this.center = marker;
        this.currentPlace = null;
      }
    },
    geolocate: function() {
      navigator.geolocation.getCurrentPosition(position => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
      });
    }
  },
  components: {
    GoogleMap
  },
  created() {
    this.createCaptcha();
  }
};
</script>

<style scoped>
div.contact_error {
  position: absolute;
  width: 500px;
  height: 150px;
  border: 3px solid#2F855A;
  color: #2f855a;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border-radius: 20px;
  z-index: 9;
  vertical-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #fefefe;
}
.error_button {
  position: absolute;
  top: 25px;
  right: 25px;
  background: transparent;
  border: 1px solid #2f855a;
  /* border-radius:50%  */
}
.invalid-feedback {
  color: rgb(248, 70, 106);
}
.col-md-6 div {
  min-height: 110px;
}
.col-md-6 div input {
  margin-bottom: 15px !important;
}
.is-invalid {
  border: 1px solid rgb(248, 70, 106);
}
h4.headline {
  color: #48bb78;
}
div.captcha_content {
  margin-bottom: 25px;
}
div.contact_map {
  max-width: 70%;
  margin: 30px auto;
}
</style>