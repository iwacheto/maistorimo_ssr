export const analyticFunction = {
  data() {
    return {
      showPhone: true,
    }
  },
  methods: {
    contactAnalytic(type) {
      let id;
      if (this.profile) {
        id = this.profile.id;
      } else {
        id = this.vendorDetails.user;
      }

      if (type == 'phone') {
        this.showPhone = !this.showPhone;
      }
      let currentDateWithFormat = new Date()
        .toJSON()
        .slice(0, 10)
        .replace(/-/g, "-");
      axios
        .post("/contact_analytcs", {
          user: id,
          // project: this.id,
          object_type: type,
          date: currentDateWithFormat,
          token: this.uniqueToken
        })
        .then(res => {
          // console.log(res);
        })
        .catch(error => {
          console.log(error);
        });
    },
    hidePhone() {
      this.showPhone = !this.showPhone;
    },
    removeHead() {
      if (document.querySelector('head meta[property="og:title"]')) {
        document.querySelector('head meta[property="og:title"]').remove();
      }
      if (document.querySelector('head meta[property="og:image"]')) {
        document.querySelector('head meta[property="og:image"]').remove();
      }
      if (document.querySelector('head meta[property="description"]')) {
        document.querySelector('head meta[property="description"]').remove();
      }
      if (document.querySelector('head meta[name="description"]')) {
        document.querySelector('head meta[name="description"]').remove();
      }
    },
    setHead(title, img,desc) {
      document.title = title;
      // OG Title
      const link = document.createElement("meta");
      link.setAttribute("property", "og:title");
      link.content = title;
      const url = document.getElementsByTagName("head")[0].prepend(link);
      // OG Image
      const image = document.createElement("meta");
      image.setAttribute("property", "og:image");
      image.content = img;
      document.getElementsByTagName("head")[0].prepend(image);
       // Meta Description
       const description = document.createElement("meta");
       description.setAttribute("property", "description");
       const descrReal = desc
         .split(" ")
         .slice(0, 149)
         .join(" ");
       description.content = descrReal;
        document
         .getElementsByTagName("head")[0]
         .prepend(description);
          // Page Description
       const pageDescription = document.createElement("meta");
       pageDescription.setAttribute('name','description');
       pageDescription.content = descrReal;
       const pageDesc = document
         .getElementsByTagName("head")[0]
         .prepend(pageDescription);
    }
  }
}
