export const project_services_functions = {
    data() {
        return {
            clearCategory: false,
            selectedMain: "",
        }
    },
    methods: {
        searchTimeOut() {
            if (this.timer) {
                clearTimeout(this.timer);
                this.timer = null;
            }
            this.timer = setTimeout(() => {
                this.pushToRouter("title", this.filterQueries.title);
            }, 800);
        },
        applyCategory(val) {
            this.filterQueries.category = val;
            this.pushToRouter("category", val);
        },
        applyMainCategory(val, main) {
            this.clearCategory = true;
            let cats = [];
            val.forEach(elem => {
                cats.push(elem.title);
            });
            this.filterQueries.mainCategory = cats;
            this.selectedMain = main;
            localStorage.setItem("storedData", this.selectedMain);
            this.pushToRouter("mainCategory", cats);
        },
        // setFilters() {
        //     this.page = 1;
        //     // this.city = this.$route.query.city;
        //     this.filters.city = this.$route.query.city;
        //     this.filters.category = this.$route.query.category;
        //     this.filters.title = this.$route.query.title;
        //     if (this.$route.query.mainCategory) {
        //         this.filters.mainCategory = this.$route.query.mainCategory;
        //         this.selectedMain = localStorage.getItem("storedData");
        //     } else {
        //         this.filters.mainCategory = [];
        //     }
        // },
        setFilters() {
            this.page = 1;
            this.filterQueries.city = this.$route.query.city;
            this.filterQueries.category = this.$route.query.category;
            this.filterQueries.title = this.$route.query.title;
            if (this.$route.query.tags) {
                this.showTags=true;
                if (typeof this.$route.query.tags === "string") {
                    this.selectTag.push(this.$route.query.tags);
                } else {
                    this.selectTag = this.$route.query.tags;
                }
               this.filterQueries.tags.push(this.$route.query.tags);
            } else {
                this.filterQueries.tags = [];
            }
            if (this.$route.query.mainCategory) {
                this.filterQueries.mainCategory.push(this.$route.query.mainCategory);
                this.selectedMain = localStorage.getItem("storedData");
            } else {
                this.filterQueries.mainCategory = [];
            }
        },
        // clearTitleQuery(val) {
        //     if (val == 'mainCategory') {
        //         this.selectedMain = "";
        //         this.clearCategory = false;
        //         this.filterQueries.mainCategory = []
        //         localStorage.removeItem('storedData')
        //     } else {
        //         this.filterQueries[val] = null;
        //     }
        //     let newPath = {};
        //     let path = Object.assign({}, this.$route.query);
        //     delete path[val];
        //     newPath = path;
        //     this.$router.push({ query: { ...newPath } });
        // },
        clearQuery(val) {
            if (val == 'mainCategory') {
                this.selectedMain = "";
                this.clearCategory = false;
                this.filterQueries.mainCategory = [];
                localStorage.removeItem('storedData')
            } else if (val == 'tags') {
                this.filterQueries.tags = [];
            } else {
                this.filterQueries[val] = null
            }
            let newPath = {};
            // let path = JSON.parse(JSON.stringify(this.$route.query));
            let path = Object.assign({}, this.$route.query);
            delete path[val];
            newPath = path;
            this.$router.push({ query: newPath });
        },
        pushToRouter(prop, val) {
            let path = this.$route.query;
            let objToPush = {};
            for (const property in path) {
                objToPush[property] = path[property];
            }
            var prop = prop
            objToPush[prop] = val
            this.$router.push({ query: objToPush });
        },
        isActiveCat(val) {
            let cat = val.title;
            return cat == this.selectedMain;
        },
        async onChange() {
            this.isOpen = true;
            try {
                const res = await axios.get("autocomplete/search", {
                    params: { searchQuery: this.city }
                });
                this.items = res.data;
            } catch (error) {
                console.log(error.response.data);
            }
            this.filterResults();
        },
        filterResults() {
            this.results = this.items.filter(
                item =>
                    item.city
                        .toLowerCase()
                        .indexOf(this.filterQueries.city.toLowerCase()) > -1
            );
        },
        setResult(result) {
            this.clearCity = true;
            this.filterQueries.city = result.city;
            this.pushToRouter("city", result.city);
            this.isOpen =false;
        },
    },
}
